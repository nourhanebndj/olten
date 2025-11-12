<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoris - Olten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
      integrity="sha512-pVZ0/UomqzLv+Jw5s6pzR5hT+AAUz8Wv44m9X/nr2P81ZPd5f2iRFPZT+5Tb6LhZQ9Q1yH8QDsW0QJ0Gp7aO2g==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style_connecter/style_connected.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/favoris.css') }}">
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
                <span>Favoris</span>
            </div>

            <h1 class="page-title">Favoris</h1>

            <!-- SECTION ANNONCES ENREGISTRÉES -->
            <div class="favoris-container">
                <div class="section-header">
                    <h2 class="section-title">Annonces enregistrées</h2>
                </div>

                <div class="favoris-list" id="favorisList">
                    <!-- Annonce 1 -->
                    <div class="favori-card" data-id="1">
                        <div class="favori-image">
                            <img src="assets/images/canoe-kayak.jpg" alt="Canoé kayak">
                        </div>
                        <div class="favori-content">
                            <h3 class="favori-title">Canoé kayak</h3>
                        </div>
                        <button class="btn-delete" onclick="deleteFavori(1)">
                            <i class="fa-solid fa-heart-circle-minus"></i>
                            Supprimer
                        </button>
                    </div>

                    <!-- Annonce 2 -->
                    <div class="favori-card" data-id="2">
                        <div class="favori-image">
                            <img src="assets/images/appartement.jpg" alt="Appartement">
                        </div>
                        <div class="favori-content">
                            <h3 class="favori-title">Appartement F3 centre ville</h3>
                        </div>
                        <button class="btn-delete" onclick="deleteFavori(2)">
                            <i class="fa-solid fa-heart-circle-minus"></i>
                            Supprimer
                        </button>
                    </div>

                    <!-- Annonce 3 -->
                    <div class="favori-card" data-id="3">
                        <div class="favori-image">
                            <img src="assets/images/velo.jpg" alt="Vélo">
                        </div>
                        <div class="favori-content">
                            <h3 class="favori-title">Vélo électrique</h3>
                        </div>
                        <button class="btn-delete" onclick="deleteFavori(3)">
                            <i class="fa-solid fa-heart-circle-minus"></i>
                            Supprimer
                        </button>
                    </div>
                </div>

                <!-- Message vide  -->
                <div class="empty-state" id="emptyState" style="display: none;">
                    <div class="empty-icon">
                        <i class="fa-solid fa-heart-crack"></i>
                    </div>
                    <h3>Aucun favori enregistré</h3>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="{{ asset('assets/js/favoris.js') }}"></script>
</body>
</html>