<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        // Supprime l'ancienne contrainte
        DB::statement('ALTER TABLE covoiturages DROP CONSTRAINT IF EXISTS covoiturages_statut_check');

        // Ajoute la nouvelle contrainte avec les nouvelles valeurs autorisées
        DB::statement("
            ALTER TABLE covoiturages
            ADD CONSTRAINT covoiturages_statut_check
            CHECK (statut IN ('actif','inactif','pending','validé','complet'))
        ");

        // Assure le DEFAULT
        DB::statement("
            ALTER TABLE covoiturages
            ALTER COLUMN statut SET DEFAULT 'actif'
        ");
    }

    public function down(): void
    {
        // Supprime la nouvelle contrainte
        DB::statement('ALTER TABLE covoiturages DROP CONSTRAINT IF EXISTS covoiturages_statut_check');

        // Restaure l’ancienne contrainte
        DB::statement("
            ALTER TABLE covoiturages
            ADD CONSTRAINT covoiturages_statut_check
            CHECK (statut IN ('actif','complet','annulé','terminé'))
        ");

        DB::statement("
            ALTER TABLE covoiturages
            ALTER COLUMN statut SET DEFAULT 'actif'
        ");
    }
};
