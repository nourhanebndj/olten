<header class="header">
    <!-- Logo -->
    <div class="header-left">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/logo/olten_location.png') }}" alt="Olten Logo">
            </a>
        </div>
    </div>

    <!-- Barre de recherche (PC uniquement) -->
    <div class="search-bar">
        <div class="search-field">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Que recherchez-vous ?" class="search-input">
        </div>
        <div class="divider"></div>
        <div class="search-field">
            <i class="fa-solid fa-location-dot"></i>
            <input type="text" placeholder="Emplacement" class="location-input">
        </div>
        <div class="divider"></div>
        <div class="search-field">
            <select class="category-select">
                <option>Toutes les catégories</option>
                <option>Auto</option>
                <option>Immobilier</option>
                <option>Emploi</option>
            </select>
        </div>
        <button class="search-btn">Rechercher</button>
    </div>

    <!-- Profil / Menu / Icônes Mobile -->
    <div class="header-right">
        <button class="icon-btn search-toggle" id="searchToggle">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

        @if(Auth::check())
            <button class="icon-btn">
                <i class="fa-solid fa-user"></i>
            </button>
        @else
            <button class="icon-btn">
                <i class="fa-solid fa-right-to-bracket"></i>
            </button>
        @endif

        <button class="icon-btn" id="menuToggle">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <!-- Bloc de recherche mobile -->
    <div class="mobile-search" id="mobileSearch">
        <div class="mobile-search-content">
            <div class="search-field">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Que recherchez-vous ?" class="search-input">
            </div>
            <div class="search-field">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" placeholder="Emplacement" class="location-input">
            </div>
            <div class="search-field">
                <select class="category-select">
                    <option>Toutes les catégories</option>
                    <option>Auto</option>
                    <option>Immobilier</option>
                    <option>Emploi</option>
                </select>
            </div>
            <button class="search-btn">Rechercher</button>
        </div>
    </div>

    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('assets/images/logo/olten_location.jpg') }}" alt="Olten Logo">
            </div>
            <button class="close-btn" id="closeSidebar">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <ul class="menu-list">
            <li><a href="{{ url('/') }}">Accueil</a></li>
            <li><a href="{{ route('intermediaire.transport') }}">Location véhicule</a></li>
            <li><a href="">Location immobilier</a></li>
            <li><a href="">Location mode & famille</a></li>
            <li><a href="">Location sport & loisir</a></li>
            <li><a href="">Location maison & bricolage</a></li>
            <li><a href="">Location événementiel</a></li>
            <li><a href="">Location nautisme</a></li>
            <li><a href="">Location électronique</a></li>
            <li><a href="">Location médical</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
        </ul>


        <div class="sidebar-footer">
            <h3>Contactez-nous</h3>
            <p>olten-location@outlook.fr</p>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
        </div>
    </nav>
</header>

<!-- Modal Connexion / Inscription -->
<div id="authModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>

        <div class="tabs">
            <button class="tab-btn active" data-tab="login">Se connecter</button>
            <button class="tab-btn" data-tab="register">S'inscrire</button>
        </div>

        <!-- Contenu Connexion -->
        <div class="tab-content" id="login">
            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" placeholder="Nom d'utilisateur / Email">
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Mot de passe">
                <i class="fa-solid fa-eye toggle-password"></i>
            </div>
            <label>
                <input type="checkbox"> Se souvenir de moi
            </label>
            <button class="submit-btn">Connexion</button>
            <p><a href="#">Vous avez perdu votre mot de passe ?</a></p>
        </div>

        <!-- Contenu Inscription -->
        <div class="tab-content" id="register" style="display:none;">
                <div class="input-group">
                <i class="fa-solid fa-pen"></i>
                <input type="text" placeholder="Prénom">
            </div>
            <div class="input-group">
                <i class="fa-solid fa-pen"></i>
                <input type="text" placeholder="Nom de famille">
            </div>
            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" placeholder="Nom d'utilisateur">
            </div>
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="Adresse e-mail">
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Mot de passe">
                <i class="fa-solid fa-eye toggle-password"></i>
            </div>
            <label>
                <input type="checkbox"> J'accepte les <a href="#">Conditions de confidentialité</a>
            </label>
            <button class="submit-btn">S'inscrire</button>
        </div>
    </div>
</div>