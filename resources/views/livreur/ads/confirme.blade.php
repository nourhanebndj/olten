@extends('layouts.connected')
@section('title', 'Demandes | ' . config('app.name'))

@section('content')
    <section class="min-h-screen pb-20 px-4 sm:px-6 lg:px-16 pt-8 sm:pt-10">

        {{-- Header --}}
        <div class="mb-8 sm:mb-10">
            <nav class="flex items-center gap-2 text-[11px] text-slate-400 uppercase tracking-widest mb-3">
                <a href="#" class="hover:text-slate-600 transition-colors">Annonces</a>
                <span>›</span>
                <span class="text-slate-600">Demandes reçues</span>
            </nav>
            <h1 class="text-xl sm:text-2xl font-semibold text-slate-900">Demandes reçues</h1>
            <p class="text-sm text-slate-400 mt-1">Interface de décision en temps réel</p>
        </div>

        {{-- Annonces --}}
        <div class="space-y-8 sm:space-y-10">
            @forelse($mesAnnonces as $ad)
                <div>
                    {{-- Header section --}}
                    <div
                        class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div>
                            <div class="flex items-baseline gap-3">
                                <span class="text-[11px] font-medium text-slate-300 tracking-wider">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <h2 class="text-base font-semibold text-slate-900">{{ $ad->title }}</h2>
                            </div>
                            <div class="flex flex-wrap items-center gap-2 sm:gap-3 mt-2">
                                <span class="text-xs text-slate-400 flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-3 h-3 flex-shrink-0"></i>
                                    {{ $ad->client_address }}
                                </span>
                                <span class="text-[11px] font-medium bg-slate-100 text-slate-700 px-3 py-1 rounded-full">
                                    {{ number_format($ad->delivery_cost, 0) }} €
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-slate-400 font-medium sm:pt-1 flex-shrink-0">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            {{ $ad->demandes->count() }} candidature{{ $ad->demandes->count() > 1 ? 's' : '' }}
                        </div>
                    </div>

                    {{-- Candidats --}}
                    @if ($ad->demandes->isEmpty())
                        <div
                            class="border border-dashed border-slate-200 rounded-2xl py-10 text-center text-xs text-slate-300 font-medium uppercase tracking-widest">
                            Aucune candidature pour le moment
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                            @foreach ($ad->demandes as $demande)
                                <div
                                    class="bg-white border border-slate-100 rounded-2xl p-4 sm:p-5 flex flex-col gap-4 hover:border-slate-200 transition-colors">

                                    {{-- Identité --}}
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 rounded-xl bg-slate-900 flex items-center justify-center text-white text-xs font-semibold flex-shrink-0">
                                                {{ strtoupper(substr($demande->livreur->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-900 leading-none mb-1">
                                                    {{ $demande->livreur->name }}
                                                </p>
                                                <span class="text-[10px] font-medium text-[#ff3c00]">● Certifié</span>
                                            </div>
                                        </div>
                                        <div class="w-2 h-2 rounded-full bg-emerald-400 mt-1 flex-shrink-0"></div>
                                    </div>

                                    {{-- Stats --}}
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="bg-slate-50 rounded-xl p-3">
                                            <p class="text-[9px] font-medium text-slate-400 uppercase tracking-wider mb-1">
                                                Score</p>
                                            <p class="text-sm font-semibold text-slate-900">{{ $scoreLivreur }} ★</p>
                                        </div>
                                        <div class="bg-slate-50 rounded-xl p-3">
                                            <p class="text-[9px] font-medium text-slate-400 uppercase tracking-wider mb-1">
                                                Distance</p>
                                            <p class="text-sm font-semibold text-slate-900">{{ $proximiteKm }} km</p>
                                        </div>
                                        <div
                                            class="col-span-2 bg-slate-50 rounded-xl px-3 py-2.5 flex items-center justify-between">
                                            <p class="text-[9px] font-medium text-slate-400 uppercase tracking-wider">
                                                Missions</p>
                                            <p class="text-xs font-semibold text-slate-900">{{ $missionsReussies }}</p>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    @if ($demande->statut == 'en_attente')
                                        <div class="flex gap-2 mt-auto">
                                            <form action="{{ route('locataire.demande.accept', $demande) }}" method="POST"
                                                class="flex-1">
                                                @csrf
                                                <button
                                                    class="w-full py-2.5 bg-slate-900 text-white rounded-xl text-[11px] font-semibold tracking-wide hover:bg-[#ff3c00] transition-colors">
                                                    Recruter →
                                                </button>
                                            </form>
                                            <form action="{{ route('locataire.demande.refuse', $demande) }}"
                                                method="POST">
                                                @csrf
                                                <button
                                                    class="w-9 h-9 flex items-center justify-center border border-slate-100 rounded-xl text-slate-300 hover:text-red-400 hover:border-red-100 transition-colors">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div
                                            class="mt-auto py-2.5 bg-slate-50 rounded-xl text-center text-[10px] font-medium text-slate-400 uppercase tracking-widest">
                                            {{ $demande->statut }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div
                    class="border border-dashed border-slate-200 rounded-2xl py-16 text-center text-xs text-slate-300 font-medium uppercase tracking-widest">
                    Aucune annonce active
                </div>
            @endforelse
        </div>
    </section>
@endsection
