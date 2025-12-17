@extends('admin.layouts.app')

@section('title', 'Détails du message')
@section('page_title', 'Détails du message')

@section('content')

    <div class="page-inner">

        {{-- HEADER / Breadcrumb --}}
        <div class="pb-3 mb-6 border-b flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Messages Contact</h1>

                <ul class="flex items-center text-sm text-gray-500 mt-1 space-x-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:underline">
                            <i class="bi bi-house"></i>
                        </a>
                    </li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li>
                        <a href="{{ route('admin.contact_messages.index') }}" class="hover:underline">
                            Messages Contact
                        </a>
                    </li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li class="text-red-600 font-semibold">Détails</li>
                </ul>
            </div>
        </div>

        {{-- Card du message --}}
        <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 relative">

            {{-- Bouton Supprimer en haut à droite --}}
            <form id="delete-form" action="{{ route('admin.contact_messages.destroy', $contactMessage) }}" method="POST"
                class="delete-form absolute top-5 right-5 z-10">
                @csrf
                @method('DELETE')
                <button type="button"
                    class="w-10 h-10 flex items-center justify-center bg-red-600 text-white rounded-full
            shadow-md hover:bg-red-700 hover:scale-105 active:scale-95 transition-all duration-200 delete-btn"
                    title="Supprimer ce message">
                    <i class="bi bi-trash-fill text-lg"></i>
                </button>
            </form>


            {{-- Header de la card --}}
            <div class="bg-gradient-to-r from-red-600 to-pink-500 p-6">
                <h2 class="text-2xl font-bold text-white">Détails du message</h2>
                <p class="text-sm text-white/80 mt-1 opacity-90">
                    Message reçu de {{ $contactMessage->name }} via le formulaire de contact
                </p>
            </div>

            {{-- Contenu du message --}}
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nom --}}
                    <div>
                        <h3 class="text-gray-400 font-semibold text-xs uppercase mb-1 tracking-wider">Nom</h3>
                        <p class="text-gray-900 text-lg font-medium">{{ $contactMessage->name }}</p>
                    </div>

                    {{-- Email --}}
                    <div>
                        <h3 class="text-gray-400 font-semibold text-xs uppercase mb-1 tracking-wider">Email</h3>
                        <p class="text-gray-900 text-lg font-medium">
                            <a href="mailto:{{ $contactMessage->email }}"
                                class="hover:text-red-600 transition duration-150">
                                {{ $contactMessage->email }}
                            </a>
                        </p>
                    </div>

                    {{-- Sujet --}}
                    <div class="md:col-span-2">
                        <h3 class="text-gray-400 font-semibold text-xs uppercase mb-1 tracking-wider">Sujet</h3>
                        <p class="text-gray-900 text-lg font-medium">{{ $contactMessage->subject }}</p>
                    </div>

                    {{-- Message --}}
                    <div class="md:col-span-2">
                        <h3 class="text-gray-400 font-semibold text-xs uppercase mb-2 tracking-wider">Message</h3>
                        <div
                            class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-gray-800 text-base whitespace-pre-line shadow-sm max-h-96 overflow-y-auto">
                            {{ $contactMessage->message ?? '— Aucun message fourni —' }}
                        </div>
                    </div>

                    {{-- Date de réception --}}
                    <div class="md:col-span-2 pt-4 border-t border-gray-100">
                        <h3 class="text-gray-400 font-semibold text-xs uppercase mb-1 tracking-wider">Reçu le</h3>
                        @php
                            use Carbon\Carbon;
                            Carbon::setLocale('fr'); // Définit la langue en français
                        @endphp

                        <p class="text-gray-600 text-sm font-light">
                            {{ Carbon::parse($contactMessage->created_at)->isoFormat('LLLL') }}
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
                        title: 'Supprimer ce message ?',
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
