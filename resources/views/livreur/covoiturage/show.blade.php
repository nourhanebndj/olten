@extends('layouts.connected')
@section('title', 'Détails du Trajet | ' . config('app.name'))

@section('content')
    <div class="min-h-screen bg-[#F8F9FA] pb-12">
        <!-- Header Section -->
        <div class="">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <nav class="flex mb-2" aria-label="Breadcrumb">
                            <ol
                                class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-medium text-gray-400 uppercase tracking-wider">
                                <li>Chauffeur VTC</li>
                                <li><i class="fas fa-chevron-right mx-2 text-[10px]"></i> Mes trajets</li>
                            </ol>
                        </nav>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                            Trajet <span class="text-[#FF4500]">#TR-{{ $trajet->covoiturage_id }}</span>
                        </h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <span
                            class="px-4 py-1.5 rounded-full text-sm font-semibold 
                        {{ $trajet->statut === 'active' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-gray-50 text-gray-600 border border-gray-100' }}">
                            ● {{ ucfirst($trajet->statut) }}
                        </span>
                  
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Colonne Gauche: Détails et Segments -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Card: Itinéraire Visuel -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-8">
                            <div class="flex items-start justify-between mb-8">
                                <div class="flex-1">
                                    <div class="relative pl-8 border-l-2 border-dashed border-gray-200 space-y-12">
                                        <!-- Départ -->
                                        <div class="relative">
                                            <div
                                                class="absolute -left-[41px] top-0 w-4 h-4 rounded-full bg-white border-4 border-[#FF4500] z-10">
                                            </div>
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Point
                                                de départ</p>
                                            <p class="text-xl font-semibold text-gray-900">{{ $trajet->depart }}</p>
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ $trajet->date_depart->format('d M Y') }} à
                                                {{ $trajet->heure_depart ?? $trajet->date_depart->format('H:i') }}
                                            </p>
                                        </div>
                                        <!-- Destination -->
                                        <div class="relative">
                                            <div
                                                class="absolute -left-[41px] top-0 w-4 h-4 rounded-full bg-[#FF4500] border-4 border-orange-100 z-10">
                                            </div>
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">
                                                Destination</p>
                                            <p class="text-xl font-semibold text-gray-900">{{ $trajet->destination }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right hidden sm:block">
                                    <div class="bg-orange-50 p-4 rounded-2xl inline-block">
                                        <p class="text-xs font-bold text-[#FF4500] uppercase mb-1">Prix par place</p>
                                        <p class="text-3xl font-black text-[#FF4500]">
                                            {{ number_format($trajet->prix_place, 2) }}€</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Segments d'escales -->
                            @if ($segments && count($segments))
                                <div class="pt-6 border-t border-gray-50">
                                    <h3 class="text-sm font-bold text-gray-900 mb-4 flex items-center">
                                        <i class="fas fa-map-signs mr-2 text-gray-400"></i> Escales prévues
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach ($segments as $segment)
                                            <div class="flex items-center p-3 bg-gray-50 rounded-xl border border-gray-100">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-sm mr-3">
                                                    <i class="fas fa-stop text-[10px] text-orange-400"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs font-medium text-gray-500 italic">
                                                        {{ $segment['from'] ?? 'Escale' }} →
                                                        {{ $segment['to'] ?? 'Escale' }}
                                                    </p>
                                                    <p class="text-sm font-bold text-gray-800">
                                                        {{ number_format($segment['price'] ?? 0, 2) }}€</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card: Map -->
                    @if ($route && isset($route['geometry']['coordinates']) && count($route['geometry']['coordinates']))
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-4 border-b border-gray-50 flex justify-between items-center">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Aperçu du parcours</h3>
                                <span class="text-xs text-gray-400"><i class="fas fa-expand-alt mr-1"></i> Plein
                                    écran</span>
                            </div>
                            <div id="map" class="h-[450px] w-full bg-gray-100"></div>
                        </div>
                    @endif
                </div>

                <!-- Colonne Droite: Résumé & Actions -->
                <div class="space-y-6">

                    <!-- Détails Techniques -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-6">Informations véhicule</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 text-sm">Places disponibles</span>
                                <span
                                    class="bg-gray-900 text-white text-xs font-bold px-2.5 py-1 rounded-lg">{{ $trajet->nb_places }}
                                    places</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 text-sm">Type de trajet</span>
                                <span
                                    class="text-sm font-semibold">{{ $trajet->retour ? 'Aller-Retour' : 'Aller simple' }}</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-gray-500 text-sm">Mode passager</span>
                                <div class="text-right text-sm font-semibold">
                                    @if ($trajet->passenger_mode === 'mixed')
                                        <span class="text-blue-600"><i class="fas fa-users mr-1"></i> Mixte</span>
                                    @elseif($trajet->passenger_mode === 'womenOnly')
                                        <span class="text-pink-500"><i class="fas fa-venus mr-1"></i> Femmes
                                            uniquement</span>
                                    @elseif($trajet->passenger_mode === 'maxBackSeats')
                                        <span class="text-gray-700"><i class="fas fa-chair mr-1"></i> Confort (Max 2
                                            AR)</span>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-50 flex justify-between items-center">
                                <span class="text-gray-900 font-bold">Revenu Total Estimé</span>
                                <span
                                    class="text-xl font-black text-gray-900">{{ number_format($trajet->prix_total_affiche, 2) }}€</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Rapides -->
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            class="flex flex-col items-center justify-center p-4 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-[#FF4500] hover:text-[#FF4500] transition-all group">
                            <i class="fas fa-edit mb-2 text-gray-400 group-hover:text-[#FF4500]"></i>
                            <span class="text-xs font-bold uppercase">Modifier</span>
                        </button>
                        <button
                            class="flex flex-col items-center justify-center p-4 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-red-500 hover:text-red-500 transition-all group">
                            <i class="fas fa-trash-alt mb-2 text-gray-400 group-hover:text-red-500"></i>
                            <span class="text-xs font-bold uppercase">Annuler</span>
                        </button>
                    </div>

                    <!-- Tip Card -->
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 text-white shadow-lg">
                        <i class="fas fa-lightbulb text-yellow-400 mb-3 text-xl"></i>
                        <p class="text-sm font-medium leading-relaxed">Pensez à vérifier l'état de votre véhicule avant
                            chaque trajet pour garantir la meilleure expérience à vos passagers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($route && isset($route['geometry']['coordinates']) && count($route['geometry']['coordinates']))
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />

        <script>
            mapboxgl.accessToken = 'YOUR_MAPBOX_TOKEN';

            const coords = {!! json_encode(array_values($route['geometry']['coordinates'])) !!};
            const validCoords = coords.filter(c => Array.isArray(c) && c.length === 2);

            if (validCoords.length) {
                const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/light-v11',
                    center: validCoords[0],
                    zoom: 5,
                    padding: 20
                });

                map.on('load', () => {
                    map.addSource('route', {
                        type: 'geojson',
                        data: {
                            type: 'Feature',
                            geometry: {
                                type: 'LineString',
                                coordinates: validCoords
                            }
                        }
                    });

                    map.addLayer({
                        id: 'route-line',
                        type: 'line',
                        source: 'route',
                        layout: {
                            'line-join': 'round',
                            'line-cap': 'round'
                        },
                        paint: {
                            'line-color': '#FF4500',
                            'line-width': 5,
                            'line-opacity': 0.8
                        }
                    });

                    const start = validCoords[0];
                    const end = validCoords[validCoords.length - 1];

                    const elStart = document.createElement('div');
                    elStart.className = 'w-4 h-4 rounded-full bg-white border-4 border-green-500 shadow-sm';
                    new mapboxgl.Marker(elStart).setLngLat(start).addTo(map);

                    const elEnd = document.createElement('div');
                    elEnd.className = 'w-4 h-4 rounded-full bg-white border-4 border-[#FF4500] shadow-sm';
                    new mapboxgl.Marker(elEnd).setLngLat(end).addTo(map);

                    const bounds = validCoords.reduce((b, c) => b.extend(c), new mapboxgl.LngLatBounds(start, start));
                    map.fitBounds(bounds, {
                        padding: 80,
                        duration: 2000
                    });
                });
            }
        </script>
    @endif
@endsection
