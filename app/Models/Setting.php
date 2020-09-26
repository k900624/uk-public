<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'id',
        'key',
        'description',
        'value',
        'help',
        'type',
        'group',
        'field',
        'ordering',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_setting');
    }

    public $timestamps  = false;
}
