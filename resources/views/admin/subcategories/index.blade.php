@extends('admin.layouts.app')

@section('title', 'Gestion des Sous-Catégories')
@section('page_title', 'Gestion des Sous-Catégories')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Sous-Catégories</h1>
    <a href="{{ route('admin.subcategories.create') }}" class="btn-red">
        Nouvelle sous-catégorie
    </a>
</div>

{{-- BARRE RECHERCHE & FILTRES --}}
<div class="card-white p-6 mb-8">
    <form method="GET" action="{{ route('admin.subcategories.index') }}" class="flex flex-col md:flex-row gap-4 md:items-center">

        {{-- Recherche --}}
        <div class="relative w-full md:w-1/3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                   class="w-full pl-10 pr-10 py-3 rounded-lg bg-white text-gray-700
                          border border-[rgba(255,187,191,1)]
                          focus:ring-2 focus:ring-[rgba(255,187,191,1)]
                          focus:border-[rgba(255,187,191,1)]">

            <i class="absolute left-3 top-1/2 -translate-y-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[rgb(233,29,40)]" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </i>
        </div>

        {{-- Filtre par catégorie --}}
        <div class="relative w-full md:w-1/3">
            <select name="category_id"
                    class="appearance-none w-full px-4 py-3 pr-10 rounded-lg bg-white text-gray-700
                           border border-[rgba(255,187,191,1)]
                           focus:ring-2 focus:ring-[rgba(255,187,191,1)]
                           focus:border-[rgba(255,187,191,1)]">
                <option value="">Toutes les catégories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nom }}
                    </option>
                @endforeach
            </select>
            <span class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[rgb(233,29,40)]" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="M6 9l6 6 6-6" />
                </svg>
            </span>
        </div>

        {{-- Bouton Filtrer --}}
        <button type="submit"
                class="px-6 py-3 bg-[rgb(233,29,40)] text-white font-semibold rounded-lg
                       shadow-md hover:bg-red-700 hover:shadow-lg active:scale-95
                       transition-all duration-200 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-7.879L2.293 6.707A1 1 0 012 6V4z" />
            </svg>
            Filtrer
        </button>
    </form>
</div>

{{-- TABLEAU RESPONSIVE --}}
<div class="card-white p-4">
    <div class="table-wrapper">
        <table class="min-w-full table-rounded divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Nom</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Catégorie</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($subcategories as $sub)
                    <tr>
                        <td class="px-6 py-4">{{ $sub->id }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $sub->nom }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $sub->description }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $sub->category->nom ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="relative inline-block">
                                <button class="action-btn px-2 py-2 rounded-full border bg-white hover:bg-gray-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6h.01M12 12h.01M12 18h.01" />
                                    </svg>
                                </button>

                                <!-- Dropdown actions -->
                                <div class="dropdown-menu-white absolute right-9 w-52 divide-y divide-gray-200 rounded-lg shadow-lg bg-white overflow-hidden z-10">
                                    <!-- Modifier -->
                                    <a href="{{ route('admin.subcategories.edit', $sub) }}"
                                       class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-red-500"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 4H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2v-4M18.5 2.5a2.121 2.121 0 113 3L13 14l-4 1 1-4 8.5-8.5z" />
                                        </svg>
                                        Modifier
                                    </a>

                                    <!-- Supprimer -->
                                    <form action="{{ route('admin.subcategories.destroy', $sub) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="delete-btn w-full flex items-center text-left px-4 py-3 text-sm text-red-600 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-red-600"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h10" />
                                            </svg>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $subcategories->links() }}
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const buttons = document.querySelectorAll(".action-btn");

        function closeAll() {
            document.querySelectorAll(".dropdown-menu-white")
                .forEach(m => m.classList.remove("active"));
        }

        buttons.forEach(btn => {
            btn.addEventListener("click", e => {
                e.stopPropagation();
                const menu = btn.nextElementSibling;
                closeAll();
                menu.classList.toggle("active");
            });
        });

        document.addEventListener("click", closeAll);

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Supprimer ?',
                    text: "Cette action est irréversible !",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        if (typeof lucide !== "undefined") lucide.createIcons();
    });
</script>

@endsection
