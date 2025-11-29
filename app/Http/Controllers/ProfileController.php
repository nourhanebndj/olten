<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.locateur.dashboard', [
            'user' => $request->user(),
        ]);
    }

    public function profile(Request $request)
    {
        return view('pages.locateur.profile', [
            'user' => $request->user(),
        ]);
    }
    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'display_format' => 'nullable|in:first_last,last_first',
            'profile_photo' => 'nullable|image|max:2048',
            'about_me' => 'nullable|string|max:1000',
            'disable_email_notifications' => 'nullable|boolean',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Homme,Femme',
            'x_com' => 'nullable|url',
            'facebook' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'whatsapp' => 'nullable|string|max:20',
            'identity_verification' => 'nullable|image|max:2048',
        ]);

        // Récupération des données à mettre à jour
        $data = $request->only([
            'firstname',
            'lastname',
            'display_format',
            'about_me',
            'phone',
            'gender',
            'x_com',
            'facebook',
            'linkedin',
            'instagram',
            'youtube',
            'tiktok',
            'whatsapp',
        ]);

        // Gestion des notifications email
        $data['disable_email_notifications'] = $request->has('disable_email_notifications') ? 1 : 0;

        // Calcul automatique du nom d'affichage
        if (isset($data['display_format'])) {
            $data['name'] = $data['display_format'] === 'first_last'
                ? $data['firstname'] . ' ' . $data['lastname']
                : $data['lastname'] . ' ' . $data['firstname'];
        } else {
            // par défaut firstname + lastname
            $data['name'] = $data['firstname'] . ' ' . $data['lastname'];
        }

        // Upload photo de profil
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // Upload vérification d'identité
        if ($request->hasFile('identity_verification')) {
            if ($user->identity_verification) {
                Storage::disk('public')->delete($user->identity_verification);
            }
            $data['identity_verification'] = $request->file('identity_verification')->store('identity_verifications', 'public');
        }

        // Mise à jour de l'utilisateur
        $user->update($data);

        // Retour avec message de succès
        return back()->with('status', 'Profil mis à jour avec succès !');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
