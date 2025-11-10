<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Olten-location.fr - Contact</title>
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
            <section class="hero-map-section">
            <div class="map-container">
                <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2786.8347106019554!2d4.542!3d45.497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f49b38a2c9f3d3%3A0x40cb7a0e1a85240!2sL'Horme%2C%2042152%20Loire%2C%20France!5e0!3m2!1sfr!2sfr!4v1696876475405!5m2!1sfr!2sfr" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <div class="contact-contact-info">
                <h2>Contactez-nous sur </h2>
                <hr class="separator">
                <p><a href="mailto:olten-location@outlook.fr">olten-location@outlook.fr</a></p>
                <br>
                <p>L’Horme, 42152 Département de la Loire,Région Auvergne-Rhône-Alpes, France</p>
            </div>
            </section>


        <!----Form SECTION------>
<section class="contact-contact-section">
    <div class="container">
        <form action="/contact" method="post" class="contact-form">
            <div class="form-group">
                <label for="name">Votre nom</label>
                <input type="text" id="name" name="name" placeholder="Entrez votre nom" required>
            </div>

            <div class="form-group">
                <label for="email">Votre e-mail</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
            </div>

            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" placeholder="Entrez le sujet" required>
            </div>

            <div class="form-group">
                <label for="message">Votre message (facultatif)</label>
                <textarea id="message" name="message" rows="6" placeholder="Écrivez votre message..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
    </div>
</section>

  </main>
  <x-footer />

  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>