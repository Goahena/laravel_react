<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $table = 'categoryposts';
    use Searchable;
    use HasFactory;
    public $timestamps = false;
    public function posts()
    {
        return $this->hasOne(Post::class);
    }
    public function categorys()
    {
        return $this->hasOne(Category::class);
    }
}