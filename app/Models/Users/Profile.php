<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'phone2',
        'phone_verified_at',
        'avatar',
        'vkontakte',
        'facebook',
        'twitter',
        'odnoklassniki',
        'telegram',
    ];

    protected $table = 'user_profile';

    public $timestamps  = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
