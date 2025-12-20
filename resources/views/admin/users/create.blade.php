@extends('admin.layouts.app')

@section('title', 'Ajouter un Utilisateur')

@section('content')

    <div class="page-inner">

        {{-- HEADER --}}
        <div class="pb-3 mb-6 border-b flex flex-col md:flex-row md:items-center md:justify-between">

            <div>
                <h1 class="text-xl font-bold text-gray-800">Utilisateurs</h1>

                <ul class="flex items-center text-sm text-gray-500 mt-1 space-x-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:underline">
                            <i class="bi bi-house"></i>
                        </a>
                    </li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li>Gestion</li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li>Utilisateurs</li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li class="text-red-600 font-semibold">Ajouter</li>
                </ul>
            </div>

        </div>

        {{-- FORMULAIRE --}}
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"
            class="mb-8 bg-white p-6 rounded-lg shadow">

            @csrf

            {{-- Prénom --}}
            <div class="mb-4">
                <label for="firstname" class="block text-gray-700 font-medium mb-1">Prénom *</label>
                <input type="text" name="firstname" id="firstname"
                    class="w-full border @error('firstname') border-red-500 @else border-gray-300 @enderror
                          rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    value="{{ old('firstname') }}">
                @error('firstname')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nom --}}
            <div class="mb-4">
                <label for="lastname" class="block text-gray-700 font-medium mb-1">Nom *</label>
                <input type="text" name="lastname" id="lastname"
                    class="w-full border @error('lastname') border-red-500 @else border-gray-300 @enderror
                          rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    value="{{ old('lastname') }}">
                @error('lastname')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-1">Email *</label>
                <input type="email" name="email" id="email"
                    class="w-full border @error('email') border-red-500 @else border-gray-300 @enderror
                          rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Mot de passe --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-1">Mot de passe *</label>
                <input type="password" name="password" id="password"
                    class="w-full border @error('password') border-red-500 @else border-gray-300 @enderror
                          rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirmer le mot de passe --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirmer le mot de passe
                    *</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>
            {{-- Rôle --}}
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium mb-1">Rôle</label>
                <select name="role" id="role"
                    class="w-full border @error('role') border-red-500 @else border-gray-300 @enderror
                   rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="particulier" {{ old('role') == 'particulier' ? 'selected' : '' }}>Particulier</option>
                    <option value="livreur" {{ old('role') == 'livreur' ? 'selected' : '' }}>Livreur</option>
                    <option value="conducteur" {{ old('role') == 'conducteur' ? 'selected' : '' }}>Conducteur</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="locateur" {{ old('role') == 'locateur' ? 'selected' : '' }}>Locateur</option>

                </select>
                @error('role')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Téléphone --}}
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-1">Téléphone</label>
                <input type="text" name="phone" id="phone"
                    class="w-full border @error('phone') border-red-500 @else border-gray-300 @enderror
                          rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    value="{{ old('phone') }}">
                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Genre --}}
            <div class="mb-4">
                <label for="gender" class="block text-gray-700 font-medium mb-1">Genre</label>
                <select name="gender" id="gender"
                    class="w-full border @error('gender') border-red-500 @else border-gray-300 @enderror
                           rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="">-- Sélectionner --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Homme</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femme</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('gender')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- À propos --}}
            <div class="mb-4">
                <label for="about_me" class="block text-gray-700 font-medium mb-1">À propos</label>
                <textarea name="about_me" id="about_me" rows="3"
                    class="w-full border @error('about_me') border-red-500 @else border-gray-300 @enderror
                             rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('about_me') }}</textarea>
                @error('about_me')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Photo --}}
            <div class="mb-6">
                <label for="profile_photo" class="block text-gray-700 font-medium mb-1">Photo de profil</label>
                <input type="file" name="profile_photo" id="profile_photo"
                    class="w-full border @error('profile_photo') border-red-500 @else border-gray-300 @enderror
                          rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                @error('profile_photo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="x_com" class="block text-gray-700 font-medium mb-1">X_COM</label>
                    <input type="text" name="x_com" id="x_com"
                        class="w-full border @error('x_com') border-red-500 @else border-gray-300 @enderror
                      rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('x_com') }}">
                    @error('x_com')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="facebook" class="block text-gray-700 font-medium mb-1">Facebook</label>
                    <input type="text" name="facebook" id="facebook"
                        class="w-full border @error('facebook') border-red-500 @else border-gray-300 @enderror
                      rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('facebook') }}">
                    @error('facebook')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="linkedin" class="block text-gray-700 font-medium mb-1">LinkedIn</label>
                    <input type="text" name="linkedin" id="linkedin"
                        class="w-full border @error('linkedin') border-red-500 @else border-gray-300 @enderror
                      rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('linkedin') }}">
                    @error('linkedin')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4 flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="instagram" class="block text-gray-700 font-medium mb-1">Instagram</label>
                    <input type="text" name="instagram" id="instagram"
                        class="w-full border @error('instagram') border-red-500 @else border-gray-300 @enderror
                      rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('instagram') }}">
                    @error('instagram')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="youtube" class="block text-gray-700 font-medium mb-1">YouTube</label>
                    <input type="text" name="youtube" id="youtube"
                        class="w-full border @error('youtube') border-red-500 @else border-gray-300 @enderror
                      rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('youtube') }}">
                    @error('youtube')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="tiktok" class="block text-gray-700 font-medium mb-1">TikTok</label>
                    <input type="text" name="tiktok" id="tiktok"
                        class="w-full border @error('tiktok') border-red-500 @else border-gray-300 @enderror
                      rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('tiktok') }}">
                    @error('tiktok')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4 flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="whatsapp" class="block text-gray-700 font-medium mb-1">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp"
                        class="w-full border @error('whatsapp') border-red-500 @else border-gray-300 @enderror
                      rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                        value="{{ old('whatsapp') }}">
                    @error('whatsapp')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Boutons --}}
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.users.index') }}"
                    class="text-gray-600 hover:text-gray-800 underline">Annuler</a>
                <button type="submit" class="ml-auto px-4 py-2 text-white rounded-2xl border transition"
                    style="background-color: #2c2c2c; border: 1px solid #2c2c2c;">
                    Ajouter
                </button>
            </div>

        </form>

    </div>

@endsection
