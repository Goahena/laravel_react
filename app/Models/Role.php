<?php

namespace App\Models;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Searchable;
    use HasFactory;

    public function users()
    {
        return $this->hasOne(User::class);
    }
    public $timestamps = false;
}