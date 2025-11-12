<aside class="connected-sidebar">
        <nav class="sidebar-menu">
            <!-- LOGO -->
            <div class="sidebar-logo">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo/olten_location.png') }}" alt="Olten Logo">
                    </a>
                </div>

            </div>

            <!-- SECTIONS -->
            <p class="menu-section">PRINCIPAL</p>
            <nav>
                <ul>
                    <li class="{{ request()->is('dashboard-locateur') ? 'active' : '' }}">
                        <a href="{{ url('/dashboard-locateur') }}">
                            <i class="fa-solid fa-table-columns"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>

                    <li>
                        <i class="fa-solid fa-calendar-check"></i>
                        <span>Mes réservations</span>
                    </li>

                    <li class="{{ request()->is('messages') ? 'active' : '' }}">
                        <a href="{{ route('messages') }}">
                            <i class="fa-solid fa-envelope"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-wallet"></i>
                        <span>Portefeuille</span>
                    </li>
                </ul>

                <p class="menu-section">ANNONCES</p>
                <ul>
                    <li class="{{ request()->is('deposer_annonce') ? 'active' : '' }}">
                        <a href="{{ route('deposer_annonce') }}">
                            <i class="fa-solid fa-circle-plus"></i>
                            <span>Ajouter une annonce</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('mes_annonces') ? 'active' : '' }}">
                        <a href="{{ route('mes_annonces') }}">
                            <i class="fa-solid fa-list"></i>
                            <span>Mes annonces</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('statistiques') ? 'active' : '' }}">
                        <a href="{{ route('statistiques') }}">
                            <i class="fa-solid fa-chart-line"></i>
                            <span>Statistiques</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('favoris') ? 'active' : '' }}">
                        <a href="{{ route('favoris') }}">
                            <i class="fa-solid fa-heart"></i>
                            <span>Favoris</span>
                        </a>
                    </li>
                </ul>

                <p class="menu-section">COMPTE</p>
                <ul>
                    <li class="{{ request()->is('profile') ? 'active' : '' }}">
                        <a href="{{ route('profile') }}">
                            <i class="fa-solid fa-users"></i>
                            <span>Mon Compte</span>
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Se déconnecter</span>
                    </li>
                </ul>
            </nav>

    </aside>