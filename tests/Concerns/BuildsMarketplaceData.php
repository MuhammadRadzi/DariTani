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
            'name_user'     => 'Uji ' . $email,
            'email_user'    => $email,
            'role'          => $role,
            'is_active'     => true,
            'login_with'    => 'email',
            'password_hash' => Hash::make('password123'),
        ]);
    }

    /** Pembeli dengan profil lengkap (No. HP dan alamat terisi, siap checkout). */
    protected function makeBuyer(string $email = 'pembeli@example.test'): Customer
    {
        $user = $this->makeUser($email, 'customer');

        return Customer::unguarded(fn () => Customer::create([
            'id_user' => $user->id_user,
            'phone'   => '081234567890',
            'address' => 'Jl. Uji No. 1, Makassar',
        ]));
    }

    /**
     * Mengembalikan User (role customer) yang sudah punya profil Customer.
     * Cocok untuk actingAs() di tes halaman beranda customer.
     */
    protected function buatCustomer(string $email = 'customer@example.test'): User
    {
        $user = $this->makeUser($email, 'customer');

        Customer::unguarded(fn () => Customer::create([
            'id_user' => $user->id_user,
            'phone'   => '081234567890',
            'address' => 'Jl. Uji No. 1',
        ]));

        return $user;
    }

    /**
     * Buat petani + farm + satu produk; kembalikan Farm.
     *
     * @param  string|null    $nameFarm     Nama farm (default auto-generate)
     * @param  string|null    $nameProduct  Nama produk (default auto-generate)
     * @param  Category|null  $category     Kategori produk (default dibuat baru)
     */
    protected function buatKebunDenganProduk(
        ?string $nameFarm    = null,
        ?string $nameProduct = null,
        ?Category $category  = null,
    ): Farm {
        static $counter = 0;
        $counter++;

        $email  = "petani{$counter}@example.test";
        $user   = $this->makeUser($email, 'farmer');

        $farmer = Farmer::unguarded(fn () => Farmer::create([
            'id_user'          => $user->id_user,
            'farm_name'        => $nameFarm ?? "Kebun Uji {$counter}",
            'location'         => 'Makassar',
            'address'          => 'Jl. Uji No. ' . $counter,
            'whatsapp_number'  => '62812345678' . str_pad($counter, 2, '0', STR_PAD_LEFT),
        ]));

        $farm = Farm::create([
            'id_farmer' => $farmer->id_farmer,
            'name_farm' => $nameFarm ?? "Kebun Uji {$counter}",
            'location'  => 'Makassar',
        ]);

        $cat = $category ?? Category::create(['name_category' => "Kategori Uji {$counter}"]);

        Product::unguarded(fn () => Product::create([
            'id_farm'      => $farm->id_farm,
            'id_category'  => $cat->id_category,
            'product_name' => $nameProduct ?? "Produk Uji {$counter}",
            'price_per_kg' => 10000,
            'stock_qty'    => 50,
            'is_available' => true,
        ]));

        return $farm;
    }

    /**
     * Petani + satu kebun + satu produk.
     * Mengembalikan [akun petani, produk].
     */
    protected function makeSellerWithProduct(array $productOverrides = []): array
    {
        $user = $this->makeUser('petani@example.test', 'farmer');

        $farmer = Farmer::unguarded(fn () => Farmer::create([
            'id_user'          => $user->id_user,
            'farm_name'        => 'Kebun Uji',
            'location'         => 'Malino',
            'address'          => 'Jl. Uji No. 2',
            'whatsapp_number'  => '628123456789',
        ]));

        $farm = Farm::create([
            'id_farmer' => $farmer->id_farmer,
            'name_farm' => 'Kebun Uji 1',
            'location'  => 'Malino',
        ]);

        $category = Category::create(['name_category' => 'Sayuran']);

        $product = Product::unguarded(fn () => Product::create(array_merge([
            'id_farm'      => $farm->id_farm,
            'id_category'  => $category->id_category,
            'product_name' => 'Wortel Uji',
            'price_per_kg' => 10000,
            'stock_qty'    => 50,
        ], $productOverrides)));

        return [$user, $product];
    }

    protected function addToCart(Customer $buyer, Product $product, int $qty): CartItem
    {
        $cart = Cart::firstOrCreate(['id_customer' => $buyer->id_customer]);

        return CartItem::create([
            'id_cart'    => $cart->id_cart,
            'id_product' => $product->id_product,
            'qty'        => $qty,
        ]);
    }
}

