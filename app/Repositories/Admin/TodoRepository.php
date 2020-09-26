<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\AdminTodo as Model;

class TodoRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getTodoes()
    {
        $result = $this
            ->startConditions()
            ->orderBy('created_at', 'asc')
            ->get();

        return $result;
    }

}