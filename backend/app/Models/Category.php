<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $updated_at = false;
    public $created_at = false;
    public function posts() {
        protected $fillable = ['slug', 'name', 'parentId'];
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parentId');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function toSearchableArray(): array

{
    return [
        'id' => (int) $this->title,
        'title' => $this->title,
        'slug' => $this->slug,
        'description' => $this->description,
    ];
    
}
}

