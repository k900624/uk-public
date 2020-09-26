<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Articles\Article;
use App\Http\Requests\Admin\Articles\AdvertRequest;
use App\Repositories\Admin\Articles\AdvertRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Image\Image;
use \DB;

class AdvertController extends BaseController
{
    protected $articleRepo;

    public function __construct(AdvertRepository $articleRepo)
    {
        parent::__construct();

        $this->articleRepo = $articleRepo;

        view()->share(['heading' => 'Объявления', 'title' => 'Список объявлений']);
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

        return view('admin.articles.adverts.index', $data);
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
        $data['action'] = route('admin.adverts.store');
        $data['article'] = $article;

        return view('admin.articles.adverts.form', $data)->with(['title' => 'Создание объявления']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdvertRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertRequest $request)
    {
        $article = new Article();
        $article->title           = $request->title;
        $article->alias           = $request->alias;
        $article->introtext       = $request->introtext;
        $article->fulltext        = $request->fulltext;
        $article->cat_id          = $request->cat_id;
        $article->image           = $request->image;
        $article->published       = $request->published;
        $article->created_by      = Auth::user()->id;
        $article->save();

        // Resize image & save to storage
        $this->storeImage($article);

        if ($article) {
            $this->setFeed('Добавил объявление <a href="'. route('admin.adverts.edit', $article->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($article, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.adverts.index'));
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
        $data['action'] = route('admin.adverts.update', $id);

        return view('admin.articles.adverts.form', $data)->with(['title' => 'Редактирование объявления']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdvertRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertRequest $request, $id)
    {
        $article = $this->articleRepo->getId($id);

        $this->recordExists($article);

        // Resize image & save to storage
        $this->storeImage($article);

        $data = $request->all();
        $result = $article->update($data);

        if ($result) {
            $this->setFeed('Изменил объявление <a href="'. route('admin.adverts.edit', $article->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.adverts.index'));
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
            $this->setFeed('Удалил объявление &laquo;'. trim($article->title, '&raquo; &laquo;') .'&raquo;');
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

        return $this->redirectResponse($result, ['success' => 'Объявление включено', 'error' => 'Ошибка! Объявление не включено']);
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

        return $this->redirectResponse($result, ['success' => 'Объявление отключено', 'error' => 'Ошибка! Объявление не отключено']);
    }

    protected function storeImage($item)
    {
        if (request()->hasFile('imageForm')) {

            $image = new Image();
            $image->deleteImage($item, 'articles');
            $path = $image->thumbs(request()->file('imageForm'), 'articles');

            $item->update([
                'image' => $path,
            ]);

        } elseif (request()->imageLoaded == 'false') {

            Storage::disk('public')->delete($item->image);

            $item->update([
                'image' => null,
            ]);
        }
    }

}
