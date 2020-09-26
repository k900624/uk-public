<?php

namespace App\Widgets;

use App\Repositories\Front\Article\CommentRepository;
use Arrilot\Widgets\AbstractWidget;

class ArticlesComments extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'article_id'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     * @param CategoryRepository $commentRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run(CommentRepository $commentRepository)
    {
        $perPage = 10;
        $article_id = $this->config['article_id'];
        $article_alias = request()->segment(2);

        $comments = $commentRepository->getAllComments($perPage, $article_id);
        $comments->setPath(route('comments.show', $article_alias));

        if ( ! empty($comments)) {
            foreach ($comments as $comment) {
                $comment->message = nl2br(html_decode($comment->message));
                $comment->created = format_date($comment->created_at, 4);
            }
        }

        $count = $commentRepository->getCountComments($article_id);

        $data = [
            'comments'   => $comments,
            'article_id' => $article_id,
            'count'      => $count,
        ];

        if (request()->ajax()) {
            $result = [
                'content' => view('articles.comments.includes.comments_data', $data)->render(),
            ];
            return response()->json($result);
        } else {
            return view('widgets.articles_comments', $data);
        }
    }
}
