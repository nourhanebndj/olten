<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('index', compact('categories'));
    }
}
