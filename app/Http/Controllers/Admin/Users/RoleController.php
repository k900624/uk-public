<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Users\Role;
use App\Models\Users\Permission;
use App\Repositories\Admin\Users\RoleRepository;
use Illuminate\Http\Request;
use \DB;

class RoleController extends BaseController
{
    protected $roleRepo;
    
    public function __construct(RoleRepository $roleRepo)
    {
        parent::__construct();
        
        $this->roleRepo = $roleRepo;

        view()->share(['heading' => 'Группы', 'title' => 'Список групп']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepo->getAllRoles();

        foreach ($roles as $role) {
            $role->users = Role::find($role->id)->users;
        }

        $data['roles'] = $roles;
        $data['countRoles'] = $this->roleRepo->getCountRoles();

        return view('admin.users.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        
        $data['action'] = route('admin.users.roles.store');
        
        $role_permissions = $role->permissions->pluck('key')->toArray();
        
        $data['role'] = $role;
        $data['role_permissions'] = $role_permissions;
        $data['permissions'] = Permission::all()->groupBy('table_name');

        return view('admin.users.roles.form', $data)->with(['title' => 'Добавление группы']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name         = $request->name;
        $role->display_name = $request->display_name;
        $role->save();

        // Save permissions
        if ($request->permissions) {
            foreach ($request->permissions as $permission => $value) {

                $permissions = [
                    'permission_id' => $permission,
                    'role_id'       => $role->id,
                ];
                DB::table('permission_role')->insert($permissions);

            }
        }
        
        if ($role) {
            $this->setFeed('Добавил группу <a href="'. route('admin.users.roles.edit', $role->id) .'">&laquo;'. $request->name .'&raquo;</a>');
        }
        return $this->redirectResponse($role, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.users.roles.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepo->getId($id);
        
        $this->recordExists($role);

        $role_permissions = $role->permissions->pluck('key')->toArray();
        
        $data['action'] = route('admin.users.roles.update', $id);
        $data['role'] = $role;
        $data['role_permissions'] = $role_permissions;
        $data['permissions'] = Permission::all()->groupBy('table_name');

        return view('admin.users.roles.form', $data)->with(['title' => 'Редактирование группы']);
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
        $role = $this->roleRepo->getId($id);

        $this->recordExists($role);

        $data = $request->all();

        $result = $role->update($data);

        // Save permissions
        if ($request->permissions) {

            // Удаляем все права с текущим role_id
            DB::table('permission_role')->where('role_id', $id)->delete();

            foreach ($request->permissions as $permission => $value) {

                $permissions = [
                    'permission_id' => $permission,
                    'role_id'       => $role->id,
                ];
                DB::table('permission_role')->insert($permissions);

            }
        }
        
        if ($result) {
            $this->setFeed('Изменил группу <a href="'. route('admin.users.roles.edit', $role->id) .'">&laquo;'. $request->name .'&raquo;</a>');
        }
        return $this->redirectResponse($result, ['success' => 'Успешно сохранено', 'error' => 'Ошибка при сохранении'], route('admin.users.roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $role = $this->roleRepo->getId($id);
        
        $this->recordExists($role);
        
        $role->users = Role::find($role->id)->users;

        if ($role->name == 'admin' || $role->users->count() > 0) {
            $this->notify->error('Эта группа не может быть удалена!');
            return back();
        }

        $result = Role::destroy($id);
        
        if ($result) {
            $this->setFeed('Удалил группу &laquo;'. $role->name .'&raquo;');
        }
        return $this->redirectResponse($result, ['success' => 'Группа удалена', 'error' => 'Ошибка удаления']);
    }
}
