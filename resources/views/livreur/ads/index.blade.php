@extends('layouts.connected')
@section('title', 'Missions Livreur | ' . config('app.name'))

@section('content')
    <section class="tab-content active animate-fade min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <nav aria-label="Breadcrumb" class="flex-1">
                    <ol class="flex items-center space-x-2 text-sm font-medium">
                        <li><a href="#" class="text-slate-400 hover:text-slate-600 transition-colors">Espace Driver</a>
                        </li>
                        <li><i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i></li>
                        <li class="text-slate-900 font-bold uppercase tracking-tight text-xs">Missions disponibles</li>
                    </ol>
                </nav>
                <div class="flex bg-slate-100 p-1 rounded-full border border-slate-200">
                    <button onclick="showTab('dispo', this)" class="tab-btn-vtc active">Disponibles</button>
                    <button onclick="showTab('demandees', this)" class="tab-btn-vtc">En attente</button>
                    <button onclick="showTab('encours', this)" class="tab-btn-vtc">En cours</button>
                </div>
            </div>
            <div class="mb-10">
                <p class="text-slate-500 mt-2"> Parcourez les annonces et proposez vos services de livraison.</p>
            </div>
            <div id="tab-dispo" class="tab-pane-vtc">
                @include('livreur.ads.partials.ads-grid', [
                    'ads' => $adsDisponibles,
                    'mode' => 'disponible',
                ])
            </div>
            <div id="tab-demandees" class="tab-pane-vtc hidden">
                @include('livreur.ads.partials.ads-grid', ['ads' => $adsDemandees, 'mode' => 'demande'])
            </div>
            <div id="tab-encours" class="tab-pane-vtc hidden">
                @include('livreur.ads.partials.ads-grid', ['ads' => $adsEnCours, 'mode' => 'encours'])
            </div>
        </div>
    </section>

   
    <script>
        lucide.createIcons();

        function showTab(id, btn) {
            document.querySelectorAll('.tab-pane-vtc').forEach(p => p.classList.add('hidden'));
            document.querySelectorAll('.tab-btn-vtc').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + id).classList.remove('hidden');
            btn.classList.add('active');
        }
    </script>
@endsection
