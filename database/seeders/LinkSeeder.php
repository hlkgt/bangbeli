<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            ['icon' => 'fa-user', 'path' => 'dashboard.profile', 'text' => 'Pengguna'],
            ['icon' => 'fa-list', 'path' => 'dashboard.product', 'text' => 'Menu'],
            ['icon' => 'fa-calendar-days', 'path' => 'dashboard.testimoni', 'text' => 'Ulasan'],
            ['icon' => 'fa-pen-to-square', 'path' => 'dashboard.history', 'text' => 'Riwayat']
        ];
        $links = collect($links)->map(function($links){
            return[
                'icon' => $links["icon"],
                'path' =>$links["path"],
                'text' =>$links["text"]
            ];
        });
        Link::insert($links->toArray());
    }
}
