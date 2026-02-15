
@extends('layouts.connected')
@section('title', 'Statistiques')

@section('content')  
    <div class="breadcrumb">
        <a href="#">Accueil</a>
        <span>></span>
        <span>Statistiques</span>
    </div>
    
    <h1 class="page-title">Statistiques</h1>
    
    <!-- SECTION ANALYTIQUES -->
    <div class="stats-container">
        <div class="section-header">
            <h2 class="section-title">Analytique des annonces</h2>
            <div class="filters">
                <select class="filter-select" id="visitFilter">
                    <option value="all">Toutes les visites</option>
                    <option value="unique">Visites uniques</option>
                    <option value="repeat">Visites répétées</option>
                </select>
                
                <select class="filter-select" id="annonceFilter">
                    <option value="all">Toutes les annonces</option>
                    <option value="active">Annonces actives</option>
                    <option value="inactive">Annonces inactives</option>
                </select>
                @php
                    use Carbon\Carbon;

                    Carbon::setLocale('fr');

                    $startOfWeek = Carbon::now()->subDays(6);
                    $endOfWeek   = Carbon::now();

                    $weekLabel = $startOfWeek->translatedFormat('d F Y')
                        . ' - ' .
                        $endOfWeek->translatedFormat('d F Y');
                @endphp
                <select class="filter-select" id="dateFilter">
                    <option value="week">{{ $weekLabel }}</option>
                    <option value="month">Ce mois</option>
                    <option value="year">Cette année</option>
                    <option value="custom">Période personnalisée</option>
                </select>

                <div id="customDateInputs" style="display:none; margin-top:10px;">
                    <input type="date" id="customStart">
                    <input type="date" id="customEnd">
                    <button id="applyCustomDate" class="btn-save">Appliquer</button>
                </div>
            </div>
        </div>
        
        <!-- GRAPHIQUE PRINCIPAL -->
        <div class="chart-container">
            <canvas id="analyticsChart"></canvas>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        //statistique 

        const chartData = {
            labels: [],
            datasets: [
                {
                    label: 'Nombre d’annonces',
                    data: [],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.15)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Nombre de vues',
                    data: [],
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.15)',
                    tension: 0.4,
                    fill: true
                }
            ]
        };

        const config = {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Initialiser le graphique
        let analyticsChart;

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('analyticsChart');
            if (ctx) {
                analyticsChart = new Chart(ctx, config);
            }
            
            // Gestionnaires d'événements pour les filtres
            initializeFilters();
        });

        // Initialiser les filtres
        function initializeFilters() {
            const visitFilter = document.getElementById('visitFilter');
            const annonceFilter = document.getElementById('annonceFilter');
            const dateFilter = document.getElementById('dateFilter');
            const customInputs = document.getElementById('customDateInputs');
            const applyCustomBtn = document.getElementById('applyCustomDate');

            dateFilter.addEventListener('change', function () {
                if (this.value === 'custom') {
                    customInputs.style.display = 'block';
                } else {
                    customInputs.style.display = 'none';
                    updateChartData(this.value);
                }
            });

            applyCustomBtn.addEventListener('click', function () {
                const start = document.getElementById('customStart').value;
                const end = document.getElementById('customEnd').value;
                if (start && end) {
                    updateChartData('custom', start, end);
                }
            });

            if (visitFilter) {
                visitFilter.addEventListener('change', function() {
                    updateChartData(this.value, 'visit');
                });
            }
            
            if (annonceFilter) {
                annonceFilter.addEventListener('change', function() {
                    updateChartData(this.value, 'annonce');
                });
            }
        }

        // Mettre à jour les données du graphique
        function updateChartData() {
            const visitFilter = document.getElementById('visitFilter').value;
            const annonceFilter = document.getElementById('annonceFilter').value;
            const dateFilter = document.getElementById('dateFilter').value;

            let start = '';
            let end = '';
            if (dateFilter === 'custom') {
                start = document.getElementById('customStart').value;
                end = document.getElementById('customEnd').value;
            }

            let url = `/stats/ads?period=${dateFilter}&visitFilter=${visitFilter}&annonceFilter=${annonceFilter}`;
            if (start && end) {
                url += `&start=${start}&end=${end}`;
            }

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    analyticsChart.data.labels = data.labels;
                    analyticsChart.data.datasets[0].data = data.datasets[0].data; // annonces
                    analyticsChart.data.datasets[1].data = data.datasets[1].data; // vues
                    analyticsChart.update();
                })
                .catch(err => console.error(err));
        }

        // Gestionnaires d'événements pour les filtres
        document.getElementById('visitFilter').addEventListener('change', updateChartData);
        document.getElementById('annonceFilter').addEventListener('change', updateChartData);
        document.getElementById('dateFilter').addEventListener('change', function () {
            if (this.value === 'custom') {
                document.getElementById('customDateInputs').style.display = 'block';
            } else {
                document.getElementById('customDateInputs').style.display = 'none';
                updateChartData();
            }
        });

        document.getElementById('applyCustomDate').addEventListener('click', updateChartData);


        // Générer des labels pour le mois
        function generateMonthLabels() {
            const labels = [];
            for (let i = 1; i <= 30; i++) {
                labels.push(`${i}/11/2025`);
            }
            return labels;
        }

        // Générer des labels pour l'année
        function generateYearLabels() {
            return ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
        }

        // Générer des données aléatoires
        function generateRandomData(count) {
            return Array.from({ length: count }, () => Math.random());
        }

        // Animation des cartes statistiques au défilement
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '0';
                    entry.target.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        entry.target.style.transition = 'all 0.6s ease';
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 100);
                    
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observer les cartes statistiques
        document.addEventListener('DOMContentLoaded', function() {
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => observer.observe(card));
        });
        document.addEventListener('DOMContentLoaded', function () {
            updateChartData('week');
        });

    </script>
@endsection
