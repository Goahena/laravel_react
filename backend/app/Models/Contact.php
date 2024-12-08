<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $updated_at = false;

    protected $table = 'contacts';

    protected $primaryKey = 'id';

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
