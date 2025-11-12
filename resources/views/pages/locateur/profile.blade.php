<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Olten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
      integrity="sha512-pVZ0/UomqzLv+Jw5s6pzR5hT+AAUz8Wv44m9X/nr2P81ZPd5f2iRFPZT+5Tb6LhZQ9Q1yH8QDsW0QJ0Gp7aO2g==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style_connecter/style_connected.css') }}">
</head>
<body>
<div class="connected-layout">
    
    {{-- SIDEBAR --}}
    @include('components.sidebar_connected')
    
    <div class="main-content">
        {{-- HEADER --}}
        @include('components.header_connected')
        
        {{-- CONTENU PRINCIPAL --}}
        <main class="dashboard-content">
            <div class="breadcrumb">
                <a href="#">Accueil</a>
                <span>></span>
                <span>Mon Profil</span>
            </div>
            <h1 class="page-title">Mon Profil</h1>
            
            <div class="profile-container">
                <!-- SECTION DÉTAILS DU PROFIL -->
                <div class="profile-section">
                    <h2 class="section-title">Détails du profil</h2>
                    
                    <div class="profile-photo-wrapper">
                        <img src="{{ asset('assets/images/user-profile.webp') }}" alt="Photo de profil" class="profile-photo" id="profilePhoto">
                        <a href="#" class="remove-photo" id="removePhotoBtn">Supprimer le fichier</a>
                        <input type="file" id="photoInput" accept="image/*" style="display: none;">
                    </div>
                    
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" value="YACINE">
                    </div>
                    
                    <div class="form-group">
                        <label for="nom">Nom de famille</label>
                        <input type="text" id="nom" name="nom" value="BOUDIAF">
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Nom d'affichage</label>
                        <select id="username" name="username">
                            <option>Réf. admin2292</option>
                        </select>
                    </div>
                </div>
                
                <!-- SECTION CHANGEMENT DE MOT DE PASSE -->
                <div class="profile-section">
                    <h2 class="section-title">Changer de mot de passe</h2>
                    
                    <div class="password-info">
                        Votre mot de passe doit comporter au moins 12 caractères aléatoires pour être sécurisé.
                    </div>
                    
                    <div class="form-group">
                        <label for="currentPassword">Mot de passe actuel</label>
                        <input type="password" id="currentPassword" name="current_password">
                    </div>
                    
                    <div class="form-group">
                        <label for="newPassword">Nouveau mot de passe</label>
                        <input type="password" id="newPassword" name="new_password">
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">Confirmer le nouveau mot de passe</label>
                        <input type="password" id="confirmPassword" name="confirm_password">
                    </div>
                    
                    <button class="btn-save" id="savePasswordBtn">Sauvegarder les modifications</button>
                </div>
                
                <!-- SECTION À PROPOS DE MOI -->
                <div class="profile-section">
                    <h2 class="section-title">À propos de moi</h2>
                    
                    <div class="form-group">
                        <label for="about">À propos de moi</label>
                        <textarea id="about" name="about" placeholder="Parlez-nous de vous..."></textarea>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="emailNotif" name="email_notif">
                        <label for="emailNotif">Désactiver les notifications par e-mail</label>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    
                    <div class="form-group">
                        <label for="sexe">Sexe</label>
                        <select id="sexe" name="sexe">
                            <option value="">-- Sélectionnez --</option>
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                        </select>
                    </div>
                </div>
                
                <!-- SECTION RÉSEAUX SOCIAUX -->
                <div class="profile-section social-links">
                    <h2 class="section-title">Liens réseaux sociaux</h2>
                    
                    <div class="form-group">
                        <label for="xcom">x.com</label>
                        <input type="url" id="xcom" name="xcom" placeholder="https://x.com/username">
                    </div>
                    
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="url" id="facebook" name="facebook" placeholder="https://facebook.com/username">
                    </div>
                    
                    <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/username">
                    </div>
                    
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="url" id="instagram" name="instagram" placeholder="https://instagram.com/username">
                    </div>
                    
                    <div class="form-group">
                        <label for="youtube">YouTube</label>
                        <input type="url" id="youtube" name="youtube" placeholder="https://youtube.com/channel">
                    </div>
                    
                    <div class="form-group">
                        <label for="tiktok">TikTok</label>
                        <input type="url" id="tiktok" name="tiktok" placeholder="https://tiktok.com/@username">
                    </div>
                    
                    <div class="form-group">
                        <label for="whatsapp">WhatsApp</label>
                        <input type="tel" id="whatsapp" name="whatsapp" placeholder="+213xxxxxxxx">
                    </div>

                    <!-- VÉRIFICATION D’IDENTITÉ -->
                    <div class="form-group">
                        <label for="identityPhoto">Vérification de votre identité<br>
                            <small>(pièce d'identité ou permis requis)</small>
                        </label>
                        <input type="file" id="identityPhoto" name="identity_photo" accept="image/*">
                        <small>Formats acceptés : JPG, PNG (max 5 Mo)</small>
                    </div>

                    
                    <button class="btn-save" id="saveSocialBtn">Sauvegarder les modifications</button>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="{{ asset('assets/js/script_connected.js') }}"></script>
</body>
</html>
