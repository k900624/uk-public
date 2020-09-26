<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    protected $table = 'services_groups';

    protected $fillable = [
        'title',
        'description',
    ];

    public $timestamps  = false;
}
