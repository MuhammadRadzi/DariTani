<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsMarketplaceData;
use Tests\TestCase;

class OrderHistoryTest extends TestCase
{
    use RefreshDatabase;
    use BuildsMarketplaceData;

    private function createOrderForBuyer($buyer, $product, int $qty = 3, string $status = 'pending'): Order
    {
        $order = Order::create([
            'id_customer' => $buyer->id_customer,
            'order_number' => 1,
            'order_date' => now()->toDateString(),
            'total_amount' => $qty * $product->price_per_kg,
            'status' => $status,
            'delivery_address' => $buyer->address,
        ]);

        OrderItem::create([
            'id_order' => $order->id_order,
            'id_product' => $product->id_product,
            'qty' => $qty,
            'price' => $product->price_per_kg,
            'subtotal' => $qty * $product->price_per_kg,
        ]);

        return $order;
    }

    public function test_customer_bisa_melihat_daftar_pesanannya(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct();
        $this->createOrderForBuyer($buyer, $product, 2);

        $response = $this->actingAs($buyer->user)->get(route('pesanan.index'));

        $response->assertOk();
        $response->assertSee('Pesanan Saya');
        $response->assertSee('Wortel Uji');
        $response->assertSee('Pesanan #1');
    }

    public function test_customer_hanya_melihat_pesanan_milik_sendiri(): void
    {
        $buyerA = $this->makeBuyer('a@example.test');
        $buyerB = $this->makeBuyer('b@example.test');
        [, $product] = $this->makeSellerWithProduct();

        $this->createOrderForBuyer($buyerA, $product, 2);
        $orderB = $this->createOrderForBuyer($buyerB, $product, 5);

        $response = $this->actingAs($buyerA->user)->get(route('pesanan.index'));

        $response->assertOk();
        $response->assertDontSee('5 Kg');
    }

    public function test_customer_bisa_filter_status_pesanan(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct();

        $this->createOrderForBuyer($buyer, $product, 2, 'pending');
        $this->createOrderForBuyer($buyer, $product, 4, 'completed');

        $response = $this->actingAs($buyer->user)->get(route('pesanan.index', ['status' => 'completed']));

        $response->assertOk();
        $response->assertSee('4 Kg');
        $response->assertDontSee('2 Kg');
    }

    public function test_customer_bisa_membatalkan_pesanan_pending_dan_stok_kembali(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct(['stock_qty' => 45]);
        $order = $this->createOrderForBuyer($buyer, $product, 5, 'pending');

        $this->actingAs($buyer->user)
            ->patch(route('pesanan.cancel', $order))
            ->assertRedirect();

        $this->assertSame('cancelled', $order->fresh()->status);
        $this->assertNotNull($order->fresh()->cancelled_at);
        $this->assertEquals(50, (float) $product->fresh()->stock_qty);
    }

    public function test_customer_tidak_bisa_membatalkan_pesanan_yang_sudah_dibayar_atau_selesai(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct(['stock_qty' => 45]);
        $order = $this->createOrderForBuyer($buyer, $product, 5, 'paid');

        $this->actingAs($buyer->user)
            ->patch(route('pesanan.cancel', $order))
            ->assertRedirect();

        $this->assertSame('paid', $order->fresh()->status);
        $this->assertEquals(45, (float) $product->fresh()->stock_qty);
    }

    public function test_customer_tidak_bisa_membatalkan_pesanan_customer_lain(): void
    {
        $buyerA = $this->makeBuyer('a@example.test');
        $buyerB = $this->makeBuyer('b@example.test');
        [, $product] = $this->makeSellerWithProduct(['stock_qty' => 45]);
        $orderA = $this->createOrderForBuyer($buyerA, $product, 5, 'pending');

        $this->actingAs($buyerB->user)
            ->patch(route('pesanan.cancel', $orderA))
            ->assertForbidden();

        $this->assertSame('pending', $orderA->fresh()->status);
        $this->assertEquals(45, (float) $product->fresh()->stock_qty);
    }

    public function test_format_wa_url_menghasilkan_url_whatsapp_dengan_struk(): void
    {
        $buyer = $this->makeBuyer();
        [, $product] = $this->makeSellerWithProduct();
        $order = $this->createOrderForBuyer($buyer, $product, 2);

        $waUrl = $order->formatWaUrl();

        $this->assertNotNull($waUrl);
        $this->assertStringContainsString('https://wa.me/628123456789', $waUrl);
        $this->assertStringContainsString('STRUK+PESANAN', $waUrl);
        $this->assertStringContainsString('Wortel+Uji', $waUrl);
    }
}
