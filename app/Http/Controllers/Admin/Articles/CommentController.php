<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Articles\CommentsRequest;
use App\Models\Articles\Comment;
use App\Repositories\Admin\Articles\CommentRepository;
use App\Repositories\Admin\Articles\ArticleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\ResponseLib;
use YoHang88\LetterAvatar\LetterAvatar;

class CommentController extends BaseController
{
    protected $articleRepo;
    protected $commentRepo;
    
    public function __construct(CommentRepository $commentRepo, ArticleRepository $articleRepo)
    {
        parent::__construct();
        
        $this->articleRepo = $articleRepo;
        $this->commentRepo = $commentRepo;

        view()->share(['heading' => 'Комментарии', 'title' => 'Список комментариев']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 20;

        $selectStatus = $request->status;

        $comments = $this->commentRepo->getAllComments($perPage, $selectStatus);

        foreach ($comments as $comment) {
            $comment->content = \Str::limit(strip_tags(html_decode($comment->content)), 40);
            $comment->message = \Str::limit(strip_tags(html_decode($comment->message)), 50);
            $comment->timeago = Carbon::parse($comment->created_at)->diffForHumans();
            $comment->contentExists = $this->articleRepo->exists($comment->content_id);

            if ($comment->user_id) {
                $comment->avatar = url('storage/'. $comment->avatar);
            } else {
                $comment->avatar = new LetterAvatar($comment->name, 'circle', 32);
            }
        }

        $countComments = $this->commentRepo->getCountComments();

        $data['comments'] = $comments;
        $data['countComments'] = $countComments;
        $data['selectStatus'] = $selectStatus;

        return view('admin.articles.comments.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function show($id)
    {
        if (request()->ajax()) {

            $comment = $this->commentRepo->getComment($id);

            if ($comment) {

                $this->commentRepo->changeStatusOnView($id);

                $comment->name = ($comment->name) ? html_decode($comment->name) : 'deleted';
                $comment->message = nl2br(html_decode($comment->message));
                $comment->date = Carbon::parse($comment->created_at)->isoFormat('DD MMMM YYYY в HH:mm');

//                if ( ! $comment->email) {
//                    $email = $this->user->email($comment->user_id);
//                    $comment->email = ($email) ? $email : 'user deleted';
//                }

                $data['comment'] = $comment;

                $response = new ResponseLib();

                $response->dialog([
                    "title" => "Просмотр комментария",
                    "body" => view("admin.articles.comments.modal_comment", $data)->render(),
                    "size" => "default",
                ]);
                $response->send();

            } else {
                $this->notify->error('Такого комментария не существует');
            }

        } else {
            return response()->json('error', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentsRequest $request, $id)
    {
        $comment = $this->commentRepo->getId($id);

        if (empty($comment)) {
            $this->notify->error('Запись не найдена!');
            return back();
        }

        $data = $request->all();

        $result = $comment->update($data);

        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->commentRepo->changeStatus($id, 'deleted');

        $result = Comment::destroy($id);

        return $this->redirectResponse($result, ['success' => 'Комментарию присвоен статус "Удален"', 'error' => 'Ошибка удаления']);
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $result = $this->commentRepo->changeStatus($id, 'on');

        return $this->redirectResponse($result, ['success' => 'Комментарий включен', 'error' => 'Ошибка! Комментарий не включен']);
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $result = $this->commentRepo->changeStatus($id, 'off');

        return $this->redirectResponse($result, ['success' => 'Комментарий отключен', 'error' => 'Ошибка! Комментарий не отключен']);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $result = Comment::withTrashed()
            ->where('id', $id)->restore();

        $this->commentRepo->changeStatus($id, 'off');

        return $this->redirectResponse($result, ['success' => 'Комментарий восстановлен, ему присвоен статус "Выкл."', 'error' => 'Ошибка! Комментарий не восстановлен']);
    }

    /**
     * Remove from DB the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $result = Comment::withTrashed()
            ->where('id', $id)->forceDelete();

        if ($result) {
            $this->setFeed('Удалил комментарий #'. $id .' из базы данных');
        }
        return $this->redirectResponse($result, ['success' => 'Комментарий удален из БД', 'error' => 'Ошибка! Комментарий не удален из БД']);
    }
}
