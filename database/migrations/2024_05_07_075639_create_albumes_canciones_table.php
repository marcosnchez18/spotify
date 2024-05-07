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
        Schema::create('albumes_canciones', function (Blueprint $table) {
            $table->foreignId('album_id')->constrained('albumes');
            $table->foreignId('cancion_id')->constrained('canciones');
            $table->timestamps();
            $table->primary(['album_id', 'cancion_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albumes_canciones');
    }
};
