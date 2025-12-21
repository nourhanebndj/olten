<?php

namespace App\Http\Controllers\Owner;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{ 
    public function index(Request $request)
    {
        return view('pages.locateur.dashboard', [
            'user' => $request->user(),
        ]);
    }
}