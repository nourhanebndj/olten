<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Olten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
      integrity="sha512-pVZ0/UomqzLv+Jw5s6pzR5hT+AAUz8Wv44m9X/nr2P81ZPd5f2iRFPZT+5Tb6LhZQ9Q1yH8QDsW0QJ0Gp7aO2g==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style_connecter/style_connected.css') }}">
</head>
<body>
<div class="connected-layout">
    
    {{-- SIDEBAR --}}
    @include('components.sidebar_connected')
    
    <div class="main-content">
        {{-- HEADER --}}
        @include('components.header_connected')
        
        {{-- CONTENU PRINCIPAL --}}
        <main class="dashboard-content">
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
                        
                        <select class="filter-select" id="dateFilter">
                            <option value="week">novembre 6, 2025 - novembre 12, 2025</option>
                            <option value="month">Ce mois</option>
                            <option value="year">Cette année</option>
                            <option value="custom">Période personnalisée</option>
                        </select>
                    </div>
                </div>
                
                <!-- GRAPHIQUE PRINCIPAL -->
                <div class="chart-container">
                    <canvas id="analyticsChart"></canvas>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
    //statistique 

const chartData = {
    labels: ['06/11/2025', '07/11/2025', '08/11/2025', '09/11/2025', '10/11/2025', '11/11/2025', '12/11/2025'],
    datasets: [
        {
            label: 'Série 1',
            data: [1.0, 0.15, 1.0, 1.0, 0, 0, 0],
            borderColor: '#10b981',
            backgroundColor: 'rgba(16, 185, 129, 0.1)',
            tension: 0.4,
            fill: true,
            pointRadius: 5,
            pointHoverRadius: 7
        },
        {
            label: 'Série 2',
            data: [0, 0.25, 1.0, 0.15, 0, 0, 0],
            borderColor: '#8b5cf6',
            backgroundColor: 'rgba(139, 92, 246, 0.1)',
            tension: 0.4,
            fill: true,
            pointRadius: 5,
            pointHoverRadius: 7
        },
        {
            label: 'Série 3',
            data: [0, 0, 0, 0.5, 1.0, 0.15, 0],
            borderColor: '#f59e0b',
            backgroundColor: 'rgba(245, 158, 11, 0.1)',
            tension: 0.4,
            fill: true,
            pointRadius: 5,
            pointHoverRadius: 7
        }
    ]
};

// Configuration du graphique
const config = {
    type: 'line',
    data: chartData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: '#333',
                borderWidth: 1,
                padding: 12,
                displayColors: true,
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y.toFixed(2);
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 1.0,
                ticks: {
                    stepSize: 0.1,
                    color: '#666'
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                ticks: {
                    color: '#666'
                },
                grid: {
                    display: false
                }
            }
        },
        interaction: {
            mode: 'nearest',
            axis: 'x',
            intersect: false
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
    
    if (dateFilter) {
        dateFilter.addEventListener('change', function() {
            updateChartData(this.value, 'date');
        });
    }
}

// Mettre à jour les données du graphique
function updateChartData(filterValue, filterType) {
    console.log(`Filtre ${filterType} changé: ${filterValue}`);
    
    // Simuler un changement de données
    if (filterType === 'date') {
        if (filterValue === 'month') {
            // Générer des données pour le mois
            analyticsChart.data.labels = generateMonthLabels();
            analyticsChart.data.datasets.forEach(dataset => {
                dataset.data = generateRandomData(30);
            });
        } else if (filterValue === 'year') {
            // Générer des données pour l'année
            analyticsChart.data.labels = generateYearLabels();
            analyticsChart.data.datasets.forEach(dataset => {
                dataset.data = generateRandomData(12);
            });
        } else {
            // Réinitialiser aux données de la semaine
            analyticsChart.data.labels = ['06/11/2025', '07/11/2025', '08/11/2025', '09/11/2025', '10/11/2025', '11/11/2025', '12/11/2025'];
            analyticsChart.data.datasets[0].data = [1.0, 0.15, 1.0, 1.0, 0, 0, 0];
            analyticsChart.data.datasets[1].data = [0, 0.25, 1.0, 0.15, 0, 0, 0];
            analyticsChart.data.datasets[2].data = [0, 0, 0, 0.5, 1.0, 0.15, 0];
        }
    }
    
    analyticsChart.update('active');
}

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
</script>
</body>
</html>