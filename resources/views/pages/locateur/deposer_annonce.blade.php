@extends('layouts.connected')
@section('title', 'Déposer une annonce - Olten')

@section('content')

<div class="breadcrumb">
    <a href="index.html">Accueil</a>
    <span>></span>
    <span>Déposer une annonce</span>
</div>

<h1>Déposer une annonce</h1>

<form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data" id="annonceForm">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- SECTION INFORMATIONS -->
    <div class="form-container">
        <div class="form-section-header">
            <div class="form-section-icon">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <h2 class="form-section-title">Informations</h2>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    Titre de l'annonce <span class="required">*</span>
                </label>
                <input type="text" name="title" class="form-input" 
                        placeholder="Titre de l'annonce" required>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Catégorie <span class="required">*</span>
                </label>
                <select name="category_id" class="form-select" required>
                    <option value="">Choisir Catégorie</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                    @empty
                        <option value="1">Aucune catégorie trouvée</option>
                    @endforelse
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Photo de l'annonce</label>
            <input type="file" name="image" class="form-input" accept="image/*">
        </div>
    </div>

    <!-- SECTION ADRESSE -->
    <div class="form-container">
        <div class="form-section-header">
            <div class="form-section-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <h2 class="form-section-title">Adresse du vendeur</h2>
        </div>

        <div class="map-container">
            <div id="map" style="height: 100%;"></div>
        </div>

        <div class="address-fields">
            <div class="form-group">
                <label class="form-label">Adresse</label>
                <input type="text" name="address" id="adresseVendeur" class="form-input" placeholder="Adresse vendeur">
                <ul id="adresseSuggestions" class="suggestions"></ul>
            </div>

            <div class="coordinate-fields d-none">
                <div class="form-group">
                    <label class="form-label">Longitude</label>
                    <input type="text" name="longitude" id="longitude" class="form-input" placeholder="Longitude">
                </div>
                <div class="form-group">
                    <label class="form-label">Latitude</label>
                    <input type="text" name="latitude" id="latitude" class="form-input" placeholder="Latitude">
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION TARIF -->
    <div class="form-container">
        <div class="form-section-header">
            <div class="form-section-icon">
                <i class="fa-solid fa-tag"></i>
            </div>
            <h2 class="form-section-title">Tarif de l'annonce</h2>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    Prix par jour <span class="required">*</span>
                </label>
                <div class="input-group">
                    <input type="number" name="price_per_day" class="form-input" placeholder="0" step="0.01" required>
                    <span class="input-suffix">€ / jour</span>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION LIVRAISON -->
    <div class="form-container">
        <div class="form-section-header">
            <div class="form-section-icon">
                <i class="fa-solid fa-truck"></i>
            </div>
            <h2 class="form-section-title">Livraison</h2>
        </div>

        <div class="form-group">
            <label class="form-label">Proposez-vous une livraison ?</label>
            <div class="toggle-switch">
                <input type="checkbox" name="delivery_active" id="livraisonActive">
                <label for="livraisonActive" class="toggle-label"></label>
            </div>
        </div>

        <div id="livraisonDetails" style="display:none;">
            <div class="form-group">
                <label class="form-label">Adresse du client</label>
                <input type="text" name="client_address" id="adresseClient" class="form-input" placeholder="Adresse de livraison">
                <ul id="adresseClientSuggestions" class="suggestions"></ul>
            </div>

            <div class="form-group">
                <label class="form-label">Tarif par kilomètre</label>
                <div class="input-group">
                    <input type="number" name="price_per_km" id="tarifKm" class="form-input" value="50" step="0.01">
                    <span class="input-suffix">Euro / km</span>
                </div>
            </div>

            <div class="distance-result" id="distanceResult">
                Distance : -- km<br>
                Coût total livraison : -- Euro
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i> Publier l'annonce
        </button>
    </div>
    <input type="hidden" name="distance_km" id="distanceKm">
    <input type="hidden" name="delivery_cost" id="deliveryCost">
</form>
@endsection