<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $customer = Customer::firstOrFail();

        $cart = Cart::create([
            'id_customer' => $customer->id_customer,
        ]);

        // Sengaja diisi produk dari 3 kebun berbeda (2 kebun milik Daeng Baso',
        // 1 kebun milik Puang Kirk) supaya bisa langsung dites skenario:
        // - grouping per petani/kebun di halaman keranjang
        // - validasi checkout yang cuma boleh 1 kebun per transaksi
        $wortel = Product::where('product_name', 'Wortel Malino')->firstOrFail();
        $kubis = Product::where('product_name', 'Kubis Malino')->firstOrFail();
        $kentang = Product::where('product_name', 'Kentang Granola')->firstOrFail();
        $markisa = Product::where('product_name', 'Markisa Malino')->firstOrFail();

        $items = [
            ['id_product' => $wortel->id_product, 'qty' => 2],   // Kebun Daeng Baso' 1
            ['id_product' => $kubis->id_product, 'qty' => 1],    // Kebun Daeng Baso' 1
            ['id_product' => $kentang->id_product, 'qty' => 3],  // Kebun Daeng Baso' 2
            ['id_product' => $markisa->id_product, 'qty' => 1],  // Kebun Puang Kirk
        ];

        foreach ($items as $item) {
            CartItem::create([
                'id_cart' => $cart->id_cart,
                'id_product' => $item['id_product'],
                'qty' => $item['qty'],
            ]);
        }
    }
}
