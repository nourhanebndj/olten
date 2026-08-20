<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'firstname')) {
                $table->string('firstname')->nullable()->after('name');
            }

            if (!Schema::hasColumn('users', 'lastname')) {
                $table->string('lastname')->nullable()->after('firstname');
            }

            if (!Schema::hasColumn('users', 'profile_photo')) {
                $table->string('profile_photo')->nullable()->after('lastname');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            if (Schema::hasColumn('users', 'firstname')) {
                $table->dropColumn('firstname');
            }

            if (Schema::hasColumn('users', 'lastname')) {
                $table->dropColumn('lastname');
            }

            if (Schema::hasColumn('users', 'profile_photo')) {
                $table->dropColumn('profile_photo');
            }

        });
    }
};

