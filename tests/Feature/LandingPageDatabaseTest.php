<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\Concerns\BuildsMarketplaceData;
use Tests\TestCase;

class LandingPageDatabaseTest extends TestCase
{
    use RefreshDatabase, BuildsMarketplaceData;

    public function test_katalog_landing_page_menampilkan_produk_dari_database(): void
    {
        $cat = Category::factory()->create(['name_category' => 'Sayuran Segar']);
        $farm = $this->buatKebunDenganProduk(
            nameFarm: 'Kebun Puncak Malino',
            nameProduct: 'Wortel Organik Super',
            category: $cat,
        );

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Wortel Organik Super');
        $response->assertSee('Sayuran Segar');
        $response->assertSee('Kebun Puncak Malino');
        $response->assertSee('Rp 10.000');
    }

    public function test_produk_yang_tidak_tersedia_tidak_ditampilkan_di_landing_page(): void
    {
        $cat = Category::factory()->create(['name_category' => 'Umbi']);
        $farm = $this->buatKebunDenganProduk(
            nameFarm: 'Kebun Uji',
            nameProduct: 'Produk Tersedia',
            category: $cat,
        );

        // Buat produk tidak tersedia
        Product::unguarded(fn () => Product::create([
            'id_farm' => $farm->id_farm,
            'id_category' => $cat->id_category,
            'product_name' => 'Kentang Habis Musim',
            'price_per_kg' => 12000,
            'stock_qty' => 50,
            'is_available' => false,
        ]));

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Produk Tersedia');
        $response->assertDontSee('Kentang Habis Musim');
    }

    public function test_produk_dengan_stok_nol_tidak_ditampilkan_di_landing_page(): void
    {
        $cat = Category::factory()->create(['name_category' => 'Sayuran']);
        $farm = $this->buatKebunDenganProduk(
            nameFarm: 'Kebun Uji 2',
            nameProduct: 'Bayam Tersedia',
            category: $cat,
        );

        // Buat produk stok 0
        Product::unguarded(fn () => Product::create([
            'id_farm' => $farm->id_farm,
            'id_category' => $cat->id_category,
            'product_name' => 'Kangkung Stok Kosong',
            'price_per_kg' => 5000,
            'stock_qty' => 0,
            'is_available' => true,
        ]));

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Bayam Tersedia');
        $response->assertDontSee('Kangkung Stok Kosong');
    }

    public function test_tab_kategori_hanya_menampilkan_kategori_yang_memiliki_produk_aktif(): void
    {
        $catAdaProduk = Category::factory()->create(['name_category' => 'Buah Malino']);
        $catKosong = Category::factory()->create(['name_category' => 'Kategori Tanpa Produk']);

        $this->buatKebunDenganProduk(
            nameFarm: 'Kebun Buah',
            nameProduct: 'Stroberi Manis',
            category: $catAdaProduk,
        );

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Buah Malino');
        $response->assertDontSee('Kategori Tanpa Produk');
    }

    public function test_landing_page_menampilkan_pesan_kosong_jika_tidak_ada_produk(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Belum ada komoditas hasil panen');
    }

    public function test_pengguna_customer_yang_sudah_login_diarahkan_ke_halaman_user(): void
    {
        $customer = $this->buatCustomer();

        $response = $this->actingAs($customer)->get('/');

        $response->assertRedirect(route('user.index'));
    }

    public function test_pengguna_petani_yang_sudah_login_diarahkan_ke_halaman_kebun_saya(): void
    {
        $farmerUser = $this->makeUser('petani.test@example.com', 'farmer');

        $response = $this->actingAs($farmerUser)->get('/');

        $response->assertRedirect(route('kebun-saya.index'));
    }
}
