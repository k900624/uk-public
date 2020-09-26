<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Polls\Poll as Model;
use \DB;

class PollRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getPollsPagination($perPage = 10)
    {
        $result = $this
            ->startConditions()
            ->limit($perPage)
            ->latest()
            ->paginate($perPage);

        return $result;
    }

    public function getAllPolls()
    {
        $result = $this
            ->startConditions()
            ->latest()
            ->get();

        return $result;
    }

    public function getCountPolls()
    {
        $result = $this
            ->startConditions()
            ->get()
            ->count();

        return $result;
    }

}