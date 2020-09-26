<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'id',
        'ip_address',
        'uid',
        'user_agent',
        'user_id',
        'last_visit',
        'visits',
        'params',
    ];
    
    public $timestamps  = false;
}
