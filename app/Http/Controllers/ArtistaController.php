<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;

class ArtistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('artistas.index', [
            'artistas' => Artista::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artistas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
        ]);

        $Artista = new Artista();
        $Artista->nombre = $validated['nombre'];
        $Artista->save();
        session()->flash('success', 'El artista se ha creado correctamente.');
        return redirect()->route('artistas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artista $artista)
    {
        return view('artistas.show', [
            'artista' => $artista,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artista $artista)
    {
        return view('artistas.edit', [
            'artista' => $artista,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artista $artista)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
        ]);

        $artista->nombre = $validated['nombre'];
        $artista->save();
        session()->flash('success', 'Artista cambiado correctamente');
        return redirect()->route('artistas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artista $artista)
    {
        $artista->delete();
        session()->flash('success', 'Artista eliminado correctamente.');
        return redirect()->route('artistas.index');
    }
}
