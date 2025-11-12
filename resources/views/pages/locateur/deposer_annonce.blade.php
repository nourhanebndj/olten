<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déposer une annonce - Olten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
      integrity="sha512-pVZ0/UomqzLv+Jw5s6pzR5hT+AAUz8Wv44m9X/nr2P81ZPd5f2iRFPZT+5Tb6LhZQ9Q1yH8QDsW0QJ0Gp7aO2g==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style_connecter/style_connected.css') }}">
    <style>
        .distance-result {
            background: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            font-weight: 500;
            color: #333;
        }
    </style>
</head>
<body>
<div class="connected-layout">
    @include('components.sidebar_connected')
    
    <div class="main-content">
        @include('components.header_connected')
        
        <main class="dashboard-content">
            <div class="breadcrumb">
                <a href="index.html">Accueil</a>
                <span>></span>
                <span>Déposer une annonce</span>
            </div>

            <h1>Déposer une annonce</h1>

            <form action="#" method="POST" enctype="multipart/form-data" id="annonceForm">
                
                <!-- SECTION INFORMATIONS -->
                <div class="form-container">
                    <div class="form-section-header">
                        <div class="form-section-icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <h2 class="form-section-title">Informations</h2>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                Titre de l'annonce <span class="required">*</span>
                            </label>
                            <input type="text" name="titre" class="form-input" 
                                   placeholder="Titre de l'annonce" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Catégorie <span class="required">*</span>
                            </label>
                            <select name="categorie_id" class="form-select" required>
                                <option value="">Choisir Catégorie</option>
                                <option value="1">Immobilier</option>
                                <option value="2">Véhicules</option>
                                <option value="3">Électronique</option>
                                <option value="4">Maison & Jardin</option>
                                <option value="5">Mode & Beauté</option>
                                <option value="6">Loisirs</option>
                                <option value="7">Emploi</option>
                                <option value="8">Services</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION ADRESSE -->
                <div class="form-container">
                    <div class="form-section-header">
                        <div class="form-section-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <h2 class="form-section-title">Adresse du vendeur</h2>
                    </div>

                    <div class="map-container">
                        <div id="map" style="height: 250px;"></div>
                    </div>

                    <div class="address-fields">
                        <div class="form-group">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="adresse" id="adresseVendeur" class="form-input" placeholder="Adresse vendeur">
                        </div>

                        <div class="coordinate-fields">
                            <div class="form-group">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-input" placeholder="Longitude">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-input" placeholder="Latitude">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION TARIF -->
                <div class="form-container">
                    <div class="form-section-header">
                        <div class="form-section-icon">
                            <i class="fa-solid fa-tag"></i>
                        </div>
                        <h2 class="form-section-title">Tarif de l'annonce</h2>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                Prix par jour <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" name="prix" class="form-input" placeholder="0" step="0.01" required>
                                <span class="input-suffix">DZD / jour</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION LIVRAISON -->
                <div class="form-container">
                    <div class="form-section-header">
                        <div class="form-section-icon">
                            <i class="fa-solid fa-truck"></i>
                        </div>
                        <h2 class="form-section-title">Livraison</h2>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Proposez-vous une livraison ?</label>
                        <div class="toggle-switch">
                            <input type="checkbox" name="livraison_active" id="livraisonActive">
                            <label for="livraisonActive" class="toggle-label"></label>
                        </div>
                    </div>

                    <div id="livraisonDetails" style="display:none;">
                        <div class="form-group">
                            <label class="form-label">Adresse du client</label>
                            <input type="text" id="adresseClient" class="form-input" placeholder="Adresse de livraison">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tarif par kilomètre</label>
                            <div class="input-group">
                                <input type="number" id="tarifKm" class="form-input" value="50" step="0.01">
                                <span class="input-suffix">Euro / km</span>
                            </div>
                        </div>

                        <div class="distance-result" id="distanceResult">
                            Distance : -- km<br>
                            Coût total livraison : -- Euro
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-paper-plane"></i> Publier l'annonce
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script src="{{ asset('assets/js/script_connected.js') }}"></script>
</body>
</html>
