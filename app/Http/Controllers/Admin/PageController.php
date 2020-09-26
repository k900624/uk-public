<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Pages\PageRequest;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\PageRepository;

class PageController extends BaseController
{
    protected $pageRepo;
    
    public function __construct(PageRepository $pageRepo)
    {
        parent::__construct();
        
        $this->pageRepo = $pageRepo;

        view()->share(['heading' => 'Страницы', 'title' => 'Список страниц']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $data['pages'] = $this->pageRepo->getPagesPagination($perPage);
        $data['countPages'] = $this->pageRepo->getCountPages();

        return view('admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = new Page();
        $page->created_at = date('Y-m-d H:i:s');

        $data['autoIncrement'] = get_autoincrement('content');
        $data['action'] = route('admin.pages.store');
        $data['page'] = $page;

        return view('admin.pages.form', $data)->with(['title' => 'Создание страницы']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = new Page();
        $page->title      = $request->title;
        $page->alias      = $request->alias;
        $page->fulltext   = $request->fulltext;
        $page->metakey    = $request->metakey;
        $page->metadesc   = $request->metadesc;
        $page->published  = $request->published;
        $page->created_at = $request->created_at;
        $page->created_by = Auth::user()->id;
        $page->save();
        
        if ($page) {
            $this->setFeed('Добавил страницу <a href="'. route('admin.pages.edit', $page->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($page, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.pages.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pageRepo->getId($id);

        $this->recordExists($page);
        
        $data['page'] = $page;
        $data['action'] = route('admin.pages.update', $id);

        return view('admin.pages.form', $data)->with(['title' => 'Редактирование страницы']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $page = $this->pageRepo->getId($id);

        $this->recordExists($page);
        
        $updated_at = ($request->updated_at != $page->updated_at) 
            ? $request->updated_at 
            : date('Y-m-d H:i:s');

        $data = $request->all();
        $data['updated_at'] = $updated_at;
        $result = $page->update($data);
        
        if ($result) {
            $this->setFeed('Изменил страницу <a href="'. route('admin.pages.edit', $page->id) .'">&laquo;'. trim($request->title, '&raquo; &laquo;') .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $page = $this->pageRepo->getId($id);
        
        $this->recordExists($page);
        
        $result = Page::destroy($id);
        
        if ($result) {
            $this->setFeed('Удалил страницу &laquo;'. trim($page->title, '&raquo; &laquo;') .'&raquo;');
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
        $page = $this->pageRepo->getId($id);
        
        $this->recordExists($page);
        
        $updateData = ['published' => '1'];

        $result = $page->update($updateData);
        
        return $this->redirectResponse($result, ['success' => 'Страница включена', 'error' => 'Ошибка! Страница не включена']);
    }

    /**
     * Deactivate the specified resource from storage.
     *

     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $page = $this->pageRepo->getId($id);
        
        $this->recordExists($page);
        
        $updateData = ['published' => '0'];

        $result = $page->update($updateData);

        return $this->redirectResponse($result, ['success' => 'Страница отключена', 'error' => 'Ошибка! Страница не отключена']);
    }
}
