<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abuse extends Model
{
    protected $fillable = [
        'id',
        'text',
        'user_id',
        'name',
        'email',
        'created_at',
    ];
}
