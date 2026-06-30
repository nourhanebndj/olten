<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE delivery_requests
            DROP CONSTRAINT delivery_requests_status_check
        ");

        DB::statement("
            ALTER TABLE delivery_requests
            ADD CONSTRAINT delivery_requests_status_check
            CHECK (
                status IN (
                    'pending',
                    'accepted',
                    'rejected',
                    'cancelled',
                    'completed'
                )
            )
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE delivery_requests
            DROP CONSTRAINT delivery_requests_status_check
        ");

        DB::statement("
            ALTER TABLE delivery_requests
            ADD CONSTRAINT delivery_requests_status_check
            CHECK (
                status IN (
                    'pending',
                    'accepted',
                    'rejected',
                    'cancelled'
                )
            )
        ");
    }
};
