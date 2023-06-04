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
            ["user_id" => 1, "rate" => 5, "description" => "Makananya enak banget sumpah dah, yakin recomended banget kalo makan disini"],
            ["user_id" => 1, "rate" => 5, "description" => "hehe yaudah iya makananya enak banget disini hehehe"],
            ["user_id" => 1, "rate" => 5, "description" => "Yakin nih gak makan disini makananya enak banget lohhh"],
            ["user_id" => 1, "rate" => 5, "description" => "recomended banget lohhh masa iya gak makan disini ntar nyesel"],
            ["user_id" => 1, "rate" => 5, "description" => "udah deh kalo pilihan tempatnya disini gausah ragu ragu enak enak lohhh makananya yakin gamau?"],
            ["user_id" => 1, "rate" => 5, "description" => "tunggu apa lagi? masih mertimbangin apa? makananya juga enak enak, harganya murah ramah lagi dikantong nunggu apa lagi sihhhh"],
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
