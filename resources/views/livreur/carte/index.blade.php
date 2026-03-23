@extends('layouts.connected')
@section('title', 'Carte VTC | ' . config('app.name'))

@section('content')
    <section class="tab-content active animate-fade">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <!-- Header & Action -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <nav aria-label="Breadcrumb" class="mb-4">
                        <ol class="flex items-center space-x-2 text-xs font-bold uppercase tracking-widest">
                            <li><a href="#" class="text-slate-400 hover:text-[#ff3c00] transition-colors">Espace
                                    Chauffeur</a></li>
                            <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-300"></i></li>
                            <li class="text-slate-900">Certifications & Véhicule</li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Mon Profil Professionnel</h1>
                    <p class="text-slate-500 mt-2 max-w-xl">Gérez vos documents réglementaires et les informations de votre
                        véhicule pour maintenir votre activité.</p>
                </div>

                <button id="openUploadModal"
                    class="group py-4 px-8 bg-[#ff3c00] hover:bg-black text-white rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all duration-500 shadow-xl shadow-orange-200 flex items-center justify-center gap-3 hover:-translate-y-1">
                    <i data-lucide="upload-cloud" class="w-4 h-4 group-hover:animate-bounce"></i>
                    Mettre à jour mes documents
                </button>
            </div>

            <!-- Main Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @php
                    $docs = [
                        [
                            'name' => 'identity_card',
                            'label' => "Pièce d'identité",
                            'desc' => 'CNI ou Passeport valide (Recto/Verso)',
                            'icon' => 'contact-2',
                        ],
                        [
                            'name' => 'vtc_card',
                            'label' => 'Carte Professionnelle',
                            'desc' => 'Carte VTC en cours de validité',
                            'icon' => 'award',
                        ],
                    ];
                @endphp

                {{-- Documents Cards --}}
                @foreach ($docs as $doc)
                    @php $file = auth()->user()->documents->where('name', $doc['name'])->first(); @endphp
                    <div
                        class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:border-slate-200 transition-all duration-500 flex flex-col min-h-[380px]">
                        <div class="flex justify-between items-start mb-8">
                            <div
                                class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-[#ff3c00]/5 group-hover:text-[#ff3c00] transition-colors duration-500">
                                <i data-lucide="{{ $doc['icon'] }}" class="w-8 h-8"></i>
                            </div>

                            @if ($file)
                                <div class="flex flex-col items-end">
                                    <span
                                        class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest flex items-center gap-2 
                                    {{ $file->status === 'approved' ? 'bg-green-50 text-green-600' : ($file->status === 'rejected' ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-600') }}">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full {{ $file->status === 'approved' ? 'bg-green-500' : ($file->status === 'rejected' ? 'bg-red-500' : 'bg-amber-500 animate-pulse') }}"></span>
                                        {{ $file->status === 'approved' ? 'Validé' : ($file->status === 'rejected' ? 'Refusé' : 'Vérification') }}
                                    </span>
                                </div>
                            @else
                                <span
                                    class="px-4 py-1.5 rounded-full bg-slate-100 text-slate-400 text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                    Manquant
                                </span>
                            @endif
                        </div>

                        <div class="flex-1">
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-3">{{ $doc['label'] }}
                            </h3>

                            @if ($file && $file->status === 'rejected')
                                <div class="bg-red-50 rounded-2xl p-4 border border-red-100 mb-4">
                                    <div class="flex items-center gap-2 text-red-600 mb-1">
                                        <i data-lucide="info" class="w-3 h-3"></i>
                                        <span class="text-[9px] font-black uppercase tracking-widest">Motif du refus</span>
                                    </div>
                                    <p class="text-xs text-red-700 font-medium italic">"{{ $file->rejection_reason }}"</p>
                                </div>
                            @else
                                <p class="text-slate-400 text-sm leading-relaxed mb-6">{{ $doc['desc'] }}</p>
                            @endif
                        </div>

                        <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                            @if ($file)
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                    class="flex items-center gap-2 text-slate-400 hover:text-slate-900 font-bold text-xs uppercase tracking-widest transition-colors">
                                    <i data-lucide="eye" class="w-4 h-4"></i> Aperçu
                                </a>
                                <button onclick="document.getElementById('openUploadModal').click()"
                                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-[#ff3c00] hover:text-white transition-all shadow-sm">
                                    <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                                </button>
                            @else
                                <button onclick="document.getElementById('openUploadModal').click()"
                                    class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-[#ff3c00] transition-all shadow-lg hover:shadow-[#ff3c00]/20">
                                    Transférer le document
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{-- Vehicle Card - Enhanced Design --}}
                @php $vehicle = auth()->user()->vehicle; @endphp
                <div
                    class="group relative bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:border-slate-200 transition-all duration-500 flex flex-col min-h-[380px] overflow-hidden">
                    <!-- Decorative background -->
                    <div
                        class="absolute -right-12 -top-12 w-48 h-48 bg-slate-50 rounded-full scale-0 group-hover:scale-100 transition-transform duration-700 ease-out z-0">
                    </div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-8">
                            <div
                                class="w-16 h-16 rounded-2xl bg-slate-900 flex items-center justify-center text-white shadow-lg shadow-slate-200 transition-transform group-hover:rotate-12 duration-500">
                                <i data-lucide="car" class="w-8 h-8"></i>
                            </div>
                            @if ($vehicle)
                                <span
                                    class="px-4 py-1.5 rounded-full bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest">Actif</span>
                            @else
                                <span
                                    class="px-4 py-1.5 rounded-full bg-amber-100 text-amber-700 text-[10px] font-black uppercase tracking-widest">À
                                    renseigner</span>
                            @endif
                        </div>

                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-2">Mon Véhicule</h3>

                        @if ($vehicle)
                            <div class="space-y-5 mt-6">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Modèle
                                        & Marque</p>
                                    <p class="text-lg font-bold text-slate-800 leading-tight">{{ $vehicle->marque }}
                                        {{ $vehicle->modele }} <span
                                            class="text-slate-400 font-medium">({{ $vehicle->annee }})</span></p>
                                </div>

                                <div class="grid grid-cols-1 gap-3">
                                    <div
                                        class="bg-slate-50 p-4 rounded-2xl flex items-center justify-between border border-slate-100">
                                        <div>
                                            <p class="text-[9px] font-black text-slate-400 uppercase mb-0.5">Immatriculation
                                            </p>
                                            <p class="text-sm font-black text-slate-800 uppercase tracking-wider">
                                                {{ $vehicle->immatriculation ?? 'AA-123-BB' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[9px] font-black text-slate-400 uppercase mb-0.5">Capacité</p>
                                            <p class="text-sm font-black text-slate-800">{{ $vehicle->places }} places</p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center gap-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50/50 p-2 rounded-xl border border-dashed border-slate-200 justify-around">
                                    <span class="flex items-center gap-1.5"><i data-lucide="fuel"
                                            class="w-3 h-3 text-[#ff3c00]"></i> {{ $vehicle->type }}</span>
                                    <span class="flex items-center gap-1.5"><i data-lucide="palette"
                                            class="w-3 h-3 text-[#ff3c00]"></i> {{ $vehicle->couleur }}</span>
                                </div>
                            </div>
                        @else
                            <p class="text-slate-400 text-sm leading-relaxed mt-4">Aucun véhicule n'est associé à votre
                                compte. Configurez-le pour commencer à recevoir des courses.</p>
                        @endif
                    </div>

                    <div class="relative z-10 mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                        <a href="{{ route('vehicle.edit') }}"
                            class="text-slate-400 hover:text-slate-900 font-bold text-xs uppercase tracking-widest transition-colors flex items-center gap-2">
                            <i data-lucide="settings-2" class="w-4 h-4"></i> Gérer
                        </a>
                        <a href="{{ route('vehicle.edit') }}"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-900 text-white hover:bg-[#ff3c00] transition-all shadow-md">
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                {{-- Support Card --}}
                <div
                    class="group md:col-span-2 lg:col-span-3 bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2.5rem] p-10 text-white relative overflow-hidden flex flex-col md:flex-row items-center justify-between shadow-2xl shadow-slate-200">
                    <div class="absolute right-0 top-0 w-1/2 h-full bg-white opacity-[0.02] -skew-x-12 translate-x-1/2">
                    </div>
                    <div class="relative z-10 mb-8 md:mb-0 text-center md:text-left">
                        <div
                            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/10 text-[10px] font-black uppercase tracking-[0.2em] mb-6">
                            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                            Support disponible 24/7
                        </div>
                        <h4 class="text-3xl font-black tracking-tighter mb-4">Un problème avec vos documents ?</h4>
                        <p class="text-slate-300 text-sm max-w-md mx-auto md:mx-0 leading-relaxed">Nos équipes analysent vos
                            pièces justificatives sous un délai maximum de 48h ouvrées. En cas de rejet, vérifiez bien la
                            lisibilité de vos fichiers.</p>
                    </div>

                    <div class="relative z-10 flex flex-col sm:flex-row items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="w-full sm:w-auto px-8 py-5 bg-white text-slate-900 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-[#ff3c00] hover:text-white transition-all duration-300 text-center">
                            Contacter l'assistance
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Modal - Simplified and Refined -->
        <div id="uploadModal" class="fixed inset-0 z-[100] hidden">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div
                    class="bg-white w-full max-w-xl rounded-[3rem] overflow-hidden shadow-2xl transform transition-all animate-in zoom-in duration-300">
                    <div class="p-8 sm:p-12">
                        <div class="flex justify-between items-center mb-10">
                            <div>
                                <h3 class="text-3xl font-black text-slate-900 tracking-tighter">Mise à jour</h3>
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Sécurisé &
                                    Chiffré</p>
                            </div>
                            <button id="closeUploadModal"
                                class="w-12 h-12 flex items-center justify-center bg-slate-50 rounded-2xl hover:bg-red-50 hover:text-red-500 transition-all">
                                <i data-lucide="x" class="w-6 h-6"></i>
                            </button>
                        </div>

                        <form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="document_type" value="identity_card" class="peer hidden"
                                        required>
                                    <div
                                        class="p-5 border-2 border-slate-100 rounded-[2rem] peer-checked:border-[#ff3c00] peer-checked:bg-orange-50/30 transition-all flex flex-col items-center gap-3">
                                        <i data-lucide="contact-2"
                                            class="w-6 h-6 text-slate-300 peer-checked:text-[#ff3c00]"></i>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest text-slate-600">Identité</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="document_type" value="vtc_card" class="peer hidden">
                                    <div
                                        class="p-5 border-2 border-slate-100 rounded-[2rem] peer-checked:border-[#ff3c00] peer-checked:bg-orange-50/30 transition-all flex flex-col items-center gap-3">
                                        <i data-lucide="award"
                                            class="w-6 h-6 text-slate-300 peer-checked:text-[#ff3c00]"></i>
                                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">Carte
                                            VTC</span>
                                    </div>
                                </label>
                            </div>

                            <div id="drop-area" class="relative">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-slate-200 rounded-[2.5rem] bg-slate-50 hover:bg-white hover:border-[#ff3c00] transition-all cursor-pointer group">
                                    <div
                                        class="w-20 h-20 bg-white rounded-[2rem] shadow-sm flex items-center justify-center mb-4 transition-transform group-hover:scale-110 duration-500">
                                        <i data-lucide="upload-cloud" class="w-8 h-8 text-[#ff3c00]"></i>
                                    </div>
                                    <p class="text-sm font-black uppercase tracking-tight text-slate-900">Importer le
                                        fichier</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">PDF,
                                        JPEG ou PNG • Max 5Mo</p>
                                    <input type="file" name="file" id="file-input" class="hidden" required />
                                </label>

                                <div id="file-preview"
                                    class="hidden absolute inset-0 bg-white rounded-[2.5rem] flex flex-col items-center justify-center border-2 border-[#ff3c00] p-6 animate-in fade-in zoom-in">
                                    <div
                                        class="w-20 h-20 bg-green-50 rounded-[2rem] flex items-center justify-center mb-4 text-green-500">
                                        <i data-lucide="file-check-2" class="w-10 h-10"></i>
                                    </div>
                                    <p id="file-name" class="text-sm font-black text-slate-800 truncate max-w-full px-4">
                                    </p>
                                    <button type="button" onclick="resetFile()"
                                        class="mt-4 text-[10px] font-black uppercase tracking-widest text-red-500 hover:text-red-700">Supprimer</button>
                                </div>
                            </div>

                            <button
                                class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-black uppercase tracking-[0.2em] text-[10px] hover:bg-black transition-all shadow-xl shadow-slate-200">
                                Confirmer la mise à jour
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .animate-fade {
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        input[type="radio"]:checked+div {
            border-color: #ff3c00;
            background-color: rgba(255, 60, 0, 0.05);
        }

        input[type="radio"]:checked+div i {
            color: #ff3c00;
        }
    </style>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        const modal = document.getElementById('uploadModal');
        const openBtn = document.getElementById('openUploadModal');
        const closeBtn = document.getElementById('closeUploadModal');
        const fileInput = document.getElementById('file-input');
        const preview = document.getElementById('file-preview');
        const fileNameDisplay = document.getElementById('file-name');

        const toggleModal = (show) => {
            modal.classList.toggle('hidden', !show);
            document.body.style.overflow = show ? 'hidden' : 'auto';
        };

        const resetFile = () => {
            fileInput.value = '';
            preview.classList.add('hidden');
        };

        openBtn.addEventListener('click', () => toggleModal(true));
        closeBtn.addEventListener('click', () => toggleModal(false));

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                preview.classList.remove('hidden');
                fileNameDisplay.textContent = e.target.files[0].name;
            }
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) toggleModal(false);
        });
    </script>
@endsection
