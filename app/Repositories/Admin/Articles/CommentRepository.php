<?php

namespace App\Repositories\Admin\Articles;

use App\Repositories\CoreRepository;
use App\Models\Articles\Comment as Model;
use \DB;

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

    public function getAllComments($perPage = 10, $status = '')
    {
        $query = $this
            ->startConditions()::withTrashed()
            ->select(
                'comments.*',
                'content.id as content_id',
                'content.alias',
                'content.title as content',
                'user_profile.avatar',
                'users.name as username'
            )
            ->join('content', 'content.id', '=', 'comments.object_id', 'left')
            ->join('users', 'users.id', '=', 'comments.created_by', 'left')
            ->join('user_profile', 'user_profile.user_id', '=', 'users.id', 'left')
            ->limit($perPage)
            ->latest();

        switch($status) {
            case 'active':
                $query->where(['comments.status' => 'on']);
                break;
            case 'deleted':
                $query->where(['comments.status' => 'deleted']);
                break;
            case 'unactive':
                $query->where(['comments.status' => 'off']);
                break;
            case 'new':
                $query->where([
                    ['comments.is_view', '=', '0'],
                    ['comments.status', '!=', 'deleted']
                ]);
                break;
            default:
                $query->where('comments.status', '!=', 'deleted');
                break;
        }

        return $query->paginate($perPage);
    }

    public function getComment($id)
    {
        $result = $this
            ->startConditions()::withTrashed()
            ->find($id);

        return $result;
    }

    public function getCountComments()
    {
        $result = $this
            ->startConditions()
            ->get()
            ->count();

        return $result;
    }

    public function changeStatusOnView($id)
    {
        $item = $this->getComment($id);

        if ( ! $item) {
            abort(404);
        }
        $item->is_view = '1';
        return $item->update();
    }

    public function changeStatus($id, $status)
    {
        $item = $this->getComment($id);

        if ( ! $item) {
            abort(404);
        }
        $item->status = $status;
        return $item->update();
    }

}