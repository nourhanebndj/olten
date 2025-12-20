<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('firstname', 'like', "%{$search}%")
                      ->orWhere('lastname', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'about_me' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|max:2048',
            'role' => 'required|in:particulier,livreur,conducteur,admin,locateur',
            'x_com' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
        ]);
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('users', 'public');
        }

        User::create([
            'nom' => $request->firstname . ' ' . $request->lastname, 
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'mot_de_passe' => Hash::make($request->password), 
            'telephone' => $request->phone,
            'gender' => $request->gender,
            'about_me' => $request->about_me,
            'profile_photo' => $profilePhotoPath,
            'role' => $request->role,
            'x_com' => $request->x_com,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'tiktok' => $request->tiktok,
            'whatsapp' => $request->whatsapp,


        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès !');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
    public function verify(User $user)
    {
        $user->verifie = true;
        $user->save();

        return redirect()->back()->with('success', 'Utilisateur Approuver avec succès.');
    }

}
