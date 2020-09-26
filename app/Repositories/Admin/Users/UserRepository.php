<?php

namespace App\Repositories\Admin\Users;

use App\Repositories\CoreRepository;
use App\Models\Users\User as Model;
use \DB;

class UserRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllUsers($perPage, $status)
    {
        $query = DB::table('users')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'users.password',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'users.invited_at',
                'users.last_login_at',
                'user_profile.avatar',
                'roles.id as role_id',
                'roles.name as role_name',
                'roles.display_name as role_display_name'
            )
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->join('user_role', 'user_role.user_id', '=', 'users.id', 'left')
            ->join('roles', 'roles.id', '=', 'user_role.role_id', 'left')
            ->limit($perPage)
            ->latest();

        if ($status == 'active') {
            $query->where(['users.status' => 'on']);
        } elseif ($status == 'unactive') {
            $query->where(['users.status' => 'off']);
        } elseif ($status == 'deleted') {
            $query->where(['users.status' => 'deleted']);
        } elseif ($status == 'banned') {
            $query->where(['users.status' => 'banned']);
        } else {
            $query->where('users.status', '!=', 'deleted');
        }

        return $query->paginate($perPage);
    }

    public function getUsersOnly()
    {
        $result = DB::table('users')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'users.password',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'users.invited_at',
                'users.last_login_at',
                'user_profile.avatar'
            )
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->join('user_role', 'user_role.user_id', '=', 'users.id', 'left')
            ->where('user_role.role_id', 2)
            ->latest()
            ->get();

        return $result;
    }

    public function getAllEmails()
    {
        $result = $this
            ->startConditions()
            ->join('user_role', 'user_role.user_id', '=', 'users.id', 'left')
            ->where([
                ['users.status', '=', 'on'],
                ['users.invited_at', '!=', null],
                ['user_role.role_id', '=', 2]
            ])
            ->get();

        return $result;
    }

    public function getCountUsers()
    {
        $result = $this
            ->startConditions()
            ->get()
            ->count();

        return $result;
    }

    public function getRoleUsers($perPage, $role_id, $status)
    {
        $query = DB::table('users')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'users.password',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'users.invited_at',
                'users.last_login_at',
                'users.ip_address',
                'user_profile.avatar',
                'roles.id as role_id',
                'roles.name as role_name',
                'roles.display_name as role_display_name'
            )
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->join('user_role', 'user_role.user_id', '=', 'users.id', 'left')
            ->join('roles', 'roles.id', '=', 'user_role.role_id', 'left')
            ->where('user_role.role_id', $role_id)
            ->limit($perPage)
            ->latest();

        if ($status == 'active') {
            $query->where(['users.status' => 'on']);
        } elseif ($status == 'unactive') {
            $query->where(['users.status' => 'off']);
        } elseif ($status == 'deleted') {
            $query->where(['users.status' => 'deleted']);
        } elseif ($status == 'banned') {
            $query->where(['users.status' => 'banned']);
        } else {
            $query->where('users.status', '!=', 'deleted');
        }

        return $query->paginate($perPage);
    }

    public function getCountRoleUsers($role_id)
    {
        $result = $this
            ->startConditions()
            ->join('user_role', 'user_role.user_id', '=', 'users.id', 'left')
            ->where('user_role.role_id', $role_id)
            ->get()
            ->count();

        return $result;
    }

    public function getUser($id)
    {
        $result = $this
            ->startConditions()::withTrashed()
            ->select(
                'users.id',
                'users.id as user_id',
                'users.name',
                'users.email',
                'users.password',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'users.deleted_at',
                'users.last_login_at',
                'users.ip_address',
                'user_profile.phone',
                'user_profile.phone2',
                'user_profile.avatar',
                'user_profile.vkontakte',
                'user_profile.facebook',
                'user_profile.twitter',
                'user_profile.odnoklassniki',
                'user_profile.telegram',
                'roles.id as role_id',
                'roles.name as role_name',
                'roles.display_name as role_display_name',
                'user_area.main'
            )
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->join('user_role', 'user_role.user_id', '=', 'users.id', 'left')
            ->join('roles', 'roles.id', '=', 'user_role.role_id', 'left')
            ->join('user_area', 'user_area.area_id', '=', 'users.id', 'left')
            ->find($id);

        return $result;
    }

    public function changeStatus($id, $status)
    {
        $user = Model::findOrFail($id);

        if ( ! $user) {
            abort(404);
        }
        $user->status = $status;
        return $user->update();
    }

    public function changeInvitedData($id, $hashedPassword)
    {
        $user = Model::findOrFail($id);

        if ( ! $user) {
            abort(404);
        }
        
        $user->increment('invite_attempts');

        $user->invited_at = time_now();
        $user->password = $hashedPassword;

        return $user->update();
    }

    public function getMainUserArea($id)
    {
        $result = DB::table('areas')
            ->select(
                'users.id as user_id',
                'users.name'
            )
            ->join('user_area', 'user_area.area_id', '=', 'areas.id', 'left')
            ->join('users', 'user_area.user_id', '=', 'users.id', 'left')
            ->where('user_area.main', 'on')
            ->where('areas.id', $id)
            ->get();

        return $result;
    }

    public function getUsersArea($id, $perPage = null)
    {
        $result = DB::table('areas')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'users.password',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'users.invited_at',
                'users.last_login_at',
                'users.ip_address',
                'user_area.main',
                'user_profile.avatar'
            )
            ->join('user_area', 'user_area.area_id', '=', 'areas.id', 'left')
            ->join('users', 'user_area.user_id', '=', 'users.id', 'left')
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->where('areas.id', $id);

        if ($perPage) {
            return $result
                ->limit($perPage)
                ->paginate($perPage);
        } else {
            return $result
                ->get();
        }
    }

    public function getCountUsersArea($id)
    {
        $result = DB::table('areas')
            ->join('user_area', 'user_area.area_id', '=', 'areas.id', 'left')
            ->where('areas.id', $id)
            ->get()
            ->count();

        return $result;
    }

    public function hasMainUser($id)
    {
        $result = $this
            ->startConditions()
            ->join('user_area', 'users.id', '=', 'user_area.user_id', 'left')
            ->where([
                'user_area.user_id' => $id,
                'user_area.main'    => 'on',
            ])
            ->exists();

        return $result;
    }

    public function hasArea($id)
    {
        $result = $this
            ->startConditions()
            ->join('user_area', 'users.id', '=', 'user_area.user_id', 'left')
            ->where([
                'user_area.user_id' => $id
            ])
            ->exists();

        return $result;
    }

}