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
        Schema::create('pokemons_trainers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pokemon_id');
            $table->uuid('trainer_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pokemon_id')->references('id')->on('pokemons')->onDelete('restrict');
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemons_trainers');
    }
};
