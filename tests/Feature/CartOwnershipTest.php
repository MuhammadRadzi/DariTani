<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Temuan A1: item keranjang hanya boleh diubah/dihapus oleh pemiliknya.
 *
 * Kalau ada kolom wajib lain di tabel yang tidak kuketahui (misalnya di
 * category), tambahkan di helper di bawah.
 */
class CartOwnershipTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(string $email, string $role): User
    {
        return User::create([
            'name_user' => 'Uji ' . $email,
            'email_user' => $email,
            'role' => $role,
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make('password123'),
        ]);
    }

    /** Pembeli lengkap dengan profil customer dan keranjangnya. */
    private function makeBuyerWithCart(string $email): array
    {
        $user = $this->makeUser($email, 'customer');
        $customer = Customer::create(['id_user' => $user->id_user]);
        $cart = Cart::create(['id_customer' => $customer->id_customer]);

        return [$user, $cart];
    }

    private function makeProduct(): Product
    {
        $farmerUser = $this->makeUser('petani@example.test', 'farmer');

        $farmer = Farmer::create([
            'id_user' => $farmerUser->id_user,
            'farm_name' => 'Kebun Uji',
            'location' => 'Malino',
            'address' => 'Jl. Uji No. 1',
            'whatsapp_number' => '628123456789',
        ]);

        $farm = Farm::create([
            'id_farmer' => $farmer->id_farmer,
            'name_farm' => 'Kebun Uji 1',
            'location' => 'Malino',
        ]);

        $category = Category::create(['name_category' => 'Sayuran']);

        return Product::create([
            'id_farm' => $farm->id_farm,
            'id_category' => $category->id_category,
            'product_name' => 'Wortel Uji',
            'price_per_kg' => 10000,
            'stock_qty' => 50,
        ]);
    }

    /** Item milik A (qty 2), dan B yang login sebagai pembeli lain. */
    private function setUpTwoBuyers(): array
    {
        $product = $this->makeProduct();

        [$userA, $cartA] = $this->makeBuyerWithCart('a@example.test');
        [$userB] = $this->makeBuyerWithCart('b@example.test');

        $itemA = CartItem::create([
            'id_cart' => $cartA->id_cart,
            'id_product' => $product->id_product,
            'qty' => 2,
        ]);

        return [$userA, $userB, $itemA];
    }

    public function test_pembeli_lain_tidak_bisa_mengubah_item_keranjang(): void
    {
        [, $userB, $itemA] = $this->setUpTwoBuyers();

        $this->actingAs($userB)
            ->patch(route('keranjang.update', $itemA), ['qty' => 999])
            ->assertForbidden();

        $this->assertEquals(2, (float) $itemA->fresh()->qty);
    }

    public function test_pembeli_lain_tidak_bisa_menghapus_item_keranjang(): void
    {
        [, $userB, $itemA] = $this->setUpTwoBuyers();

        $this->actingAs($userB)
            ->delete(route('keranjang.destroy', $itemA))
            ->assertForbidden();

        $this->assertNotNull($itemA->fresh());
    }

    public function test_pemilik_bisa_mengubah_item_keranjangnya(): void
    {
        [$userA, , $itemA] = $this->setUpTwoBuyers();

        $this->actingAs($userA)
            ->patch(route('keranjang.update', $itemA), ['qty' => 5])
            ->assertRedirect();

        $this->assertEquals(5, (float) $itemA->fresh()->qty);
    }

    public function test_pemilik_bisa_menghapus_item_keranjangnya(): void
    {
        [$userA, , $itemA] = $this->setUpTwoBuyers();

        $this->actingAs($userA)
            ->delete(route('keranjang.destroy', $itemA))
            ->assertRedirect();

        $this->assertNull($itemA->fresh());
    }
}
