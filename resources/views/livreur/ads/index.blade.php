@extends('layouts.connected')
@section('title', 'Espace Livraison | ' . config('app.name'))

@section('content')
    <section class="tab-content active animate-fade  min-h-screen">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-12">

            <nav aria-label="Breadcrumb" class="flex-1">
                <ol class="flex items-center space-x-3 text-sm font-medium">
                    <li>
                        <a href="#"
                            class="text-slate-400 hover:text-[#ff3c00] transition-colors flex items-center gap-2">
                            <i class="fa-solid fa-truck-velocity text-xs"></i>
                            Livreur
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                    </li>
                    <li class="text-slate-900 font-black uppercase tracking-tight">
                        Annonces à livrer
                    </li>
                </ol>
            </nav>

            <div class="flex items-center bg-white p-2 rounded-[2rem] border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4 px-6 py-2 border-r border-slate-100">
                    <div
                        class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white shadow-lg shadow-slate-200">
                        <i class="fa-solid fa-route text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase leading-none mb-1 text-nowrap">Disponibles
                        </p>
                        <p class="text-xl font-black text-slate-900 leading-none">{{ $ads->count() }}</p>
                    </div>
                </div>
                <div class="px-4">
                    <button
                        class="w-9 h-9 rounded-lg bg-slate-50 text-slate-400 hover:bg-[#ff3c00] hover:text-white transition-all">
                        <i class="fa-solid fa-sliders text-xs"></i>
                    </button>
                </div>
            </div>
        </div>

        @if ($ads->isEmpty())
            <div class="bg-white border-2 border-dashed border-slate-200 p-24 rounded-[4rem] text-center shadow-sm">
                <div class="relative w-24 h-24 mx-auto mb-8">
                    <div class="absolute inset-0 bg-orange-50 rounded-full animate-ping opacity-20"></div>
                    <div
                        class="relative w-24 h-24 flex items-center justify-center text-slate-300 bg-slate-50 rounded-full">
                        <i class="fa-solid fa-box-open fa-3x"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Zone Calme</h3>
                <p class="text-slate-400 mt-3 max-w-xs mx-auto font-medium">Toutes les livraisons ont été attribuées.
                    Revenez d'ici quelques minutes !</p>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($ads as $ad)
                <div
                    class="group relative bg-white rounded-[3rem] border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_50px_-10px_rgba(255,60,0,0.15)] hover:border-orange-100 transition-all duration-500 flex flex-col h-full overflow-hidden">

                    <!-- Header -->
                    <div class="p-8 pb-0 flex justify-between items-center text-nowrap">
                        <span
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-wider group-hover:bg-[#ff3c00] group-hover:text-white transition-colors">
                            {{ $ad->category?->nom ?? 'Express' }}
                        </span>
                        <div class="flex flex-col items-end">
                            <span class="text-[10px] font-black text-slate-300 uppercase">Tarif Net</span>
                            <span
                                class="text-3xl font-black text-slate-900 tracking-tighter">{{ $ad->delivery_cost + $ad->price_per_day }}€</span>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="p-8">
                        <h3
                            class="text-xl font-bold text-slate-800 leading-snug mb-8 min-h-[3.5rem] group-hover:text-[#ff3c00] transition-colors">
                            {{ Str::limit($ad->title, 50) }}
                        </h3>

                        <!-- Details -->
                        <div class="space-y-8 relative">
                            <div
                                class="absolute left-[11px] top-3 bottom-3 w-[2px] bg-gradient-to-b from-slate-900 via-slate-200 to-[#ff3c00]">
                            </div>

                            <div class="flex items-start gap-5 relative z-10">
                                <div
                                    class="w-[24px] h-[24px] rounded-full bg-slate-900 border-4 border-white shadow-md flex-shrink-0">
                                </div>
                                <div>
                                    <p
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-tighter leading-none mb-1">
                                        Point d'enlèvement</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $ad->address }}</p>
                                </div>
                            </div>



                            <div class="flex items-start gap-5 relative z-10">
                                <div
                                    class="w-[24px] h-[24px] rounded-full bg-[#ff3c00] border-4 border-white shadow-md flex-shrink-0">
                                </div>
                                <div>
                                    <p
                                        class="text-[10px] font-black text-[#ff3c00] uppercase tracking-tighter leading-none mb-1">
                                        Destination</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $ad->client_address }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Expéditeur -->
                    <div class="px-8 mt-auto">
                        <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 overflow-hidden border border-slate-200">
                                    @if ($ad->user?->avatar)
                                        <img src="{{ $ad->user->avatar }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-user-tie text-xs"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase leading-none">Expéditeur</p>
                                    <p class="text-sm font-bold text-slate-800">{{ $ad->user?->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="p-8 flex gap-3">
                        @if ($ad->status === 'pending')
                            <form method="POST" action="{{ route('delivery.ads.accept', $ad) }}" class="w-full">
                                @csrf
                                <button
                                    class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-[#ff3c00] transition-all flex items-center justify-center gap-3">
                                    <i class="fa-solid fa-paper-plane text-[10px]"></i>
                                    Confirmer la course
                                </button>
                            </form>
                        @elseif ($ad->status === 'confirmed')
                            <span
                                class="px-4 py-2 text-xs font-bold rounded-full bg-green-100 text-green-700 w-full text-center">
                                Confirmée
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <style>
        .animate-fade {
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
