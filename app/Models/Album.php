<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//para imágenes:
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albumes';

    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'albumes_artistas');
    }

    public function canciones()
    {
        return $this->belongsToMany(Cancion::class, 'albumes_canciones');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function duracion_album()
    {
        $registros = AlbumCancion::where('album_id', $this->id)->get();
        $duracion = 0;

        foreach ($registros as $registro) {
            $cancion = Cancion::find($registro->cancion_id);
            $tiempo = $cancion->duracion;

            // Convertir la duración a minutos y segundos
            list($horas, $minutos, $segundos) = explode(':', $tiempo);
            $duracion += $minutos * 60 + $segundos;
        }

        // Convertir la duración total de segundos a formato minutos:segundos
        $minutos = floor($duracion / 60);
        $segundos = $duracion % 60;

        return sprintf('%02d:%02d', $minutos, $segundos);
    }

    public function artistas_album()
    {
        $artistas = AlbumArtista::where('album_id', $this->id)->get();
        $nombres_artistas = '';
        foreach ($artistas as $artista) {
            $nombre = $artista->artista_id;

            $ar = Artista::find($nombre);
            $nombres_artistas .= '<li>' . $ar->nombre . '</li>';
        }
        return $nombres_artistas ? '<ul>' . $nombres_artistas . '</ul>' : 'Sin artistas';
    }

    public function nombres_canciones()
    {
        $canciones = AlbumCancion::where('album_id', $this->id)->get();
        $nombres_canciones = '';
        foreach ($canciones as $cancion) {
            $nombre = $cancion->cancion_id;

            $al = Cancion::find($nombre);
            $nombres_canciones .= '<li>' . $al->titulo . '</li>';
        }
        return $nombres_canciones ? '<ul>' . $nombres_canciones . '</ul>' : 'Sin canciones';
    }

    public function duraciones()
    {
        $canciones = AlbumCancion::where('album_id', $this->id)->get();
        $nombres_canciones = '';
        foreach ($canciones as $cancion) {
            $nombre = $cancion->cancion_id;

            $al = Cancion::find($nombre);
            $nombres_canciones .= '<li>' . $al->duracion . '</li>';
        }
        return $nombres_canciones ? '<ul>' . $nombres_canciones . '</ul>' : 'Sin canciones';
    }







    //para imágenes:

    private function imagen_url_relativa()
    {
        return '/uploads/' . $this->foto;
    }


    public function getImagenUrlAttribute()
    {
        return Storage::url(mb_substr($this->imagen_url_relativa(), 1));
    }


    public function existeImagen()
    {
        return Storage::disk('public')->exists($this->imagen_url_relativa());
    }


    public function guardar_imagen(UploadedFile $imagen, string $nombre, int $escala, ?ImageManager $manager = null)
    {
        if ($manager === null) {
            $manager = new ImageManager(new Driver());
        }
        Storage::makeDirectory('public/uploads');
        $imagen = $manager->read($imagen);
        $imagen->scaleDown($escala);
        $ruta = Storage::path('public/uploads/' . $nombre);
        $imagen->save($ruta);
    }
}
