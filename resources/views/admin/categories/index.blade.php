@extends('admin.layouts.app')

@section('title', 'Gestion des Catégories')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Liste des Catégories</h1>
    </div>
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div class="">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une catégorie..."
                    class="flex-1 px-4 py-2 focus:outline-none text-gray-700"
                    style="border: 0.5px solid #ec1d20; border-radius: 32px;" />

                <button type="submit" class="search-button">

                    <i class="bi bi-search"></i>
                </button>


            </form>
        </div>
        <div class="flex items-center gap-2 w-full md:w-auto">
            <a href="{{ route('admin.categories.create') }}"
                class="ml-auto px-4 py-2 text-white rounded-2xl border transition"
                style="background-color: #2c2c2c; border: 1px solid #2c2c2c;">
                Nouvelle catégorie
            </a>

        </div>
    </div>

    <div class="bg-white  rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Créé le</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $category->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $category->nom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $category->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton{{ $category->id }}" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $category->id }}">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                            href="{{ route('admin.categories.edit', $category) }}">
                                            <i class="bi bi-pencil" style="color: #ec1d20;"></i> Modifier
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 ">
                                                <i class="bi bi-trash" style="color: #ec1d20;"></i> Supprimer
                                            </button>
                                        </form>
                                    </li>

                                </ul>
                            </div>
                        </td>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Aucune catégorie trouvée</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButtons = document.querySelectorAll('[id^="menu-button-"]');

            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation(); // Empêche la fermeture immédiate
                    const menu = this.nextElementSibling;

                    // Ferme tous les autres menus
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if (m !== menu) m.classList.add('hidden');
                    });

                    menu.classList.toggle('hidden');
                });
            });

            // Fermer si clic en dehors
            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.add('hidden'));
            });
        });
    </script>


@endsection
