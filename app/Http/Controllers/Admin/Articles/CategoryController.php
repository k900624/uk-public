<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Articles\CategoryRequest;
use App\Models\Articles\Category;
use App\Repositories\Admin\Articles\CategoryRepository;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryRepo;
    
    public function __construct(CategoryRepository $categoryRepo)
    {
        parent::__construct();
        
        $this->categoryRepo = $categoryRepo;

        view()->share(['heading' => 'Категории статей', 'title' => 'Список категорий']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepo->getTree();

        foreach ($categories as $category) {
            // Считаем кол-во товаров в категориях
            $category->atriclesCount = $this->categoryRepo->getCategoryArticlesCount($category->id, $category->parent_id);
        }

        $data['categories'] = $categories;
        $data['categoryRepo'] = $this->categoryRepo;

        return view('admin.articles.categories.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = new Category();
        $category->ordering = 0;

        $parents = $this->categoryRepo->getTree();

        $data['action'] = route('admin.categories.store');
        $data['selectParentId'] = (int) $request->parent;
        $data['parents'] = $parents;
        $data['category'] = $category;

        return view('admin.articles.categories.form', $data)->with(['title' => 'Создание категории']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $title = $this->categoryRepo->checkUniqueTitle($request->title, $request->parent_id);

        if ($title) {
            $this->notify->error('Такая категория уже существует, введите новое название категории!');
            return back()
                ->withInput();
        }

        $category = new Category();
        $category->title = $request->title;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->metakey = $request->metakey;
        $category->metadesc = $request->metadesc;
        $category->published = $request->published;
        $category->ordering = $request->ordering;
        $category->save();

        // Resize image & save to storage
        $this->storeImage($category);
        
        if ($category) {
            $this->setFeed('Добавил категорию <a href="'. route('admin.categories.edit', $category->id) .'">&laquo;'. $request->title .'&raquo;</a>');
        }
        return $this->redirectResponse($category, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepo->getId($id);

        $this->recordExists($category);

        $parents = $this->categoryRepo->getTree();

        $data['selectParentId'] = null;
        $data['action'] = route('admin.categories.update', $id);
        $data['parents'] = $parents;
        $data['category'] = $category;

        return view('admin.articles.categories.form', $data)->with(['title' => 'Редактирование категории']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepo->getId($id);

        $this->recordExists($category);

        $data = $request->all();

        // Resize image & save to storage
        $this->storeImage($category);

        $result = $category->update($data);
        
        if ($result) {
            $this->setFeed('Изменил категорию <a href="'. route('admin.categories.edit', $category->id) .'">&laquo;'. $request->title .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = $this->categoryRepo->getId($id);

        $this->recordExists($category);
        
        $childs = $this->categoryRepo->getChildsId($id);
        $articles_count = $this->categoryRepo->getCategoryArticlesCount($id, $category->parent_id);

        if ( ! $childs->count() && ! $articles_count) {
            $result = Category::destroy($id);
            if ($result) {
                $this->notify->info('Категория удалена');
                $this->setFeed('Удалил категорию &laquo;'. $category->title .'&raquo;');
                return redirect()
                    ->route('admin.categories.index');
            } else {
                $this->notify->error('Ошибка удаления');
                return back();
            }
        } else {
            $this->notify->error('Категория содержит дочерние категории или товары и не может быть удалена!');
            return back();
        }
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $category = $this->categoryRepo->getId($id);
        
        $this->recordExists($category);
        
        $updateData = ['published' => '1'];

        $result = $category->update($updateData);

        return $this->redirectResponse($result, ['success' => 'Категория включена', 'error' => 'Ошибка! Категория не включена']);
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $category = $this->categoryRepo->getId($id);
        
        $this->recordExists($category);
        
        $childs = $this->categoryRepo->getChildsId($id);
        
        $updateData = ['published' => '0'];

        if ($childs) {
            // Отключаем дочерние
            foreach ($childs as $child) {
                $child->update($updateData);
            }
        }

        $result = $category->update($updateData);
        
        return $this->redirectResponse($result, ['success' => 'Категория и все дочерние категории отключены', 'error' => 'Ошибка! Категория не отключена']);
    }
    
    /**
     * Resize image & save to storage
     *
     * @param $item
     */
    protected function storeImage($item)
    {
        if (request()->hasFile('imageForm')) {

            $image = request()->file('imageForm');
            $path = $image->hashName('categories');

            $resize = Image::make($image)->resize(450, null, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode();

            // Delete old image
            $oldImage = $item->image;
            Storage::disk('public')->delete($oldImage);

            // Upload new image
            Storage::disk('public')->put($path, $resize);

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
