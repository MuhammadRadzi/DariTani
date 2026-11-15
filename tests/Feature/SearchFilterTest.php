<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Farm;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\BuildsMarketplaceData;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase, BuildsMarketplaceData;

    private function getHome(array $params = [])
    {
        $customer = $this->buatCustomer();
        return $this->actingAs($customer)->get(route('user.index', $params));
    }

    // ── Pencarian teks ────────────────────────────────────────────────────────

    public function test_pencarian_menemukan_kebun_berdasarkan_nama_kebun(): void
    {
        $this->buatKebunDenganProduk(nameFarm: 'Kebun Stroberi Segar');
        $this->buatKebunDenganProduk(nameFarm: 'Kebun Sayur Hijau');

        $res = $this->getHome(['q' => 'Stroberi']);

        $res->assertStatus(200);
        $res->assertSee('Kebun Stroberi Segar');
        $res->assertDontSee('Kebun Sayur Hijau');
    }

    public function test_pencarian_menemukan_kebun_berdasarkan_nama_produk(): void
    {
        $kebun = $this->buatKebunDenganProduk(nameProduct: 'Tomat Cherry');
        $lain  = $this->buatKebunDenganProduk(nameFarm: 'Kebun Lain', nameProduct: 'Bayam Hijau');

        $res = $this->getHome(['q' => 'Tomat']);

        $res->assertStatus(200);
        $res->assertSee($kebun->name_farm);
        $res->assertDontSee($lain->name_farm);
    }

    public function test_pencarian_tanpa_hasil_menampilkan_pesan_kosong(): void
    {
        $this->buatKebunDenganProduk(nameFarm: 'Kebun Mangga');

        $res = $this->getHome(['q' => 'XYZ_TIDAK_ADA_123']);

        $res->assertStatus(200);
        $res->assertDontSee('Kebun Mangga');
        $res->assertSee('Tidak ada kebun yang cocok');
    }

    // ── Filter kategori ───────────────────────────────────────────────────────

    public function test_filter_kategori_hanya_tampilkan_kebun_dengan_produk_dari_kategori_tersebut(): void
    {
        $catBuah   = Category::factory()->create(['name_category' => 'Buah']);
        $catSayur  = Category::factory()->create(['name_category' => 'Sayur']);

        $kebunBuah  = $this->buatKebunDenganProduk(category: $catBuah);
        $kebunSayur = $this->buatKebunDenganProduk(category: $catSayur);

        $res = $this->getHome(['kategori' => $catBuah->id_category]);

        $res->assertStatus(200);
        $res->assertSee($kebunBuah->name_farm);
        $res->assertDontSee($kebunSayur->name_farm);
    }

    public function test_filter_kategori_yang_tidak_punya_produk_menampilkan_pesan_kosong(): void
    {
        $catKosong = Category::factory()->create(['name_category' => 'Rempah']);
        $catIsi    = Category::factory()->create(['name_category' => 'Buah']);

        $this->buatKebunDenganProduk(category: $catIsi);

        $res = $this->getHome(['kategori' => $catKosong->id_category]);

        $res->assertStatus(200);
        $res->assertSee('Tidak ada kebun yang cocok');
    }

    // ── Kombinasi pencarian + filter ─────────────────────────────────────────

    public function test_kombinasi_pencarian_dan_filter_kategori(): void
    {
        $catBuah  = Category::factory()->create(['name_category' => 'Buah']);
        $catSayur = Category::factory()->create(['name_category' => 'Sayur']);

        $kebunA = $this->buatKebunDenganProduk(nameFarm: 'Kebun Alpha', nameProduct: 'Jeruk Manis', category: $catBuah);
        $kebunB = $this->buatKebunDenganProduk(nameFarm: 'Kebun Beta',  nameProduct: 'Bayam',       category: $catSayur);
        $kebunC = $this->buatKebunDenganProduk(nameFarm: 'Kebun Alpha Dua', nameProduct: 'Kangkung', category: $catSayur);

        // Cari "Alpha" di kategori Buah → hanya kebunA
        $res = $this->getHome(['q' => 'Alpha', 'kategori' => $catBuah->id_category]);

        $res->assertStatus(200);
        $res->assertSee($kebunA->name_farm);
        $res->assertDontSee($kebunB->name_farm);
        $res->assertDontSee($kebunC->name_farm);
    }

    // ── Tanpa filter ─────────────────────────────────────────────────────────

    public function test_tanpa_filter_menampilkan_semua_kebun(): void
    {
        $kebunA = $this->buatKebunDenganProduk(nameFarm: 'Kebun Satu');
        $kebunB = $this->buatKebunDenganProduk(nameFarm: 'Kebun Dua');

        $res = $this->getHome();

        $res->assertStatus(200);
        $res->assertSee('Kebun Satu');
        $res->assertSee('Kebun Dua');
    }
}
