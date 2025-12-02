<nav class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-5">
    <div class="text-2xl font-semibold text-gray-800">
        @yield('page-title', 'Dashboard')
    </div>
    <div class="flex items-center space-x-4">
        <button id="sidebarToggle" class="p-2 rounded-lg text-gray-700 hover:bg-gray-100 md:hidden">
            <i class="bi bi-list text-2xl"></i>
        </button>
        <span class="hidden sm:inline text-gray-600 font-medium">{{ auth()->user()->firstname ?? auth()->user()->name }}</span>
        <img src="https://placehold.co/40x40/3b82f6/ffffff?text={{ substr(auth()->user()->firstname ?? auth()->user()->name,0,2) }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover border-2 border-primary-light">
    </div>
</nav>
