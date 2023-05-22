<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMINHOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'phone';
    }

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->active == 0) {
            $this->guard()->logout();
            return adminResponse(route('dashboard.login'), __('Sorry , :username Your Account Not Activated Yet', ['username' => $user->name]), 'danger');
        }

        if ($user->block == 1) {
            $this->guard()->logout();
            return adminResponse(route('dashboard.login'), __('Sorry , :username Your Account Has Blocked', ['username' => $user->name]), 'danger');
        }

        return adminResponse(route('dashboard.index'), __('Welcome Back , :username', ['username' => $user->name]));
    }

    protected function loggedOut()
    {
        return adminResponse(route('dashboard.login'), __('You Have Logout Successfully'));
    }
}
