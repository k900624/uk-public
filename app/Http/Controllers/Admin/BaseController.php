<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\MainRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use Request;

class BaseController extends Controller
{
    function __construct()
    {
        parent::__construct();

        $this->middleware('auth:admin');

        $countNewMessages = MainRepository::getCountNewMessages();
        $newMessages = MainRepository::getNewMessages();
        $countNewComments = MainRepository::getCountNewComments();
        $newComments = MainRepository::getNewComments();
        $getAdminNavigation = Menu::getMenu('admin');
        
        // get uri_string
        $uri_string = ltrim(request()->path(), 'admin');
        
        $data['countNewMessages'] = $countNewMessages;
        $data['newMessages'] = $newMessages;
        $data['getAdminNavigation'] = $getAdminNavigation;
        $data['countNewComments'] = $countNewComments;
        $data['newComments'] = $newComments;
        $data['uri_string'] = $uri_string;

        view()->share($data);
    }
    
    protected function redirectResponse($result, $message, $route = null)
    {
        if ($result) {
            $this->notify->info($message['success']);
            if ($route) {
                return redirect()->to($route);
            }
        } else {
            $this->notify->error($message['error']);
        }
        return back()->withInput();
    }
    
    protected function recordExists($record)
    {
        if ( ! $record || empty($record)) {
            $this->notify->error('Запись не найдена!');

            return back()->send();
        }
    }
}
