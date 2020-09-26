<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\ResponseLib;
use App\Models\MenuGroup;
use App\Repositories\Admin\MenuRepository;

class MenuGroupController extends BaseController
{
    protected $menuRepo;
    
    public function __construct(MenuRepository $menuRepo)
    {
        parent::__construct();
        
        $this->menuRepo = $menuRepo;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function create()
    {
        if (request()->ajax()) {

            $data['menu_group'] = new MenuGroup();
            $data['action'] = route('admin.menu_group.store');

            $response = new ResponseLib();

            $response->dialog([
                "title" => "Создание группы меню",
                "body" => view("admin.menu.groups.modal_form", $data)->render(),
                "size" => "default",
            ]);
            $response->send();
            
        } else {
            return response()->json('error', 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $this->menuRepo->checkUniqueGroupTitle($request->name);

        if ($name) {
            $this->notify->error('Такая группа уже существует, введите другое название!');
            return back();
        }
        
        $group = new MenuGroup();

        $group->title = $request->title;
        $group->name  = $request->name;
        $group->save();
        
        if ($group) {
            $this->setFeed('Добавил группу меню <a href="'. route('admin.menu_group.edit', $group->id) .'">&laquo;'. $request->title .'&raquo;</a>');
        }
        return $this->redirectResponse($group, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function edit($id)
    {
        $group = $this->menuRepo->getGroupById($id);

        $this->recordExists($group);

        if (request()->ajax()) {
            
            $data['menu_group'] = $group;
            $data['action'] = route('admin.menu_group.update', $id);

            $response = new ResponseLib();

            $response->dialog([
                "title" => "Редактирование группы меню",
                "body" => view("admin.menu.groups.modal_form", $data)->render(),
                "size" => "default",
            ]);
            $response->send();
            
        } else {
            return response()->json('error', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = MenuGroup::find($id);

        $this->recordExists($group);

        $data = $request->all();

        $result = $group->update($data);
        
        if ($result) {
            $this->setFeed('Изменил группу меню <a href="'. route('admin.menu_group.edit', $group->id) .'">&laquo;'. $request->title .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $group = MenuGroup::find($id);

        $this->recordExists($group);
        
        $result = MenuGroup::destroy($id);
        
        if ($result) {
            $this->setFeed('Удалил группу меню &laquo;'. $group->title .'&raquo;');
        }
        return $this->redirectResponse($result, ['success' => 'Группа меню удалена', 'error' => 'Ошибка удаления']);
    }
}
