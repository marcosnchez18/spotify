<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancion extends Model
{
    use HasFactory;

    protected $table = 'canciones';

    public function albumes()
    {
        return $this->belongsToMany(Album::class, 'albumes_canciones');
    }

    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'artistas_canciones');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function nombres_artistas()
    {
        $artistas = ArtistaCancion::where('cancion_id', $this->id)->get();
        $nombres_artistas = '';
        foreach ($artistas as $artista) {
            $nombre = $artista->artista_id;

            $ar = Artista::find($nombre);
            $nombres_artistas .= '<li>' . $ar->nombre . '</li>';
        }
        return $nombres_artistas ? '<ul>' . $nombres_artistas . '</ul>' : 'Sin artistas';
    }

    public function nombres_albumes()
    {
        $albumes = AlbumCancion::where('cancion_id', $this->id)->get();
        $nombres_albumes = '';
        foreach ($albumes as $album) {
            $nombre = $album->album_id;

            $al = Album::find($nombre);
            $nombres_albumes .= '<li>' . $al->titulo . '</li>';
        }
        return $nombres_albumes ? '<ul>' . $nombres_albumes . '</ul>' : 'Sin albumes';
    }
}
