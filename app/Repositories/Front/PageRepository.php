<?php

namespace App\Repositories\Front;

use App\Models\Page as Model;
use App\Repositories\CoreRepository;

class PageRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getPage($param)
    {
        if (is_numeric($param)) {
            $paramName = 'id';
        } else {
            $paramName = 'alias';
        }

        $result = $this
            ->startConditions()
            ->where([
                ['cat_id', '=', 0],
                [$paramName, $param],
                ['published', '1']
            ])
            ->first();

        return $result;
    }

}