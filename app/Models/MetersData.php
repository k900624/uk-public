<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetersData extends Model
{
    protected $fillable = [
        'id',
        'area_id',
        'water',
        'electricity',
        'created_at',
        'updated_at'
    ];

    protected $table = 'meters_data';
}
