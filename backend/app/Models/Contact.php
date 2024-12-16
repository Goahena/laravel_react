<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'fullname',
        'email',
        'content',
        'seen',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
