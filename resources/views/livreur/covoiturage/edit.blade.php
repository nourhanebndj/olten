@extends('layouts.connected')

@section('title', 'Modifier votre annonce | ' . config('app.name'))

@section('content')
    <div class="min-h-screen bg-[#F8FAFC] py-8">
        <div class="max-w-4xl mx-auto px-4">

            <!-- Navigation & Status -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <nav
                        class="flex items-center space-x-2 text-[10px] font-bold text-slate-400 mb-2 uppercase tracking-widest">
                        <a href="{{ route('covoiturage.index') }}" class="hover:text-orange-600 transition-colors">Mes
                            trajets</a>
                        <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-slate-900">Édition trajet</span>
                    </nav>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                        Modifier le trajet <span class="text-orange-600">#TR-13</span>
                    </h1>
                </div>

                <div
                    class="flex items-center space-x-3 bg-white px-3 py-1.5 rounded-full border border-slate-200 shadow-sm self-start md:self-center">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-wider">En attente</span>
                </div>
            </div>

            <!-- Section Principale : Grille de Blocs -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

                <!-- Block: Itinéraire -->
                <a href="#"
                    class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md hover:border-orange-200 transition-all group text-left relative overflow-hidden block">
                    <div
                        class="absolute top-0 right-0 w-16 h-16 bg-orange-50 rounded-bl-full -mr-4 -mt-4 group-hover:bg-orange-100 transition-colors">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="p-3 bg-orange-50 rounded-2xl text-orange-600 w-fit mb-4 group-hover:bg-orange-600 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-1">Itinéraire</h3>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed">Gérer les points de départ, d'arrivée
                            et les horaires précis.</p>
                    </div>
                </a>

                <!-- Block: Route & Étapes -->
                <a href="#"
                    class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md hover:border-blue-200 transition-all group text-left relative overflow-hidden block">
                    <div
                        class="absolute top-0 right-0 w-16 h-16 bg-blue-50 rounded-bl-full -mr-4 -mt-4 group-hover:bg-blue-100 transition-colors">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="p-3 bg-blue-50 rounded-2xl text-blue-600 w-fit mb-4 group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-1">Route & Étapes</h3>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed">Ajouter des arrêts intermédiaires et
                            choisir la route.</p>
                    </div>
                </a>

                <!-- Block: Prix & Paiement -->
                <a href="{{ route('covoiturage.prix.edit', $trajet->covoiturage_id) }}"
                    class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all group text-left relative overflow-hidden block">
                    <div
                        class="absolute top-0 right-0 w-16 h-16 bg-emerald-50 rounded-bl-full -mr-4 -mt-4 group-hover:bg-emerald-100 transition-colors">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="p-3 bg-emerald-50 rounded-2xl text-emerald-600 w-fit mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-bold text-slate-900">Prix & Paiement </h3>
                            <span
                                class="bg-orange-500 text-white text-[9px] px-2 py-0.5 rounded-md font-black tracking-wider uppercase shadow-sm">92€</span>
                        </div>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed">Fixer vos tarifs par place et options
                            de réservation.</p>
                    </div>
                </a>

                <a href="{{ route('covoiturage.options.edit', $trajet->covoiturage_id) }}"
                    class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all group text-left relative overflow-hidden block">

                    <div
                        class="absolute top-0 right-0 w-16 h-16 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 group-hover:bg-indigo-100 transition-colors">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="p-3 bg-indigo-50 rounded-2xl text-indigo-600 w-fit mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>

                        <h3 class="font-bold text-slate-900 mb-1">Places & Confort</h3>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed">
                            Nombre de passagers, bagages et prestations bord.
                        </p>
                    </div>
                </a>

            </div>

            <!-- Barre d'Actions Inférieure -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-200">
                <div class="flex items-center space-x-3 w-full sm:w-auto">
                    <!-- Lien Dupliquer -->
                    <a href="#"
                        class="flex-1 sm:flex-none flex items-center justify-center space-x-2 bg-white px-5 py-2.5 rounded-2xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition-all shadow-sm group font-bold text-xs uppercase tracking-wider">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                        </svg>
                        <span>Dupliquer</span>
                    </a>

                    <!-- Lien Ajouter Retour -->
                    <a href="#"
                        class="flex-1 sm:flex-none flex items-center justify-center space-x-2 bg-slate-900 px-6 py-2.5 rounded-2xl text-white hover:bg-orange-600 transition-all shadow-md group font-bold text-xs uppercase tracking-wider">
                        <svg class="w-4 h-4 text-orange-400 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <span>Ajouter Retour</span>
                    </a>
                </div>

                <!-- Lien Annuler -->
                <a href="#"
                    class="w-full sm:w-auto flex items-center justify-center space-x-2 text-red-500 hover:text-red-700 font-black text-[10px] uppercase tracking-[0.2em] transition-colors group">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Supprimer le trajet</span>
                </a>
            </div>

            <!-- Footer ID -->
            <p class="text-center text-slate-300 text-[9px] font-bold uppercase tracking-[0.4em] mt-12">
                REF #TR-X0013
            </p>
        </div>
    </div>
@endsection
