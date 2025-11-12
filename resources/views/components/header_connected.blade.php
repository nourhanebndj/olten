
        <!-- HEADER -->
        <header class="connected-header">
            <div class="header-left">
                <button class="btn-toggle-sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <div class="header-right">
                <div class="user-menu">
                    <div class="user-avatar">Y</div>
                    <span class="username">YACINE</span>
                    <i class="fa-solid fa-chevron-down"></i>

                    <!-- DROPDOWN MENU -->
                    <ul class="user-dropdown">
                        <li><i class="fa-solid fa-table-columns"></i> Tableau de bord</li>
                        <li><i class="fa-solid fa-calendar-check"></i> Mes réservations</li>
                        <li><i class="fa-solid fa-list"></i> Mes annonces</li>
                        <li><i class="fa-solid fa-heart"></i> Favoris</li>
                        <li><i class="fa-solid fa-envelope"></i> Messages</li>
                        <li><i class="fa-solid fa-user"></i> Mon profil</li>
                        <li><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</li>
                    </ul>
                </div>

                <a href="{{ route('deposer_annonce') }}" class="btn-add-annonce">
                    <i class="fa-solid fa-plus"></i>
                    <span>Ajouter une annonce</span>
                </a>

            </div>
        </header>