<?php

namespace App\Repositories\Front\Article;

use \DB;
use App\Models\Articles\Comment as Model;
use App\Repositories\CoreRepository;

class CommentRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllComments($perPage, $article_id)
    {
        $result = $this->startConditions()
            ->select(
                'comments.*',
                'user_profile.avatar',
                'user_profile.last_name',
                'user_profile.first_name',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'comments.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->limit($perPage)
            ->where([
                'comments.object_name' => 'articles',
                'comments.object_id'   => $article_id,
                'comments.status'      => 'on',
            ])
            ->orderBy('comments.created_at', 'desc')
            ->paginate($perPage);

        return $result;
    }

    public function getCountComments($article_id)
    {
        $result = $this->startConditions()
            ->where([
                'comments.object_name' => 'articles',
                'comments.object_id'   => $article_id,
                'comments.status'      => 'on',
            ])
            ->count();

        return $result;
    }
}