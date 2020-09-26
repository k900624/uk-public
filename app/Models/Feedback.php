<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    protected $table = 'feedback';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_id',
        'message',
        'attach',
        'subject',
        'ip_address',
        'status',
        'is_view',
        'answer',
    ];
}
