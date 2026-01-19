@extends('layouts.connected')
@section('title', 'Historique des Livraisons | ' . config('app.name'))

@section('content')
<section class="tab-content active animate-fad min-h-screen">
    <div>
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-12">
            
            <nav aria-label="Breadcrumb" class="flex-1">
                <ol class="flex items-center space-x-3 text-sm font-medium">
                    <li>
                        <a href="#" class="text-slate-400 hover:text-[#ff3c00] transition-colors flex items-center gap-2">
                            <i class="fa-solid fa-box-archive text-xs"></i>
                            Livreur
                        </a>
                    </li>
                    <li><i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i></li>
                    <li class="text-slate-900 font-black uppercase tracking-tight">Historique des courses</li>
                </ol>
            </nav>

            <div class="flex items-center bg-white p-2 rounded-[2rem] border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4 px-6 py-2 border-r border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white shadow-lg">
                        <i class="fa-solid fa-check-double text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase leading-none mb-1 text-nowrap">Total Livré</p>
                        <p class="text-xl font-black text-slate-900 leading-none">24</p>
                    </div>
                </div>
                <div class="px-6">
                    <div>
                        <p class="text-[9px] font-black text-[#ff3c00] uppercase leading-none mb-1 text-nowrap">Revenus Cumulés</p>
                        <p class="text-xl font-black text-slate-900 leading-none">842.00€</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            <div class="group relative bg-white rounded-[3rem] border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_50px_-10px_rgba(255,60,0,0.1)] transition-all duration-500 flex flex-col h-full overflow-hidden">
                <div class="p-8 pb-0 flex justify-between items-start">
                    <div class="flex flex-col gap-2">
                        <span class="px-3 py-1 bg-[#ff3c00] text-white rounded-lg font-black text-[9px] uppercase tracking-widest flex items-center gap-1.5 w-fit">
                            <i class="fa-solid fa-circle-check text-[10px]"></i> Livré
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">18 Janv. 2024</span>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-tighter">Montant Payé</span>
                        <span class="text-2xl font-black text-slate-900 tracking-tighter underline decoration-[#ff3c00] decoration-2 underline-offset-4">35.00€</span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-slate-800 leading-snug mb-8 min-h-[3.5rem] group-hover:text-[#ff3c00] transition-colors">MacBook Pro M2 - Protection renforcée</h3>
                    <div class="space-y-8 relative">
                        <div class="absolute left-[11px] top-3 bottom-3 w-[2px] bg-slate-100"></div>
                        <div class="flex items-start gap-5 relative z-10 opacity-50">
                            <div class="w-[24px] h-[24px] rounded-full bg-slate-100 border-4 border-white shadow-sm"></div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Point de retrait</p>
                                <p class="text-sm font-bold text-slate-500 italic">Apple Store, Opéra Paris</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5 relative z-10">
                            <div class="w-[24px] h-[24px] rounded-full bg-slate-900 border-4 border-white shadow-md"></div>
                            <div>
                                <p class="text-[10px] font-black text-[#ff3c00] uppercase leading-none mb-1">Destination finale</p>
                                <p class="text-sm font-bold text-slate-700">12 Rue de la Paix, Paris</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-8 mt-auto">
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100"><i class="fa-solid fa-user-check text-xs"></i></div>
                            <div><p class="text-[9px] font-black text-slate-400 uppercase leading-none">Client</p><p class="text-sm font-bold text-slate-800 tracking-tight">Jean-Luc Picard</p></div>
                        </div>
                        <div class="flex items-center gap-1.5 px-3 py-1 bg-orange-50 rounded-full border border-orange-100">
                            <i class="fa-solid fa-star text-[#ff3c00] text-[10px]"></i><span class="text-[11px] font-black text-[#ff3c00]">5.0</span>
                        </div>
                    </div>
                </div>
                <div class="p-8 flex gap-3">
                    <button class="flex-[3] py-4 bg-slate-900 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-[#ff3c00] transition-all flex items-center justify-center gap-3">
                        <i class="fa-solid fa-file-invoice"></i> Voir le reçu
                    </button>
                    <div class="dropdown flex-1">
                        <button class="w-full h-full py-4 bg-white border border-slate-200 text-slate-400 rounded-2xl hover:text-[#ff3c00] hover:border-[#ff3c00] transition-all flex items-center justify-center" type="button" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-xl rounded-2xl p-2 bg-white">
                            <li><a class="dropdown-item flex items-center gap-3 py-3 px-4 rounded-xl text-slate-600 font-bold text-xs hover:bg-slate-50" href="#"><i class="fa-solid fa-magnifying-glass-location"></i> Détails trajet</a></li>
                            <li><a class="dropdown-item flex items-center gap-3 py-3 px-4 rounded-xl text-red-500 font-bold text-xs hover:bg-red-50" href="#"><i class="fa-solid fa-circle-exclamation"></i> Signaler litige</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white rounded-[3rem] border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_50px_-10px_rgba(255,60,0,0.1)] transition-all duration-500 flex flex-col h-full overflow-hidden">
                <div class="p-8 pb-0 flex justify-between items-start">
                    <div class="flex flex-col gap-2">
                        <span class="px-3 py-1 bg-[#ff3c00] text-white rounded-lg font-black text-[9px] uppercase tracking-widest flex items-center gap-1.5 w-fit">
                            <i class="fa-solid fa-circle-check text-[10px]"></i> Livré
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">15 Janv. 2024</span>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-tighter">Montant Payé</span>
                        <span class="text-2xl font-black text-slate-900 tracking-tighter underline decoration-[#ff3c00] decoration-2 underline-offset-4">12.50€</span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-slate-800 leading-snug mb-8 min-h-[3.5rem] group-hover:text-[#ff3c00] transition-colors">Vêtements de Luxe - Boutique Chanel</h3>
                    <div class="space-y-8 relative">
                        <div class="absolute left-[11px] top-3 bottom-3 w-[2px] bg-slate-100"></div>
                        <div class="flex items-start gap-5 relative z-10 opacity-50">
                            <div class="w-[24px] h-[24px] rounded-full bg-slate-100 border-4 border-white shadow-sm"></div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Point de retrait</p>
                                <p class="text-sm font-bold text-slate-500 italic">Rue du Faubourg Saint-Honoré</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5 relative z-10">
                            <div class="w-[24px] h-[24px] rounded-full bg-slate-900 border-4 border-white shadow-md"></div>
                            <div>
                                <p class="text-[10px] font-black text-[#ff3c00] uppercase leading-none mb-1">Destination finale</p>
                                <p class="text-sm font-bold text-slate-700">Hôtel Ritz, Place Vendôme</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-8 mt-auto">
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100"><i class="fa-solid fa-user-check text-xs"></i></div>
                            <div><p class="text-[9px] font-black text-slate-400 uppercase leading-none">Client</p><p class="text-sm font-bold text-slate-800 tracking-tight">Amélie Poulain</p></div>
                        </div>
                        <div class="flex items-center gap-1.5 px-3 py-1 bg-orange-50 rounded-full border border-orange-100">
                            <i class="fa-solid fa-star text-[#ff3c00] text-[10px]"></i><span class="text-[11px] font-black text-[#ff3c00]">4.8</span>
                        </div>
                    </div>
                </div>
                <div class="p-8 flex gap-3">
                    <button class="flex-[3] py-4 bg-slate-900 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-[#ff3c00] transition-all flex items-center justify-center gap-3">
                        <i class="fa-solid fa-file-invoice"></i> Voir le reçu
                    </button>
                    <div class="dropdown flex-1">
                        <button class="w-full h-full py-4 bg-white border border-slate-200 text-slate-400 rounded-2xl hover:text-[#ff3c00] hover:border-[#ff3c00] transition-all flex items-center justify-center" type="button" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-xl rounded-2xl p-2 bg-white">
                            <li><a class="dropdown-item flex items-center gap-3 py-3 px-4 rounded-xl text-slate-600 font-bold text-xs hover:bg-slate-50" href="#"><i class="fa-solid fa-magnifying-glass-location"></i> Détails trajet</a></li>
                            <li><a class="dropdown-item flex items-center gap-3 py-3 px-4 rounded-xl text-red-500 font-bold text-xs hover:bg-red-50" href="#"><i class="fa-solid fa-circle-exclamation"></i> Signaler litige</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="group relative bg-white rounded-[3rem] border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_50px_-10px_rgba(255,60,0,0.1)] transition-all duration-500 flex flex-col h-full overflow-hidden opacity-90 scale-[0.98]">
                <div class="p-8 pb-0 flex justify-between items-start">
                    <div class="flex flex-col gap-2">
                        <span class="px-3 py-1 bg-[#ff3c00] text-white rounded-lg font-black text-[9px] uppercase tracking-widest flex items-center gap-1.5 w-fit">
                            <i class="fa-solid fa-circle-check text-[10px]"></i> Livré
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">12 Janv. 2024</span>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-tighter">Montant Payé</span>
                        <span class="text-2xl font-black text-slate-900 tracking-tighter underline decoration-[#ff3c00] decoration-2 underline-offset-4">8.00€</span>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-bold text-slate-800 leading-snug mb-8 min-h-[3.5rem] group-hover:text-[#ff3c00] transition-colors">Documents Notariés - Signature Express</h3>
                    <div class="space-y-8 relative">
                        <div class="absolute left-[11px] top-3 bottom-3 w-[2px] bg-slate-100"></div>
                        <div class="flex items-start gap-5 relative z-10 opacity-50">
                            <div class="w-[24px] h-[24px] rounded-full bg-slate-100 border-4 border-white shadow-sm"></div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Point de retrait</p>
                                <p class="text-sm font-bold text-slate-500 italic">Cabinet Maître Dupont, Lyon</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5 relative z-10">
                            <div class="w-[24px] h-[24px] rounded-full bg-slate-900 border-4 border-white shadow-md"></div>
                            <div>
                                <p class="text-[10px] font-black text-[#ff3c00] uppercase leading-none mb-1">Destination finale</p>
                                <p class="text-sm font-bold text-slate-700">Mairie du 3ème, Lyon</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-8 mt-auto">
                    <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100"><i class="fa-solid fa-user-check text-xs"></i></div>
                            <div><p class="text-[9px] font-black text-slate-400 uppercase leading-none">Client</p><p class="text-sm font-bold text-slate-800 tracking-tight">Julien Clerc</p></div>
                        </div>
                        <div class="flex items-center gap-1.5 px-3 py-1 bg-orange-50 rounded-full border border-orange-100">
                            <i class="fa-solid fa-star text-[#ff3c00] text-[10px]"></i><span class="text-[11px] font-black text-[#ff3c00]">5.0</span>
                        </div>
                    </div>
                </div>
                <div class="p-8 flex gap-3">
                    <button class="flex-[3] py-4 bg-slate-900 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-[#ff3c00] transition-all flex items-center justify-center gap-3">
                        <i class="fa-solid fa-file-invoice"></i> Voir le reçu
                    </button>
                    <div class="dropdown flex-1">
                        <button class="w-full h-full py-4 bg-white border border-slate-200 text-slate-400 rounded-2xl hover:text-[#ff3c00] hover:border-[#ff3c00] transition-all flex items-center justify-center" type="button" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-xl rounded-2xl p-2 bg-white">
                            <li><a class="dropdown-item flex items-center gap-3 py-3 px-4 rounded-xl text-slate-600 font-bold text-xs hover:bg-slate-50" href="#"><i class="fa-solid fa-magnifying-glass-location"></i> Détails trajet</a></li>
                            <li><a class="dropdown-item flex items-center gap-3 py-3 px-4 rounded-xl text-red-500 font-bold text-xs hover:bg-red-50" href="#"><i class="fa-solid fa-circle-exclamation"></i> Signaler litige</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .animate-fade {
        animation: fadeIn 0.5s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .dropdown-menu {
        min-width: 200px;
    }
</style>
@endsection