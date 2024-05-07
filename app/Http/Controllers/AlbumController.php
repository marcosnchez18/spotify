<?php

namespace App\Http\Controllers;

use App\Models\Album;
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

        $album = new Album();
        $imagen = $request->file('foto');            //img
        Storage::makeDirectory('public/album');      //img
        $nombre = Carbon::now() . '.jpeg';          //img
        $manager = new ImageManager(new Driver());  //img

        $album->guardar_imagen($imagen, $nombre, 100, $manager);


        $album->titulo = $validated['titulo'];
        $album->foto = $nombre;
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

        $album->titulo = $validated['titulo'];
        $album->save();
        session()->flash('success', 'Album cambiado correctamente');
        return redirect()->route('albumes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $album->delete();
        session()->flash('success', 'Album eliminado correctamente.');
        return redirect()->route('albumes.index');
    }
}
