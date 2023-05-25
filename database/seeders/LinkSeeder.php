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
            ['icon' => 'fa-user', 'path' => 'dashboard.profile', 'text' => 'Profile'],
            ['icon' => 'fa-list', 'path' => 'dashboard.product', 'text' => 'Product'],
            ['icon' => 'fa-calendar-days', 'path' => 'dashboard.testimoni', 'text' => 'Testimoni'],
            ['icon' => 'fa-cart-shopping', 'path' => 'dashboard.cart', 'text' => 'Cart'],
            ['icon' => 'fa-pen-to-square', 'path' => 'dashboard.history', 'text' => 'History']
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
