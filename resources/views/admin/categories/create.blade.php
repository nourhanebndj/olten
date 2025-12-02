@extends('admin.layouts.app')

@section('title', 'Ajouter une Catégorie')

@section('content')
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Ajouter une Catégorie</h1>

    </div>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire création catégorie -->
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="mb-8 bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-medium mb-2">Nom de la catégorie</label>
            <input type="text" name="nom" id="nom"
                   class="w-full border border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-[#ec1d20]"
                   value="{{ old('nom') }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description (optionnel)</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full border border-gray-300 rounded-full p-3 focus:outline-none focus:ring-2 focus:ring-[#ec1d20]">{{ old('description') }}</textarea>
        </div>

        <div class="mb-6">
            <label for="image" class="block text-gray-700 font-medium mb-2">Image (optionnel)</label>
            <input type="file" name="image" id="image"
                   class="w-full border border-gray-300 rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-[#ec1d20]">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-[#ec1d20] hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-full transition shadow-sm flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Ajouter
            </button>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:underline">Annuler</a>
        </div>
    </form>
@endsection
