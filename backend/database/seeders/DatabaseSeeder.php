<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(roles_table::class);
        $this->call(users_table::class);
        $this->call(posts_table::class);
        $this->call(categories_table::class);
        $this->call(comments_table::class);
        $this->call(contacts_table::class);
        $this->call(post_categorys_table::class);
    }
}
