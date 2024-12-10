<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class contacts_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'id' => 1,
            'fullname' => 'Le Thanh Huy',
            'email' => 'huyhoahien86@gmail.com',
            'content' => 'hello',
            'created_at' => now(),
            'seen' => true,
            'user_id' => 1
        ]);
    }
}
