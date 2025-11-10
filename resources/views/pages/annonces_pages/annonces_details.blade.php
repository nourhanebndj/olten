<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Olten-location.fr - Annonce detail</title>
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
 <!-- Galerie d'images -->
    <div class="image-gallery">
        <div class="gallery-container">
            <div class="gallery-slides" id="gallerySlides">
                <div class="gallery-slide">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=450&fit=crop" alt="Image 1">
                </div>
                <div class="gallery-slide">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=450&fit=crop" alt="Image 2">
                </div>
                <div class="gallery-slide">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?w=600&h=450&fit=crop" alt="Image 3">
                </div>
                <div class="gallery-slide">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=450&fit=crop" alt="Image 4">
                </div>
            </div>
            <button class="gallery-nav prev" onclick="changeSlide(-1)">‹</button>
            <button class="gallery-nav next" onclick="changeSlide(1)">›</button>
            <div class="gallery-indicators" id="indicators"></div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="container-annonce-details">
        <div class="main-content-annonce">
            <!-- Section gauche -->
            <div class="left-section-annonce">
                <div class="breadcrumb">
                    <a href="#">Outils et matériel de bricolage</a>
                    <span>›</span>
                    <span>Saint-Étienne</span>
                </div>

                <div class="status-badge">
                    <i class="fas fa-check-circle"></i>
                    Commence à partir de €30.00
                </div>

                <h1>Karcher vapeur eau chaude</h1>

                <div class="tags-container">
                    <div class="category-tag">
                        <i class="fas fa-tools"></i>
                        Outils et matériel de bricolage
                    </div>
                    <div class="location-tag">
                        <i class="fas fa-map-marker-alt"></i>
                        Saint-Étienne
                    </div>
                </div>

                <div class="tabs-navigation">
                    <a href="#apercu" class="tab-link active" onclick="scrollToSection(event, 'apercu')">Aperçu</a>
                    <a href="#description" class="tab-link" onclick="scrollToSection(event, 'description')">Description</a>
                    <a href="#emplacement" class="tab-link" onclick="scrollToSection(event, 'emplacement')">Emplacement</a>
                </div>

                <section id="apercu" class="content-section">
                    <h2 class="section-title">Aperçu</h2>
                    <p class="description">
                        Trotinette urban glide. Lorem ipsum. m. Tout terrain ! Batterie au lithium. Reloadie et facile de transport en plus a une main. Elle marche plus que vous la pour vous faciliter les trajets du quotidient.
                    </p>
                </section>

                <section id="description" class="content-section">
                    <h2 class="section-title">Description</h2>
                    <p class="description">
                        Ce Karcher vapeur à eau chaude professionnel est idéal pour un nettoyage en profondeur. Parfait pour les travaux de bricolage et le nettoyage industriel. Équipement en excellent état, bien entretenu et prêt à l'emploi.
                    </p>
                    <p class="description">
                        Caractéristiques principales :
                        • Puissance élevée pour un nettoyage efficace<br>
                        • Facilité d'utilisation et de transport<br>
                        • Entretien régulier garanti<br>
                        • Idéal pour usage professionnel ou domestique intensif
                    </p>
                </section>

                <section id="emplacement" class="content-section location-section">
                    <h2 class="section-title">Emplacement</h2>
                    <div class="map-container">
                        <i class="fas fa-map-marker-alt" style="font-size: 48px; color: #999;"></i>
                        <span style="margin-left: 15px;">Carte de localisation (Saint-Étienne)</span>
                    </div>
                </section>
            </div>

            <!-- Section droite -->
            <div class="right-section">
                <div class="alert-box">
                    <i class="fas fa-exclamation-triangle alert-icon"></i>
                    <span>Non vérifié. Revendiquer cette annonce !</span>
                </div>

                <div class="reservation-box">
                    <div class="reservation-title">
                        <i class="far fa-calendar-alt"></i>
                        Réservation
                    </div>

                    <div class="date-selector">
                        <label>Sélectionnez les Dates</label>
                        <input type="date" placeholder="Date de début">
                    </div>

                    <button class="reserve-button">Réserver Maintenant</button>

                    <div class="action-buttons">
                        <button class="action-btn">
                            <i class="far fa-comment"></i>
                            Message
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-phone"></i>
                            Appeler
                        </button>
                        <button class="action-btn">
                            <i class="far fa-heart"></i>
                            J'aime
                        </button>
                    </div>

                    <button class="signal-btn">
                        <i class="fas fa-flag"></i>
                        Signaler cette annonce
                    </button>
                </div>
            </div>
        </div>
    </div>

  </main>
  <x-footer />

  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>