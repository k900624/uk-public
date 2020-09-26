<?php

namespace App\Repositories\Admin\Articles;

use App\Repositories\CoreRepository;
use App\Models\Articles\Tag;
use App\Models\Articles\Article as Model;
use \DB;

class ArticleRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllArticles($perPage)
    {
        $result = $this
            ->startConditions()
            ->select(
                'content.*',
                'categories.title as category',
                DB::raw('(SELECT count(*)
                  FROM comments 
                  WHERE comments.object_id = content.id 
                  AND comments.object_name = "articles") as commentsCount')
            )
            ->join('categories', 'content.cat_id', '=', 'categories.id', 'left')
            ->limit($perPage)
            ->latest()
            ->where('content.cat_id', '!=', 0)
            ->where('content.cat_id', '!=', 2)
            ->paginate($perPage);

        return $result;
    }

    public function getCountArticles()
    {
        $result = $this
            ->startConditions()
            ->where('cat_id', '!=', 0)
            ->where('cat_id', '!=', 2)
            ->get()
            ->count();

        return $result;
    }

    public function getCategoryArticles($perPage, $cat_id)
    {
        $result = $this
            ->startConditions()
            ->select(
                'content.*',
                'categories.title as category',
                DB::raw('(SELECT count(*)
                  FROM comments 
                  WHERE comments.object_id = content.id 
                  AND comments.object_name = "articles") as commentsCount')
            )
            ->join('categories', 'content.cat_id', '=', 'categories.id', 'left')
            ->where('content.cat_id', $cat_id)
            ->latest()
            ->limit($perPage)
            ->paginate($perPage);

        return $result;
    }

    public function getCountCategoryArticles($cat_id = null)
    {
        $result = $this
            ->startConditions()
            ->join('categories', 'content.cat_id', '=', 'categories.id', 'left')
            ->where('content.cat_id', $cat_id)
            ->get()
            ->count();

        return $result;
    }

}