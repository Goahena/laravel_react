<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class users_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
           'username' => 'huythanhle',
           'slug' => 'huy-thanh-le',
           'password' => 'lethanhhuy123456',
           'role_id' => 1,
           'email' => 'huyhoahien86@gmail.com',
           'status' => 1,
           'avatar' => 'thanhle.jpg',
           'fullname' => 'Lê Thanh Huy',
           'phone' => '0123456789',
           'created_at' => now(),
           'updated_at' => now(),
       ]);
    }
}
