<?php

namespace App\Models;
use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Searchable;
    use HasFactory;

    public function users()
    {
        return $this->hasOne(User::class);
    }



    protected $table = 'contacts';
    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'contact_content',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
