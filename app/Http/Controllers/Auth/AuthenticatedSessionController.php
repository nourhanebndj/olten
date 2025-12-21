<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return redirect('/')
            ->with('showLoginModal', true);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $messages = [
            'email.required'    => 'L’adresse e-mail est obligatoire.',
            'email.email'       => 'L’adresse e-mail doit être valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ];

        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'general' => ['Identifiants incorrects. Veuillez vérifier vos informations.']
                ],
            ], 422);
        }

        $request->session()->regenerate();
        $request->session()->forget('showLoginModal');

        return response()->json([
            'status' => 'success',
            'redirect' => route('dashboard'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
