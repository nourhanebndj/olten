<div id="sidebar" class="sidebar flex flex-col bg-primary-dark text-white p-4 fixed md:relative shadow-lg">
    <!-- Logo -->
    <a href="#" class="sidebar-logo text-white no-underline">
        <img src="{{ asset('assets/images/logo/olten_location.png') }}" alt="Logo Olten">
    </a>


    <!-- Menu principal (scrollable si contenu long) -->
    <ul class="flex flex-col flex-grow space-y-2">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center p-3 rounded-lg hover:bg-white/10 transition duration-150">
                <i class="bi bi-speedometer2 text-xl mr-3"></i>
                <span class="font-medium">Tableau de bord</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}"
                class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }} flex items-center p-3 rounded-lg hover:bg-white/10 transition duration-150">
                <i class="bi bi-tags text-xl mr-3"></i>
                <span class="font-medium">Catégories</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="usersDropdownToggle"
                class="nav-link flex items-center p-3 rounded-lg hover:bg-white/10 transition duration-150 cursor-pointer"
                data-target="#usersSubmenu">
                <i class="bi bi-people text-xl mr-3"></i>
                <span class="font-medium">Utilisateurs</span>
                <i class="bi bi-chevron-down ml-auto transition-transform duration-300 transform" id="usersChevron"></i>
            </a>
            <ul class="hidden flex flex-col mt-1 ml-6 space-y-1" id="usersSubmenu">
                <li><a href="#"
                        class="nav-link block py-2 px-3 text-sm rounded-lg hover:bg-white/10 transition duration-150">Liste</a>
                </li>
                <li><a href="#"
                        class="nav-link block py-2 px-3 text-sm rounded-lg hover:bg-white/10 transition duration-150">Ajouter</a>
                </li>
                <!-- Tu peux rajouter plein d'éléments ici pour tester le scroll -->
            </ul>
        </li>

        <!-- Ajoute d'autres liens pour tester le scroll -->
    </ul>

    <!-- Déconnexion -->
    <div class="mt-auto pt-4 border-t border-white/10">
        <a href="#" class="nav-link flex items-center   transition duration-150">
            <i class="bi bi-box-arrow-right text-xl mr-3"></i>
            <span class="font-medium">Déconnexion</span>
        </a>
    </div>
</div>
