<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'slug', 'tag', 'description', 'title', 'created_at', 'update_at', 'author_id', 
        'is_active', 'published_at', 'image', 'is_comment'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categoryPost', 'postId', 'categoryId');
    }
}
