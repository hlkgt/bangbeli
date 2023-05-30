<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonis = [
            ["user_id" => 1, "rate" => 4, "description" => "Makananya enak banget sumpah dah, yakin recomended banget kalo makan disini"],
            ["user_id" => 1, "rate" => 4, "description" => "hehe yaudah iya makananya enak banget disini hehehe"],
            ["user_id" => 1, "rate" => 4, "description" => "Yakin nih gak makan disini makananya enak banget lohhh"],
        ];
        $testimonis = collect($testimonis)->map(function ($testimoni) {
            return [
                "user_id" => $testimoni["user_id"],
                "rate" => $testimoni["rate"],
                "description" => $testimoni["description"]
            ];
        });
        Testimoni::insert($testimonis->toArray());
    }
}
