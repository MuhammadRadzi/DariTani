<?php

namespace Tests\Concerns;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Pembuat data uji bersama untuk tes keranjang, stok, dan pesanan.
 *
 * Memakai unguarded() pada kolom yang tidak pasti masuk $fillable (phone,
 * address, whatsapp_number, is_available), supaya data uji tidak diam-diam
 * kehilangan nilainya.
 *
 * Kalau ada kolom wajib lain di tabel category atau farm yang tidak kuketahui,
 * tambahkan di sini.
 */
trait BuildsMarketplaceData
{
    protected function makeUser(string $email, string $role): User
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

    /** Pembeli dengan profil lengkap (No. HP dan alamat terisi, siap checkout). */
    protected function makeBuyer(string $email = 'pembeli@example.test'): Customer
    {
        $user = $this->makeUser($email, 'customer');

        return Customer::unguarded(fn () => Customer::create([
            'id_user' => $user->id_user,
            'phone' => '081234567890',
            'address' => 'Jl. Uji No. 1, Makassar',
        ]));
    }

    /**
     * Petani + satu kebun + satu produk.
     * Mengembalikan [akun petani, produk].
     */
    protected function makeSellerWithProduct(array $productOverrides = []): array
    {
        $user = $this->makeUser('petani@example.test', 'farmer');

        $farmer = Farmer::unguarded(fn () => Farmer::create([
            'id_user' => $user->id_user,
            'farm_name' => 'Kebun Uji',
            'location' => 'Malino',
            'address' => 'Jl. Uji No. 2',
            'whatsapp_number' => '628123456789',
        ]));

        $farm = Farm::create([
            'id_farmer' => $farmer->id_farmer,
            'name_farm' => 'Kebun Uji 1',
            'location' => 'Malino',
        ]);

        $category = Category::create(['name_category' => 'Sayuran']);

        $product = Product::unguarded(fn () => Product::create(array_merge([
            'id_farm' => $farm->id_farm,
            'id_category' => $category->id_category,
            'product_name' => 'Wortel Uji',
            'price_per_kg' => 10000,
            'stock_qty' => 50,
        ], $productOverrides)));

        return [$user, $product];
    }

    protected function addToCart(Customer $buyer, Product $product, int $qty): CartItem
    {
        $cart = Cart::firstOrCreate(['id_customer' => $buyer->id_customer]);

        return CartItem::create([
            'id_cart' => $cart->id_cart,
            'id_product' => $product->id_product,
            'qty' => $qty,
        ]);
    }
}
