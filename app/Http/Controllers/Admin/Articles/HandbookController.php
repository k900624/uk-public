<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Articles\Article;
use App\Http\Requests\Admin\Articles\HandbookRequest;
use App\Repositories\Admin\Articles\HandbookRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \DB;

class HandbookController extends BaseController
{
    protected $articleRepo;

    public function __construct(HandbookRepository $articleRepo)
    {
        parent::__construct();

        $this->articleRepo = $articleRepo;

        view()->share(['heading' => 'Статьи', 'title' => 'Список статей']);
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
        $articles = $this->articleRepo->getArticlesPaginate($perPage);
        $countArticles = $this->articleRepo->getCountArticles();

        $data['articles'] = $articles;
        $data['countArticles'] = $countArticles;

        return view('admin.articles.handbook.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $article = new Article();
        $article->created_at = date('Y-m-d H:i:s');

        $data['autoIncrement'] = get_autoincrement('content');
        $data['action'] = route('admin.handbook.store');
        $data['article'] = $article;

        return view('admin.articles.handbook.form', $data)->with(['title' => 'Создание статьи']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HandbookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HandbookRequest $request)
    {
        $article = new Article();
        $article->title           = $request->title;
        $article->alias           = $request->alias;
        $article->fulltext        = $request->fulltext;
        $article->cat_id          = 6;
        $article->published       = $request->published;
        $article->created_by      = Auth::user()->id;
        $article->save();

        if ($article) {
            $this->setFeed('Добавил статью <a href="'. route('admin.handbook.edit', $article->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($article, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.handbook.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->articleRepo->getId($id);

        $this->recordExists($article);

        $data['article'] = $article;
        $data['action'] = route('admin.handbook.update', $id);

        return view('admin.articles.handbook.form', $data)->with(['title' => 'Редактирование статьи']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HandbookRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(HandbookRequest $request, $id)
    {
        $article = $this->articleRepo->getId($id);

        $this->recordExists($article);

        $data = $request->all();
        $result = $article->update($data);

        if ($result) {
            $this->setFeed('Изменил статью <a href="'. route('admin.handbook.edit', $article->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.handbook.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $article = $this->articleRepo->getId($id);

        $this->recordExists($article);

        $result = Article::destroy($id);

        if ($result) {
            $this->setFeed('Удалил статью &laquo;'. trim($article->title, '&raquo; &laquo;') .'&raquo;');
        }
        return $this->redirectResponse($result, ['success' => 'Запись удалена', 'error' => 'Ошибка удаления']);
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $article = $this->articleRepo->getId($id);

        $this->recordExists($article);

        $updateData = ['published' => '1'];

        $result = $article->update($updateData);

        return $this->redirectResponse($result, ['success' => 'Статья включена', 'error' => 'Ошибка! Статья не включена']);
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $article = $this->articleRepo->getId($id);

        $this->recordExists($article);

        $updateData = ['published' => '0'];

        $result = $article->update($updateData);

        return $this->redirectResponse($result, ['success' => 'Статья отключена', 'error' => 'Ошибка! Статья не отключена']);
    }

}
