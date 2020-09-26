<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Feedback as Model;
use \DB;

class FeedbackRepository extends CoreRepository
{
    function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllMessages($perPage, $status = '')
    {
        $query = $this
            ->startConditions()::withTrashed()
            ->select(
                'feedback.*',
                'user_profile.avatar',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'feedback.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id', '=', 'feedback.user_id', 'left')
            ->limit($perPage)
            ->orderBy('feedback.created_at', 'desc');

        switch($status) {
            case 'answer':
                $query->where([['feedback.answer', '!=', null]]);
                break;
            case 'no_answer':
                $query->where(['feedback.answer' => null]);
                break;
            case 'deleted':
                $query->where(['feedback.status' => 'deleted']);
                break;
            case 'spam':
                $query->where(['feedback.status' => 'spam']);
                break;
            case 'new':
                $query->where([
                    ['feedback.is_view', '=', '0'],
                    ['feedback.status', '!=', 'deleted'],
                ]);
                break;
            default:
                $query->where('feedback.status', '=', 'on');
                break;
        }

        return $query->paginate($perPage);
    }

    public function getMessage($id)
    {
        $result = $this
            ->startConditions()::withTrashed()
            ->select(
                'feedback.*',
                'user_profile.avatar',
                'users.name as username'
            )
            ->join('users', 'users.id', '=', 'feedback.user_id', 'left')
            ->join('user_profile', 'user_profile.user_id', '=', 'feedback.user_id', 'left')
            ->find($id);

        return $result;
    }

    public function getCountMessages()
    {
        $result = $this
            ->startConditions()
            ->where('feedback.status', '!=', 'deleted')
            ->get()
            ->count();

        return $result;
    }

    public function changeStatusOnView($id)
    {
        $item = $this->getMessage($id);

        if ( ! $item) {
            abort(404);
        }
        $item->is_view = '1';
        return $item->update();
    }

    public function changeStatus($id, $status)
    {
        $item = $this->getMessage($id);

        if ( ! $item) {
            abort(404);
        }
        $item->status = $status;
        return $item->update();
    }

}