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
            ["categori_id" => 1, "name" => "Nasi Goreng", "description" => "Nasi Goreng Lejat Begiji", "price" => "13.000", "rate" => 5, "stock" => 10],
            ["categori_id" => 2, "name" => "Lemon Tea", "description" => "Nasi Goreng Lejat Begiji", "price" => "13.000", "rate" => 5, "stock" => 10],
            ["categori_id" => 3, "name" => "Kentang Goyeng", "description" => "Nasi Goreng Lejat Begiji", "price" => "13.000", "rate" => 5, "stock" => 10]
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
