<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Searchable;
    use HasFactory;
    public $updated_at = false;
    public function posts()
    {
        return $this->hasOne(Post::class);
    }
}