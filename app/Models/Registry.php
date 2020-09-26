<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{
    protected $fillable = [
        'id',
        'key',
        'value',
        'title',
        'group',
    ];

    protected $table = 'registry';
}
