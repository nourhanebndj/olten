<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('about_me')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['Homme', 'Femme'])->nullable();
            $table->boolean('disable_email_notifications')->default(false);

            $table->string('x_com')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('whatsapp')->nullable();

            $table->string('identity_verification')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'about_me', 'phone', 'gender', 'disable_email_notifications',
                'x_com', 'facebook', 'linkedin', 'instagram', 'youtube', 'tiktok', 'whatsapp',
                'identity_verification'
            ]);
        });
    }
};
