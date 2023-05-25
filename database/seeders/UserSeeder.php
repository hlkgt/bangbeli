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
            'status' => false,
        ]);
    }
}
