@extends('layouts.connected')
@section('title', 'Mon Profil')

@section('content')
@php
    $fullName = Auth::user()->name;
    $parts = explode(' ', $fullName, 2);

    $prenom = $parts[0];
    $nom = $parts[1] ?? '';
@endphp
<div class="breadcrumb">
    <a href="#">Accueil</a>
    <span>></span>
    <span>Mon Profil</span>
</div>

<h1 class="page-title">Mon Profil</h1>

<div class="profile-container">

    {{-- DÉTAILS DU PROFIL --}}
    <div class="profile-section">

        <h2 class="section-title">Détails du profil</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="profile-photo-wrapper">
                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('assets/images/user-profile.webp') }}" class="profile-photo">
                {{-- Upload photo --}}
                <input type="file" name="profile_photo" id="photoInput" accept="image/*">

                @error('profile_photo')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Prénom --}}
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" 
                    name="firstname" 
                    value="{{ old('firstname', $user->firstname) }}">

                @error('firstname')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Nom de famille --}}
            <div class="form-group">
                <label>Nom de famille</label>
                <input type="text" 
                    name="lastname" 
                    value="{{ old('lastname', $user->lastname) }}">

                @error('lastname')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Nom d'affichage --}}
            <div class="form-group">
                <label>Nom d'affichage</label>
                <select name="display_format">
                    <option value="first_last" {{ old('display_format', $user->display_format ?? 'first_last') == 'first_last' ? 'selected' : '' }}>
                        {{ $user->firstname }} {{ $user->lastname }}
                    </option>
                    <option value="last_first" {{ old('display_format', $user->display_format ?? 'last_first') == 'last_first' ? 'selected' : '' }}>
                        {{ $user->lastname }} {{ $user->firstname }}
                    </option>
                </select>

                @error('display_format')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn-save">Sauvegarder</button>

            @if (session('status') === 'profile-updated')
                <p class="saved-message">✔ Profil mis à jour</p>
            @endif
        </form>

    </div>

    {{-- MOT DE PASSE --}}
    <div class="profile-section">

        <h2 class="section-title">Changer de mot de passe</h2>

        <div class="password-info">
            Votre mot de passe doit comporter au moins 12 caractères.
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Mot de passe actuel</label>
                <input type="password" name="current_password">
                @error('current_password', 'updatePassword')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" name="password">
                @error('password', 'updatePassword')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation">
                @error('password_confirmation', 'updatePassword')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn-save">Sauvegarder</button>

            @if (session('status') === 'password-updated')
                <p class="saved-message">✔ Mot de passe mis à jour</p>
            @endif
        </form>

    </div>


    {{-- A PROPOS DE MOI --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="profile-section">

            <h2 class="section-title">À propos de moi</h2>

            {{-- À propos de moi --}}
            <div class="form-group">
                <label>À propos de moi</label>
                <textarea name="about_me" placeholder="Parlez-nous de vous...">{{ old('about_me', $user->about_me) }}</textarea>

                @error('about_me')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Désactiver notifications email --}}
            <div class="checkbox-group">
                <input type="checkbox" 
                    name="disable_email_notifications"
                    id="notif"
                    {{ old('disable_email_notifications', $user->disable_email_notifications) ? 'checked' : '' }}>

                <label for="notif">Désactiver les notifications email</label>

                @error('disable_email_notifications')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Téléphone --}}
            <div class="form-group">
                <label>Téléphone</label>
                <input type="tel" 
                    name="phone" 
                    value="{{ old('phone', $user->phone) }}">

                @error('phone')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Sexe --}}
            <div class="form-group">
                <label>Sexe</label>
                <select name="gender">
                    <option value="">-- Sélectionnez --</option>
                    <option value="Homme" {{ old('gender', $user->gender) == 'Homme' ? 'selected' : '' }}>Homme</option>
                    <option value="Femme" {{ old('gender', $user->gender) == 'Femme' ? 'selected' : '' }}>Femme</option>
                </select>

                @error('gender')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn-save" type="submit">Sauvegarder</button>

            @if (session('status') === 'profile-updated')
                <p class="saved-message">✔ Profil mis à jour</p>
            @endif
        </div>
    </form>

    {{-- RÉSEAUX SOCIAUX (statique pour l’instant) --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="profile-section">
            <h2 class="section-title">Réseaux sociaux</h2>

            {{-- X.com --}}
            <div class="form-group">
                <label>x.com</label>
                <input type="url" 
                    name="x_com"
                    placeholder="https://x.com/username"
                    value="{{ old('x_com', $user->x_com) }}">

                @error('x_com')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Facebook --}}
            <div class="form-group">
                <label>Facebook</label>
                <input type="url" 
                    name="facebook"
                    placeholder="https://facebook.com/username"
                    value="{{ old('facebook', $user->facebook) }}">

                @error('facebook')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- LinkedIn --}}
            <div class="form-group">
                <label>LinkedIn</label>
                <input type="url" 
                    name="linkedin"
                    placeholder="https://linkedin.com/in/username"
                    value="{{ old('linkedin', $user->linkedin) }}">

                @error('linkedin')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Instagram --}}
            <div class="form-group">
                <label>Instagram</label>
                <input type="url" 
                    name="instagram"
                    placeholder="https://instagram.com/username"
                    value="{{ old('instagram', $user->instagram) }}">

                @error('instagram')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- YouTube --}}
            <div class="form-group">
                <label>YouTube</label>
                <input type="url" 
                    name="youtube"
                    placeholder="https://youtube.com/channel"
                    value="{{ old('youtube', $user->youtube) }}">

                @error('youtube')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- TikTok --}}
            <div class="form-group">
                <label>TikTok</label>
                <input type="url" 
                    name="tiktok"
                    placeholder="https://tiktok.com/@username"
                    value="{{ old('tiktok', $user->tiktok) }}">

                @error('tiktok')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- WhatsApp --}}
            <div class="form-group">
                <label>WhatsApp</label>
                <input type="tel" 
                    name="whatsapp"
                    placeholder="+213xxxxxxxx"
                    value="{{ old('whatsapp', $user->whatsapp) }}">

                @error('whatsapp')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Vérification d’identité --}}
            <div class="form-group">
                <label>Vérification d’identité</label>
                <input type="file" 
                    name="identity_verification"
                    accept="image/*">

                @error('identity_verification')
                    <small class="error">{{ $message }}</small>
                @enderror

                @if ($user->identity_verification)
                    <p class="mt-2">
                        <a href="{{ asset('storage/' . $user->identity_verification) }}" target="_blank">
                            Voir le document actuel
                        </a>
                    </p>
                @endif
            </div>

            <button class="btn-save">Sauvegarder</button>

            @if (session('status') === 'profile-updated')
                <p class="saved-message">✔ Informations mises à jour</p>
            @endif
        </div>
    </form>
</div>

@endsection
