
        <!-- HEADER -->
        <header class="connected-header">
            <div class="header-left">
                <button class="btn-toggle-sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <div class="header-right">
                <div class="user-menu">
                    @php
                        $name = Auth::user()->name;
                        $initial = strtoupper(substr($name, 0, 1));
                    @endphp
                    <div class="user-avatar">{{ $initial }}</div>
                    <span class="username">{{ $name }}</span>
                    <i class="fa-solid fa-chevron-down"></i>

                    <!-- DROPDOWN MENU -->
                    <ul class="user-dropdown">
                        <li><i class="fa-solid fa-table-columns"></i> Tableau de bord</li>
                        <li><i class="fa-solid fa-calendar-check"></i> Mes réservations</li>
                        <li><i class="fa-solid fa-list"></i> Mes annonces</li>
                        <li><i class="fa-solid fa-heart"></i> Favoris</li>
                        <li><i class="fa-solid fa-envelope"></i> Messages</li>
                        <li><i class="fa-solid fa-user"></i> Mon profil</li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                                </x-responsive-nav-link>
                            </form>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('deposer_annonce') }}" class="btn-add-annonce">
                    <i class="fa-solid fa-plus"></i>
                    <span>Ajouter une annonce</span>
                </a>

            </div>
        </header>