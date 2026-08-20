@extends('layouts.main')

@section('title', 'Covoiturage - Olten.fr')

@section('content')

<div class="cv">

    {{-- ============ HERO ============ --}}
    <section class="cv-hero">
        <div class="cv-hero__bg">
            <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?q=80&w=1600&auto=format&fit=crop" alt="Véhicule premium disponible au covoiturage">
        </div>

        <div class="cv-hero__content">
            <span class="cv-eyebrow">
                <span class="cv-eyebrow__bar"></span>
                Axé sur le trajet personnalisé
            </span>
            <h1 class="cv-hero__title">
                Réservez votre<br>
                <span class="cv-accent">trajet.</span>
            </h1>
            <p class="cv-hero__text">
                Profitez d'une expérience de covoiturage unique.
                Confort premium, sécurité totale et flexibilité à la demande.
            </p>
        </div>

        {{-- ============ SEARCH CARD ============ --}}
        <form action="{{ route('covoiturage.search') ?? '#' }}" method="GET" class="cv-search">
            <h2 class="cv-search__title">Rechercher un trajet</h2>

            <div class="cv-search__grid">
                <div class="cv-field">
                    <label for="depart">Lieu de départ</label>
                    <div class="cv-field__input">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M12 22s7-7.58 7-12.5A7 7 0 0 0 5 9.5C5 14.42 12 22 12 22Z" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="9.5" r="2.3" stroke="currentColor" stroke-width="1.6"/></svg>
                        <input type="text" id="depart" name="depart" placeholder="Ex : Paris, France">
                    </div>
                </div>

                <div class="cv-field">
                    <label for="arrivee">Lieu de fin</label>
                    <div class="cv-field__input">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M12 22s7-7.58 7-12.5A7 7 0 0 0 5 9.5C5 14.42 12 22 12 22Z" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="9.5" r="2.3" stroke="currentColor" stroke-width="1.6"/></svg>
                        <input type="text" id="arrivee" name="arrivee" placeholder="Ex : Lyon, France">
                    </div>
                </div>

                <div class="cv-field">
                    <label for="date_depart">Date de départ</label>
                    <div class="cv-field__input">
                        <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M3 10h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        <input type="date" id="date_depart" name="date_depart">
                    </div>
                </div>

                <div class="cv-field">
                    <label for="date_retour">Date de retour</label>
                    <div class="cv-field__input">
                        <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M3 10h18M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        <input type="date" id="date_retour" name="date_retour">
                    </div>
                </div>

                <div class="cv-field cv-field--stepper">
                    <label for="voyageurs">Nombre de personnes</label>
                    <div class="cv-field__input">
                        <input type="number" id="voyageurs" name="voyageurs" value="2" min="1" max="8">
                    </div>
                </div>

                <button type="submit" class="cv-btn cv-btn--primary cv-search__submit">Rechercher</button>
            </div>
        </form>
    </section>

    {{-- ============ DESTINATIONS ============ --}}
    <section class="cv-section cv-destinations">
        <div class="cv-section__head">
            <div>
                <span class="cv-kicker"></span>
                <h2>Destinations disponibles</h2>
            </div>
            <a href="{{ route('covoiturage.index') ?? '#' }}" class="cv-link">Voir tous les trajets</a>
        </div>

        <div class="cv-cards">
            @php
                $trajets = $trajets ?? collect(range(1, 6))->map(fn($i) => [
                    'depart' => 'Paris',
                    'arrivee' => 'Lyon',
                    'prix' => '12,00',
                    'note' => '4.8',
                    'conducteur' => 'Trajet vérifié',
                    'image' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?q=80&w=800&auto=format&fit=crop',
                ]);
            @endphp

            @foreach ($trajets as $trajet)
                <a href="#" class="cv-card">
                    <div class="cv-card__media">
                        <img src="{{ $trajet['image'] }}" alt="Trajet {{ $trajet['depart'] }} vers {{ $trajet['arrivee'] }}">
                        <span class="cv-card__route">{{ $trajet['depart'] }} <em>&rarr;</em> {{ $trajet['arrivee'] }}</span>
                    </div>

                    <div class="cv-card__body">
                        <div class="cv-card__price-row">
                            <div>
                                <span class="cv-card__label">Dès à partir de</span>
                                <span class="cv-card__price">{{ $trajet['prix'] }} €</span>
                            </div>
                            <span class="cv-card__arrow" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>

                        <div class="cv-card__foot">
                            <div class="cv-card__avatars">
                                <span class="cv-avatar" style="background-image:url('https://i.pravatar.cc/48?img=12')"></span>
                                <span class="cv-avatar" style="background-image:url('https://i.pravatar.cc/48?img=32')"></span>
                                <span class="cv-avatar" style="background-image:url('https://i.pravatar.cc/48?img=5')"></span>
                                <span class="cv-card__driver">{{ $trajet['conducteur'] }}</span>
                            </div>
                            <span class="cv-badge">&#9733; {{ $trajet['note'] }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ============ OFFRE CONDUCTEUR ============ --}}
    <section class="cv-section">
        <div class="cv-offer">
            <div class="cv-offer__bg">
                <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=1600&auto=format&fit=crop" alt="Conducteur au volant la nuit">
            </div>
            <div class="cv-offer__content">
                <span class="cv-pill">Offre Conducteur</span>
                <h2 class="cv-offer__title">Récupérez <span class="cv-accent">90&nbsp;€</span> par trajet.</h2>
                <p class="cv-offer__text">
                    Vous avez une voiture ? Faites-la travailler pour vous (et pas l'inverse).
                    Récupérez jusqu'à 90&nbsp;€ en covoiturant sur un trajet de 300&nbsp;km avec 3 passagers.
                </p>
                <a href="{{ route('covoiturage.publier') ?? '#' }}" class="cv-btn cv-btn--light">Publier un trajet</a>
            </div>
        </div>
    </section>

    {{-- ============ NOTRE ENGAGEMENT ============ --}}
    <section class="cv-section cv-engagement">
        <div class="cv-section__head">
            <div>
                <h2>Notre Engagement</h2>
                <span class="cv-underline"></span>
            </div>
        </div>

        <div class="cv-engagement__grid">
            <div class="cv-engage-card">
                <span class="cv-engage-card__icon cv-engage-card__icon--blue">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M4 6h11a3 3 0 0 1 0 6H8a3 3 0 0 0 0 6h11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="4" cy="6" r="1.6" fill="currentColor"/><circle cx="20" cy="18" r="1.6" fill="currentColor"/></svg>
                </span>
                <h3>L'autonomie absolue</h3>
                <p>Libérez-vous des contraintes horaires. Explorez le pays selon vos propres règles grâce à notre écosystème combinant bus, covoiturage et rail.</p>
                <span class="cv-engage-card__foot">Flexibilité illimitée</span>
            </div>

            <div class="cv-engage-card">
                <span class="cv-engage-card__icon cv-engage-card__icon--green">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 2v20M17 6.5c0-1.93-2.24-3.5-5-3.5S7 4.57 7 6.5 9.24 10 12 10s5 1.57 5 3.5-2.24 3.5-5 3.5-5-1.57-5-3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </span>
                <h3>Le luxe de l'épargne</h3>
                <p>Ne choisissez plus entre confort et budget. Accédez à un catalogue de destinations premium au tarif le plus juste du marché, sans frais cachés.</p>
                <span class="cv-engage-card__foot">Meilleurs tarifs garantis</span>
            </div>

            <div class="cv-engage-card">
                <span class="cv-engage-card__icon cv-engage-card__icon--orange">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 3l7 3v6c0 4.4-2.9 7.9-7 9-4.1-1.1-7-4.6-7-9V6l7-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 12.2l2 2 4-4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <h3>Sérénité certifiée</h3>
                <p>Nous sélectionnons rigoureusement nos partenaires et vérifions manuellement chaque profil, identité, avis et véhicule : tout est passé au crible.</p>
                <span class="cv-engage-card__foot">Réseau 100% vérifié</span>
            </div>
        </div>
    </section>

</div>

<style>
    .cv{
        --cv-orange:#FF6A3D;
        --cv-orange-dark:#F4531E;
        --cv-navy:#12172B;
        --cv-ink:#151823;
        --cv-muted:#8B92A0;
        --cv-bg:#F5F6F9;
        --cv-line:#EAECF1;
        --cv-green-bg:#D9F7E4;
        --cv-green-text:#1C9A57;
        --cv-radius:18px;
        background:var(--cv-bg);
        color:var(--cv-ink);
        font-family: 'Poppins', 'Inter', system-ui, -apple-system, sans-serif;
    }
    .cv *{box-sizing:border-box;}
    .cv img{max-width:100%;display:block;}
    .cv a{text-decoration:none;color:inherit;}

    /* ---------- Hero ---------- */
    .cv-hero{position:relative;padding:0 0 96px;}
    .cv-hero__bg{position:relative;height:420px;overflow:hidden;}
    .cv-hero__bg::after{
        content:"";position:absolute;inset:0;
        background:linear-gradient(90deg, rgba(10,12,20,.88) 0%, rgba(10,12,20,.55) 45%, rgba(10,12,20,.15) 100%);
    }
    .cv-hero__bg img{width:100%;height:100%;object-fit:cover;}
    .cv-hero__content{
        position:absolute;top:0;left:0;height:420px;
        display:flex;flex-direction:column;justify-content:center;
        width:100%;max-width:1200px;margin:0 auto;left:0;right:0;
        padding:0 24px;
    }
    .cv-eyebrow{
        display:inline-flex;align-items:center;gap:10px;
        color:var(--cv-orange);font-weight:600;font-size:13px;
        letter-spacing:.02em;margin-bottom:14px;
    }
    .cv-eyebrow__bar{width:26px;height:2px;background:var(--cv-orange);display:inline-block;}
    .cv-hero__title{
        color:#fff;font-size:44px;line-height:1.1;font-weight:700;margin:0 0 16px;
    }
    .cv-accent{color:var(--cv-orange);}
    .cv-hero__text{
        color:rgba(255,255,255,.82);max-width:420px;font-size:15px;line-height:1.6;margin:0;
    }

    /* ---------- Search card ---------- */
    .cv-search{
        position:relative;z-index:2;
        max-width:1200px;margin:-64px auto 0;
        background:#fff;border-radius:var(--cv-radius);
        box-shadow:0 24px 48px rgba(18,23,43,.12);
        padding:28px 28px 24px;
    }
    .cv-search__title{font-size:17px;font-weight:700;margin:0 0 18px;}
    .cv-search__grid{
        display:grid;
        grid-template-columns:repeat(4,1fr) 140px auto;
        gap:16px;align-items:end;
    }
    .cv-field label{
        display:block;font-size:11px;font-weight:700;letter-spacing:.04em;
        color:var(--cv-muted);text-transform:uppercase;margin-bottom:8px;
    }
    .cv-field__input{
        display:flex;align-items:center;gap:8px;
        border:1px solid var(--cv-line);border-radius:10px;
        padding:10px 12px;background:#fff;
    }
    .cv-field__input svg{width:17px;height:17px;color:var(--cv-orange);flex:none;}
    .cv-field__input input{
        border:0;outline:0;width:100%;font-size:14px;color:var(--cv-ink);font-family:inherit;background:transparent;
    }
    .cv-field__input input::placeholder{color:#B7BCC6;}
    .cv-search__submit{grid-column:auto;height:44px;white-space:nowrap;padding:0 26px;}

    /* ---------- Buttons ---------- */
    .cv-btn{
        display:inline-flex;align-items:center;justify-content:center;
        border-radius:10px;font-weight:600;font-size:14px;
        border:0;cursor:pointer;transition:transform .15s ease, box-shadow .15s ease;
    }
    .cv-btn--primary{
        background:linear-gradient(180deg,var(--cv-orange),var(--cv-orange-dark));
        color:#fff;box-shadow:0 10px 20px rgba(255,106,61,.35);
    }
    .cv-btn--primary:hover{transform:translateY(-1px);}
    .cv-btn--light{
        background:#fff;color:var(--cv-navy);padding:13px 26px;
    }
    .cv-btn--light:hover{transform:translateY(-1px);}

    /* ---------- Sections generic ---------- */
    .cv-section{max-width:1200px;margin:0 auto;padding:56px 24px;}
    .cv-section__head{
        display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:26px;
    }
    .cv-section__head h2{font-size:24px;font-weight:700;margin:0 0 8px;}
    .cv-underline{display:block;width:44px;height:3px;background:var(--cv-orange);border-radius:2px;}
    .cv-link{color:var(--cv-orange);font-weight:600;font-size:14px;}
    .cv-link:hover{text-decoration:underline;}

    /* ---------- Destination cards ---------- */
    .cv-cards{
        display:grid;grid-template-columns:repeat(3,1fr);gap:22px;
    }
    .cv-card{
        background:#fff;border-radius:16px;overflow:hidden;
        box-shadow:0 10px 24px rgba(18,23,43,.06);
        border:1px solid var(--cv-line);
        transition:transform .18s ease, box-shadow .18s ease;
    }
    .cv-card:hover{transform:translateY(-4px);box-shadow:0 18px 32px rgba(18,23,43,.12);}
    .cv-card__media{position:relative;height:150px;}
    .cv-card__media img{width:100%;height:100%;object-fit:cover;}
    .cv-card__media::after{
        content:"";position:absolute;inset:0;
        background:linear-gradient(180deg,rgba(0,0,0,0) 45%,rgba(0,0,0,.65) 100%);
    }
    .cv-card__route{
        position:absolute;left:14px;bottom:12px;z-index:1;color:#fff;font-weight:600;font-size:14px;
    }
    .cv-card__route em{color:var(--cv-orange);font-style:normal;margin:0 2px;}
    .cv-card__body{padding:16px 16px 14px;}
    .cv-card__price-row{display:flex;align-items:center;justify-content:space-between;}
    .cv-card__label{display:block;font-size:11px;color:var(--cv-muted);margin-bottom:2px;}
    .cv-card__price{font-size:18px;font-weight:700;}
    .cv-card__arrow{
        width:32px;height:32px;border-radius:9px;background:var(--cv-navy);
        display:flex;align-items:center;justify-content:center;color:#fff;flex:none;
    }
    .cv-card__foot{
        display:flex;align-items:center;justify-content:space-between;
        margin-top:14px;padding-top:14px;border-top:1px solid var(--cv-line);
    }
    .cv-card__avatars{display:flex;align-items:center;}
    .cv-avatar{
        width:26px;height:26px;border-radius:50%;background-size:cover;background-position:center;
        border:2px solid #fff;margin-left:-8px;
    }
    .cv-avatar:first-child{margin-left:0;}
    .cv-card__driver{margin-left:8px;font-size:12px;color:var(--cv-muted);}
    .cv-badge{
        background:var(--cv-green-bg);color:var(--cv-green-text);
        font-size:12px;font-weight:700;padding:4px 10px;border-radius:20px;
    }

    /* ---------- Offer banner ---------- */
    .cv-offer{
        position:relative;border-radius:24px;overflow:hidden;min-height:300px;
        display:flex;align-items:center;
    }
    .cv-offer__bg{position:absolute;inset:0;}
    .cv-offer__bg img{width:100%;height:100%;object-fit:cover;}
    .cv-offer__bg::after{
        content:"";position:absolute;inset:0;
        background:linear-gradient(90deg, rgba(8,10,18,.92) 0%, rgba(8,10,18,.7) 55%, rgba(8,10,18,.2) 100%);
    }
    .cv-offer__content{position:relative;z-index:1;padding:48px;max-width:560px;}
    .cv-pill{
        display:inline-block;background:var(--cv-orange);color:#fff;
        font-size:12px;font-weight:700;padding:7px 16px;border-radius:20px;margin-bottom:18px;
    }
    .cv-offer__title{color:#fff;font-size:30px;font-weight:700;line-height:1.2;margin:0 0 14px;}
    .cv-offer__text{color:rgba(255,255,255,.8);font-size:14px;line-height:1.7;margin:0 0 24px;}

    /* ---------- Engagement ---------- */
    .cv-engagement__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;}
    .cv-engage-card{
        background:#fff;border:1px solid var(--cv-line);border-radius:18px;padding:26px;
    }
    .cv-engage-card__icon{
        width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;
    }
    .cv-engage-card__icon svg{width:22px;height:22px;}
    .cv-engage-card__icon--blue{background:#E4E9FF;color:#4A5CE0;}
    .cv-engage-card__icon--green{background:#DBF6E6;color:#1DA355;}
    .cv-engage-card__icon--orange{background:#FDE7D8;color:var(--cv-orange);}
    .cv-engage-card h3{font-size:16px;font-weight:700;margin:0 0 10px;}
    .cv-engage-card p{font-size:13.5px;color:var(--cv-muted);line-height:1.7;margin:0 0 16px;}
    .cv-engage-card__foot{
        display:block;font-size:12px;color:var(--cv-ink);font-weight:600;
        padding-top:14px;border-top:1px solid var(--cv-line);
    }

    /* ---------- Responsive ---------- */
    @media (max-width:1024px){
        .cv-search__grid{grid-template-columns:repeat(2,1fr);}
        .cv-search__submit{grid-column:span 2;}
        .cv-cards{grid-template-columns:repeat(2,1fr);}
        .cv-engagement__grid{grid-template-columns:1fr;}
    }
    @media (max-width:640px){
        .cv-hero__bg{height:480px;}
        .cv-hero__content{height:480px;padding:0 18px;}
        .cv-hero__title{font-size:32px;}
        .cv-search{margin-top:-40px;padding:22px 18px;border-radius:16px;}
        .cv-search__grid{grid-template-columns:1fr;}
        .cv-search__submit{grid-column:1;}
        .cv-cards{grid-template-columns:1fr;}
        .cv-section{padding:40px 18px;}
        .cv-section__head{flex-direction:column;align-items:flex-start;gap:10px;}
        .cv-offer__content{padding:30px 24px;}
        .cv-offer__title{font-size:24px;}
    }
</style>

@endsection