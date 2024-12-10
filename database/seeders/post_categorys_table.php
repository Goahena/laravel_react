<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class post_categorys_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryPost::create([
           'id' => 1,
           'post_id' => 1,
           'category_id' => 1
        ]);
        CategoryPost::create([
            'id' => 2,
            'post_id' => 2,
            'category_id' => 1
        ]);
        CategoryPost::create([
           'id' => 3,
           'post_id' => 3,
           'category_id' => 2
        ]);
    }
}
