<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use App\Models\Renta;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function index()
    {
        // Buscar el cliente ligado al usuario logueado por correo
        $cliente = Cliente::where('correo', auth()->user()->email)->first();

        $misRentas = $cliente
            ? Renta::with('pelicula')->where('cliente_id', $cliente->id)->latest()->take(5)->get()
            : collect();

        $totalRentas  = $cliente ? Renta::where('cliente_id', $cliente->id)->count() : 0;
        $rentasActivas = $cliente ? Renta::where('cliente_id', $cliente->id)->where('estatus', 'activa')->count() : 0;

        return view('clientes.dashboard', compact('misRentas', 'totalRentas', 'rentasActivas'));
    }

    public function catalogo()
    {
        $peliculas = Pelicula::orderBy('titulo')->paginate(12);
        return view('clientes.catalogo', compact('peliculas'));
    }

    public function misRentas()
    {
        $cliente = Cliente::where('correo', auth()->user()->email)->first();
        $rentas  = $cliente
            ? Renta::with('pelicula')->where('cliente_id', $cliente->id)->latest()->paginate(10)
            : collect();

        return view('clientes.mis-rentas', compact('rentas'));
    }

    public function recomendar(\Illuminate\Http\Request $request)
    {
        $request->validate(['consulta' => 'required|string|max:500']);

        $peliculas = \App\Models\Pelicula::all(['titulo', 'genero', 'anio', 'sinopsis', 'copias_disponibles']);

        $catalogo = $peliculas->map(
            fn($p) =>
            "- {$p->titulo} ({$p->genero}, {$p->anio}) - " .
                ($p->copias_disponibles > 0 ? 'Disponible' : 'Sin stock') .
                ($p->sinopsis ? ": {$p->sinopsis}" : '')
        )->join("\n");

        $prompt = "Eres el asistente virtual exclusivo de Blockbuster Video Club. Tu ÚNICA función es recomendar películas del catálogo. Reglas estrictas:
                1. SOLO hablas de películas del catálogo proporcionado. Nunca recomiendas películas que no estén en la lista.
                2. Si el cliente pregunta algo fuera del tema de películas (clima, política, chistes, consejos de vida, etc.), NO respondas eso. En su lugar, redirige amablemente la conversación hacia películas relacionadas con lo que mencionó. Ejemplo: si pregunta por comida italiana, recomienda películas italianas o ambientadas en Italia del catálogo.
                3. Si no hay películas que coincidan exactamente, recomienda la más cercana del catálogo y explica por qué podría gustarle.
                4. Sé amigable, breve y entusiasta. Máximo 3 recomendaciones por respuesta.
                5. Siempre termina invitando al cliente a rentar alguna película.

                Catálogo disponible:
                {$catalogo}

                Pregunta del cliente: \"{$request->consulta}\"";

        $response = \Illuminate\Support\Facades\Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 500,
            ]);

        $texto = $response->json('choices.0.message.content') ?? 'No pude generar una recomendación en este momento.';

        return response()->json(['respuesta' => $texto]);
    }

    public function rentar(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'pelicula_id'      => 'required|exists:peliculas,id',
            'fecha_devolucion' => 'required|date|after:today',
        ]);

        $cliente = Cliente::where('correo', auth()->user()->email)->first();

        if (!$cliente) {
            return back()->with('error', 'No tienes un perfil de cliente asociado.');
        }

        $pelicula = \App\Models\Pelicula::findOrFail($request->pelicula_id);

        if ($pelicula->copias_disponibles <= 0) {
            return back()->with('error', 'No hay copias disponibles de esta película.');
        }

        \App\Models\Renta::create([
            'cliente_id'       => $cliente->id,
            'pelicula_id'      => $pelicula->id,
            'fecha_renta'      => now()->toDateString(),
            'fecha_devolucion' => $request->fecha_devolucion,
            'estatus'          => 'activa',
        ]);

        $pelicula->decrement('copias_disponibles');

        // Enviar correo de confirmación
        \Illuminate\Support\Facades\Mail::to(auth()->user()->email)
            ->send(new \App\Mail\RecordatorioDevolucion(
                \App\Models\Renta::with(['cliente', 'pelicula'])
                    ->where('cliente_id', $cliente->id)
                    ->latest()->first()
            ));

        return back()->with('success', '¡Renta registrada exitosamente!');
    }
}
