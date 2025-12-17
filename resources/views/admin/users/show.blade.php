@extends('admin.layouts.app')

@section('title', 'Détails de l\'utilisateur')
@section('page_title', 'Détails de l\'utilisateur')

@section('content')

<div class="page-inner">

    {{-- HEADER / Breadcrumb --}}
    <div class="pb-3 mb-6 border-b flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Utilisateur</h1>

            <ul class="flex items-center text-sm text-gray-500 mt-1 space-x-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:underline">
                        <i class="bi bi-house"></i>
                    </a>
                </li>

                <li><i class="bi bi-chevron-right text-xs"></i></li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="hover:underline">
                        Utilisateurs
                    </a>
                </li>
                <li><i class="bi bi-chevron-right text-xs"></i></li>
                <li class="text-red-600 font-semibold">Détails</li>
            </ul>
        </div>
    </div>

    {{-- Card utilisateur --}}
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 relative">

        {{-- Bouton Supprimer si ce n'est pas un admin --}}
        @if($user->role !== 'admin')
        <form id="delete-form" action="{{ route('admin.users.destroy', $user) }}" method="POST"
            class="delete-form absolute top-5 right-5 z-10">
            @csrf
            @method('DELETE')
            <button type="button"
                class="w-10 h-10 flex items-center justify-center bg-red-600 text-white rounded-full
                shadow-md hover:bg-red-700 hover:scale-105 active:scale-95 transition-all duration-200 delete-btn"
                title="Supprimer cet utilisateur">
                <i class="bi bi-trash-fill text-lg"></i>
            </button>
        </form>
        @endif

        {{-- Header de la card --}}
        <div class="bg-gradient-to-r from-red-600 to-pink-500 p-6">
            <h2 class="text-2xl font-bold text-white">Détails de l'utilisateur</h2>
            <p class="text-sm text-white/80 mt-1 opacity-90">
                Informations de l'utilisateur {{ $user->name }}
            </p>
        </div>

        {{-- Contenu utilisateur --}}
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nom --}}
                <div>
                    <h3 class="text-gray-400 font-semibold text-xs uppercase mb-1 tracking-wider">Nom</h3>
                    <p class="text-gray-900 text-lg font-medium">{{ $user->firstname }} {{ $user->lastname }}</p>
                </div>

                {{-- Email --}}
                <div>
                    <h3 class="text-gray-400 font-semibold text-xs uppercase mb-1 tracking-wider">Email</h3>
                    <p class="text-gray-900 text-lg font-medium">
                        <a href="mailto:{{ $user->email }}" class="hover:text-red-600 transition duration-150">
                            {{ $user->email }}
                        </a>
                    </p>
                </div>

                {{-- Rôle --}}
                <div>
                    <h3 class="text-gray-400 font-semibold text-xs uppercase mb-1 tracking-wider">Rôle</h3>
                    <p class="text-lg">
                        @if($user->role === 'admin')
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-red-600 bg-red-100 rounded-full">
                                Admin
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">
                                Utilisateur
                            </span>
                        @endif
                    </p>
                </div>

                {{-- Date de création --}}
                <div class="md:col-span-2 pt-4 border-t border-gray-100">
                    <h3 class="text-gray-400 font-semibold text-xs uppercase mb-1 tracking-wider">Créé le</h3>
                    <p class="text-gray-600 text-sm font-light">
                        {{ $user->created_at}}
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- SweetAlert JS pour suppression --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const form = this.closest('.delete-form');

            Swal.fire({
                title: 'Supprimer cet utilisateur ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
});
</script>

@endsection
