    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const usersToggle = document.getElementById('usersDropdownToggle');
    const usersSubmenu = document.getElementById('usersSubmenu');
    const usersChevron = document.getElementById('usersChevron');

    toggleBtn?.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        if(sidebar.classList.contains('show')){
            const overlay = document.createElement('div');
            overlay.id = 'sidebar-overlay';
            overlay.className = 'fixed inset-0 bg-black opacity-50 z-5';
            document.body.appendChild(overlay);
            overlay.addEventListener('click', ()=>{sidebar.classList.remove('show'); overlay.remove();});
        } else document.getElementById('sidebar-overlay')?.remove();
    });

    usersToggle?.addEventListener('click', () => {
        usersSubmenu.classList.toggle('hidden');
        usersChevron.classList.toggle('rotate-180');
    });