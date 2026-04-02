@extends('layouts.connected')

@section('title', 'Modifier l\'itinéraire | ' . config('app.name'))

    <style>
        .tab-btn {
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: #0f172a;
            color: white;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.3);
        }

        .tab-btn:not(.active) {
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .tab-btn:not(.active):hover {
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .tab-panel {
            display: none;
            animation: fadeUp 0.35s ease;
        }

        .tab-panel.active {
            display: block;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-card {
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .step-card.selected {
            border-color: #f97316;
            background: #fff7ed;
        }

        .step-card.selected .step-check {
            background: #f97316;
            border-color: #f97316;
            color: white;
        }

        #edit-map {
            height: 400px;
            border-radius: 24px;
        }

        .price-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .loader-dots span {
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .loader-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }

        .loader-dots span:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1);
            }
        }
    </style>

@section('content')
    <div class="min-h-screen">
        <div class="max-w-5xl mx-auto px-4">

            <!-- Breadcrumb -->
            <div class="mb-8">
                <nav class="flex items-center space-x-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">
                    <a href="{{ route('covoiturage.index') }}" class="hover:text-orange-600 transition-colors">Mes trajets</a>
                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                    <a href="{{ route('covoiturage.edit', $covoiturage->covoiturage_id) }}"
                        class="hover:text-orange-600 transition-colors">Édition trajet</a>
                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-slate-900">Modifier l'itinéraire</span>
                </nav>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                    Modifier l'itinéraire <span class="text-orange-600">#TR-{{ $covoiturage->covoiturage_id }}</span>
                </h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                <!-- Colonne gauche -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">

                        <!-- Tabs -->
                        <div class="flex p-3 gap-2 bg-slate-50/50 border-b border-slate-100">
                            <button onclick="switchTab('locations')" id="tab-locations"
                                class="tab-btn active flex-1 flex items-center justify-center gap-2 py-3 rounded-2xl text-xs font-black uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Départ & Arrivée
                            </button>
                            <button onclick="switchTab('stops')" id="tab-stops"
                                class="tab-btn flex-1 flex items-center justify-center gap-2 py-3 rounded-2xl text-xs font-black uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                Escales
                                <span id="stops-count"
                                    class="hidden ml-1 w-5 h-5 bg-orange-600 text-white rounded-full text-[10px] items-center justify-center">0</span>
                            </button>
                        </div>

                        <!-- Tab 1 : Départ & Arrivée -->
                        <div id="panel-locations" class="tab-panel active p-6 md:p-8">

                            <!-- Départ -->
                            <div class="mb-8">
                                <label
                                    class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-3 block">Point
                                    de départ</label>
                                <div class="relative">
                                    <div
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-orange-600">
                                    </div>
                                    <input type="text" id="input-depart" value="{{ $covoiturage->depart }}"
                                        placeholder="Saisissez une adresse de départ..."
                                        class="w-full pl-10 pr-12 py-4 bg-slate-50/80 rounded-2xl border border-slate-200 focus:border-orange-400 focus:ring-4 focus:ring-orange-100 outline-none text-sm font-bold text-slate-800 transition-all"
                                        autocomplete="off">
                                    <button onclick="clearInput('depart')"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-red-500 transition-colors hidden"
                                        id="clear-depart">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Ligne de connexion -->
                            <div class="flex justify-center my-2">
                                <div class="w-[2px] h-8 bg-slate-200 rounded-full"></div>
                            </div>

                            <!-- Destination -->
                            <div class="mt-8">
                                <label
                                    class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-3 block">Destination</label>
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-slate-900">
                                    </div>
                                    <input type="text" id="input-destination" value="{{ $covoiturage->destination }}"
                                        placeholder="Saisissez une adresse d'arrivée..."
                                        class="w-full pl-10 pr-12 py-4 bg-slate-50/80 rounded-2xl border border-slate-200 focus:border-slate-400 focus:ring-4 focus:ring-slate-100 outline-none text-sm font-bold text-slate-800 transition-all"
                                        autocomplete="off">
                                    <button onclick="clearInput('destination')"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-red-500 transition-colors hidden"
                                        id="clear-destination">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Bouton Valider -->
                            <div class="mt-10">
                                <button onclick="validateLocations()" id="btn-validate-locations"
                                    class="w-full flex items-center justify-center gap-3 py-4 bg-slate-900 hover:bg-orange-600 text-white rounded-2xl transition-all duration-300 shadow-xl shadow-slate-200 hover:shadow-orange-200 hover:-translate-y-0.5 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-slate-900 disabled:hover:translate-y-0 disabled:hover:shadow-slate-200">
                                    <span class="text-[11px] font-black uppercase tracking-[0.2em]">Valider & charger les
                                        escales</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Tab 2 : Escales -->
                        <div id="panel-stops" class="tab-panel p-6 md:p-8">

                            <!-- Loader -->
                            <div id="stops-loader" class="hidden flex flex-col items-center justify-center py-16">
                                <div class="loader-dots flex gap-2 mb-4">
                                    <span class="w-3 h-3 bg-orange-600 rounded-full inline-block"></span>
                                    <span class="w-3 h-3 bg-orange-600 rounded-full inline-block"></span>
                                    <span class="w-3 h-3 bg-orange-600 rounded-full inline-block"></span>
                                </div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Chargement des
                                    escales...</p>
                            </div>

                            <!-- État vide -->
                            <div id="stops-empty" class="flex flex-col items-center justify-center py-16">
                                <div class="w-16 h-16 bg-slate-100 rounded-3xl flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-slate-400">Validez d'abord le départ et la destination</p>
                                <p class="text-xs text-slate-300 mt-1">Les escales seront calculées automatiquement</p>
                            </div>

                            <!-- Liste des escales -->
                            <div id="stops-list" class="hidden">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <p class="text-sm font-black text-slate-900">Escales détectées</p>
                                        <p class="text-xs text-slate-400 mt-0.5">Sélectionnez les escales à conserver et
                                            définissez le prix par segment</p>
                                    </div>
                                    <button onclick="toggleAllStops()" id="btn-toggle-all"
                                        class="text-[10px] font-bold uppercase tracking-widest text-orange-600 hover:text-orange-700 transition-colors">
                                        Tout sélectionner
                                    </button>
                                </div>

                                <!-- En-tête départ -->
                                <div class="flex items-center gap-3 mb-3 px-4 py-2 bg-orange-50 rounded-xl">
                                    <div class="w-3 h-3 rounded-full bg-orange-600 flex-shrink-0"></div>
                                    <span class="text-xs font-black text-orange-700 truncate"
                                        id="label-depart">{{ $covoiturage->depart }}</span>
                                </div>

                                <div id="stops-container" class="space-y-3 mb-3"></div>

                                <!-- En-tête destination -->
                                <div class="flex items-center gap-3 px-4 py-2 bg-slate-100 rounded-xl">
                                    <div class="w-3 h-3 rounded-full bg-slate-900 flex-shrink-0"></div>
                                    <span class="text-xs font-black text-slate-700 truncate"
                                        id="label-destination">{{ $covoiturage->destination }}</span>
                                </div>

                                <!-- Prix dernier segment -->
                                <div class="mt-4 p-4 bg-slate-50 rounded-2xl border border-slate-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs font-bold text-slate-600">Prix du dernier segment</p>
                                            <p class="text-[10px] text-slate-400 mt-0.5" id="last-segment-label">Dernière
                                                escale → Destination</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <input type="number" min="0" step="50" value="0"
                                                id="price-last-segment"
                                                class="price-input w-24 px-3 py-2 text-sm font-bold text-center bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-200 focus:border-orange-400 outline-none">
                                            <span class="text-xs font-bold text-slate-400">DA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Résumé prix -->
                            <div id="price-summary"
                                class="hidden mt-6 p-5 bg-gradient-to-r from-orange-50 to-amber-50 rounded-2xl border border-orange-100">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase tracking-widest text-orange-800">Prix total
                                        du trajet</span>
                                    <span class="text-xl font-black text-orange-600" id="total-price">0 DA</span>
                                </div>
                            </div>

                            <!-- Bouton Sauvegarder -->
                            <div class="mt-8" id="stops-save-wrapper" style="display:none;">
                                <button onclick="saveRoute()" id="btn-save"
                                    class="w-full flex items-center justify-center gap-3 py-4 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl transition-all duration-300 shadow-xl shadow-orange-200 hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-[11px] font-black uppercase tracking-[0.2em]">Sauvegarder les
                                        modifications</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Colonne droite : Carte -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 p-4 sticky top-6">
                        <div id="edit-map" class="w-full"></div>
                        <div id="route-info" class="hidden mt-4 p-4 bg-slate-50 rounded-2xl">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Distance</p>
                                    <p class="text-sm font-black text-slate-900" id="route-distance">--</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Durée</p>
                                    <p class="text-sm font-black text-slate-900" id="route-duration">--</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let map, directionsService, directionsRenderer;
        let departPlace = null; // { name, latlng }
        let destPlace = null; // { name, latlng }
        let departAutocomplete, destinationAutocomplete;
        let intermediateCities = [];
        let selectedStops = new Set();

        // Données existantes
        const existingItineraire = @json($covoiturage->itineraire ?? []);
        const existingSegments = @json($covoiturage->segments ?? []);

        // --- INIT ---
        function initEditMap() {
            map = new google.maps.Map(document.getElementById('edit-map'), {
                center: {
                    lat: 36.75,
                    lng: 3.06
                },
                zoom: 6,
                disableDefaultUI: true,
                zoomControl: true,
                styles: [{
                        featureType: "poi",
                        stylers: [{
                            visibility: "off"
                        }]
                    },
                    {
                        featureType: "transit",
                        stylers: [{
                            visibility: "off"
                        }]
                    }
                ]
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: false,
                polylineOptions: {
                    strokeColor: '#f97316',
                    strokeWeight: 5,
                    strokeOpacity: 0.8
                }
            });

            setupGoogleAutocomplete();

            // Charger le trajet existant sur la carte
            if (existingItineraire.length >= 2) {
                const start = existingItineraire.find(p => p.type === 'start');
                const end = existingItineraire.find(p => p.type === 'end');

                if (start && end) {
                    departPlace = {
                        name: start.name,
                        latlng: start.latlng
                    };
                    destPlace = {
                        name: end.name,
                        latlng: end.latlng
                    };
                    displayRoute();
                }
            }
        }

        // --- GOOGLE AUTOCOMPLETE ---
        function setupGoogleAutocomplete() {
            const inputDepart = document.getElementById('input-depart');
            const inputDest = document.getElementById('input-destination');

            const options = {
                fields: ['formatted_address', 'geometry', 'name']
            };

            departAutocomplete = new google.maps.places.Autocomplete(inputDepart, options);
            destinationAutocomplete = new google.maps.places.Autocomplete(inputDest, options);

            departAutocomplete.addListener('place_changed', () => {
                const place = departAutocomplete.getPlace();
                if (!place.geometry) return;
                departPlace = {
                    name: place.formatted_address || place.name,
                    latlng: [place.geometry.location.lat(), place.geometry.location.lng()]
                };
                inputDepart.value = departPlace.name;
                document.getElementById('clear-depart').classList.remove('hidden');
            });

            destinationAutocomplete.addListener('place_changed', () => {
                const place = destinationAutocomplete.getPlace();
                if (!place.geometry) return;
                destPlace = {
                    name: place.formatted_address || place.name,
                    latlng: [place.geometry.location.lat(), place.geometry.location.lng()]
                };
                inputDest.value = destPlace.name;
                document.getElementById('clear-destination').classList.remove('hidden');
            });

            // Clear buttons
            if (inputDepart.value) document.getElementById('clear-depart').classList.remove('hidden');
            if (inputDest.value) document.getElementById('clear-destination').classList.remove('hidden');
        }

        function clearInput(type) {
            document.getElementById('input-' + type).value = '';
            document.getElementById('clear-' + type).classList.add('hidden');
            if (type === 'depart') departPlace = null;
            else destPlace = null;
        }

        // --- AFFICHER ROUTE ---
        function displayRoute() {
            if (!departPlace || !destPlace) return;

            const origin = {
                lat: departPlace.latlng[0],
                lng: departPlace.latlng[1]
            };
            const destination = {
                lat: destPlace.latlng[0],
                lng: destPlace.latlng[1]
            };

            directionsService.route({
                origin,
                destination,
                travelMode: google.maps.TravelMode.DRIVING
            }, (result, status) => {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                    showRouteInfo(result.routes[0]);
                }
            });
        }

        function showRouteInfo(route) {
            const leg = route.legs[0];
            document.getElementById('route-distance').textContent = leg.distance.text;
            document.getElementById('route-duration').textContent = leg.duration.text;
            document.getElementById('route-info').classList.remove('hidden');
        }

        // --- VALIDER ET CHARGER ESCALES ---
        function validateLocations() {
            // Si pas encore sélectionné via autocomplete, utiliser les valeurs existantes
            if (!departPlace && existingItineraire.length >= 2) {
                const start = existingItineraire.find(p => p.type === 'start');
                if (start) departPlace = {
                    name: start.name,
                    latlng: start.latlng
                };
            }
            if (!destPlace && existingItineraire.length >= 2) {
                const end = existingItineraire.find(p => p.type === 'end');
                if (end) destPlace = {
                    name: end.name,
                    latlng: end.latlng
                };
            }

            if (!departPlace || !destPlace) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Champs requis',
                    text: 'Sélectionnez un départ et une destination depuis les suggestions.'
                });
                return;
            }

            // Mettre à jour les labels
            document.getElementById('label-depart').textContent = departPlace.name;
            document.getElementById('label-destination').textContent = destPlace.name;

            switchTab('stops');
            showStopsLoader();

            const origin = {
                lat: departPlace.latlng[0],
                lng: departPlace.latlng[1]
            };
            const destination = {
                lat: destPlace.latlng[0],
                lng: destPlace.latlng[1]
            };

            directionsService.route({
                origin,
                destination,
                travelMode: google.maps.TravelMode.DRIVING
            }, (result, status) => {
                if (status !== 'OK') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Impossible de calculer l\'itinéraire.'
                    });
                    hideStopsLoader();
                    return;
                }

                directionsRenderer.setDirections(result);
                showRouteInfo(result.routes[0]);
                extractCitiesViaGeocode(result.routes[0]);
            });
        }

        // --- EXTRAIRE LES VILLES VIA GEOCODING INVERSE ---
        function extractCitiesViaGeocode(route) {
            const path = route.overview_path;
            const totalPoints = path.length;
            const numSamples = 8;
            const geocoder = new google.maps.Geocoder();
            const promises = [];
            const seenCities = new Set();

            for (let i = 1; i <= numSamples; i++) {
                const idx = Math.floor((i / (numSamples + 1)) * totalPoints);
                const point = path[idx];

                promises.push(new Promise(resolve => {
                    geocoder.geocode({
                        location: {
                            lat: point.lat(),
                            lng: point.lng()
                        }
                    }, (results, status) => {
                        if (status === 'OK' && results[0]) {
                            const components = results[0].address_components;
                            const city = components.find(c => c.types.includes('locality')) ||
                                components.find(c => c.types.includes('administrative_area_level_2'));

                            if (city && !seenCities.has(city.long_name.toLowerCase())) {
                                seenCities.add(city.long_name.toLowerCase());
                                resolve({
                                    name: city.long_name,
                                    latlng: [point.lat(), point.lng()]
                                });
                            } else {
                                resolve(null);
                            }
                        } else {
                            resolve(null);
                        }
                    });
                }));
            }

            Promise.all(promises).then(results => {
                intermediateCities = results.filter(Boolean);
                renderStops();
            });
        }

        // --- AFFICHER LES ESCALES ---
        function renderStops() {
            hideStopsLoader();
            const container = document.getElementById('stops-container');
            const list = document.getElementById('stops-list');
            const empty = document.getElementById('stops-empty');

            if (intermediateCities.length === 0) {
                list.classList.add('hidden');
                empty.classList.remove('hidden');
                empty.querySelector('p:first-child').textContent = 'Aucune escale détectée sur ce trajet';
                return;
            }

            empty.classList.add('hidden');
            list.classList.remove('hidden');
            document.getElementById('stops-save-wrapper').style.display = 'block';
            document.getElementById('price-summary').classList.remove('hidden');
            container.innerHTML = '';
            selectedStops.clear();

            // Retrouver les escales existantes (waypoints dans itineraire)
            const existingWaypoints = existingItineraire
                .filter(p => p.type === 'waypoint')
                .map(p => p.name.toLowerCase());

            intermediateCities.forEach((city, index) => {
                const isExisting = existingWaypoints.some(w => w.includes(city.name.toLowerCase()) || city.name
                    .toLowerCase().includes(w));

                // Retrouver le prix existant pour cette escale
                let existingPrice = 0;
                if (isExisting && existingSegments[index]) {
                    existingPrice = existingSegments[index]?.price || 0;
                }

                if (isExisting) selectedStops.add(index);

                const card = document.createElement('div');
                card.className =
                    `step-card flex items-center gap-4 p-4 rounded-2xl border border-slate-200 cursor-pointer ${isExisting ? 'selected' : ''}`;
                card.onclick = (e) => {
                    if (e.target.closest('.price-input')) return;
                    toggleStop(index, card);
                };
                card.id = `stop-card-${index}`;

                card.innerHTML = `
                <div class="step-check w-8 h-8 rounded-xl border-2 border-slate-200 flex items-center justify-center flex-shrink-0 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800 truncate">${city.name}</p>
                    <p class="text-[10px] text-slate-400 font-medium">Escale intermédiaire</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <input type="number" min="0" step="50" value="${existingPrice}" placeholder="Prix"
                        class="price-input w-20 px-3 py-2 text-xs font-bold text-center bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-200 focus:border-orange-400 outline-none"
                        oninput="updateTotalPrice()" id="price-${index}">
                    <span class="text-[10px] font-bold text-slate-400">DA</span>
                </div>
            `;
                container.appendChild(card);
            });

            // Prix dernier segment
            const lastSegPrice = existingSegments.length > 0 ?
                (existingSegments[existingSegments.length - 1]?.price || 0) :
                0;
            document.getElementById('price-last-segment').value = lastSegPrice;
            document.getElementById('price-last-segment').oninput = updateTotalPrice;

            updateStopsCount();
            updateLastSegmentLabel();
            updateTotalPrice();
        }

        function toggleStop(index, card) {
            if (selectedStops.has(index)) {
                selectedStops.delete(index);
                card.classList.remove('selected');
            } else {
                selectedStops.add(index);
                card.classList.add('selected');
            }
            updateStopsCount();
            updateLastSegmentLabel();
            updateTotalPrice();
        }

        function toggleAllStops() {
            const allSelected = selectedStops.size === intermediateCities.length;
            intermediateCities.forEach((_, i) => {
                const card = document.getElementById(`stop-card-${i}`);
                if (allSelected) {
                    selectedStops.delete(i);
                    card.classList.remove('selected');
                } else {
                    selectedStops.add(i);
                    card.classList.add('selected');
                }
            });
            updateStopsCount();
            updateLastSegmentLabel();
            updateTotalPrice();
            document.getElementById('btn-toggle-all').textContent = allSelected ? 'Tout sélectionner' :
                'Tout désélectionner';
        }

        function updateStopsCount() {
            const badge = document.getElementById('stops-count');
            if (selectedStops.size > 0) {
                badge.classList.remove('hidden');
                badge.classList.add('flex');
                badge.textContent = selectedStops.size;
            } else {
                badge.classList.add('hidden');
                badge.classList.remove('flex');
            }
        }

        function updateLastSegmentLabel() {
            const sorted = [...selectedStops].sort((a, b) => a - b);
            const lastCity = sorted.length > 0 ? intermediateCities[sorted[sorted.length - 1]].name : departPlace?.name ||
                'Départ';
            const destName = destPlace?.name || document.getElementById('input-destination').value;
            document.getElementById('last-segment-label').textContent = `${lastCity} → ${destName}`;
        }

        function updateTotalPrice() {
            let total = 0;
            selectedStops.forEach(idx => {
                total += parseFloat(document.getElementById(`price-${idx}`).value) || 0;
            });
            total += parseFloat(document.getElementById('price-last-segment').value) || 0;
            document.getElementById('total-price').textContent = total.toLocaleString('fr-FR') + ' DA';
        }

        // --- SAUVEGARDER ---
        function saveRoute() {
            const depart = document.getElementById('input-depart').value;
            const destination = document.getElementById('input-destination').value;

            // ========== Construire itineraire ==========
            // Format: [{name, type, latlng}, ...]
            const itineraire = [];

            // Start
            itineraire.push({
                name: departPlace.name,
                type: 'start',
                latlng: departPlace.latlng
            });

            // Waypoints (seulement les sélectionnés, triés par ordre)
            const sortedStops = [...selectedStops].sort((a, b) => a - b);
            sortedStops.forEach(idx => {
                const city = intermediateCities[idx];
                itineraire.push({
                    name: city.name,
                    type: 'waypoint',
                    latlng: city.latlng
                });
            });

            // End
            itineraire.push({
                name: destPlace.name,
                type: 'end',
                latlng: destPlace.latlng
            });

            // ========== Construire segments ==========
            // Format: [{from, to, price}, ...]
            const segments = [];
            let prevName = departPlace.name;

            sortedStops.forEach(idx => {
                const city = intermediateCities[idx];
                const price = parseFloat(document.getElementById(`price-${idx}`).value) || 0;
                segments.push({
                    from: prevName,
                    to: city.name,
                    price: price
                });
                prevName = city.name;
            });

            // Dernier segment vers destination
            segments.push({
                from: prevName,
                to: destPlace.name,
                price: parseFloat(document.getElementById('price-last-segment').value) || 0
            });

            // ========== Envoyer ==========
            const payload = {
                depart: depart,
                destination: destination,
                itineraire: JSON.stringify(itineraire),
                segments: JSON.stringify(segments),
            };

            fetch(`/covoiturage/{{ $covoiturage->covoiturage_id }}/update-route`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Itinéraire mis à jour !',
                            text: 'Les modifications ont été sauvegardées avec succès.',
                            confirmButtonText: 'Retour au trajet',
                            confirmButtonColor: '#f97316',
                        }).then(() => {
                            window.location.href = `/covoiturage/{{ $covoiturage->covoiturage_id }}/edit`;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: data.message || 'Erreur serveur.'
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Erreur de connexion.'
                    });
                });
        }

        // --- UTILITAIRES ---
        function switchTab(tab) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.getElementById('tab-' + tab).classList.add('active');
            document.getElementById('panel-' + tab).classList.add('active');
        }

        function showStopsLoader() {
            document.getElementById('stops-loader').classList.remove('hidden');
            document.getElementById('stops-empty').classList.add('hidden');
            document.getElementById('stops-list').classList.add('hidden');
        }

        function hideStopsLoader() {
            document.getElementById('stops-loader').classList.add('hidden');
        }
    </script>

@endsection
