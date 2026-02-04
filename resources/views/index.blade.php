<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Olten-location.fr</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <!---------Swiper------------>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- Feuille de style  -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
  <x-header />

  <main>
        <!----HERO SECTION------>
        <section class="hero-section">
        <div class="hero-content">
            <h1><span>Olten</span>-<span class="highlight">location.fr</span></h1>
            <p>
            Avec Olten-location.fr, trouvez ce qu’il vous faut près de chez vous, 
            ou mettez vos propres affaires en location pour arrondir vos fins de mois.
            </p>
            <div class="hero-buttons">
            <a href="{{ route(name: 'deposer_annonce') }}" class="btn-orange">Déposer une annonce</a>
            <a href="{{ route('creer.site') }}" class="btn-black">Créer un site</a>
            </div>
        </div>
        </section>

    <!----CATEGORIES SECTION------>
    <section class="categories-section">
      <div class="section-header">
        <h2 class="section-title">Découvrez nos catégories</h2>
        <p class="section-subtitle">Parcourez notre sélection et explorez ce qui vous intéresse.</p>
      </div>

      <div class="categories-carousel">
        <button class="carousel-nav-btn prev-btn" aria-label="Précédent">
          <i class="fas fa-chevron-left"></i>
        </button>

        <div class="carousel-container">
          <div class="carousel-track">
            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=600&h=800&fit=crop" alt="Location sport & loisir" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location sport & loisir</h3>
                <a href="#" class="category-btn">Parcourir</a>
              </div>
            </div>

            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=600&h=800&fit=crop" alt="Location véhicule" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location véhicule</h3>
                <a href="{{ route('intermediaire.transport') }}" class="category-btn">Parcourir</a>
              </div>
            </div>

            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&h=800&fit=crop" alt="Location électronique" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location électronique</h3>
                <a href="#" class="category-btn">Parcourir</a>
              </div>
            </div>

            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=600&h=800&fit=crop" alt="Location événementiel" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location événementiel</h3>
                <a href="#" class="category-btn">Parcourir</a>
              </div>
            </div>

            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=600&h=800&fit=crop" alt="Location immobilier" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location immobilier</h3>
                <a href="#" class="category-btn">Parcourir</a>
              </div>
            </div>

            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=600&h=800&fit=crop" alt="Location bricolage" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location bricolage</h3>
                <a href="#" class="category-btn">Parcourir</a>
              </div>
            </div>

            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1511376777868-611b54f68947?w=600&h=800&fit=crop" alt="Location multimédia" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location multimédia</h3>
                <a href="#" class="category-btn">Parcourir</a>
              </div>
            </div>

            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1505798577917-a65157d3320a?w=600&h=800&fit=crop" alt="Location mode" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location mode</h3>
                <a href="#" class="category-btn">Parcourir</a>
              </div>
            </div>

            <div class="category-card">
              <img src="https://images.unsplash.com/photo-1488972685288-c3fd157d7c7a?w=600&h=800&fit=crop" alt="Location matériel" class="category-image">
              <div class="category-content">
                <h3 class="category-title">Location matériel</h3>
                <a href="#" class="category-btn">Parcourir</a>
              </div>
            </div>
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
      <h2 class="section-title">Les Annonces qui Font Parler d'elles sur <span class="site-name">Olten-location.fr</span></h2>

      <div class="annonces-carousel">
        <button class="carousel-btn prev-btn" aria-label="Précédent">
          <i class="fas fa-chevron-left"></i>
        </button>

        <div class="carousel-wrapper">
          <div class="carousel-track">
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
                  <span class="info-icon">
                    <i class="fas fa-question"></i>
                  </span>
                </h3>
                <p class="card-price">Commence à partir de €30,00</p>
              </div>
            </div>

            <div class="annonce-card">
              <div class="card-image-container">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=450&fit=crop" alt="Aspirateur feuille Pro" class="card-image">
                <span class="watermark">leboncoin</span>
                <span class="category-badge">Location maison & bricolage</span>
                <button class="favorite-btn" aria-label="Ajouter aux favoris">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="card-content">
                <h3 class="card-title">
                  Aspirateur feuille Pro
                  <span class="info-icon">
                    <i class="fas fa-question"></i>
                  </span>
                </h3>
                <p class="card-price">Commence à partir de €40,00</p>
              </div>
            </div>

            <div class="annonce-card">
              <div class="card-image-container">
                <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?w=600&h=450&fit=crop" alt="Livre Programmation C++" class="card-image">
                <span class="watermark">leboncoin</span>
                <span class="category-badge">Location sport & loisir</span>
                <button class="favorite-btn" aria-label="Ajouter aux favoris">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="card-content">
                <h3 class="card-title">
                  Livre Programmation C++
                  <span class="info-icon">
                    <i class="fas fa-question"></i>
                  </span>
                </h3>
                <p class="card-price">Commence à partir de €2,00</p>
              </div>
            </div>

            <div class="annonce-card">
              <div class="card-image-container">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=450&fit=crop" alt="Scène professionnelle" class="card-image">
                <span class="watermark">leboncoin</span>
                <span class="category-badge">Location événementiel</span>
                <button class="favorite-btn" aria-label="Ajouter aux favoris">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="card-content">
                <h3 class="card-title">
                  Scène professionnelle 7m x 5m
                  <span class="info-icon">
                    <i class="fas fa-question"></i>
                  </span>
                </h3>
                <p class="card-price">Commence à partir de €300,00</p>
              </div>
            </div>

            <div class="annonce-card">
              <div class="card-image-container">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=450&fit=crop" alt="Casque audio pro" class="card-image">
                <span class="watermark">leboncoin</span>
                <span class="category-badge">Location multimédia</span>
                <button class="favorite-btn" aria-label="Ajouter aux favoris">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="card-content">
                <h3 class="card-title">
                  Casque audio professionnel
                  <span class="info-icon">
                    <i class="fas fa-question"></i>
                  </span>
                </h3>
                <p class="card-price">Commence à partir de €15,00</p>
              </div>
            </div>
          </div>
        </div>

        <button class="carousel-btn next-btn" aria-label="Suivant">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <div class="carousel-dots"></div>
    </section>

  </main>

  <x-footer />

  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>