<?php

namespace App\Http\Controllers\Dashboard\Core;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard.core.home')->with([
            'products'=> Product::active()->get(),
        ]);
    }
}
