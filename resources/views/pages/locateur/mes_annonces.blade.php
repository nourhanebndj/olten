<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes annonces - Olten</title>
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
                <span>Mes annonces</span>
            </div>
            
            <h1 class="page-title">Mes annonces</h1>
            
            <!-- SECTION MES ANNONCES -->
            <div class="annonces-container">
                <div class="section-header">
                    <h2 class="section-title">Annonces actives</h2>
                    <div class="search-filters">
                        <input type="text" class="search-input" placeholder="Rechercher une annonce">
                        <select class="filter-select">
                            <option value="all">Toutes les catégories</option>
                            <option value="location">Location</option>
                            <option value="vente">Vente</option>
                            <option value="service">Service</option>
                        </select>
                        <button class="btn-search">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- LISTE DES ANNONCES -->
                <div class="annonces-list">
                    <!-- Annonce 1 -->
                    <div class="annonce-card">
                        <div class="annonce-image">
                            <img src="assets/images/canoe-kayak.jpg" alt="Canoé kayak">
                        </div>
                        <div class="annonce-details">
                            <h3 class="annonce-title">Canoé kayak</h3>
                            <div class="annonce-tags">
                                <span class="tag tag-orange">Location Kayak / Canoë</span>
                            </div>
                            <div class="annonce-stats">
                                <span class="stat-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Vues : 6
                                </span>
                                <span class="stat-item">
                                    <i class="fa-solid fa-calendar"></i>
                                    Expirant : 05/12/2025
                                </span>
                            </div>
                        </div>
                        <div class="annonce-actions">
                            <button class="btn-action btn-ical">
                                <i class="fa-solid fa-calendar-plus"></i>
                                iCal
                            </button>
                            <button class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                                Modifier
                            </button>
                            <button class="btn-action btn-delete">
                                <i class="fa-solid fa-trash"></i>
                                Supprimer
                            </button>
                        </div>
                    </div>
                    
                    <!-- Annonce 2 -->
                    <div class="annonce-card">
                        <div class="annonce-image">
                            <img src="assets/images/livre-js.jpg" alt="Livre JavaScript">
                        </div>
                        <div class="annonce-details">
                            <h3 class="annonce-title">livre js</h3>
                            <div class="annonce-tags">
                                <span class="tag tag-orange">Location mode & famille</span>
                            </div>
                            <div class="annonce-location">
                                <i class="fa-solid fa-location-dot"></i>
                                56 rue d'onzion 42152 l'horme
                            </div>
                            <div class="annonce-stats">
                                <span class="stat-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Vues : 13
                                </span>
                                <span class="stat-item">
                                    <i class="fa-solid fa-calendar"></i>
                                    Expirant : 05/12/2025
                                </span>
                            </div>
                        </div>
                        <div class="annonce-actions">
                            <button class="btn-action btn-ical">
                                <i class="fa-solid fa-calendar-plus"></i>
                                iCal
                            </button>
                            <button class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                                Modifier
                            </button>
                            <button class="btn-action btn-delete">
                                <i class="fa-solid fa-trash"></i>
                                Supprimer
                            </button>
                        </div>
                    </div>
                    
                    <!-- Annonce 3 -->
                    <div class="annonce-card">
                        <div class="annonce-image">
                            <img src="assets/images/renault-clio.jpg" alt="Renault Clio 2">
                        </div>
                        <div class="annonce-details">
                            <h3 class="annonce-title">Renault clio 2</h3>
                            <div class="annonce-tags">
                                <span class="tag tag-orange">location voiture</span>
                            </div>
                            <div class="annonce-stats">
                                <span class="stat-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Vues : 46
                                </span>
                                <span class="stat-item">
                                    <i class="fa-solid fa-calendar"></i>
                                    Expirant : 23/11/2025
                                </span>
                            </div>
                        </div>
                        <div class="annonce-actions">
                            <button class="btn-action btn-ical">
                                <i class="fa-solid fa-calendar-plus"></i>
                                iCal
                            </button>
                            <button class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                                Modifier
                            </button>
                            <button class="btn-action btn-delete">
                                <i class="fa-solid fa-trash"></i>
                                Supprimer
                            </button>
                        </div>
                    </div>
                    
                    <!-- Annonce 4 -->
                    <div class="annonce-card">
                        <div class="annonce-image">
                            <img src="assets/images/costume-homme.jpg" alt="Costume homme XL">
                        </div>
                        <div class="annonce-details">
                            <h3 class="annonce-title">Costume homme xl</h3>
                            <div class="annonce-tags">
                                <span class="tag tag-orange">Location chaussure</span>
                                <span class="tag tag-orange">Location vêtement</span>
                            </div>
                            <div class="annonce-stats">
                                <span class="stat-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Vues : 21
                                </span>
                                <span class="stat-item">
                                    <i class="fa-solid fa-calendar"></i>
                                    Expirant : Jamais/non défini
                                </span>
                            </div>
                        </div>
                        <div class="annonce-actions">
                            <button class="btn-action btn-ical">
                                <i class="fa-solid fa-calendar-plus"></i>
                                iCal
                            </button>
                            <button class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                                Modifier
                            </button>
                            <button class="btn-action btn-delete">
                                <i class="fa-solid fa-trash"></i>
                                Supprimer
                            </button>
                        </div>
                    </div>
                    
                    <!-- Annonce 5 -->
                    <div class="annonce-card">
                        <div class="annonce-image">
                            <img src="assets/images/robe-mariee.jpg" alt="Robe de mariée">
                        </div>
                        <div class="annonce-details">
                            <h3 class="annonce-title">Robe de mariée</h3>
                            <div class="annonce-tags">
                                <span class="tag tag-orange">Location vêtement</span>
                            </div>
                            <div class="annonce-stats">
                                <span class="stat-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Vues : 16
                                </span>
                                <span class="stat-item">
                                    <i class="fa-solid fa-calendar"></i>
                                    Expirant : 22/11/2025
                                </span>
                            </div>
                        </div>
                        <div class="annonce-actions">
                            <button class="btn-action btn-ical">
                                <i class="fa-solid fa-calendar-plus"></i>
                                iCal
                            </button>
                            <button class="btn-action btn-edit">
                                <i class="fa-solid fa-pen"></i>
                                Modifier
                            </button>
                            <button class="btn-action btn-delete">
                                <i class="fa-solid fa-trash"></i>
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- PAGINATION -->
                <div class="pagination">
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn page-next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                
                <!-- BOUTON NOUVELLE ANNONCE -->
                <div class="create-annonce-section">
                    <a href="#" class="btn-create-annonce">
                        <i class="fa-solid fa-plus"></i>
                        Soumettre une nouvelle annonce
                    </a>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="{{ asset('assets/js/script_connected.js') }}"></script>
</body>
</html>