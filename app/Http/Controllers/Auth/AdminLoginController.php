<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use \Session;
use Carbon\Carbon;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        $message = '';
        if (Session::has('message')) {
            $message = Session::get('message');
        }
        return view('auth.admin-login', compact('message'));
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email|max:150',
            'password' => 'required|min:8|string'
        ]);

        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            $user = Auth::guard('admin')->user();
            // if (Auth::guard('admin')->user()->isAdmin()) {
            if ($user->hasRoles(['admin', 'manager_uk', 'content_manager'])) {
                $user->last_login_at = Carbon::now()->toDateTimeString();
                $user->ip_address    = $request->ip();
                $user->save();
                return redirect()->intended(route('admin.dashboard.index'));
            } else {
                Auth::guard('admin')->logout();
            }
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->with('message', 'Email или пароль введены не верно');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
