<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class Notification extends Model
{
    protected $fillable = [
        'id',
        'sender_id',
        'type',
        'text',
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notification');
    }
}
