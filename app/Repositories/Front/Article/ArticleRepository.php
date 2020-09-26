<?php

namespace App\Repositories\Front\Article;

use App\Models\Articles\Article as Model;
use App\Repositories\CoreRepository;

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
                'categories.alias as category_alias',
                'categories.title as category_title',
                'users.name as username'
            )
            ->limit($perPage)
            ->latest()
            ->join('users', 'users.id', '=', 'content.created_by', 'left')
            ->join('categories', 'categories.id', '=', 'content.cat_id', 'left')
            ->where([
                ['content.cat_id', '!=', 0],
                ['content.cat_id', '!=', 2],
                ['content.published', '1']
            ])
            ->paginate($perPage);

        return $result;
    }

    public function getArticle($param)
    {
        if (is_numeric($param)) {
            $paramName = 'id';
        } else {
            $paramName = 'alias';
        }

        $result = $this
            ->startConditions()
            ->where([
                [$paramName, $param],
                ['cat_id', '!=', 0],
                ['cat_id', '!=', 2],
                ['published', '1']
            ])
            ->first();

        return $result;
    }

    public function getCategoryArticles($perPage, $cat_id)
    {
        $result = $this
            ->startConditions()
            ->select(
                'content.*',
                'categories.alias as category_alias',
                'categories.title as category_title',
                'users.name as username'
            )
            ->limit($perPage)
            ->latest()
            ->join('users', 'users.id', '=', 'content.created_by', 'left')
            ->join('categories', 'categories.id', '=', 'content.cat_id', 'left')
            ->where([
                ['content.cat_id', $cat_id],
                ['content.published', '1']
            ])
            ->paginate($perPage);

        return $result;
    }

}