<?php

namespace App\Repositories\Front\Article;

use \DB;
use App\Models\Articles\Category as Model;
use App\Repositories\CoreRepository;

class CategoryRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getCategory($param)
    {
        if (is_numeric($param)) {
            $paramName = 'id';
        } else {
            $paramName = 'alias';
        }

        $result = $this
            ->startConditions()
            ->where([
                $paramName  => $param,
                'published' => '1'
            ])
            ->first();

        return $result;
    }

    public function getCategoriesWithCounts()
    {
        $result = $this
            ->startConditions()
            ->select(
                'categories.id',
                'categories.alias',
                'categories.title',
                DB::raw('(SELECT count(*)
                  FROM content
                  WHERE categories.id = content.cat_id
                  AND content.published = "1") as articles_count')
            )
            ->where([
                'parent_id' => 1,
                'published' => '1'
            ])
            ->orderBy('ordering', 'asc')
            ->get();

        return $result;
    }

}