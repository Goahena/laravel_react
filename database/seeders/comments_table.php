<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class comments_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
           'id' => 1,
           'parent_id' => 1,
            'is_approve' => true,
            'level' => 1,
            'post_id' => 2,
            'content' => 'bài viết hay',
            'created_at' => now(),
        ]);

        Comment::create([
            'id' => 2,
            'parent_id' => 1,
            'is_approve' => true,
            'level' => 2,
            'post_id' => 2,
            'content' => 'bài viết rất hay',
            'created_at' => now(),
        ]);

        Comment::create([
            'id' => 3,
            'parent_id' => 2,
            'is_approve' => true,
            'level' => 1,
            'post_id' => 1,
            'content' => 'bài viết rất hay',
            'created_at' => now(),
        ]);
    }
}
