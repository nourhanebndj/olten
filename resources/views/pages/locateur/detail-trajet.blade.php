<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Olten-location.fr - detail trajet</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <!-- Feuille de style  -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
  <x-header />

  <main class="detail-trajet-main">
    <div class="detail-trajet-container">
      <!-- Colonne gauche -->
      <div class="detail-trajet-left">
        <h1>Détails du trajet</h1>

        <!-- Carton trajet aller -->
        <div class="trajet-card">
          <div class="journey-times">
            <div class="time-block">
              <span class="time">11:00</span>
              <span class="location">La Queue-en-Brie</span>
              <span class="address">6 Rue Edgar Degas</span>
            </div>
            <div class="journey-line"></div>
            <div class="time-block">
              <span class="time">19:30</span>
              <span class="location">Marseille</span>
              <span class="address">METRO La Fourragère</span>
            </div>
          </div>
        </div>

        <!-- Carton trajet retour -->
        <div class="trajet-card">
          <h3 class="return-title">Aller • Mercredi 11 février</h3>
          <div class="journey-times">
            <div class="time-block">
              <span class="time">11:00</span>
              <span class="location">La Queue-en-Brie</span>
              <span class="address">6 Rue Edgar Degas</span>
            </div>
            <div class="journey-line"></div>
            <div class="time-block">
              <span class="time">19:30</span>
              <span class="location">Marseille</span>
              <span class="address">METRO La Fourragère</span>
            </div>
          </div>
        </div>

        <!-- Profil conducteur -->
        <div class="driver-card">
          <div class="driver-header">
            <div class="driver-avatar">
              <img src="{{ asset('assets/images/photo-profil/provi-profil.jpg') }}" alt="Mo">
            </div>
            <div class="driver-info">
              <h3>Mo</h3>
              <div class="driver-rating">
                <i class="fas fa-star"></i>
                <span>4.98/5 - 52 avis</span>
              </div>
            </div>
            <div class="driver-action">
              <i class="fas fa-chevron-right"></i>
            </div>
          </div>

          <div class="driver-details">
            <div class="detail-item verified">
              <i class="fas fa-check-circle"></i>
              <span>Profil Vérifié</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-history"></i>
              <span>N'annule jamais ses trajets</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-calendar-check"></i>
              <span>Votre réservation sera confirmée lorsque le conducteur acceptera votre demande</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-smoking"></i>
              <span>Cigarette autorisée</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-ban"></i>
              <span>Je préfère ne pas voyager en compagnie d'animaux</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-users"></i>
              <span>Max. 2 à l'arrière</span>
            </div>
          </div>

          <button class="btn-contact-driver">
            <i class="fas fa-comments"></i>
            Contacter Mo
          </button>
        </div>
      </div>

      <!-- Colonne droite (sticky) -->
      <div class="detail-trajet-right">
        <div class="booking-card sticky">
          <div class="booking-header">
            <span class="booking-label">Aller • Mercredi 11 février</span>
          </div>

          <div class="journey-summary">
            <div class="journey-item">
              <div class="time">11:00</div>
              <div class="location">La Queue-en-Brie</div>
              <div class="address">6 Rue Edgar Degas</div>
            </div>
            <div class="journey-separator"></div>
            <div class="journey-item">
              <div class="time">19:30</div>
              <div class="location">Marseille</div>
              <div class="address">METRO La Fourragère</div>
            </div>
          </div>

          <div class="driver-mini">
            <img src="{{ asset('assets/images/photo-profil/provi-profil.jpg') }}" alt="Mo">
            <div class="driver-mini-info">
              <span class="name">Mo</span>
              <div class="rating">
                <i class="fas fa-star"></i>
                <span>5</span>
              </div>
            </div>
            <div class="car-icon">
              <i class="fas fa-car"></i>
            </div>
          </div>

          <div class="price-section">
            <span class="passengers">1 passager</span>
            <div class="price">51<sup>€9</sup></div>
          </div>

          <button class="btn-book-journey">
            <i class="fas fa-calendar-check"></i>
            Demande de réservation
          </button>
        </div>
      </div>
    </div>
  </main>

  <x-footer />

</body>
</html>