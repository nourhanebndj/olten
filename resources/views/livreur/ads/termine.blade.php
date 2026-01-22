@extends('layouts.connected')
@section('title', 'Historique des Livraisons | ' . config('app.name'))

@section('content')
    <section class="animate-fade min-h-screen pb-20">
        <div class="px-6 lg:px-16 pt-12 mb-16">
            <nav aria-label="Breadcrumb" class="mb-8">
                <ol class="flex items-center space-x-2 text-sm font-medium">
                    <li>
                        <a href="#"
                            class="text-slate-400 hover:text-slate-600 transition-colors text-xs uppercase tracking-[0.2em] font-black">
                            Livreur
                        </a>
                    </li>
                    <li><i data-lucide="chevron-right" class="w-4 h-4 text-slate-200"></i></li>
                    <li class="text-slate-900 font-black uppercase tracking-[0.2em] text-xs italic">Historique</li>
                </ol>
            </nav>
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">

                <div class="mb-10">
                    <p class="text-slate-500 mt-2"> Archives de vos performances passées.</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="bg-white border border-slate-100 p-6 rounded-[2.5rem] shadow-sm flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-2xl bg-slate-900 flex items-center justify-center text-white shadow-lg shadow-slate-200">
                            <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                Total</p>
                            <p class="text-xl font-[1000] text-slate-900 leading-none">{{ $totalLivres }}</p>
                        </div>
                    </div>
                    <div class="bg-white border border-slate-100 p-6 rounded-[2.5rem] shadow-sm flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-[#ff3c00]/10 flex items-center justify-center text-[#ff3c00]">
                            <i data-lucide="banknote" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p
                                class="text-[8px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1 text-nowrap">
                                Revenus</p>
                            <p class="text-xl font-[1000] text-slate-900 leading-none">
                                {{ number_format($revenusCumules, 0) }}€</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 lg:px-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($livraisonsTerminees as $livraison)
                <div
                    class="group bg-white rounded-[3rem] border border-slate-100 p-8 hover:border-slate-200 hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] transition-all duration-500 flex flex-col h-full">
                    <div class="flex justify-between items-start mb-8">
                        <div class="space-y-2">
                            <span
                                class="px-3 py-1 bg-green-50 text-green-600 rounded-lg font-black text-[8px] uppercase tracking-widest flex items-center gap-1.5 w-fit">
                                <i data-lucide="check" class="w-3 h-3"></i> Terminé
                            </span>
                            <p class="text-[9px] font-bold text-slate-300 uppercase">
                                {{ \Carbon\Carbon::parse($livraison->date_creation)->translatedFormat('d M Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-[1000] text-slate-900 tracking-tighter leading-none">
                                {{ number_format($livraison->prix_total_affiche, 2) }}€
                            </p>
                            <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest mt-1">Gains nets</p>
                        </div>
                    </div>
                    <h3
                        class="text-xl font-black text-slate-900 uppercase tracking-tighter leading-tight mb-8 group-hover:text-[#ff3c00] transition-colors line-clamp-2 min-h-[3rem]">
                        {{ $livraison->objet_description }}
                    </h3>
                    <div class="space-y-6 relative mb-8">
                        <div class="absolute left-[9px] top-2 bottom-2 w-[1px] bg-slate-100"></div>

                        <div
                            class="flex items-start gap-4 relative z-10 opacity-40 group-hover:opacity-60 transition-opacity">
                            <div class="w-5 h-5 rounded-full bg-slate-100 border-4 border-white shadow-sm flex-none mt-1">
                            </div>
                            <div class="min-w-0">
                                <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Départ</p>
                                <p class="text-[11px] font-bold text-slate-500 truncate">{{ $livraison->adresse_depart }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 relative z-10">
                            <div class="w-5 h-5 rounded-full bg-slate-900 border-4 border-white shadow-md flex-none mt-1">
                            </div>
                            <div class="min-w-0">
                                <p class="text-[8px] font-black text-[#ff3c00] uppercase tracking-widest mb-1 italic">
                                    Arrivée</p>
                                <p class="text-[11px] font-black text-slate-900 truncate">{{ $livraison->adresse_arrivee }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center overflow-hidden border border-slate-100">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($livraison->expediteur->name ?? 'C') }}&background=f8fafc&color=0f172a&bold=true"
                                    alt="">
                            </div>
                            <div>
                                <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">Client</p>
                                <p class="text-xs font-black text-slate-900 uppercase tracking-tighter">
                                    {{ $livraison->expediteur->name ?? 'Anonyme' }}</p>
                            </div>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center">
                            <i data-lucide="arrow-up-right"
                                class="w-3 h-3 text-slate-300 group-hover:text-slate-900 transition-colors"></i>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </section>
@endsection
