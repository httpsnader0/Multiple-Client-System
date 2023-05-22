<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\ChangePasswordRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.change-password');
    }

    public function update(ChangePasswordRequest $request)
    {
        User::find(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword),
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return adminResponse(route('dashboard.login'), __('Your Password Has Changed Successfully'));
    }
}
