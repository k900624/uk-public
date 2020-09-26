<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Repositories\Admin\MenuRepository;
use App\Repositories\Admin\PageRepository;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    protected $menuRepo;
    protected $pageRepo;
    
    public function __construct(MenuRepository $menuRepo, PageRepository $pageRepo)
    {
        parent::__construct();
        
        $this->menuRepo = $menuRepo;
        $this->pageRepo = $pageRepo;

        view()->share(['heading' => 'Меню', 'title' => 'Список пунктов меню']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectGroupId = $request->group;

        if ( ! $selectGroupId) {
            $selectGroupId = $this->menuRepo->getFirstGroup();
        }

        $menus = $this->menuRepo->getTreeMenus($selectGroupId);

        $groups = $this->menuRepo->getAllGroups();

        $data['selectGroupId'] = $selectGroupId;
        $data['groups'] = $groups;
        $data['menus'] = $menus;

        return view('admin.menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $selectGroupId = $request->group;

        $menu = new Menu();
        $menu->ordering = 0;

        $data['group_menu'] = $this->menuRepo->getGroupById($selectGroupId);
        $data['pages'] = $this->pageRepo->getAllPages();
        $data['parents'] = $this->menuRepo->getTreeMenus($selectGroupId);
        $data['selectGroupId'] = $selectGroupId;
        $data['action'] = route('admin.menu.store');
        $data['menu'] = $menu;

        return view('admin.menu.form', $data)->with(['title' => 'Создание пункта меню']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu();
        $menu->title     = $request->title;
        $menu->group_id  = $request->group_id;
        $menu->type      = $request->type;
        $menu->parent_id = $request->parent_id;
        $menu->link      = $request->link;
        $menu->ordering  = $request->ordering;
        $menu->published = $request->published;
        $menu->save();
        
        if ($menu) {
            $this->setFeed('Добавил пункт меню <a href="'. route('admin.menu.edit', $menu->id) .'">&laquo;'. $request->title .'&raquo;</a>');
        }
        return $this->redirectResponse($menu, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.menu.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->menuRepo->getId($id);
        
        $this->recordExists($menu);

        $data['pages'] = $this->pageRepo->getAllPages();
        $data['parents'] = $this->menuRepo->getTreeMenus($menu->group_id);
        $data['action'] = route('admin.menu.update', $id);
        $data['group_menu'] = $this->menuRepo->getGroupById($menu->group_id);
        $data['menu'] = $menu;

        return view('admin.menu.form', $data)->with(['title' => 'Редактирование пункта меню']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = $this->menuRepo->getId($id);

        $this->recordExists($menu);

        $data = $request->all();

        $result = $menu->update($data);
        
        if ($result) {
            $this->setFeed('Изменил пункт меню <a href="'. route('admin.menu.edit', $id) .'">&laquo;'. $request->title .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.menu.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $menu = $this->menuRepo->getId($id);

        $this->recordExists($menu);
        
        $result = Menu::destroy($id);
        
        if ($result) {
            $this->setFeed('Удалил пункт меню &laquo;'. $menu->title .'&raquo;');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении']);
    }
    
    /**
     * Activate the specified resource from storage.
     *
     * @param ShopCurrencyRepository $shopCurrencyRepository
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $menu = $this->menuRepo->getId($id);

        $this->recordExists($menu);
        
        $updateData = ['published' => '1'];

        $result = $menu->update($updateData);
        
        return $this->redirectResponse($result, ['success' => 'Пункт меню включен', 'error' => 'Ошибка! Пункт меню не включен']);
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param ShopCurrencyRepository $shopCurrencyRepository
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $menu = $this->menuRepo->getId($id);

        $this->recordExists($menu);
        
        $updateData = ['published' => '0'];

        $result = $menu->update($updateData);
        
        return $this->redirectResponse($result, ['success' => 'Пункт меню отключен', 'error' => 'Ошибка! Пункт меню не отключен']);
    }
}
