@extends('layouts.connected')
@section('title', 'Ajouter un produit - Olten')

@section('content')

<div class="breadcrumb">
    <a href="#">Accueil</a>
    <span>></span>
    <span>Ajouter un produit</span>
</div>

<h1>Ajouter un produit</h1>

<form action="{{ route('seller.produits.store') }}" method="POST" enctype="multipart/form-data">
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
                <i class="fa-solid fa-box"></i>
            </div>
            <h2 class="form-section-title">Informations du produit</h2>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    Nom du produit <span class="required">*</span>
                </label>
                <input type="text" name="name" class="form-input" placeholder="Nom du produit" required>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Catégorie <span class="required">*</span>
                </label>
                <select name="category_id" class="form-select" required>
                    <option value="">Choisir Catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" placeholder="Description du produit"></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Images du produit</label>
            <input type="file" name="images[]" class="form-input" accept="image/*" multiple>
        </div>
    </div>

    <!-- SECTION PRIX & STOCK -->
    <div class="form-container">
        <div class="form-section-header">
            <div class="form-section-icon">
                <i class="fa-solid fa-tag"></i>
            </div>
            <h2 class="form-section-title">Prix & Stock</h2>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    Prix <span class="required">*</span>
                </label>
                <div class="input-group">
                    <input type="number" name="price" class="form-input" step="0.01" required>
                    <span class="input-suffix">DA</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Stock <span class="required">*</span>
                </label>
                <input type="number" name="stock" class="form-input" required>
            </div>
        </div>
    </div>

    <!-- SECTION STATUT -->
    <div class="form-container">
        <div class="form-section-header">
            <div class="form-section-icon">
                <i class="fa-solid fa-toggle-on"></i>
            </div>
            <h2 class="form-section-title">Statut</h2>
        </div>

        <div class="form-group">
            <label class="form-label">Produit actif ?</label>
            <div class="toggle-switch">
                <input type="checkbox" name="is_active" checked>
                <label class="toggle-label"></label>
            </div>
        </div>
    </div>

    <!-- SUBMIT -->
    <div class="form-actions">
        <button type="submit" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i> Ajouter le produit
        </button>
    </div>

</form>

@endsection