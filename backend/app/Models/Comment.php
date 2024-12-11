<?php

namespace App\Models;
use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Searchable;
    use HasFactory;

    public function posts()
    {
        return $this->hasOne(Post::class);
    }


    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'parent_id',
        'is_approve',
        'level',
        'post_id',
        'content',
        'created_at',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
