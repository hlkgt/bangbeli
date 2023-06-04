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
            ["categori_id" => 1, "name" => "Nasi Goreng", "description" => "Nasi Goreng Lejat Begiji", "price" => "13.000", "rate" => 5, "stock" => 20],
            ["categori_id" => 1, "name" => "Mie Goreng", "description" => "Mie Goreng Terlezat Hehehe", "price" => "13.000", "rate" => 5, "stock" => 20],
            ["categori_id" => 1, "name" => "Nasi Bebek", "description" => "Nasi Bebek tanpa toping ayam ehehehe", "price" => "13.000", "rate" => 4, "stock" => 20],
            ["categori_id" => 1, "name" => "Nasi Danging", "description" => "Nasi Daging dengan campuran daging sapi", "price" => "13.000", "rate" => 4, "stock" => 20],
            ["categori_id" => 2, "name" => "Kentang Goyeng", "description" => "Kentang Goyeng sebuah camilan terfavorit", "price" => "8.000", "rate" => 4, "stock" => 20],
            ["categori_id" => 2, "name" => "Sate Kambing", "description" => "Sate Kambing sate terecomended buat dimakan sama nasi goreng", "price" => "8.000", "rate" => 5, "stock" => 20],
            ["categori_id" => 2, "name" => "Nugget Keju", "description" => "Nugget Keju Camilan Yang Paling Baik", "price" => "8.000", "rate" => 5, "stock" => 20],
            ["categori_id" => 3, "name" => "Teh Caramel", "description" => "Teh Caramel minuman kekinian dari campuran teh dan caramel", "price" => "6.000", "rate" => 4, "stock" => 20],
            ["categori_id" => 3, "name" => "Taro Caramel", "description" => "Taro Caramel sama juga dengan Teh Caramel tapi tidak pake teh", "price" => "6.000", "rate" => 4, "stock" => 20],
            ["categori_id" => 3, "name" => "Lemon Tea", "description" => "Lemon Tea penghilang dahaga", "price" => "9.000", "rate" => 5, "stock" => 20]
        ];
        $products = collect($products)->map(function ($product) {
            return [
                'categori_id' => $product['categori_id'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'rate' => $product['rate'],
                'stock' => $product['stock'],
            ];
        });

        Product::insert($products->toArray());
    }
}
