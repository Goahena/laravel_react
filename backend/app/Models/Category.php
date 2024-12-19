<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Searchable;
    use HasFactory;
    protected $fillable = ['slug', 'name', 'parentId'];
    public $timestamps = false;
    public function children()
    {
        return $this->hasMany(Category::class, 'parentId');
    }
    public function posts()
    {
        return $this->hasOne(Post::class);
    }
    public function categoryPosts()
    {
        return $this->hasOne(CategoryPost::class);
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
