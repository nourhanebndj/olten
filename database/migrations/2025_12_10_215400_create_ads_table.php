<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->unsignedBigInteger('category_id');

            $table->string('address')->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('price_per_day', 10, 2);

            $table->boolean('delivery_active')->default(false);
            $table->string('client_address')->nullable();
            $table->decimal('price_per_km', 10, 2)->nullable();
            $table->decimal('distance_km', 10, 2)->nullable();
            $table->decimal('delivery_cost', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
