<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsMarketplaceData;
use Tests\TestCase;

/**
 * Temuan A4: stok diperiksa di keranjang, dikurangi saat checkout,
 * dan dikembalikan saat pesanan dibatalkan petani.
 */
class CartStockTest extends TestCase
{
    use RefreshDatabase;
    use BuildsMarketplaceData;

    private function stok(Product $product): float
    {
        return (float) $product->fresh()->stock_qty;
    }

    public function test_tambah_melebihi_stok_ditolak(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct(['stock_qty' => 50]);

        $this->actingAs($buyer->user)
            ->postJson(route('keranjang.store'), [
                'id_product' => $product->id_product,
                'qty' => 51,
            ])
            ->assertStatus(422)
            ->assertJsonFragment(['message' => 'Stok Wortel Uji tersisa 50 Kg.']);

        $this->assertSame(0, CartItem::count());
    }

    public function test_tambah_berulang_yang_totalnya_melebihi_stok_ditolak(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct(['stock_qty' => 5]);
        $item = $this->addToCart($buyer, $product, 4);

        $this->actingAs($buyer->user)
            ->postJson(route('keranjang.store'), [
                'id_product' => $product->id_product,
                'qty' => 2,
            ])
            ->assertStatus(422);

        $this->assertEquals(4, (float) $item->fresh()->qty);
    }

    public function test_ubah_jumlah_melebihi_stok_ditolak(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct(['stock_qty' => 50]);
        $item = $this->addToCart($buyer, $product, 2);

        $this->actingAs($buyer->user)
            ->patchJson(route('keranjang.update', $item), ['qty' => 51])
            ->assertStatus(422);

        $this->assertEquals(2, (float) $item->fresh()->qty);
    }

    public function test_produk_tidak_tersedia_ditolak(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct(['is_available' => false]);

        $this->actingAs($buyer->user)
            ->postJson(route('keranjang.store'), ['id_product' => $product->id_product])
            ->assertStatus(422)
            ->assertJsonFragment(['message' => 'Wortel Uji sedang tidak tersedia.']);

        $this->assertSame(0, CartItem::count());
    }

    public function test_checkout_mengurangi_stok_dan_mengosongkan_keranjang(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct(['stock_qty' => 50]);
        $this->addToCart($buyer, $product, 3);

        $this->actingAs($buyer->user)
            ->post(route('checkout'), ['id_farm' => $product->id_farm])
            ->assertRedirectContains('wa.me/628123456789');

        $this->assertEquals(47, $this->stok($product));
        $this->assertSame(1, Order::count());
        $this->assertSame(0, CartItem::count());
    }

    public function test_checkout_ditolak_kalau_stok_berkurang_setelah_masuk_keranjang(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct(['stock_qty' => 50]);
        $item = $this->addToCart($buyer, $product, 10);

        // Stok berubah setelah barang masuk keranjang (misalnya petani mengubahnya).
        $product->forceFill(['stock_qty' => 5])->save();

        $this->actingAs($buyer->user)
            ->post(route('checkout'), ['id_farm' => $product->id_farm])
            ->assertSessionHas('error');

        $this->assertEquals(5, $this->stok($product));
        $this->assertSame(0, Order::count());
        $this->assertNotNull($item->fresh());
    }

    public function test_pembatalan_pesanan_oleh_petani_mengembalikan_stok(): void
    {
        $buyer = $this->makeBuyer();
        [$sellerUser, $product] = $this->makeSellerWithProduct(['stock_qty' => 50]);
        $this->addToCart($buyer, $product, 3);

        $this->actingAs($buyer->user)
            ->post(route('checkout'), ['id_farm' => $product->id_farm]);

        $this->assertEquals(47, $this->stok($product));

        $order = Order::first();

        $this->actingAs($sellerUser)
            ->patch(route('pesanan-masuk.status', $order), ['status' => 'cancelled'])
            ->assertRedirect();

        $this->assertSame('cancelled', $order->fresh()->status);
        $this->assertEquals(50, $this->stok($product));
    }
}
