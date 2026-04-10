@extends('layouts.connected')

@section('title', 'Modifier le mode de réservation | ' . config('app.name'))

@section('content')
    <div class="min-h-screen bg-[#F8FAFC] py-12 px-4">
        <div class="max-w-3xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <nav
                        class="flex items-center space-x-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">
                        <a href="{{ route('covoiturage.index') }}" class="hover:text-orange-600 transition-colors">Mes
                            trajets</a>
                        <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                        <a href="{{ route('covoiturage.edit', $covoiturage->covoiturage_id) }}"
                            class="hover:text-orange-600 transition-colors">Édition trajet</a>
                        <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-slate-900">Mode de réservation</span>
                    </nav>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                        Modifier le mode de réservation <span class="text-orange-600">#TR-{{ $covoiturage->covoiturage_id }}</span>
                    </h1>
                </div>
            </div>
       
            <!-- Formulaire Full Page Premium -->
            <form action="{{ route('covoiturage.updateMode', $covoiturage->covoiturage_id) }}" method="POST">
                @csrf
              

                <!-- Option Instantanée (Large Card) -->
                <label class="group relative block cursor-pointer">
                    <input type="radio" name="booking_type" value="instant" class="peer sr-only"
                        {{ $covoiturage->booking_mode === 'instant' ? 'checked' : '' }}>
                    <div
                        class="relative overflow-hidden bg-white p-6 md:p-8 rounded-[35px] border-2 border-transparent shadow-sm transition-all duration-300 peer-checked:border-orange-500 peer-checked:shadow-xl peer-checked:shadow-orange-100 group-hover:shadow-md border-slate-100">

                        <!-- Effet de fond subtil au check -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-bl-full opacity-0 peer-checked:opacity-100 transition-opacity -mr-8 -mt-8">
                        </div>

                        <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-6">
                            <div class="shrink-0">
                                <div
                                    class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="text-lg font-black text-slate-900">Réservation instantanée</h3>
                                    <span
                                        class="bg-green-500 text-white text-[8px] font-black px-2 py-0.5 rounded uppercase tracking-wider">Populaire</span>
                                </div>
                                <p class="text-slate-400 text-[13px] font-medium leading-relaxed max-w-lg">
                                    Gain de temps maximum : les passagers réservent et payent immédiatement sans attendre
                                    votre accord manuel.
                                </p>
                            </div>

                            <div class="shrink-0 flex flex-col items-end">
                                <div class="text-orange-600 font-black text-[10px] uppercase tracking-widest mb-1">+200%
                                    visibilité</div>
                                <div
                                    class="w-6 h-6 rounded-full border-2 border-slate-200 flex items-center justify-center peer-checked:bg-orange-600 peer-checked:border-orange-600 transition-all">
                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>

                <!-- Option Manuelle (Large Card) -->
                <label class="group relative block cursor-pointer">
                    <input type="radio" name="booking_type" value="manual" class="peer sr-only"
                        {{ $covoiturage->booking_mode === 'manual' ? 'checked' : '' }}>
                    <div
                        class="relative overflow-hidden bg-white p-6 md:p-8 rounded-[35px] border-2 border-transparent shadow-sm transition-all duration-300 peer-checked:border-orange-500 peer-checked:shadow-xl peer-checked:shadow-orange-100 group-hover:shadow-md border-slate-100">

                        <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-6">
                            <div class="shrink-0">
                                <div
                                    class="w-14 h-14 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center group-hover:bg-slate-100 group-hover:text-slate-600 transition-colors duration-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-1">
                                <h3 class="text-lg font-black text-slate-900 mb-1">Validation manuelle</h3>
                                <p class="text-slate-400 text-[13px] font-medium leading-relaxed max-w-lg">
                                    Gardez le contrôle total : vous recevez une notification et disposez de quelques heures
                                    pour accepter chaque passager.
                                </p>
                            </div>

                            <div class="shrink-0 flex items-center">
                                <div
                                    class="w-6 h-6 rounded-full border-2 border-slate-200 flex items-center justify-center peer-checked:bg-orange-600 peer-checked:border-orange-600 transition-all">
                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>

                <!-- Section Argumentaire (Horizontal) -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 px-2">
                    <div class="flex items-start space-x-3">
                        <div
                            class="shrink-0 w-6 h-6 rounded-full bg-white shadow-sm flex items-center justify-center text-orange-600">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-relaxed">
                            Badge "Instantané" visible sur votre annonce.
                        </p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div
                            class="shrink-0 w-6 h-6 rounded-full bg-white shadow-sm flex items-center justify-center text-orange-600">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest leading-relaxed">
                            Algorithme de placement optimisé.
                        </p>
                    </div>
                </div>

                <!-- Barre d'Action (Bouton plus petit et aligné à gauche/centré selon besoin, ici centré mais plus discret) -->
                <div class="mt-12 flex flex-col items-center">
                    <button type="submit"
                        class="w-full md:w-auto md:min-w-[240px] bg-slate-900 hover:bg-orange-600 text-white font-black py-4 px-10 rounded-[20px] shadow-xl shadow-slate-200 transition-all transform hover:-translate-y-1 active:scale-95 text-[11px] uppercase tracking-[0.2em]">
                        Enregistrer le choix
                    </button>

                    <a href="#"
                        class="mt-5 text-slate-400 hover:text-red-500 font-bold text-[9px] uppercase tracking-widest transition-colors">
                        Annuler la modification
                    </a>
                </div>
            </form>

            <!-- Footer -->
            <div class="mt-16 border-t border-slate-200 pt-8 flex flex-col items-center">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="flex -space-x-2">
                        <div class="w-7 h-7 rounded-full border-2 border-white bg-slate-200"></div>
                        <div class="w-7 h-7 rounded-full border-2 border-white bg-slate-300"></div>
                        <div
                            class="w-7 h-7 rounded-full border-2 border-white bg-orange-500 flex items-center justify-center text-[7px] text-white font-black">
                            +5k</div>
                    </div>
                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Conducteurs
                        certifiés</span>
                </div>
                <p class="text-slate-300 text-[8px] font-bold uppercase tracking-[0.5em]">
                    REF #TR-X0013
                </p>
            </div>
        </div>
    </div>

    <style>
        /* Simulation du comportement peer pour les icônes et radio custom */
        input:checked+div {
            border-color: #f97316 !important;
            /* orange-500 */
            box-shadow: 0 15px 20px -5px rgb(249 115 22 / 0.08), 0 8px 10px -6px rgb(249 115 22 / 0.08) !important;
        }

        input:checked+div .w-6 {
            background-color: #ea580c;
            /* orange-600 */
            border-color: #ea580c;
        }

        input:checked+div .w-2 {
            opacity: 1;
        }
    </style>
@endsection
