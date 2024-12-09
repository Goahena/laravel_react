<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class categories_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
           'id' => 1,
           'name' => 'Chính trị',
           'slug' => 'chinh-tri',
           'parent_id' => 1,
        ]);
        Category::create([
            'id' => 2,
            'name' => 'Khoa học',
            'slug' => 'khoa-hoc',
            'parent_id' => 1,
        ]);
        Category::create([
            'id' => 3,
            'name' => 'Quân sự',
            'slug' => 'quan-su',
            'parent_id' => 1,
        ]);
    }
}
