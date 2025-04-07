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
        Schema::create('pokemons_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pokemon_id');
            $table->uuid('user_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pokemon_id')->references('id')->on('pokemons')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemons_users');
    }
};
