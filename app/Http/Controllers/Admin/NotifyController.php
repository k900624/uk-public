<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Users\UserRepository;
use App\Services\ResponseLib;
use App\Models\Notification;
use App\Services\CurrentUser;
use App\Notifications\NewMessage;
use App\Models\Users\User;

class NotifyController extends BaseController
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();
        
        $this->userRepo = $userRepo;
    }

    public function getForm(Request $request)
    {
        $data = [];
        
        $recipient = $request->recipient;
        
        if ($recipient == 'one') {
            $user = User::findOrFail($request->userId);
            $data['route'] = 'notify/'. $request->userId .'/toOne';
            $data['user_id'] = $request->userId;
            $data['user'] = $user;
        } else {
            $data['route'] = 'notify/toAll';
        }

        $response = new ResponseLib();

        $response->dialog([
            "title" => "Новое уведомление",
            "body"  => view("admin.notify.modal_form", $data)->render(),
            "size"  => "default",
        ]);
        $response->send();
    }

    public function toOne(Request $request, $id)
    {
        $message = new Notification;
        $message->setAttribute('type', 'message');
        $message->setAttribute('sender_id', CurrentUser::id());
        $message->setAttribute('text', $request->text);
        $message->save();

        $message->users()->attach($id);

        $fromUser = User::find(CurrentUser::id());
        $toUser = User::find($id);

        // Send message
        $notifyData = [
            'body' => $request->text,
        ];
        // $result = $toUser->notify(new NewMessage($notifyData));
        $result = true;

        if ($result) {
            $this->notify->info('Уведомление отправлено');
            $response = [
                'type' => 'success',
            ];
        } else {
            $this->notify->error('Ошибка! Уведомление не отправлено');

            $response = [
                'type' => 'error',
            ];
        }

        return response()->json($response);
    }

    public function toAll(Request $request)
    {
        $users = $this->userRepo->getAllEmails();

        $message = new Notification;
        $message->setAttribute('type', 'message');
        $message->setAttribute('sender_id', CurrentUser::id());
        $message->setAttribute('text', $request->text);
        $message->save();
        
        $fromUser = User::find(CurrentUser::id());

        foreach ($users as $user) {
            $message->users()->attach($user->id);
            
            $toUser = User::find($user->id);

            // $result = $toUser->notify(new NewMessage($fromUser));
            $result = true;
        }

        if ($result) {
            $this->notify->info('Уведомления отправлены');
            $response = [
                'type' => 'success',
            ];
        } else {
            $this->notify->error('Ошибка! Уведомления не отправлены');
            $response = [
                'type' => 'error',
            ];
        }
        return response()->json($response);
    }
}
