<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Olten-location.fr - Comment voyager ?</title>
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
        <!-- <h1 style="font-size: 48px; margin-bottom: 20px; font-weight: 700;">Comment voyager ?</h1> -->
        <!-- <p style="font-size: 18px;">Choisissez votre mode de transport préféré</p> -->
      </div>
    </section>

    <!-- TRANSPORT OPTIONS SECTION -->
    <section class="transport-options" style="padding: 80px 20px; background: #f5f5f5;">
      <div class="container" style="max-width: 1200px; margin: 0 auto;">
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
          
          <!-- COVOITURAGE/LOCATION -->
          <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; text-align: center;">
            <div style="background: #ff3c00; padding: 50px 20px; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-car" style="font-size: 80px; color: white;"></i>
            </div>
            <div style="padding: 40px 30px;">
              <h2 style="font-size: 28px; color: #1b1b18; margin-bottom: 15px; font-weight: 700;">Covoiturage/Location</h2>
              <p style="color: #666; font-size: 16px; margin-bottom: 25px; line-height: 1.6;">
                Allez partout, à prix mini. Partagez votre trajet avec d'autres passagers et économisez.
              </p>
              <a href="{{ route('location.vehicule', ['type' => 'covoiturage']) }}" style="display: inline-block; padding: 14px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: transform 0.2s;">
                Parcourir
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- INFO SECTION -->
    <section class="info-section" style="padding: 60px 20px; background: white;">
      <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h2 style="text-align: center; margin-bottom: 40px; font-size: 32px; color: #1b1b18;">Pourquoi Olten Location ?</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
          
          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-shield" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Sécurisé</h3>
            <p style="color: #666;">Plateforme sécurisée et certifiée</p>
          </div>

          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-euro-sign" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Meilleurs prix</h3>
            <p style="color: #666;">Les tarifs les plus compétitifs du marché</p>
          </div>

          <!-- <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-headset" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Support 24/7</h3>
            <p style="color: #666;">À votre écoute en permanence</p>
          </div> -->

          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <a href="#" target="blank"><i class="fa-solid fa-star" style="font-size: 40px; color: white;"></i></a>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Notés 5⭐</h3>
            <p style="color: #666;">Avis vérifiés de nos clients</p>
          </div>

          <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-mouse" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Réservation facile</h3>
            <p style="color: #666;">En quelques clics seulement</p>
          </div>

          <!-- <div style="text-align: center;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fa-solid fa-earth" style="font-size: 40px; color: white;"></i>
            </div>
            <h3 style="font-size: 20px; color: #1b1b18; margin-bottom: 10px;">Écologique</h3>
            <p style="color: #666;">Transport durable et responsable</p>
          </div> -->

        </div>
      </div>
    </section>

  </main>

  <x-footer />

    <script src="{{ asset('assets/js/script.js') }}"></script>
  
</body>
</html>
