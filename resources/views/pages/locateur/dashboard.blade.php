@extends('layouts.connected')
@section('title', 'Tableau de bord')

@section('content')

    <div class="breadcrumb">
        <a href="#">Accueil</a>
        <span>></span>
        <span>Tableau de bord</span>
    </div>

    <h1>Bonjour {{ Auth::user()->name }} 🖐</h1>

    {{-- STATS --}}
    <div class="stats-cards">
        <div class="stat-card green">
            <i class="fa-solid fa-shopping-bag stat-icon"></i>
            <div class="stat-number">18</div>
            <div class="stat-label">Annonces actives</div>
        </div>

        <div class="stat-card blue">
            <i class="fa-solid fa-chart-line stat-icon"></i>
            <div class="stat-number">706</div>
            <div class="stat-label">Total des vues</div>
        </div>

        <div class="stat-card yellow">
            <i class="fa-solid fa-comment-dots stat-icon"></i>
            <div class="stat-number">1</div>
            <div class="stat-label">Total des avis</div>
        </div>

        <div class="stat-card pink">
            <i class="fa-solid fa-heart stat-icon"></i>
            <div class="stat-number">0</div>
            <div class="stat-label">Fois ajoutées aux favoris</div>
        </div>
    </div>

    {{-- ACTIVITES --}}
    <div class="content-grid">

        <section class="content-section">
            <div class="section-header">
                <h2 class="section-title">Activités récentes</h2>
                <button class="btn-clear">Tout effacer</button>
            </div>

            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">
                            Annonce <span class="activity-highlight">livre js</span> a été mise à jour
                        </div>
                        <div class="activity-time">5 jours auparavant</div>
                    </div>
                    <i class="fa-solid fa-times activity-delete"></i>
                </li>
                <li class="activity-item">
                    <div class="activity-icon"><i class="fa-solid fa-bell"></i></div>
                    <div class="activity-content">
                        <div class="activity-text">
                            Annonce <span class="activity-highlight">Clio bleu</span> a été supprimée
                        </div>
                        <div class="activity-time">6 jours auparavant</div>
                    </div>
                    <i class="fa-solid fa-times activity-delete"></i>
                </li>
            </ul>

            <div class="pagination">
                <button class="active">1</button>
                <button>2</button>
                <button>3</button>
                <button>4</button>
            </div>
        </section>

        {{-- GRAPHIQUES --}}
        <section class="content-section">
            <div class="chart-header">
                <h2 class="chart-title">Vos vues d'annonces</h2>
                <div class="chart-date">Novembre 3, 2025 - Novembre 9, 2025</div>
            </div>

            <div class="chart-container">
                <svg width="100%" height="100%" viewBox="0 0 600 250">
                    <line x1="0" y1="250" x2="600" y2="250" stroke="#e5e5e5"/>

                    <polyline points="0,200 100,150 200,100 300,120 400,180 500,220 600,250"
                              fill="none" stroke="#3b82f6" stroke-width="2"/>
                    <polyline points="0,250 100,220 200,180 300,160 400,200 500,230 600,250"
                              fill="none" stroke="#10b981" stroke-width="2"/>
                    <polyline points="0,250 100,240 200,220 300,180 400,220 500,240 600,250"
                              fill="none" stroke="#f59e0b" stroke-width="2"/>
                </svg>
            </div>

            <button class="btn-more-stats">Vérifier plus de statistiques</button>
        </section>

    </div>

@endsection
