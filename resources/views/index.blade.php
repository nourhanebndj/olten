@extends('layouts.main')

@section('title', 'Accueil - Olten-location.fr')

@section('content')

<!----HERO SECTION------>
<section class="hero-section">
    <div class="hero-content">
        <h1><span>Olten</span>-<span class="highlight">location.fr</span></h1>
        <p>
            Avec Olten-location.fr, trouvez ce qu’il vous faut près de chez vous,
            ou mettez vos propres affaires en location pour arrondir vos fins de mois.
        </p>
        <div class="hero-buttons">
            <a href="{{ route('ads.create') }}" class="btn-orange">Déposer une annonce</a>
            <a href="{{ route('creer.site') }}" class="btn-black">Créer un site</a>
        </div>
    </div>
</section>

<!---- CATEGORIES SECTION ------>
<section class="categories-section">
    <div class="section-header">
        <h2 class="section-title">Découvrez nos catégories</h2>
        <p class="section-subtitle">
            Parcourez notre sélection et explorez ce qui vous intéresse.
        </p>
    </div>

    <div class="categories-carousel">
        <button class="carousel-nav-btn prev-btn" aria-label="Précédent">
            <i class="fas fa-chevron-left"></i>
        </button>

        <div class="carousel-container">
            <div class="carousel-track">

                @forelse($categories as $category)
                    <div class="category-card">
                        <img 
                            src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->nom }}"
                            class="category-image"
                        >

                        <div class="category-content">
                            <h3 class="category-title">{{ $category->nom }}</h3>

                            <a 
                                href=""
                                class="category-btn"
                            >
                                Parcourir
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center">
                        Aucune catégorie disponible pour le moment.
                    </p>
                @endforelse

            </div>
        </div>

        <button class="carousel-nav-btn next-btn" aria-label="Suivant">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <div class="carousel-dots"></div>
</section>


<!----------Plus récent annonce-------------->
@php
    $approvedAds = $ads->where('is_approved', true);
    use Carbon\Carbon;
@endphp

@if($approvedAds->isNotEmpty())
    <section class="annonces-section">
        <h2 class="section-title">
            Les Annonces qui Font Parler d'elles sur <span class="site-name">Olten-location.fr</span>
        </h2>

        <div class="annonces-carousel">
            <button class="carousel-btn prev-btn" aria-label="Précédent">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="carousel-wrapper">
                <div class="carousel-track">
                    @forelse($ads as $ad)
                        @if($ad->is_approved)
                            <a href="{{ route('ads.show', $ad) }}" class="annonce-card" id="ad-link">
                                <div class="card-image-container">
                                    <img src="{{ $ad->images->first() ? asset('storage/' . $ad->images->first()->path) : asset('assets/images/no-image.jpg') }}" alt="{{ $ad->title }}" class="card-image">
                                    <span class="watermark">leboncoin</span>
                                    <span class="category-badge">{{ $ad->category->nom ?? 'Catégorie non définie' }}</span>
                                    <button class="favorite-btn" aria-label="Ajouter aux favoris" data-ad-id="{{ $ad->id }}" data-favorited="{{ auth()->check() && auth()->user()->hasFavorited($ad) ? 'true' : 'false' }}">
                                        <i class="{{ auth()->check() && auth()->user()->hasFavorited($ad) ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                    </button>
                                </div>
                                <div class="card-content">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">
                                            {{ $ad->title }}
                                            <span class="info-icon"><i class="fas fa-question"></i></span>
                                        </h3>
                                        @if($ad->expires_at && Carbon::parse($ad->expires_at)->toDateString() < now()->toDateString())
                                            <span class="expired">Expirée</span>
                                        @endif
                                    </div>
                                    
                                    <p class="card-price">Commence à partir de {{ number_format($ad->price_per_day, 2) }} € / jour</p>
                                </div>
                            </a>
                        @endif
                    @empty
                        <p class="text-center">
                            Aucune annonce disponible pour le moment.
                        </p>
                    @endforelse
                </div>
            </div>

            <button class="carousel-btn next-btn" aria-label="Suivant">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="carousel-dots"></div>
    </section>
@else
    <p class="text-center">
        Aucune annonce disponible pour le moment.
    </p>
@endif
@endsection
