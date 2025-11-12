-- ========================================================
-- 1. TABLE UTILISATEURS
-- ========================================================
CREATE TABLE users (
    user_id BIGSERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    role VARCHAR(20) CHECK (role IN ('particulier','livreur','conducteur','admin')) DEFAULT 'particulier',
    solde_points INT DEFAULT 0,
    statut_compte VARCHAR(20) CHECK (statut_compte IN ('actif','suspendu','banni')) DEFAULT 'actif',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    verifie BOOLEAN DEFAULT FALSE
);

-- ========================================================
-- 2. OBJETS (location entre particuliers)
-- ========================================================
CREATE TABLE objets (
    objet_id BIGSERIAL PRIMARY KEY,
    proprietaire_id BIGINT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    titre VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    categorie VARCHAR(100),
    prix_jour DECIMAL(10,2) CHECK (prix_jour >= 0),
    disponible BOOLEAN DEFAULT TRUE,
    localisation VARCHAR(255) NOT NULL,
    condition_sanitaire TEXT,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX idx_objets_categorie ON objets(categorie);

-- ========================================================
-- 3. RÉSERVATIONS (location d’objets)
-- ========================================================
CREATE TABLE reservations (
    reservation_id BIGSERIAL PRIMARY KEY,
    objet_id BIGINT NOT NULL REFERENCES objets(objet_id) ON DELETE CASCADE,
    locataire_id BIGINT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL CHECK (date_fin > date_debut),
    montant_total DECIMAL(10,2) CHECK (montant_total >= 0),
    commission_plateforme DECIMAL(10,2) DEFAULT 0,
    statut VARCHAR(20) CHECK (statut IN ('en_attente','confirmée','annulée','terminée')) DEFAULT 'en_attente',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reglementation_applicable TEXT
);

-- ========================================================
-- 4. COVOITURAGE
-- ========================================================
CREATE TABLE covoiturages (
    covoiturage_id BIGSERIAL PRIMARY KEY,
    conducteur_id BIGINT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    depart VARCHAR(255) NOT NULL,
    destination VARCHAR(255) NOT NULL,
    date_depart TIMESTAMP NOT NULL,
    nb_places INT CHECK (nb_places > 0),
    prix_place DECIMAL(10,2) CHECK (prix_place >= 0),
    commission_plateforme DECIMAL(10,2) DEFAULT 0,
    statut VARCHAR(20) CHECK (statut IN ('actif','complet','annulé','terminé')) DEFAULT 'actif',
    reglementation_applicable TEXT
);

-- ========================================================
-- 5. LIVRAISONS REPAS
-- ========================================================
CREATE TABLE livraisons_repas (
    livraison_repas_id BIGSERIAL PRIMARY KEY,
    client_id BIGINT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    livreur_id BIGINT REFERENCES users(user_id),
    restaurant_nom VARCHAR(255),
    adresse_depart VARCHAR(255) NOT NULL,
    adresse_arrivee VARCHAR(255) NOT NULL,
    distance_km DECIMAL(5,2) CHECK (distance_km >= 0),
    prix_base DECIMAL(10,2) CHECK (prix_base >= 0),
    commission_plateforme DECIMAL(10,2) DEFAULT 0,
    prix_total_affiche DECIMAL(10,2) CHECK (prix_total_affiche >= 0),
    statut VARCHAR(20) CHECK (statut IN ('en_attente','en_cours','livré','annulé')) DEFAULT 'en_attente',
    reglementation_sanitaire TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================================================
-- 6. LIVRAISONS COLIS
-- ========================================================
CREATE TABLE livraisons_colis (
    colis_id BIGSERIAL PRIMARY KEY,
    expediteur_id BIGINT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    livreur_id BIGINT REFERENCES users(user_id),
    objet_description TEXT,
    adresse_depart VARCHAR(255) NOT NULL,
    adresse_arrivee VARCHAR(255) NOT NULL,
    distance_km DECIMAL(5,2) CHECK (distance_km >= 0),
    prix_base DECIMAL(10,2) CHECK (prix_base >= 0),
    commission_plateforme DECIMAL(10,2) DEFAULT 0,
    prix_total_affiche DECIMAL(10,2) CHECK (prix_total_affiche >= 0),
    statut VARCHAR(20) CHECK (statut IN ('en_attente','en_cours','livré','annulé')) DEFAULT 'en_attente',
    reglementation_transport TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================================================
-- 7. CHAUFFEUR VTC
-- ========================================================
CREATE TABLE livraisons_vtc (
    vtc_id BIGSERIAL PRIMARY KEY,
    client_id BIGINT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    chauffeur_id BIGINT REFERENCES users(user_id),
    adresse_depart VARCHAR(255) NOT NULL,
    adresse_arrivee VARCHAR(255) NOT NULL,
    distance_km DECIMAL(5,2) CHECK (distance_km >= 0),
    prix_base DECIMAL(10,2) CHECK (prix_base >= 0),
    commission_plateforme DECIMAL(10,2) DEFAULT 0,
    prix_total_affiche DECIMAL(10,2) CHECK (prix_total_affiche >= 0),
    statut VARCHAR(20) CHECK (statut IN ('en_attente','en_cours','terminé','annulé')) DEFAULT 'en_attente',
    reglementation_transport TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================================================
-- 8. COMMISSIONS
-- ========================================================
CREATE TABLE commissions (
    commission_id BIGSERIAL PRIMARY KEY,
    type_service VARCHAR(30) CHECK (type_service IN ('location','livraison_colis','livraison_repas','vtc','covoiturage')) UNIQUE NOT NULL,
    taux DECIMAL(5,2) CHECK (taux >= 0 AND taux <= 100),
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================================================
-- 9. TRANSACTIONS
-- ========================================================
CREATE TABLE transactions (
    transaction_id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    type_operation VARCHAR(20) CHECK (type_operation IN ('paiement','remboursement','commission','points')) NOT NULL,
    service_type VARCHAR(30) CHECK (service_type IN ('location','livraison_colis','livraison_repas','vtc','covoiturage')) NOT NULL,
    service_id BIGINT NOT NULL,
    montant DECIMAL(10,2) CHECK (montant >= 0),
    moyen_paiement VARCHAR(20) CHECK (moyen_paiement IN ('CB','PayPal','points','virement')),
    statut VARCHAR(20) CHECK (statut IN ('en_attente','validée','échouée')) DEFAULT 'en_attente',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX idx_transactions_service ON transactions(service_type, service_id);

-- ========================================================
-- 10. REVENUS PLATEFORME
-- ========================================================
CREATE TABLE revenus_plateforme (
    revenu_id BIGSERIAL PRIMARY KEY,
    transaction_id BIGINT NOT NULL REFERENCES transactions(transaction_id) ON DELETE CASCADE,
    montant_commission DECIMAL(10,2) NOT NULL,
    date_reception TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================================================
-- 11. POINTS FIDÉLITÉ
-- ========================================================
CREATE TABLE points_fidelite (
    fidelite_id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(user_id) ON DELETE CASCADE,
    action_source VARCHAR(30) CHECK (action_source IN ('location','livraison_colis','livraison_repas','vtc','covoiturage','invitation')),
    points_gagnes INT DEFAULT 0,
    points_utilises INT DEFAULT 0,
    date_operation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- ========================================================
--⚙️ TRIGGER : Calcul automatique de la commission
--Ce trigger met à jour la commission lors de l’insertion d’un enregistrement dans les tables de services.
-- ========================================================
-- Fonction pour appliquer le taux de commission automatiquement
CREATE OR REPLACE FUNCTION appliquer_commission()
RETURNS TRIGGER AS $$
DECLARE
    taux DECIMAL(5,2);
BEGIN
    SELECT c.taux INTO taux
    FROM commissions c
    WHERE c.type_service = TG_ARGV[0];

    IF taux IS NULL THEN
        taux := 10; -- taux par défaut 10%
    END IF;

    NEW.commission_plateforme := ROUND(NEW.prix_base * (taux / 100), 2);
    NEW.prix_total_affiche := ROUND(NEW.prix_base + NEW.commission_plateforme, 2);

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Déclencheurs pour chaque type de service
CREATE TRIGGER trg_commission_location
BEFORE INSERT ON reservations
FOR EACH ROW EXECUTE FUNCTION appliquer_commission('location');

CREATE TRIGGER trg_commission_colis
BEFORE INSERT ON livraisons_colis
FOR EACH ROW EXECUTE FUNCTION appliquer_commission('livraison_colis');

CREATE TRIGGER trg_commission_repas
BEFORE INSERT ON livraisons_repas
FOR EACH ROW EXECUTE FUNCTION appliquer_commission('livraison_repas');

CREATE TRIGGER trg_commission_vtc
BEFORE INSERT ON livraisons_vtc
FOR EACH ROW EXECUTE FUNCTION appliquer_commission('vtc');

CREATE TRIGGER trg_commission_covoiturage
BEFORE INSERT ON covoiturages
FOR EACH ROW EXECUTE FUNCTION appliquer_commission('covoiturage');
