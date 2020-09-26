<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    protected $fillable = [
        'id',
        'name',
        'title',
    ];

    public $timestamps  = false;
}
