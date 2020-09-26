<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Repositories\Front\Users\UserRepository;
use Illuminate\Support\Facades\Auth;

class MainController extends BaseController
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();

        $this->userRepo = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;

        $data['api_token'] = $this->userRepo->getApiToken($user_id);

        return view('users.index', $data);
    }

}
