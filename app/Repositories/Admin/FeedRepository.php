<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Feed as Model;
use \DB;

class FeedRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllFeeds($perPage)
    {
        $result = $this
            ->startConditions()
            ->select(
                'activities.id',
                'activities.activity',
                'activities.created_at',
                'activities.type',
                'activities.user_id',
                'users.name'
            )
            ->orderBy('activities.created_at', 'desc')
            ->limit($perPage)
            ->join('users', 'activities.user_id', '=', 'users.id', 'left')
            ->paginate($perPage);
            
        return $result;
    }

 
    public function getCountFeeds()
    {
        $result = $this
            ->startConditions()
            ->get()
            ->count();

        return $result;
    }

}