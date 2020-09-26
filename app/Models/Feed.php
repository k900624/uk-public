<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    const UPDATED_AT = null;

    protected $table = 'activities';

    protected $fillable = [
        'name',
        'user_id',
        'activity',
        'type',
        'new',
    ];
}
