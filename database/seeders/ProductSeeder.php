<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ["categori_id" => 1, "url_image" => "photo-product/nasi-goreng.jpg", "name" => "Nasi Goreng", "description" => "Nasi Goreng Lejat Begiji", "price" => "13.000", "rate" => 5, "stock" => 20, "sold" => 300],
            ["categori_id" => 1, "url_image" => "photo-product/mie-goreng.jpg", "name" => "Mie Goreng", "description" => "Mie Goreng Terlezat Hehehe", "price" => "13.000", "rate" => 5, "stock" => 20, "sold" => 198],
            ["categori_id" => 1, "url_image" => "photo-product/nasi-bebek.jpg", "name" => "Nasi Bebek", "description" => "Nasi Bebek tanpa toping ayam ehehehe", "price" => "13.000", "rate" => 4, "stock" => 20, "sold" => 231],
            ["categori_id" => 1, "url_image" => "photo-product/nasi-daging.jpg", "name" => "Nasi Danging", "description" => "Nasi Daging dengan campuran daging sapi", "price" => "13.000", "rate" => 4, "stock" => 20, "sold" => 190],
            ["categori_id" => 2, "url_image" => "photo-product/kentang-goreng.jpg", "name" => "Kentang Goyeng", "description" => "Kentang Goyeng sebuah camilan terfavorit", "price" => "8.000", "rate" => 4, "stock" => 20, "sold" => 287],
            ["categori_id" => 2, "url_image" => "photo-product/sate-kambing.jpg", "name" => "Sate Kambing", "description" => "Sate Kambing sate terecomended buat dimakan sama nasi goreng", "price" => "8.000", "rate" => 5, "stock" => 20, "sold" => 186],
            ["categori_id" => 2, "url_image" => "photo-product/nugget-keju.jpg", "name" => "Nugget Keju", "description" => "Nugget Keju Camilan Yang Paling Baik", "price" => "8.000", "rate" => 5, "stock" => 20, "sold" => 90],
            ["categori_id" => 3, "url_image" => "photo-product/teh-caramel.jpg", "name" => "Teh Caramel", "description" => "Teh Caramel minuman kekinian dari campuran teh dan caramel", "price" => "6.000", "rate" => 4, "stock" => 20, "sold" => 258],
            ["categori_id" => 3, "url_image" => "photo-product/taro-caramel.jpg", "name" => "Taro Caramel", "description" => "Taro Caramel sama juga dengan Teh Caramel tapi tidak pake teh", "price" => "6.000", "rate" => 4, "stock" => 20, "sold" => 178],
            ["categori_id" => 3, "url_image" => "photo-product/lemon-tea.jpg", "name" => "Lemon Tea", "description" => "Lemon Tea penghilang dahaga", "price" => "9.000", "rate" => 5, "stock" => 20, "sold" => 170]
        ];
        $products = collect($products)->map(function ($product) {
            return [
                'categori_id' => $product['categori_id'],
                'url_image' => $product['url_image'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'rate' => $product['rate'],
                'stock' => $product['stock'],
                'sold' => $product['sold'],
            ];
        });

        Product::insert($products->toArray());
    }
}
