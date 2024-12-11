<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable; // Thêm Searchable vào đây

    public $timestamps = true;
    protected $fillable = [
        'name',
        'slug',
        'tag',
        'description',
        'title',
        'created_at',
        'update_at',
        'author_id',
        'is_active',
        'published_at',
        'image',
        'is_comment',
    ];

    public function categoryPost()
    {
        return $this->hasOne(CategoryPost::class);
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function comments()
    {
        return $this->hasOne(Comment::class);
    }

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->title,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categoryPost', 'postId', 'categoryId');
    }
}
