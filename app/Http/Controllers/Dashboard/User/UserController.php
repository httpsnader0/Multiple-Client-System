<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\User\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Index User'])->only('index');
        $this->middleware(['permission:Show User'])->only('show');
        $this->middleware(['permission:Delete User'])->only('destroy');
        $this->middleware(['permission:Active User'])->only('active');
    }

    public function index()
    {
        return view('dashboard.user.users.index');
    }

    public function show(User $user)
    {
        return view('dashboard.user.users.show')->with([
            'user' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        $user->clearMediaCollection();
        $user->delete();
    }

    public function active(User $user)
    {
        $user->update(['active' => $user->active == 0 ? 1 : 0]);

        return response()->json([
            'active' => $user->active,
        ]);
    }
}
