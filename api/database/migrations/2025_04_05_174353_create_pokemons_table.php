<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pokemons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('pokeapi_id')->unique();
            $table->string('name');
            $table->string('sprite')->nullable();
            $table->json('types')->nullable();
            $table->json('stats')->nullable();
            $table->json('abilities')->nullable();
            $table->json('moves')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemons');
    }
};
