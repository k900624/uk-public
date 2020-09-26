<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Users\UsersAddRequest;
use App\Http\Requests\Admin\Users\UsersEditRequest;
use App\Models\Users\Role;
use App\Models\Users\User;
use App\Models\Users\Area;
use App\Models\Users\Profile;
use App\Models\MetersData;
use App\Models\Service;
use App\Models\Notification;
use App\Repositories\Admin\Users\RoleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Admin\Users\UserRepository;
use Intervention\Image\Facades\Image;
use YoHang88\LetterAvatar\LetterAvatar;
use Illuminate\Support\Facades\Storage;
use App\Services\ResponseLib;
use App\Notifications\InviteUser;
use App\Services\CurrentUser;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Admin\Users\AreaRepository;

class UserController extends BaseController
{
    protected $userRepo;
    protected $roleRepo;
    protected $areaRepo;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo, AreaRepository $areaRepo)
    {
        parent::__construct();

        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->areaRepo = $areaRepo;

        view()->share(['heading' => 'Пользователи', 'title' => 'Список пользователей']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectRoleId = $request->role;
        $selectStatus = $request->status;

        $perPage = 20;
        if ( ! $selectRoleId) {
            $selectRoleId = 2;
        }

        if ($selectRoleId == 'all') {
            $users = $this->userRepo->getAllUsers($perPage, $selectStatus);
            $countUsers = $this->userRepo->getCountUsers();
        } else {
            $users = $this->userRepo->getRoleUsers($perPage, $selectRoleId, $selectStatus);
            $countUsers = $this->userRepo->getCountRoleUsers($selectRoleId);
        }

        foreach ($users as $user) {
            if ( ! is_null($user->last_login_at)) {
                $user->timeago = Carbon::parse($user->last_login_at)->diffForHumans();
            } else {
                $user->timeago = '&mdash;';
            }
            $user->avatar = ($user->avatar)
                ? url('storage/'. $user->avatar)
                : new LetterAvatar($user->name, 'circle', 32);

            $user->main = $this->hasMainUserStatus($user->user_id);
            $user->hasArea = $this->hasArea($user->user_id);

            // $user->invited = $this->hasInvitedEmail($user->invited_at);
        }

        $data['selectRoleId'] = $selectRoleId;
        $data['selectStatus'] = $selectStatus;
        $data['roles'] = $this->roleRepo->getAllRoles($perPage);
        $data['countUsers'] = $countUsers;
        $data['users'] = $users;

        return view('admin.users.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param RoleRepository $this->roleRepo
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['user'] = new User();
        $data['selectRoleId'] = $request->role;
        $data['roles'] = $this->roleRepo->getAllRoles();
        $data['addresses'] = $this->areaRepo->getAreas()->toArray();
        $data['action'] = route('admin.users.store');

        if ($request->role == 1) {
            $view = 'form_admin';
        } elseif ($request->role == 3 || $request->role == 4) {
            $view = 'form_uk';
        } else {
            $view = 'form';
        }

        return view('admin.users.users.'. $view , $data)->with(['title' => 'Добавление пользователя']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UsersAddRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersAddRequest $request)
    {
        $user = new User();
        $user->name  = $request->name;
        $user->email = $request->email;
        // $user->status   = ($request->status) ? 'on' : 'off';
        $user->save();

        if ($user) {

            // Roles
            $role = Role::find($request->role_id);
            $role->users()->save($user);

            if ( ! $role) {
                $this->notify->error('Ошибка при сохранении');
                return back()
                    ->withInput();
            }

            // Profile
            $profile = new Profile();
            $profile->user_id       = $user->id;
            $profile->phone         = $request->phone;
            $profile->phone2        = $request->phone2;
            $profile->vkontakte     = $request->vkontakte;
            $profile->facebook      = $request->facebook;
            $profile->twitter       = $request->twitter;
            $profile->odnoklassniki = $request->odnoklassniki;
            $profile->save();

            if ( ! $profile) {
                $this->notify->error('Ошибка при сохранении');
                return back()
                    ->withInput();
            }

            // Area
            if ($request->role_id == 2) {
                $area_id = $request->area_id;
                $area = $this->areaRepo->getArea($area_id);

                $this->recordExists($area);

                if ($request->main == 'on') {
                    // делаем текущего пользователя собственником
                    // а прошлых пользователей заносим в user_area_history
                    $addressUsers = $this->areaRepo->getAreaUsers($area_id);
                    if ($addressUsers->count()) {
                        foreach ($addressUsers as $addressUser) {
                            \DB::table('user_area_history')
                                ->insert([
                                    'user_id' => $addressUser->user_id,
                                    'area_id' => $area_id
                                ]);
                        }
                    }

                    $area->users()->detach(); // Отсоединяем всех пользователей от участка
                    $user->areas()->attach($area->id, ['main' => 'on']);
                } else {
                    // добавляем к участку домовладельца
                    $user->areas()->attach($area->id, ['main' => 'off']);
                }
            }


            // Invite
            // $randomPassword = str_random(8);

            // // send invite
            // $inviteData = [
            //     'login'    => $user->email,
            //     'password' => $randomPassword,
            // ];
            // $user->notify(new InviteUser($inviteData));

            // // make changes to the database
            // $hashedRandomPassword = Hash::make($randomPassword);
            // $result = $this->userRepo->changeInvitedData($user->id, $hashedRandomPassword);

            $result = $this->sendInvite($user);

            $this->notify->success('Личный кабинет домовладельца ('. $user->name .', '. $area->address .', '. $area->land_area .' сот.) успешно создан.');
            $this->setFeed('Личный кабинет домовладельца ('. $user->name .', '. $area->address .', '. $area->land_area .' сот.) успешно создан.');

            return redirect()
                ->route('admin.users.index');
        } else {
            $this->notify->error('Ошибка при сохранении');
            return back()
                ->withInput();
        }
    }

    public function show($id)
    {
        $user = $this->userRepo->getUser($id);

        $this->recordExists($user);

        $user->main = $this->hasMainUserStatus($user->user_id);

        $addressesSelect = $this->areaRepo->getUserAreas($id)->toArray();

        $data['addresses'] = $addressesSelect;
        $data['user'] = $user;

        if ($user->role_name == 'admin') {
            $view = 'details_admin';
        } elseif ($user->role_name == 'manager_uk') {
            $view = 'details_uk';
        } else {
            $view = 'details';
        }

        return view('admin.users.users.'. $view, $data)->with(['heading' => $user->name, 'title' => 'Информация о пользователе']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepo->getUser($id);

        $this->recordExists($user);

        $user->avatar = ($user->avatar)
            ? url('storage/'. $user->avatar)
            : new LetterAvatar($user->name, 'circle', 100);

        $addressesSelect = $this->areaRepo->getUserAreas($id)->toArray();
        $addresses = $this->areaRepo->getAreas()->toArray();

        if ($addressesSelect) {
            $data['addresses'] = $this->similaire($addressesSelect, $addresses);
        } else {
            $data['addresses'] = $addresses;
        }

        $data['user'] = $user;
        // $data['roles'] = $this->roleRepo->getAllRoles();
        $data['action'] = route('admin.users.update', $id);

        if ($user->role_name == 'admin') {
            $view = 'form_admin';
        } elseif ($user->role_name == 'manager_uk') {
            $view = 'form_uk';
        } else {
            $view = 'form';
        }

        return view('admin.users.users.'. $view, $data)->with(['title' => 'Редактирование пользователя']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UsersEditRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = $this->userRepo->getUser($id);

        $this->recordExists($user);

        $data = $request->all();

        // $data['status'] = $data['status'] ? 'on' : 'off';

        $result = $user->update($data);

        if ($result) {

            $profile = Profile::where('user_id', $id)->first();

            $profileData = [
                'phone'              => $data['phone'],
                'phone2'             => $data['phone2'],
                'vkontakte'          => $data['vkontakte'],
                'facebook'           => $data['facebook'],
                'twitter'            => $data['twitter'],
                'odnoklassniki'      => $data['odnoklassniki'],
            ];
            $profile->update($profileData);

            // Resize image & save to storage
            // $this->storeImage($profile);

            $this->notify->success('Успешно сохранено');
            return redirect()
                ->route('admin.users.index');
        } else {
            $this->notify->error('Ошибка при сохранении');
            return back()
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = $this->userRepo->getUser($id);

        $this->recordExists($user);

        if ($user->role_name == 'admin') {
            $this->notify->error('Администратор не может быть удален!');
            return back();
        }

        $result = User::destroy($id);

        if ($result) {
            $this->userRepo->changeStatus($id, 'deleted');
        }
        return $this->redirectResponse($result, ['success' => 'Пользователю присвоен статус "Удален"', 'error' => 'Ошибка удаления']);
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $user = $this->userRepo->getUser($id);

        $this->recordExists($user);

        $result = $this->userRepo->changeStatus($id, 'on');

        return $this->redirectResponse($result, ['success' => 'Пользователь включен', 'error' => 'Ошибка! Пользователь не включен']);
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $user = $this->userRepo->getUser($id);

        $this->recordExists($user);

        $result = $this->userRepo->changeStatus($id, 'off');

        return $this->redirectResponse($result, ['success' => 'Пользователь отключен', 'error' => 'Ошибка! Пользователь не отключен']);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = $this->userRepo->getUser($id);

        $this->recordExists($user);

        $result = User::withTrashed()
            ->where('id', $id)->restore();

        if ($result) {
            $this->userRepo->changeStatus($id, 'off');
        }
        return $this->redirectResponse($result, ['success' => 'Пользователь восстановлен, ему присвоен статус "Выкл."', 'error' => 'Ошибка! Пользователь не восстановлен']);
    }

    /**
     * Remove from DB the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $user = $this->userRepo->getUser($id);

        $this->recordExists($user);

        $result = User::withTrashed()
            ->where('id', $id)->forceDelete();

        if ($result) {
            $this->setFeed('Удалил пользователя '. $user->name .' из базы данных');
        }
        return $this->redirectResponse($result, ['success' => 'Пользователь удален из БД', 'error' => 'Ошибка! Пользователь не удален из БД']);
    }

    /**
     * send an email invitation
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function invite($id)
    {
        $user = User::findOrFail($id);

        $this->recordExists($user);

        // $randomPassword = str_random(8);

        // // Send invite
        // $inviteData = [
        //     'login'    => $user->email,
        //     'password' => $randomPassword,
        // ];
        // $user->notify(new InviteUser($inviteData));

        // // make changes to the database
        // $hashedRandomPassword = Hash::make($randomPassword);
        // $result = $this->userRepo->changeInvitedData($id, $hashedRandomPassword);

        $result = $this->sendInvite($user);

        return $this->redirectResponse($result, ['success' => 'Пользователь приглашен', 'error' => 'Ошибка! Пользователь не приглашен']);
    }

    protected function storeImage($item)
    {
        if (request()->hasFile('imageForm')) {

            $image = request()->file('imageForm');
            $path = $image->hashName('avatars');

            $img = Image::make($image);

            $width = 600;
            $height = 600;

            $img->height() > $img->width() ? $width = null : $height = null;

            $resize = $img->resize($width, $height, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode();

            Storage::disk('public')->put($path, $resize);

            $item->update([
                'avatar' => $path,
            ]);

        } elseif (request()->imageLoaded == 'false') {

            Storage::disk('public')->delete($item->image);

            $item->update([
                'avatar' => null,
            ]);
        }
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allUsersArea($area_id)
    {
        $perPage = 20;

        $area = $this->areaRepo->getArea($area_id);
        $users = $this->userRepo->getUsersArea($area_id, $perPage);
        $countUsers = $this->userRepo->getCountUsersArea($area_id);

        foreach ($users as $user) {
            $user->timeago = Carbon::parse($user->updated_at)->diffForHumans();
            $user->avatar = ($user->avatar)
                ? url('storage/'. $user->avatar)
                : new LetterAvatar($user->name, 'circle', 32);

            $user->invited = $this->hasInvitedEmail($user->invited_at);
        }

        $data['countUsers'] = $countUsers;
        $data['users'] = $users;

        return view('admin.users.areas.all_users', $data)->with(['title' => 'Все проживающие на участке '. $area->address]);
    }

    protected function sendInvite(User $user)
    {
        $randomPassword = str_random(8);

        // send invite
        $inviteData = [
            'login'    => $user->email,
            'password' => $randomPassword,
        ];
        $user->notify(new InviteUser($inviteData));

        // make changes to the database
        $hashedRandomPassword = Hash::make($randomPassword);
        return $this->userRepo->changeInvitedData($user->id, $hashedRandomPassword);
    }

    protected function hasInvitedEmail($invited_at)
    {
        return ! is_null($invited_at);
    }

    protected function hasVerifiedPhone($phone_verified_at)
    {
        return ! is_null($phone_verified_at);
    }

    protected function hasMainUserStatus($user_id)
    {
        return $this->userRepo->hasMainUser($user_id);
    }

    protected function hasArea($user_id)
    {
        return $this->userRepo->hasArea($user_id);
    }

    private function similaire($a, $b)
    {
        foreach ($a as $row) {
            $a1[$row->area_id] = $row;
        }

        $result = [];
        $i = 0;
        foreach ($b as $var) {
            if (array_key_exists($var['area_id'], $a1)) {
                $var['selected'] = true;
            }
            $result[$i] = $var;
            $i++;
        }
        return $result;
    }
}
