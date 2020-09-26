<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTodo extends Model
{
    protected $table = 'admin_todo';
    
    protected $fillable = [
        'id',
        'title',
        'created_at',
        'status'
    ];
    
    public $timestamps  = false;
}
