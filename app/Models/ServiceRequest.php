<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'service_requests';

    protected $fillable = [
        'id',
        'area_id',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];
}
