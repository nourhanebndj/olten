@extends('layouts.connected')
@section('title', 'Gestion des Demandes | ' . config('app.name'))

@section('content')
    <section class="animate-fade min-h-screen pb-20">
        <div class="px-6 lg:px-16 pt-12 mb-16">
            <nav aria-label="Breadcrumb" class="flex-1">
                <ol class="flex items-center space-x-2 text-sm font-medium">
                    <li><a href="#" class="text-slate-400 hover:text-slate-600 transition-colors">Annonce</a></li>
                    <li><i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i></li>
                    <li class="text-slate-900 font-bold uppercase tracking-tight text-xs">Demandes reçues</li>
                </ol>
            </nav>
            <div class="mb-10">
                <p class="text-slate-500 mt-2"> Interface de décision en temps réel</p>
            </div>

        </div>
        <div class="space-y-4">
            @forelse($mesAnnonces as $ad)
                <div
                    class="bg-white border-y border-slate-100 px-6 lg:px-16 py-16 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.02)]">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 mb-16">
                        <div class="flex items-center gap-10">
                            <span
                                class="text-7xl font-[1000] text-slate-50 tabular-nums select-none">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="w-2 h-2 rounded-full bg-[#ff3c00] animate-pulse"></span>
                                    <h2 class="text-3xl font-[1000] uppercase tracking-tighter text-slate-900">
                                        {{ $ad->title }}</h2>
                                </div>
                                <div class="flex flex-wrap items-center gap-4">
                                    <span
                                        class="text-[10px] font-black uppercase text-slate-400 tracking-widest flex items-center gap-2">
                                        <i data-lucide="map-pin" class="w-3 h-3 text-slate-300"></i>
                                        {{ $ad->client_address }}
                                    </span>
                                    <span
                                        class="px-3 py-1 bg-slate-50 border border-slate-100 text-slate-900 text-[10px] font-[1000] uppercase tracking-widest rounded-lg">
                                        Budget : {{ number_format($ad->delivery_cost, 0) }}€
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-3xl border border-slate-100">
                            <div class="text-right">
                                <p class="text-[9px] font-black uppercase text-slate-400 tracking-widest">Candidatures</p>
                                <p class="text-2xl font-[1000] text-slate-900 leading-none">{{ $ad->demandes->count() }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center shadow-sm">
                                <i data-lucide="users" class="w-5 h-5 text-[#ff3c00]"></i>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse($ad->demandes as $demande)
                            <div
                                class="group relative bg-white border border-slate-100 rounded-[2.5rem] p-6 transition-all duration-500 hover:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.08)] hover:border-[#ff3c00]/20 flex flex-col justify-between min-h-[300px]">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <div
                                                class="w-14 h-14 rounded-2xl bg-slate-900 overflow-hidden ring-4 ring-slate-50 transition-transform duration-500 group-hover:scale-110">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($demande->livreur->name) }}&background=0f172a&color=fff&bold=true"
                                                    alt="" class="w-full h-full object-cover">
                                            </div>
                                            <div
                                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-4 border-white rounded-full shadow-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <h4
                                                class="text-sm font-[1000] uppercase tracking-tighter text-slate-900 leading-none mb-1">
                                                {{ $demande->livreur->name }}
                                            </h4>
                                            <span
                                                class="text-[8px] font-black text-[#ff3c00] uppercase tracking-[0.2em] flex items-center gap-1">
                                                <i data-lucide="verified" class="w-3 h-3"></i> Profil Certifié
                                            </span>
                                        </div>
                                    </div>
                                    <button class="text-slate-300 hover:text-slate-900 transition-colors">
                                        <i data-lucide="info" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                <div class="my-6 grid grid-cols-2 gap-2">
                                    <div class="bg-slate-50/80 rounded-2xl p-3 border border-slate-50">
                                        <p
                                            class="text-[7px] font-black text-slate-400 uppercase tracking-widest mb-1 italic">
                                            Score Livreur
                                        </p>
                                        <div class="flex items-center gap-1">
                                            <span class="text-xs font-[1000] text-slate-900">
                                                {{ $scoreLivreur }}
                                            </span>
                                            <i data-lucide="star" class="w-2.5 h-2.5 text-amber-400 fill-amber-400"></i>
                                        </div>
                                    </div>
                                    <div class="bg-slate-50/80 rounded-2xl p-3 border border-slate-50">
                                        <p
                                            class="text-[7px] font-black text-slate-400 uppercase tracking-widest mb-1 italic">
                                            Proximité
                                        </p>
                                        <div class="flex items-center gap-1 text-slate-900 font-[1000] text-xs">
                                            <i data-lucide="navigation" class="w-2.5 h-2.5 text-[#ff3c00]"></i>
                                            {{ $proximiteKm }} km
                                        </div>
                                    </div>
                                    <div
                                        class="col-span-2 bg-slate-50/80 rounded-2xl p-3 border border-slate-50 flex items-center justify-between">
                                        <p class="text-[7px] font-black text-slate-400 uppercase tracking-widest italic">
                                            Missions réussies
                                        </p>
                                        <span class="text-[10px] font-black text-slate-900 uppercase tracking-tighter">
                                            {{ $missionsReussies }} livraisons
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    @if ($demande->statut == 'en_attente')
                                        <div class="flex gap-2">
                                            <form action="{{ route('locataire.demande.accept', $demande) }}" method="POST"
                                                class="flex-1">
                                                @csrf
                                                <button
                                                    class="w-full py-4 bg-slate-900 text-white rounded-2xl font-[1000] text-[10px] uppercase tracking-[0.2em] hover:bg-[#ff3c00] transition-all shadow-lg shadow-slate-100 active:scale-95 flex items-center justify-center gap-2 group-hover:gap-3">
                                                    Recruter <i data-lucide="arrow-right"
                                                        class="w-3 h-3 transition-all"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('locataire.demande.refuse', $demande) }}"
                                                method="POST">
                                                @csrf
                                                <button
                                                    class="w-12 h-12 flex items-center justify-center bg-white border border-slate-100 text-slate-300 hover:text-red-500 hover:border-red-100 rounded-2xl transition-all shadow-sm">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div
                                            class="w-full py-4 bg-slate-100 rounded-2xl flex items-center justify-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            <span
                                                class="text-[9px] font-[1000] uppercase text-slate-400 tracking-[0.2em]">Offre
                                                {{ $demande->statut }}</span>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        @empty

                            <div
                                class="col-span-full py-12 flex flex-col items-center justify-center bg-slate-50/30 rounded-[2.5rem] border-2 border-dashed border-slate-100">
                                <i data-lucide="clock" class="w-6 h-6 text-slate-200 mb-2"></i>
                                <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.3em]">En attente de
                                    chauffeurs...</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @empty

            @endforelse
        </div>

    </section>


@endsection
