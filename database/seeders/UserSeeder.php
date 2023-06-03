<?php

namespace Database\Seeders;

use App\Models\DataUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            "name" => "admin Leo",
            "email" => "adminleo@gmail.com",
            "password" => Hash::make("adminleo123")
        ]);
        DataUser::insert([
            'user_id' => 1,
            'username' => 'Admin Leo',
            'address' => 'Dsn.Disini Ds.Disana Kec.Disono',
            'photo_profile' => 'photo-profile/foto-adminleo.jpg',
            'telephone' => '081234561234',
            'status' => true,
        ]);
    }
}
