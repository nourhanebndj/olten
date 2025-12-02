@extends('admin.layouts.app')

@section('title', 'Modifier la Catégorie')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Modifier la Catégorie</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-medium mb-2">Nom de la catégorie</label>
                <input type="text" name="nom" id="nom"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary-light"
                    value="{{ old('nom', $category->nom) }}" required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description (optionnel)</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-primary-light">{{ old('description', $category->description) }}</textarea>
            </div>
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Image (optionnel)</label>
                <input type="file" name="image" id="image"
                    class="w-full border border-gray-300 rounded-full p-2 focus:outline-none focus:ring-2 focus:ring-[#ec1d20]">
            </div>

            <button type="submit"
                class="bg-primary-light hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">Mettre à
                jour</button>
            <a href="{{ route('admin.categories.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
        </form>
    </div>
@endsection
