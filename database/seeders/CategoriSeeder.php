<?php

namespace Database\Seeders;

use App\Models\Categori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoris = [[
            "categori" => "makanan",
            "icon" => "fa-burger"
        ],[
            "categori" => "minuman",
            "icon" => "fa-solid fa-martini-glass-citrus"
        ],[
            "categori" => "camilan",
            "icon" => "fa-cookie-bite"
        ]];
        $categoris = collect($categoris)->map(function($categori){
            return[
                "categori" => $categori['categori'],
                "icon" => $categori['icon']
            ];
        });
        Categori::insert($categoris->toArray());
    }
}
