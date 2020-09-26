<?php

namespace App\Repositories\Admin\Articles;

use App\Repositories\CoreRepository;
use App\Models\Articles\Tag;
use App\Models\Articles\Article as Model;
use \DB;

class HandbookRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getArticlesPaginate($perPage)
    {
        $result = $this
            ->startConditions()
            ->limit($perPage)
            ->latest()
            ->where('content.cat_id', 6)
            ->paginate($perPage);

        return $result;
    }

    public function getCountArticles()
    {
        $result = $this
            ->startConditions()
            ->where('content.cat_id', 6)
            ->get()
            ->count();

        return $result;
    }

    public function getAllArticles($perPage)
    {
        $result = $this
            ->startConditions()
            ->where('content.cat_id', 6)
            ->latest()
            ->limit($perPage)
            ->all();

        return $result;
    }

}
