<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'id',
        'group_id',
        'title',
        'description',
        'unit',
        'price',
        'name_company',
        'phone',
        'address',
        'url',
        'created_at',
        'updated_at',
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\ServiceGroup', 'group_id'); //Прямая связь
    }
}
