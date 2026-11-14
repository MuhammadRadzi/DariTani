<?php

namespace Tests\Feature;

use App\Models\CartItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsMarketplaceData;
use Tests\TestCase;

/**
 * Temuan A7: satu aturan jumlah di semua tempat, yaitu kelipatan 1 kg
 * (bilangan bulat, minimal 1).
 */
class CartQuantityTest extends TestCase
{
    use RefreshDatabase;
    use BuildsMarketplaceData;

    public function test_jumlah_pecahan_ditolak_saat_tambah_ke_keranjang(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct();

        $this->actingAs($buyer->user)
            ->postJson(route('keranjang.store'), [
                'id_product' => $product->id_product,
                'qty' => 0.5,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors('qty');

        $this->assertSame(0, CartItem::count());
    }

    public function test_jumlah_pecahan_ditolak_saat_ubah_jumlah(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct();
        $item = $this->addToCart($buyer, $product, 2);

        $this->actingAs($buyer->user)
            ->patchJson(route('keranjang.update', $item), ['qty' => 0.5])
            ->assertStatus(422)
            ->assertJsonValidationErrors('qty');

        $this->assertEquals(2, (float) $item->fresh()->qty);
    }

    public function test_jumlah_bulat_diterima(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct();

        $this->actingAs($buyer->user)
            ->postJson(route('keranjang.store'), [
                'id_product' => $product->id_product,
                'qty' => 3,
            ]);

        $this->assertEquals(3, (float) CartItem::first()->qty);
    }
}
