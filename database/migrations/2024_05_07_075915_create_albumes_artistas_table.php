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
        Schema::create('albumes_artistas', function (Blueprint $table) {
            $table->foreignId('album_id')->constrained('albumes');
            $table->foreignId('artista_id')->constrained('artistas');
            $table->timestamps();
            $table->primary(['album_id', 'artista_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albumes_artistas');
    }
};
