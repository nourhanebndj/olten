<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @forelse ($ads as $ad)
        <div
            class="group relative bg-white rounded-[2.8rem] p-8 border border-slate-200 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_50px_-12px_rgba(255,60,0,0.12)] hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between min-h-[480px] overflow-hidden">
            <div
                class="absolute -top-24 -right-24 w-48 h-48 bg-slate-50 rounded-full group-hover:bg-orange-50 transition-colors duration-500 -z-10">
            </div>
            <div>
                <div class="flex justify-between items-start mb-8">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100 p-[2px] shadow-sm group-hover:rotate-6 transition-transform duration-500">
                                <div
                                    class="w-full h-full rounded-2xl bg-white overflow-hidden flex items-center justify-center">
                                    @if ($ad->user && $ad->user->avatar)
                                        <img src="{{ $ad->user->avatar }}" alt=""
                                            class="w-full h-full object-cover">
                                    @else
                                        <i data-lucide="user" class="w-6 h-6 text-slate-300"></i>
                                    @endif
                                </div>
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-4 border-white rounded-full">
                            </div>
                        </div>
                        <div>
                            <p
                                class="text-[9px] font-black text-[#ff3c00] uppercase tracking-[0.15em] leading-none mb-1.5">
                                Expéditeur</p>
                            <p class="text-sm font-[900] text-slate-900 tracking-tight">
                                {{ Str::limit($ad->user->name ?? 'Client VIP', 15) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-[1000] text-slate-900 tracking-tighter leading-none">
                            {{ number_format($ad->delivery_cost, 0) }}<span
                                class="text-lg ml-0.5 text-[#ff3c00]">€</span>
                        </div>
                        <span
                            class="inline-block px-2 py-1 rounded-lg bg-slate-900 text-[8px] font-black text-white uppercase tracking-widest mt-2 shadow-lg shadow-slate-200">Net</span>
                    </div>
                </div>
                @if ($mode === 'demande')
                    <div class="mb-6 flex items-center justify-between  ">
                        <span class="text-[10px] font-bold text-slate-500 italic"></span>
                        <button
                            class="flex items-center gap-1.5 text-[#ff3c00] text-[10px] font-black uppercase tracking-tighter hover:scale-105 transition-transform">
                            <i data-lucide="message-square" class="w-3 h-3"></i> Chat
                        </button>
                    </div>
                @endif
                <h3
                    class="text-xl font-[1000] text-slate-900 uppercase tracking-tighter leading-[1.1] mb-8 line-clamp-2 min-h-[2.2em] group-hover:text-[#ff3c00] transition-colors">
                    {{ $ad->title }}
                </h3>
                <div class="space-y-7 relative px-1">
                    <div
                        class="absolute left-[11px] top-3 bottom-3 w-[2px] bg-gradient-to-b from-slate-200 via-slate-100 to-[#ff3c00] rounded-full">
                    </div>
                    <div class="flex items-start gap-5 relative z-10">
                        <div
                            class="w-[22px] h-[22px] rounded-full bg-white border-[3px] border-slate-900 flex items-center justify-center shrink-0 shadow-sm">
                            <div class="w-1.5 h-1.5 rounded-full bg-slate-900"></div>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Point de
                                départ</p>
                            <p
                                class="text-[12px] font-bold text-slate-600 leading-tight uppercase tracking-tight group-hover:text-slate-900 transition-colors">
                                {{ $ad->address }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-5 relative z-10">
                        <div
                            class="w-[22px] h-[22px] rounded-full bg-[#ff3c00] border-[3px] border-white shadow-[0_0_15px_rgba(255,60,0,0.4)] flex items-center justify-center shrink-0">
                            <i data-lucide="map-pin" class="w-2.5 h-2.5 text-white"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[8px] font-black text-[#ff3c00] uppercase tracking-widest mb-1">Arrivée</p>
                            <p class="text-[12px] font-[900] text-slate-900 leading-tight uppercase tracking-tight">
                                {{ $ad->client_address }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                @if ($mode === 'disponible')
                    <form action="{{ route('delivery.ads.request', $ad) }}" method="POST">
                        @csrf
                        <button
                            class="w-full h-16 bg-slate-900 text-white rounded-[1.8rem] font-black text-xs uppercase tracking-[0.2em] flex items-center justify-center gap-3 transition-all relative overflow-hidden group/btn shadow-xl shadow-slate-200 active:scale-95">
                            <span class="relative z-10">Prendre la mission</span>
                            <i data-lucide="bolt"
                                class="w-4 h-4 relative z-10 group-hover/btn:fill-white group-hover/btn:scale-125 transition-all"></i>
                            <div
                                class="absolute inset-0 bg-[#ff3c00] -translate-x-full group-hover/btn:translate-x-0 transition-transform duration-500 ease-out">
                            </div>
                        </button>
                    </form>
                @elseif($mode === 'demande')
                    <div class="flex gap-3">
                        <a href="https://www.google.com/maps/dir/?api=1&origin={{ urlencode($ad->address) }}&destination={{ urlencode($ad->client_address) }}"
                            target="_blank"
                            class="flex-1 h-16 bg-slate-50 text-slate-900 rounded-[1.8rem] border-2 border-slate-100 font-black text-[10px] uppercase flex flex-col items-center justify-center gap-1 hover:bg-white hover:border-[#ff3c00] transition-all group/map">
                            <i data-lucide="map" class="w-4 h-4 group-hover/map:animate-bounce text-[#ff3c00]"></i>
                            <span>Itinéraire</span>
                        </a>
                        <div
                            class="flex-[1.5] h-16 bg-orange-50/50 border-2 border-orange-100 text-[#ff3c00] rounded-[1.8rem] flex flex-col items-center justify-center gap-1">
                            <div class="flex items-center gap-2">
                                <span class="flex h-2 w-2 relative">
                                    <span
                                        class=" absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#ff3c00]"></span>
                                </span>
                                <span class="font-[1000] text-[10px] uppercase tracking-widest">En examen</span>
                            </div>
                            <span
                                class="text-[8px] font-bold opacity-60 uppercase italic tracking-tighter text-slate-500">Validation
                                en cours</span>
                        </div>
                    </div>
                @elseif($mode === 'encours')
                    <div class="mt-8 flex items-center gap-3">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($ad->client_address) }}"
                            target="_blank"
                            class="flex-none w-14 h-14 bg-white border-2 border-slate-100 rounded-2xl flex items-center justify-center transition-all hover:border-slate-900 hover:bg-slate-50 active:scale-90 group"
                            title="Ouvrir l'itinéraire">
                            <i data-lucide="map-pin"
                                class="w-6 h-6 text-slate-400 group-hover:text-[#ff3c00] transition-colors"></i>
                        </a>
                        <form
                            action="{{ route('demande.finaliser', $ad->demandes->firstWhere('statut', 'acceptee')) }}"
                            method="POST" class="flex-1">
                            @csrf
                            <button
                                class="w-full py-4 bg-slate-900 text-white rounded-2xl font-[1000] text-[11px] uppercase tracking-[0.2em] flex items-center justify-center gap-3 transition-all duration-300 shadow-xl shadow-slate-100 group">
                                <span class="relative">Finaliser</span>
                                <div
                                    class="w-5 h-5 rounded-full bg-white/10 flex items-center justify-center group-hover:bg-white/20">
                                    <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                </div>
                            </button>
                        </form>
                        <form action="{{ route('demande.annuler', $ad->demandes->firstWhere('statut', 'acceptee')) }}"
                            method="POST">
                            @csrf
                            <button
                                class="flex-none w-14 h-14 bg-white border-2 border-slate-100 rounded-2xl flex items-center justify-center text-red-500 transition-all hover:border-red-500 hover:bg-red-50 active:scale-90"
                                title="Annuler la mission">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </form>

                    </div>
                    <div class="mt-4 flex items-center gap-2 px-2">
                        <span class="w-1 h-1 rounded-full bg-green-500 animate-ping"></span>
                        <p class="text-[8px] font-[1000] text-slate-400 uppercase tracking-widest">Mission en cours de
                            livraison</p>
                    </div>
                @endif

            </div>
        </div>

    @empty
        <div
            class="col-span-full py-24 flex flex-col items-center justify-center text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-100 shadow-sm">
            <div class="relative mb-8">
                <div class="w-32 h-32 bg-slate-50 rounded-[3.5rem] flex items-center justify-center animate-float">
                    <i data-lucide="ghost" class="w-16 h-16 text-slate-200"></i>
                </div>
                <div
                    class="absolute -bottom-2 -right-2 w-12 h-12 bg-white border-4 border-slate-50 rounded-full flex items-center justify-center shadow-lg">
                    <i data-lucide="search" class="w-5 h-5 text-[#ff3c00]"></i>
                </div>
            </div>

            <h3 class="text-2xl font-[1000] text-slate-900 uppercase tracking-tighter italic">
                C'est bien <span class="text-[#ff3c00]">calme</span> ici...
            </h3>
            <p
                class="text-slate-400 text-sm mt-3 max-w-xs mx-auto font-bold uppercase tracking-tight leading-relaxed opacity-70">
                @if ($mode === 'disponible')
                    Aucune mission n'est disponible pour le moment. Revenez d'ici quelques minutes !
                @elseif($mode === 'demande')
                    Vous n'avez pas encore fait d'offre. C'est le moment de vous lancer !
                @else
                    Vous n'avez aucune mission active. Prêt pour une nouvelle livraison ?
                @endif
            </p>
            <button onclick="window.location.reload()"
                class="mt-10 px-10 py-4 bg-slate-900 hover:bg-[#ff3c00] text-white rounded-full font-black text-[10px] uppercase tracking-[0.2em] transition-all shadow-xl shadow-slate-200 active:scale-95 flex items-center gap-3">
                <i data-lucide="refresh-cw" class="w-3 h-3"></i> Actualiser le flux
            </button>
        </div>
    @endforelse
</div>
