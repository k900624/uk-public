<?php

namespace App\Repositories\Admin\Articles;

use \DB;
use App\Repositories\CoreRepository;
use App\Models\Articles\Category as Model;

class CategoryRepository extends CoreRepository
{
    protected $catParentId = 1;

    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllCategories()
    {
        $result = $this
            ->startConditions()
            ->orderBy('ordering', 'asc')
            ->get();

        return $result;
    }
    
    public function getTree()
    {
        $result = $this
            ->startConditions()
            ->orderBy('ordering', 'asc')
            ->get();

        return $this->buildTree($result);
    }

    public function getArticlesCategories()
    {
        $result = $this
            ->startConditions()
            ->orderBy('ordering', 'asc')
            ->where([
                'published' => '1',
                'parent_id' => $this->catParentId
            ])
            ->get();

        return $result;
    }

    public function getCategoryArticlesCount($cat_id, $parent_id)
    {
        if ($parent_id != 0) {
            // у дочерних просто считаем кол-во статей
            $result = DB::table('content')
                ->where([
                    'cat_id' => $cat_id,
                    'deleted_at' => null,
                ])
                ->count();

            return $result;
        } else {
            // у родительских суммируем кол-во статей дочерних
            $count = [];
            $childs = $this
                ->startConditions()
                ->where([
                    'parent_id'  => $cat_id,
                ])
                ->get();

            foreach ($childs as $child) {
                $count[] = DB::table('content')
                    ->where([
                        'cat_id'     => $child->id,
                        'deleted_at' => null,
                    ])
                    ->count();
            }
            return array_sum($count);
        }
    }

    public function checkUniqueTitle($title, $parent_id)
    {
        $result = $this
            ->startConditions()
            ->where([
                'title'     => $title,
                'parent_id' => $parent_id
            ])
            ->exists();

        return $result;
    }

    public function getChildsId($id)
    {
        $childs = $this
            ->startConditions()
            ->where('parent_id', $id)
            ->get();

        if ($childs) {
            foreach ($childs as $item) {
                $subChilds = $this->getChildsId($item->id);

                $childs = $childs->merge($subChilds);
            }
        }
        return $childs;
    }

}