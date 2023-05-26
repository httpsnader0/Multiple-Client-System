<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\RegisterRequest;
use App\Models\User\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::ADMINHOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function clientRegister()
    {
        return view('dashboard.auth.client-register');
    }

    public function userRegister()
    {
        return view('dashboard.auth.user-register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->type == UserTypeEnum::USER()) {
            $user->assignRole(2);
        }

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
    }
}
