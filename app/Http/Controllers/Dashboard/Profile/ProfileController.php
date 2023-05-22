<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.profile');
    }
}
