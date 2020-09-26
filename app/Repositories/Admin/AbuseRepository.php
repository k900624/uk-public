<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Abuse as Model;

class AbuseRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAbusesPagination($perPage = 10)
    {
        $result = $this
            ->startConditions()
            ->select(
                'abuses.*',
                'user_profile.avatar',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'abuses.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id', '=', 'abuses.user_id', 'left')
            ->limit($perPage)
            ->latest()
            ->paginate($perPage);

        return $result;
    }

    public function getAllAbuses()
    {
        $result = $this
            ->startConditions()
            ->select(
                'abuses.*',
                'user_profile.avatar',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'abuses.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id', '=', 'abuses.user_id', 'left')
            ->latest()
            ->get();

        return $result;
    }

    public function getCountAbuses()
    {
        $result = $this
            ->startConditions()
            ->get()
            ->count();

        return $result;
    }

    public function getAbuse($id)
    {
        $result = $this
            ->startConditions()
            ->select(
                'abuses.*',
                'user_profile.avatar',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'abuses.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id', '=', 'abuses.user_id', 'left')
            ->find($id);

        return $result;
    }

}