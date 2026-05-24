<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Http\Requests\StorePeliculaRequest;
use Illuminate\Support\Facades\Storage;


class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::paginate(10);
        return view('peliculas.index', compact('peliculas'));
    }

    public function create()
    {
        return view('peliculas.create');
    }

    public function store(StorePeliculaRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('peliculas', 'public');
        }

        Pelicula::create($data);
        return redirect()->route('admin.peliculas.index')->with('success', 'Película creada correctamente.');
    }

    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', compact('pelicula'));
    }

    public function update(StorePeliculaRequest $request, Pelicula $pelicula)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            if ($pelicula->imagen) Storage::disk('public')->delete($pelicula->imagen);
            $data['imagen'] = $request->file('imagen')->store('peliculas', 'public');
        }

        $pelicula->update($data);
        return redirect()->route('admin.peliculas.index')->with('success', 'Película actualizada.');
    }

    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return redirect()->route('admin.peliculas.index')->with('success', 'Película eliminada.');
    }
}
