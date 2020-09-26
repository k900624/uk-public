<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // protected $table = 'payments';
    protected $table = 'user_transactions';

    protected $fillable = [
        'id',
        'area_id',
        'amount',
        'operation',
        'created_at',
        'description',
    ];
}
