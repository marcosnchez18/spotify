<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumCancion;
use App\Models\Artista;
use App\Models\ArtistaCancion;
use App\Models\Cancion;
use Illuminate\Http\Request;

class CancionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $order = $request->query('order', 'titulo');
        $order_dir = $request->query('order_dir', 'asc');

        $canciones = Cancion::orderBy($order, $order_dir)->paginate(2);

        return view('canciones.index', [
            'canciones' => $canciones,
            'order' => $order,
            'order_dir' => $order_dir
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
        //AlbumCancion::where('cancion_id', $cancion->id)->delete();
        //ArtistaCancion::where('cancion_id', $cancion->id)->delete();   //esto es si queremos que se borre y listo, pero el ejercicio nos dice que se impida borrar
        $r1 = AlbumCancion::where('cancion_id', $cancion->id)->count();
        $r2 = ArtistaCancion::where('cancion_id', $cancion->id)->count();

        if ($r1 > 0 || $r2 > 0) {
            session()->flash('error', 'No se puede borrar una cancion de un artista contenida en un álbum');
            return redirect()->route('canciones.index');   //sin esto no funcionaría
        }

        $cancion->delete();

        session()->flash('success', 'Canción eliminada correctamente.');
        return redirect()->route('canciones.index');
    }
}
