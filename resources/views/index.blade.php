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
            <a href="{{ route('deposer_annonce') }}" class="btn-orange">Déposer une annonce</a>
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

                {{-- Exemple d'annonce --}}
                <div class="annonce-card">
                    <div class="card-image-container">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=600&h=450&fit=crop" alt="Karcher vapeur eau chaude" class="card-image">
                        <span class="watermark">leboncoin</span>
                        <span class="category-badge">Outils et matériel de bricolage</span>
                        <button class="favorite-btn" aria-label="Ajouter aux favoris">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">
                            Karcher vapeur eau chaude
                            <span class="info-icon"><i class="fas fa-question"></i></span>
                        </h3>
                        <p class="card-price">Commence à partir de €30,00</p>
                    </div>
                </div>

                {{-- ... toutes les autres annonces ... --}}

            </div>
        </div>

        <button class="carousel-btn next-btn" aria-label="Suivant">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <div class="carousel-dots"></div>
</section>

@endsection
