<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Articles\Article;
use App\Models\Articles\Tag;
use App\Http\Requests\Admin\Articles\ArticleRequest;
use App\Repositories\Admin\Articles\ArticleRepository;
use App\Repositories\Admin\Articles\CategoryRepository;
use App\Repositories\Admin\Articles\TagRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Image\Image;
use \DB;

class ArticleController extends BaseController
{
    protected $articleRepo;
    protected $categoryRepo;
    
    public function __construct(ArticleRepository $articleRepo, CategoryRepository $categoryRepo, TagRepository $tagRepo)
    {
        parent::__construct();
        
        $this->articleRepo = $articleRepo;
        $this->categoryRepo = $categoryRepo;
        $this->tagRepo = $tagRepo;

        view()->share(['heading' => 'Новости', 'title' => 'Список новостей']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectCatId = $request->cat;

        $perPage = 20;
        if ( ! $selectCatId) {
            $articles = $this->articleRepo->getAllArticles($perPage);
            $countArticles = $this->articleRepo->getCountArticles();
        } else {
            $articles = $this->articleRepo->getCategoryArticles($perPage, $selectCatId);
            $countArticles = $this->articleRepo->getCountCategoryArticles($selectCatId);
        }

        $data['selectCatId'] = $selectCatId;
        $data['categories'] = $this->categoryRepo->getArticlesCategories();
        $data['articles'] = $articles;
        $data['countArticles'] = $countArticles;

        return view('admin.articles.articles.index', $data);
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

        $data['selectCatId'] = $request->cat;
        $data['categories'] = $this->categoryRepo->getArticlesCategories();
        $data['autoIncrement'] = get_autoincrement('content');
        $data['action'] = route('admin.articles.store');
        $data['article'] = $article;
        $data['tags'] = $this->tagRepo->getAllTags()->toArray();

        return view('admin.articles.articles.form', $data)->with(['title' => 'Создание новости']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title           = $request->title;
        $article->alias           = $request->alias;
        $article->introtext       = $request->introtext;
        $article->fulltext        = $request->fulltext;
        $article->cat_id          = $request->cat_id;
        $article->image           = $request->image;
        $article->metakey         = $request->metakey;
        $article->metadesc        = $request->metadesc;
        $article->published       = $request->published;
        $article->enable_comments = $request->enable_comments;
        $article->created_at      = $request->created_at;
        $article->created_by      = Auth::user()->id;
        $article->save();

        // Resize image & save to storage
        $this->storeImage($article);
        
        // Insert tags
        $this->setTags($request, $article->id, false);

        if ($article) {
            $this->setFeed('Добавил новость <a href="'. route('admin.articles.edit', $article->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($article, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.articles.index'));
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
        $data['categories'] = $this->categoryRepo->getArticlesCategories();
        $data['action'] = route('admin.articles.update', $id);
        
        $tagsSelect = $this->tagRepo->getTagsArticle($id)->toArray();
        $tags = $this->tagRepo->getAllTags()->toArray();
        
        if ($tagsSelect) {
            $data['tags'] = $this->similaire($tagsSelect, $tags);
        } else {
            $data['tags'] = $tags;
        }

        return view('admin.articles.articles.form', $data)->with(['title' => 'Редактирование новости']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = $this->articleRepo->getId($id);

        $this->recordExists($article);
        
        $updated_at = ($request->updated_at != $article->updated_at) 
            ? $request->updated_at 
            : date('Y-m-d H:i:s');
        
        // Resize image & save to storage
        $this->storeImage($article);
        
        $data = $request->all();
        $data['updated_at'] = $updated_at;
        $result = $article->update($data);
        
        // Update tags
        DB::table('tags_content')->where(['object_name' => 'articles', 'object_id' => $id])->delete();
        $this->setTags($request, $id);

        if ($result) {
            $this->setFeed('Изменил новость <a href="'. route('admin.articles.edit', $article->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.articles.index'));
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
            $this->setFeed('Удалил новость &laquo;'. trim($article->title, '&raquo; &laquo;') .'&raquo;');
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
        
        return $this->redirectResponse($result, ['success' => 'Новость включена', 'error' => 'Ошибка! Новость не включена']);
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
        
        return $this->redirectResponse($result, ['success' => 'Новость отключена', 'error' => 'Ошибка! Новость не отключена']);
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
    
    private function similaire($a, $b)
    {
        foreach ($a as $row) {
            $a1[$row->alias] = $row;
        }
      
        $result = [];
        $i = 0;
        foreach ($b as $var) {
            if (array_key_exists($var['alias'], $a1)) {
                $var['selected'] = true;
            }
            $result[$i] = $var;
            $i++;
        }
        return $result;
    }
    
    private function setTags(Request $request, $article_id, $isEdit = true)
    {
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $query = null;
                if ($isEdit) {
                    $alias = \Str::slug($tag);
                    $query = $this->tagRepo->findOneBy(['alias' => $alias]);
                }

                if ( ! $query) {
                    $tag_id = get_autoincrement('tags');

                    $insert_tag = [
                      'name'  => $tag,
                      'alias' => \Str::slug($tag),
                    ];
                    Tag::insert($insert_tag);
                } else {
                    $tag_id = $query->id;
                }

                $insertTagContent = [
                    'object_name' => 'articles',
                    'object_id'   => $article_id,
                    'tag_id'      => $tag_id,
                ];
                DB::table('tags_content')->insert($insertTagContent);
            }
        }
    }

}
