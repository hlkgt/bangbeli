<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoris = ["makanan","minuman","camilan"];

        for($i = 0; $i < count($categoris);$i++){
            DB::table('categoris')->insert([
                'categori' => $categoris[$i]
            ]);
        };
    }
}
