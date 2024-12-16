<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\Type\NullType;

class users_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            'id' => 1,
           'slug' => 'le-thanh-huy',
           'username' => 'lethanhhuy',
           'fullname' => 'Le Thanh Huy',
           'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
           'role_id' => 1,
           'status' => 1,
           'email' => 'huyhoahien86@gmail.com',
           'phone' => '0123456789',
            'image' => 'https://i.pravatar.cc/150?img=1',
            'created_at' => now(),
            'updated_at' => now(),
       ]);

       User::create([
            'id' => 2,
           'slug' => 'le-thanh-huy-123',
           'username' => 'lethanhhuy123',
           'fullname' => 'Le Thanh Huy',
           'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
           'role_id' => 1,
           'status' => 1,
           'email' => 'huyhoahien876@gmail.com',
           'phone' => '0123456780',
            'image' => 'https://i.pravatar.cc/150?img=2',
            'created_at' => now(),
            'updated_at' => now(),
       ]);
    }
}
