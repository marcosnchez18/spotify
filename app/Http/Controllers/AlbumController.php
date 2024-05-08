<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumArtista;
use App\Models\AlbumCancion;
use Illuminate\Http\Request;

//para imágenes:
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('albumes.index', [
            'albumes' => Album::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('albumes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
        ]);

        $album = new Album();                         //img
        $imagen = $request->file('foto');            //img
        Storage::makeDirectory('public/album');      //img
        $nombre = Carbon::now() . '.jpeg';          //img
        $manager = new ImageManager(new Driver());  //img

        $album->guardar_imagen($imagen, $nombre, 100, $manager);  //img

        //$album = new Album();  si no hay img descomentar
        $album->titulo = $validated['titulo'];
        $album->foto = $nombre;   //img
        $album->save();

        session()->flash('success', 'El álbum se ha creado correctamente.');
        return redirect()->route('albumes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('albumes.show', [
            'album' => $album,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('albumes.edit', [
            'album' => $album,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
        ]);

        $imagen = $request->file('foto');            //img
        Storage::makeDirectory('public/album');      //img
        $nombre = Carbon::now() . '.jpeg';          //img
        $manager = new ImageManager(new Driver());  //img

        $album->guardar_imagen($imagen, $nombre, 100, $manager);    //img

        $album->titulo = $validated['titulo'];
        $album->foto = $nombre;     //si no img, se quita esta linea
        $album->save();
        session()->flash('success', 'Album cambiado correctamente');
        return redirect()->route('albumes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {

        //AlbumCancion::where('arlbum_id', $album->id)->delete();
        //AlbumArtista::where('album_id', $album->id)->delete();   //esto es si queremos que se borre y listo, pero el ejercicio nos dice que se impida borrar
        $r1 = AlbumCancion::where('album_id', $album->id)->count();
        $r2 = AlbumArtista::where('album_id', $album->id)->count();

        if ($r1 > 0 || $r2 > 0) {
            session()->flash('error', 'No se puede borrar una album con canciones');
            return redirect()->route('canciones.index');   //sin esto no funcionaría
        }


        $album->delete();
        session()->flash('success', 'Album eliminado correctamente.');
        return redirect()->route('albumes.index');
    }
}
