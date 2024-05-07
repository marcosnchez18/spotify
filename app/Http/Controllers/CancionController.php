<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artista;
use App\Models\Cancion;
use Illuminate\Http\Request;

class CancionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('canciones.index', [
            'canciones' => Cancion::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('canciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'duracion' => 'required|date_format:H:i:s',
        ]);

        $Cancion = new Cancion();
        $Cancion->titulo = $validated['titulo'];
        $Cancion->duracion = $validated['duracion'];
        $Cancion->save();
        session()->flash('success', 'El álbum se ha creado correctamente.');
        return redirect()->route('canciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cancion $cancion)
    {
        return view('canciones.show', [
            'cancion' => $cancion,
            'artista' => Artista::all(),
            'album' => Album::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cancion $cancion)
    {
        return view('canciones.edit', [
            'cancion' => $cancion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cancion $cancion)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'duracion' => 'required|date_format:H:i:s',
        ]);

        $cancion->titulo = $validated['titulo'];
        $cancion->duracion = $validated['duracion'];
        $cancion->save();
        session()->flash('success', 'Cancion cambiada correctamente');
        return redirect()->route('canciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cancion $cancion)
    {
        $cancion->delete();
        session()->flash('success', 'Cancion eliminada correctamente.');
        return redirect()->route('canciones.index');
    }
}
