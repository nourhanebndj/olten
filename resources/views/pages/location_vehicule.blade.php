<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Olten-location.fr - Location de véhicule</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <!-- Feuille de style  -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
  <x-header />

  <main>
    <!-- HERO SECTION -->
    <section class="hero-section" style="background: url('{{ asset('assets/images/tesla-8327257_1280.jpg') }}') center/cover no-repeat; padding: 80px 20px; height: 400px;">
      <div class="hero-content" style="text-align: center; color: white;">
        <!-- <h1 style="font-size: 48px; margin-bottom: 20px; font-weight: 700;">Location de Véhicules</h1> -->
        <!-- <p style="font-size: 18px; margin-bottom: 30px;">Trouvez le véhicule parfait pour vos déplacements</p> -->
      </div>
    </section>

    <!-- FORMULAIRE DE RECHERCHE -->
    <section class="search-section" style="padding: 60px 20px; background: #f5f5f5;">
      <div class="container" style="max-width: 1200px; margin: 0 auto;">
        
        <!-- ONGLETS LOCATION / COVOITURAGE -->
        <div style="display: flex; justify-content: center; margin-bottom: 40px; gap: 10px;">
          <button class="search-tab active" data-tab="location" style="padding: 12px 30px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
            <i class="fa-solid fa-car" style="margin-right: 8px;"></i>Location de véhicules
          </button>
          <button class="search-tab" data-tab="covoiturage" style="padding: 12px 30px; background: white; color: #1b1b18; border: 2px solid #FF6B35; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
            <i class="fa-solid fa-people-group" style="margin-right: 8px;"></i>Covoiturage
          </button>
        </div>

        <!-- LOCATION FORM -->
        <div id="location-form" class="search-form-tab" style="display: block;">
          <h2 style="text-align: center; margin-bottom: 40px; font-size: 32px; color: #1b1b18;">Rechercher un véhicule</h2>
          
          <form class="search-form" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px;">
            
            <div class="form-group">
              <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Lieu de départ</label>
              <div style="position: relative;">
                <i class="fa-solid fa-location-dot" style="position: absolute; left: 12px; top: 12px; color: #FF6B35;"></i>
                <input type="text" placeholder="Où commencer ?" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
              </div>
            </div>

            <div class="form-group">
              <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Lieu de fin</label>
              <div style="position: relative;">
                <i class="fa-solid fa-location-dot" style="position: absolute; left: 12px; top: 12px; color: #FF6B35;"></i>
                <input type="text" placeholder="Où aller ?" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
              </div>
            </div>

            <div class="form-group">
              <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Date de départ</label>
              <div style="position: relative;">
                <i class="fa-solid fa-calendar" style="position: absolute; left: 12px; top: 12px; color: #FF6B35;"></i>
                <input type="date" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
              </div>
            </div>

            <div class="form-group">
              <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Date de retour</label>
              <div style="position: relative;">
                <i class="fa-solid fa-calendar" style="position: absolute; left: 12px; top: 12px; color: #FF6B35;"></i>
                <input type="date" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
              </div>
            </div>

            <div class="form-group">
              <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Type de véhicule</label>
              <select style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                <option>Tous les véhicules</option>
                <option>Voiture</option>
                <option>SUV</option>
                <option>Monospace</option>
                <option>Utilitaire</option>
                <option>Moto</option>
                <option>Camping-car</option>
              </select>
            </div>
          </div>

          <button type="submit" style="width: 100%; padding: 14px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; transition: transform 0.2s;">
            <i class="fa-solid fa-search"></i> Rechercher des véhicules
          </button>
          </form>
        </div>

        <!-- COVOITURAGE FORM -->
        <div id="covoiturage-form" class="search-form-tab" style="display: none;">
          <h2 style="text-align: center; margin-bottom: 40px; font-size: 32px; color: #1b1b18;">Trouver un covoiturage</h2>
          
          <form class="search-form" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px;">
              
              <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Départ</label>
                <div style="position: relative;">
                  <i class="fa-solid fa-location-dot" style="position: absolute; left: 12px; top: 12px; color: #FF6B35;"></i>
                  <input type="text" placeholder="Ville de départ" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                </div>
              </div>

              <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Destination</label>
                <div style="position: relative;">
                  <i class="fa-solid fa-location-dot" style="position: absolute; left: 12px; top: 12px; color: #FF6B35;"></i>
                  <input type="text" placeholder="Ville de destination" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                </div>
              </div>

              <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Date de départ</label>
                <div style="position: relative;">
                  <i class="fa-solid fa-calendar" style="position: absolute; left: 12px; top: 12px; color: #FF6B35;"></i>
                  <input type="date" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                </div>
              </div>

              <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #1b1b18;">Nombre de passagers</label>
                <div style="position: relative;">
                  <i class="fa-solid fa-users" style="position: absolute; left: 12px; top: 12px; color: #FF6B35;"></i>
                  <select style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                    <option>1 passager</option>
                    <option>2 passagers</option>
                    <option>3 passagers</option>
                    <option>4 passagers</option>
                    <option>5 passagers</option>
                  </select>
                </div>
              </div>
            </div>

            <button type="submit" style="width: 100%; padding: 14px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; transition: transform 0.2s;">
              <i class="fa-solid fa-search"></i> Chercher un covoiturage
            </button>
          </form>
        </div>
      </div>
    </section>

    <!-- CATEGORIES DE VEHICULES -->
    <section class="vehicles-categories" style="padding: 60px 20px;">
      <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h2 style="text-align: center; margin-bottom: 40px; font-size: 32px; color: #1b1b18;">Parcourez par type de véhicule</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
          
          <div style="background: white; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;">
            <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-car" style="font-size: 60px; color: white;"></i>
            </div>
            <div style="padding: 20px; text-align: center;">
              <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 8px;">Voiture</h3>
              <p style="color: #999; margin-bottom: 15px;">Locations de voitures de tous types</p>
              <a href="{{ route('categories') }}" style="color: #FF6B35; font-weight: 600; text-decoration: none;">Voir les annonces →</a>
            </div>
          </div>

          <div style="background: white; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;">
            <div style="height: 200px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-van-shuttle" style="font-size: 60px; color: white;"></i>
            </div>
            <div style="padding: 20px; text-align: center;">
              <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 8px;">SUV</h3>
              <p style="color: #999; margin-bottom: 15px;">Pour vos aventures tout-terrain</p>
              <a href="#" style="color: #FF6B35; font-weight: 600; text-decoration: none;">Voir les annonces →</a>
            </div>
          </div>

          <div style="background: white; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;">
            <div style="height: 200px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-people-group" style="font-size: 60px; color: white;"></i>
            </div>
            <div style="padding: 20px; text-align: center;">
              <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 8px;">Monospace</h3>
              <p style="color: #999; margin-bottom: 15px;">Pour les familles et groupes</p>
              <a href="#" style="color: #FF6B35; font-weight: 600; text-decoration: none;">Voir les annonces →</a>
            </div>
          </div>

          <div style="background: white; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;">
            <div style="height: 200px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-cube" style="font-size: 60px; color: white;"></i>
            </div>
            <div style="padding: 20px; text-align: center;">
              <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 8px;">Utilitaire</h3>
              <p style="color: #999; margin-bottom: 15px;">Pour vos déménagements</p>
              <a href="#" style="color: #FF6B35; font-weight: 600; text-decoration: none;">Voir les annonces →</a>
            </div>
          </div>

          <div style="background: white; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;">
            <div style="height: 200px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-motorcycle" style="font-size: 60px; color: white;"></i>
            </div>
            <div style="padding: 20px; text-align: center;">
              <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 8px;">Moto</h3>
              <p style="color: #999; margin-bottom: 15px;">Pour les amateurs de deux-roues</p>
              <a href="#" style="color: #FF6B35; font-weight: 600; text-decoration: none;">Voir les annonces →</a>
            </div>
          </div>

          <div style="background: white; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;">
            <div style="height: 200px; background: linear-gradient(135deg, #ff9a56 0%, #ff6a88 100%); display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-caravan" style="font-size: 60px; color: white;"></i>
            </div>
            <div style="padding: 20px; text-align: center;">
              <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 8px;">Camping-car</h3>
              <p style="color: #999; margin-bottom: 15px;">Pour vos vacances en liberté</p>
              <a href="#" style="color: #FF6B35; font-weight: 600; text-decoration: none;">Voir les annonces →</a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ANNONCES RECENTES -->
    <section class="recent-listings" style="padding: 60px 20px; background: #f5f5f5;">
      <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h2 style="text-align: center; margin-bottom: 40px; font-size: 32px; color: #1b1b18;">Annonces récentes</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
          
          <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
            <div style="position: relative; height: 200px; background: #ddd;">
              <img src="https://images.unsplash.com/photo-1552519507-da3effff991-?w=400&h=300&fit=crop" alt="Peugeot 308" style="width: 100%; height: 100%; object-fit: cover;">
              <span style="position: absolute; top: 10px; right: 10px; background: #FF6B35; color: white; padding: 5px 10px; border-radius: 4px; font-weight: 600;">40€/jour</span>
            </div>
            <div style="padding: 15px;">
              <h3 style="font-size: 18px; color: #1b1b18; margin-bottom: 8px;">Peugeot 308</h3>
              <p style="color: #999; font-size: 14px; margin-bottom: 10px;">
                <i class="fa-solid fa-location-dot"></i> Paris, Île-de-France
              </p>
              <div style="display: flex; gap: 10px; font-size: 14px; margin-bottom: 12px; color: #666;">
                <span><i class="fa-solid fa-user-circle"></i> Marie D.</span>
              </div>
              <button style="width: 100%; padding: 10px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); color: white; border: none; border-radius: 4px; font-weight: 600; cursor: pointer;">Voir détails</button>
            </div>
          </div>

          <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
            <div style="position: relative; height: 200px; background: #ddd;">
              <img src="https://images.unsplash.com/photo-1609687739428-1f8b33b24d65?w=400&h=300&fit=crop" alt="Toyota Yaris" style="width: 100%; height: 100%; object-fit: cover;">
              <span style="position: absolute; top: 10px; right: 10px; background: #FF6B35; color: white; padding: 5px 10px; border-radius: 4px; font-weight: 600;">35€/jour</span>
            </div>
            <div style="padding: 15px;">
              <h3 style="font-size: 18px; color: #1b1b18; margin-bottom: 8px;">Toyota Yaris</h3>
              <p style="color: #999; font-size: 14px; margin-bottom: 10px;">
                <i class="fa-solid fa-location-dot"></i> Lyon, Rhône
              </p>
              <div style="display: flex; gap: 10px; font-size: 14px; margin-bottom: 12px; color: #666;">
                <span><i class="fa-solid fa-user-circle"></i> Jean P.</span>
              </div>
              <button style="width: 100%; padding: 10px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); color: white; border: none; border-radius: 4px; font-weight: 600; cursor: pointer;">Voir détails</button>
            </div>
          </div>

          <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
            <div style="position: relative; height: 200px; background: #ddd;">
              <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=400&h=300&fit=crop" alt="Renault Clio" style="width: 100%; height: 100%; object-fit: cover;">
              <span style="position: absolute; top: 10px; right: 10px; background: #FF6B35; color: white; padding: 5px 10px; border-radius: 4px; font-weight: 600;">30€/jour</span>
            </div>
            <div style="padding: 15px;">
              <h3 style="font-size: 18px; color: #1b1b18; margin-bottom: 8px;">Renault Clio</h3>
              <p style="color: #999; font-size: 14px; margin-bottom: 10px;">
                <i class="fa-solid fa-location-dot"></i> Marseille, Provence
              </p>
              <div style="display: flex; gap: 10px; font-size: 14px; margin-bottom: 12px; color: #666;">
                <span><i class="fa-solid fa-user-circle"></i> Sophie L.</span>
              </div>
              <button style="width: 100%; padding: 10px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); color: white; border: none; border-radius: 4px; font-weight: 600; cursor: pointer;">Voir détails</button>
            </div>
          </div>

        </div>

        <div style="text-align: center; margin-top: 40px;">
          <a href="{{ route('categories') }}" style="display: inline-block; padding: 14px 30px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
            Voir toutes les annonces
          </a>
        </div>
      </div>
    </section>

    <!-- INFO SECTION -->
    <section class="info-section" style="padding: 60px 20px; background: white;">
      <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h2 style="text-align: center; margin-bottom: 40px; font-size: 32px; color: #1b1b18;">Pourquoi choisir Olten Location ?</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
          
          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-shield-halved" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Sécurisé & Assuré</h3>
            <p style="color: #666;">Tous nos véhicules sont vérifiés et assurés pour votre tranquillité d'esprit</p>
          </div>

          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-wallet" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Meilleurs Prix</h3>
            <p style="color: #666;">Comparez les prix et trouvez les meilleures offres de location</p>
          </div>

          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-headset" style="font-size: 40px; color: white;"><a href="{{ route('location.vehicule', ['type' => 'covoiturage']) }}"></a></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Support 24/7</h3>
            <p style="color: #666;">Notre équipe est toujours disponible pour vous aider</p>
          </div>

          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <a href="#" target="blank"><i class="fa-solid fa-star" style="font-size: 40px; color: white;"></i></a>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Notés 5⭐</h3>
            <p style="color: #666;">Lisez les avis vérifiés de nos clients satisfaits</p>
          </div>

          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-clock" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Réservation Rapide</h3>
            <p style="color: #666;">Réservez en quelques clics, en moins de 2 minutes</p>
          </div>

          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-handshake" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Entre Particuliers</h3>
            <p style="color: #666;">Louez directement auprès des propriétaires locaux</p>
          </div>

        </div>
      </div>
    </section>

  </main>

  <x-footer />

<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Script pour gérer les onglets Location/Covoiturage -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.search-tab');
    const locationForm = document.getElementById('location-form');
    const covoiturageForm = document.getElementById('covoiturage-form');

    tabs.forEach(tab => {
      tab.addEventListener('click', function() {
        const tabName = this.getAttribute('data-tab');
        
        // Mettre à jour les onglets actifs
        tabs.forEach(t => {
          t.classList.remove('active');
          t.style.background = 'white';
          t.style.color = '#1b1b18';
          t.style.borderColor = '#FF6B35';
        });
        
        this.classList.add('active');
        this.style.background = 'linear-gradient(135deg, #FF6B35 0%, #F7931E 100%)';
        this.style.color = 'white';
        this.style.borderColor = 'transparent';
        
        // Afficher/Cacher les formulaires
        if (tabName === 'location') {
          locationForm.style.display = 'block';
          covoiturageForm.style.display = 'none';
        } else {
          locationForm.style.display = 'none';
          covoiturageForm.style.display = 'block';
        }
      });
    });
  });
</script>

</body>
</html>
