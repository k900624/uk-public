<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Permission extends Model
{
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
