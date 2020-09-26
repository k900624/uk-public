<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'id',
        'title',
        'alias',
        'created_at',
    ];
    
    public $timestamps  = false;
}
