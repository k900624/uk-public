<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;
use App\Models\MetersData;

class Area extends Model
{
    protected $fillable = [
        'id',
        'address',
        'contract_number',
        'contract_date',
        'land_area',
        'house_area',
        'quantity_residents',
        'сounters'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_area');
    }
}
