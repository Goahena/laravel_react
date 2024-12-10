<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'slug',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }  
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            
        ];
    } 
}