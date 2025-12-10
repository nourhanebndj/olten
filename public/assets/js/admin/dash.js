document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const reportsToggle = document.getElementById('reports-dropdown-toggle');
    const reportsContent = document.getElementById('reports-dropdown-content');
    const reportsArrow = document.getElementById('reports-arrow');
    const settingsToggle = document.getElementById('settings-toggle');
    const settingsClose = document.getElementById('settings-close');
    const settingsSidebar = document.getElementById('settings-sidebar');
    const settingsOverlay = document.getElementById('settings-overlay');
    const header = document.querySelector('header');
    const cards = document.querySelectorAll('.card');
    const searchInput = document.querySelector('.search-input');
    const activeLink = document.querySelector('.sidebar-link-active');

    const themeLightBtn = document.getElementById('theme-light-btn');
    const themeDarkBtn = document.getElementById('theme-dark-btn');

    // Les variables CSS pour l'accès facile
    const colorPrimary = getComputedStyle(document.documentElement).getPropertyValue('--color-primary')
        .trim();

    // --- Configuration des Thèmes ---
    const themes = {
        'dark': {
            isDark: true,
            // Classes Body
            bodyClasses: 'dark-mode bg-[#1a1a1a] text-[#e0e0e0]',
            // Styles Sidebars & Header
            surfaceStyle: `background-color: #262626; border-color: #333;`,
            // Liens Sidebar
            linkText: 'text-[#a0a0a0]',
            // Cartes
            cardClasses: 'shadow-2xl shadow-black/50',
            cardStyle: `background-color: #262626; border-color: #333;`,
            // Recherche
            searchInputStyle: `background-color: #333; border-color: #444; color: #e0e0e0;`,
            // Boutons Thème
            btnLightStyle: `background-color: #383838; color: #e0e0e0;`,
            btnDarkStyle: `background-color: ${colorPrimary}; color: white;`,
        },
        'light': {
            isDark: false,
            bodyClasses: 'light-mode bg-[#f7f7f7] text-[#1F1F1F]',
            surfaceStyle: `background-color: white; border-color: #E5E7EB;`,
            linkText: 'text-gray-500',
            // Cartes
            cardClasses: 'shadow-lg',
            cardStyle: `background-color: white; border-color: #E5E7EB;`,
            // Recherche
            searchInputStyle: `background-color: #F3F4F6; border-color: #E5E7EB; color: #1F1F1F;`,
            // Boutons Thème
            btnLightStyle: `background-color: ${colorPrimary}; color: white;`,
            btnDarkStyle: `background-color: #F3F4F6; color: #1F1F1F;`,
        }
    };

    // Fonction utilitaire pour nettoyer les classes Tailwind
    function cleanClasses(element, prefixes) {
        if (!element) return;
        element.className = element.className.split(' ').filter(c =>
            !prefixes.some(prefix => c.startsWith(prefix))
        ).join(' ');
    }

    // Fonction pour appliquer un thème
    function applyTheme(mode) {
        const config = themes[mode];

        // 1. Body
        cleanClasses(body, ['bg-', 'text-', 'light-mode', 'dark-mode']);
        body.className = config.bodyClasses + ' min-h-screen';

        // 2. Sidebar Gauche & Droite (Settings) & Header
        [sidebar, settingsSidebar, header].forEach(el => {
            el.removeAttribute('style');
            el.setAttribute('style', config.surfaceStyle);
        });

        // Correction pour les bordures
        document.querySelector('#sidebar > div:first-child').style.borderColor = config.isDark ? '#333' :
            '#E5E7EB';
        document.querySelector('#sidebar > div.mt-auto').style.borderColor = config.isDark ? '#333' :
            '#E5E7EB';
        document.querySelector('#settings-sidebar > div:first-child').style.borderColor = config.isDark ?
            '#333' : '#E5E7EB';
        const mainH2 = document.querySelector('main > h2');
        if (mainH2) mainH2.style.borderColor = config.isDark ? '#333' : '#E5E7EB';

        const themeButtons = document.getElementById('theme-buttons');
        if (themeButtons) themeButtons.style.backgroundColor = config.isDark ? '#383838' : '#F3F4F6';

        header.style.borderBottom = `1px solid ${config.isDark ? '#333' : '#E5E7EB'}`;

        // Couleur des icônes dans le header
        document.querySelectorAll('header button:not(#sidebar-toggle), header button > svg').forEach(el => {
            if (config.isDark) {
                el.classList.add('text-[#e0e0e0]', 'hover:bg-gray-700');
                el.classList.remove('text-gray-700', 'hover:bg-gray-100');
            } else {
                el.classList.add('text-gray-700', 'hover:bg-gray-100');
                el.classList.remove('text-[#e0e0e0]', 'hover:bg-gray-700');
            }
        });

        // 3. Liens Sidebar
        document.querySelectorAll('.sidebar-link').forEach(link => {
            cleanClasses(link, ['text-', 'bg-']);
            if (!link.classList.contains('sidebar-link-active')) {
                link.classList.add(...config.linkText.split(' '));
            }
            // Gérer les hover spécifiques aux modes
            link.classList.remove('hover:bg-gray-700', 'hover:bg-gray-100', 'hover:bg-gray-800');
            if (config.isDark) {
                link.classList.add('hover:bg-gray-700');
                link.querySelectorAll('.text-gray-400').forEach(el => el.classList.remove(
                    'text-gray-400'));
            } else {
                link.classList.add('hover:bg-gray-100');
            }
        });

        // Lien actif 
        if (activeLink) {
            cleanClasses(activeLink, ['bg-', 'text-']);
            activeLink.classList.add('sidebar-link-active', 'text-white');
            activeLink.style.backgroundColor = colorPrimary;
        }

        // 4. Cartes (Cards)
        cards.forEach(card => {
            cleanClasses(card, ['bg-', 'shadow-']);
            card.classList.add(...config.cardClasses.split(' '));
            card.removeAttribute('style');
            card.setAttribute('style', card.getAttribute('style') + config.cardStyle);
        });


    }

    // Initialiser le thème au CLAIR par défaut (ce que l'utilisateur a demandé)
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);


    // --- Gestion des Sidebars et Interactions (non modifiées) ---

    function toggleSidebar() {
        const isHidden = sidebar.classList.contains('-translate-x-full');
        if (isHidden) {
            sidebar.classList.remove('-translate-x-full');
            settingsOverlay.classList.remove('hidden'); // Afficher l'overlay
            document.body.classList.add('overflow-hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            settingsOverlay.classList.add('hidden'); // Cacher l'overlay
            document.body.classList.remove('overflow-hidden');
        }
    }

    // Masquer les deux sidebars si la fenêtre est trop petite
    settingsOverlay.addEventListener('click', () => {
        toggleSettingsSidebar(false);
        if (!sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
            document.body.classList.remove('overflow-hidden');
        }
    });


    function toggleSettingsSidebar(show) {
        const shouldShow = typeof show === 'boolean' ? show : settingsSidebar.classList.contains(
            'translate-x-full');

        settingsSidebar.classList.toggle('translate-x-full', !shouldShow);
        settingsOverlay.classList.toggle('hidden', !shouldShow);

        if (shouldShow) {
            document.body.classList.add('overflow-hidden');
        } else {
            if (sidebar.classList.contains('-translate-x-full')) {
                document.body.classList.remove('overflow-hidden');
            }
        }
    }

    sidebarToggle.addEventListener('click', toggleSidebar);
    settingsToggle.addEventListener('click', () => toggleSettingsSidebar(true));
    settingsClose.addEventListener('click', () => toggleSettingsSidebar(false));



    reportsToggle.addEventListener('click', () => {
        const isHidden = reportsContent.classList.contains('hidden');
        reportsContent.classList.toggle('hidden', !isHidden);
        reportsArrow.classList.toggle('rotate-180', isHidden);
    });

    window.addEventListener('resize', () => {
        // Si on passe en mode desktop, s'assurer que la sidebar gauche est visible et que l'overflow est retiré
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('-translate-x-full');
            document.body.classList.remove('overflow-hidden');
            settingsOverlay.classList.add('hidden');
        } else {
            // En mode mobile, s'assurer que la sidebar est repliée
            if (sidebar.classList.contains('-translate-x-full') && settingsSidebar.classList
                .contains('translate-x-full')) {
                document.body.classList.remove('overflow-hidden');
                settingsOverlay.classList.add('hidden');
            }
        }
    });
  

});