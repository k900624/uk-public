<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'id',
        'name',
        'display_name',
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
