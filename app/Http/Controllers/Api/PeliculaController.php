<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PeliculaController extends Controller
{
    // GET /api/peliculas
    public function index(): JsonResponse
    {
        $peliculas = Pelicula::orderBy('titulo')->get();
        return response()->json([
            'data'  => $peliculas,
            'total' => $peliculas->count(),
        ], 200);
    }

    // GET /api/peliculas/{id}
    public function show(Pelicula $pelicula): JsonResponse
    {
        return response()->json(['data' => $pelicula], 200);
    }

    // POST /api/peliculas
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'titulo'             => 'required|string|max:255',
            'genero'             => 'required|string|max:100',
            'anio'               => 'required|integer|min:1888|max:' . date('Y'),
            'sinopsis'           => 'nullable|string',
            'copias_disponibles' => 'required|integer|min:0',
        ]);

        $pelicula = Pelicula::create($data);
        return response()->json(['data' => $pelicula, 'message' => 'Película creada.'], 201);
    }

    // PUT /api/peliculas/{id}
    public function update(Request $request, Pelicula $pelicula): JsonResponse
    {
        $data = $request->validate([
            'titulo'             => 'sometimes|string|max:255',
            'genero'             => 'sometimes|string|max:100',
            'anio'               => 'sometimes|integer|min:1888|max:' . date('Y'),
            'sinopsis'           => 'nullable|string',
            'copias_disponibles' => 'sometimes|integer|min:0',
        ]);

        $pelicula->update($data);
        return response()->json(['data' => $pelicula, 'message' => 'Película actualizada.'], 200);
    }

    // DELETE /api/peliculas/{id}
    public function destroy(Pelicula $pelicula): JsonResponse
    {
        $pelicula->delete();
        return response()->json(['message' => 'Película eliminada.'], 200);
    }
}