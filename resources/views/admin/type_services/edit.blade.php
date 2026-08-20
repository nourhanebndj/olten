@extends('admin.layouts.app')

@section('title', 'Modifier Type de Service')

@section('content')

    <div class="page-inner">

        {{-- HEADER --}}
        <div class="pb-3 mb-6 border-b flex flex-col md:flex-row md:items-center md:justify-between">

            <div>
                <h1 class="text-xl font-bold text-gray-800">Types de Services</h1>

                <ul class="flex items-center text-sm text-gray-500 mt-1 space-x-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:underline">
                            <i class="bi bi-house"></i>
                        </a>
                    </li>

                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li>Paramètres</li>

                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li>Types de Services</li>

                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li class="text-red-600 font-semibold">Modifier</li>
                </ul>
            </div>

        </div>

        {{-- Formulaire --}}
        <form action="{{ route('admin.type_services.update', $typeService) }}" method="POST"
            class="mb-8 bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            {{-- Nom --}}
            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-medium mb-1">Nom du type *</label>
                <input type="text" name="nom" id="nom"
                    class="w-full border @error('nom') border-red-500 @else border-gray-300 @enderror
                   rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    value="{{ old('nom', $typeService->nom) }}" required>
                @error('nom')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border @error('description') border-red-500 @else border-gray-300 @enderror
                      rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('description', $typeService->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Boutons --}}
            <div class="flex items-center justify-between">
                {{-- Annuler --}}
                <a href="{{ route('admin.type_services.index') }}" class="text-gray-600 hover:text-gray-800 underline">
                    Annuler
                </a>

                {{-- Mettre à jour --}}
                <button type="submit" class="ml-auto px-4 py-2 text-white rounded-2xl border transition"
                    style="background-color: #2c2c2c; border: 1px solid #2c2c2c;">
                    Mettre à jour
                </button>
            </div>

        </form>

    </div>

@endsection
