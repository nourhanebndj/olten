<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ad;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $ads = Ad::latest()->get();
        return view('index', compact('categories','ads'));
    }
}
