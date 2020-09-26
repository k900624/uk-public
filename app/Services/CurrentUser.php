<?php

namespace App\Services;

use App\Models\Users\User;

class CurrentUser
{
    public static function id()
    {
        return auth()->id();
    }

    public static function user()
    {
        $id = self::id();

        return User::find($id);
    }

    public static function name()
    {
        $user = self::user();

        return $user->name;
    }

    public static function email()
    {
        $user = self::user();

        return $user->email;
    }

    public static function ip_address()
    {
        $user = self::user();

        return $user->ip_address;
    }

    public static function created_at()
    {
        $user = self::user();

        return $user->created_at;
    }

    public static function updated_at()
    {
        $user = self::user();

        return $user->created_at;
    }

    public static function deleted_at()
    {
        $user = self::user();

        return $user->created_at;
    }

    public static function last_login_at()
    {
        $user = self::user();

        return $user->last_login_at;
    }

    public static function status()
    {
        $user = self::user();

        return $user->status;
    }

    public static function is_active()
    {
        $status = self::status();

        return ($status == 'on') ? true : false;
    }

    public static function is_deleted()
    {
        $status = self::status();

        return ($status == 'deleted') ? true : false;
    }

    public static function is_banned()
    {
        $status = self::status();

        return ($status == 'banned') ? true : false;
    }

    public static function is_unactive()
    {
        $status = self::status();

        return ($status == 'off') ? true : false;
    }

    // --------------------------------------------------------------------


    public static function profile()
    {
        $user = self::user();

        return $user->profile;
    }

    public static function first_name()
    {
        $profile= self::profile();

        return $profile->first_name;
    }

    public static function last_name()
    {
        $profile= self::profile();

        return $profile->last_name;
    }

    public static function avatar()
    {
        $profile= self::profile();

        return $profile->avatar;
    }

    public static function birthday()
    {
        $profile= self::profile();

        return $profile->birthday;
    }


    public static function address()
    {
        $profile= self::profile();

        return $profile->address;
    }

    public static function phone()
    {
        $profile= self::profile();

        return $profile->phone;
    }

    public static function gender()
    {
        $profile= self::profile();

        return $profile->gender;
    }

    public static function about()
    {
        $profile= self::profile();

        return $profile->about;
    }

    // --------------------------------------------------------------------

    public static function role()
    {
        $user = self::user();

        return $user->roles[0];
    }

    public static function role_name()
    {
        $role = self::role();

        return $role->name;
    }

    public static function role_id()
    {
        $role = self::role();

        return $role->id;
    }

    public static function role_display_name()
    {
        $role = self::role();

        return $role->display_name;
    }

}
