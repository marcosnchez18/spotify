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
        Schema::create('artistas_canciones', function (Blueprint $table) {
            $table->foreignId('artista_id')->constrained('artistas');
            $table->foreignId('cancion_id')->constrained('canciones');
            $table->timestamps();
            $table->primary(['artista_id', 'cancion_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artistas_canciones');
    }
};
