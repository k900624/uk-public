<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Users\Traits\UserAccess;
use App\Models\Notification;
use App\Models\Setting;

class User extends Authenticatable
{
    use Notifiable,
        SoftDeletes,
        UserAccess;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'user_notification')->withPivot('read_at');
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'user_area')->withPivot('main');
    }

    public function settings()
    {
        return $this->belongsToMany(Setting::class, 'user_setting')->withPivot('setting_value');
    }

    // public function meters()
    // {
    //     return $this->hasOne(MetersData::class, 'user_id');
    // }

}
