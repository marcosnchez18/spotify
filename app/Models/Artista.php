<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;

    public function albumes()
    {
        return $this->belongsToMany(Album::class, 'albumes_artistas');
    }

    public function canciones()
    {
        return $this->belongsToMany(Cancion::class, 'artistas_canciones');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    
}
