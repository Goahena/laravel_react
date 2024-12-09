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


    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'comment', 'comment_parent_id', 'post_id', 'created_at', 'updated_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
