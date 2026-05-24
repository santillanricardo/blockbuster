<?php

namespace App\Http\Controllers;

use App\Models\Renta;
use App\Models\Cliente;
use App\Models\Pelicula;
use App\Http\Requests\StoreRentaRequest;
use App\Mail\RecordatorioDevolucion;
use Illuminate\Support\Facades\Mail;

class RentaController extends Controller
{
    public function index()
    {
        $rentas = Renta::with(['cliente', 'pelicula'])->paginate(10);
        return view('rentas.index', compact('rentas'));
    }

    public function create()
    {
        $clientes  = Cliente::orderBy('nombre')->get();
        $peliculas = Pelicula::where('copias_disponibles', '>', 0)->orderBy('titulo')->get();
        return view('rentas.create', compact('clientes', 'peliculas'));
    }

    public function store(StoreRentaRequest $request)
    {
        $renta = Renta::create($request->validated());

        // Reducir copia disponible
        $pelicula = Pelicula::find($request->pelicula_id);
        $pelicula->decrement('copias_disponibles');

        // Enviar correo de confirmación al cliente
        $cliente = Cliente::find($request->cliente_id);
        if ($cliente && $cliente->correo) {
            Mail::to($cliente->correo)->send(new RecordatorioDevolucion($renta->load(['cliente', 'pelicula'])));
        }

        return redirect()->route('admin.rentas.index')->with('success', 'Renta registrada y correo enviado.');
    }

    public function edit(Renta $renta)
    {
        $clientes  = Cliente::orderBy('nombre')->get();
        $peliculas = Pelicula::orderBy('titulo')->get();
        return view('rentas.edit', compact('renta', 'clientes', 'peliculas'));
    }

    public function update(StoreRentaRequest $request, Renta $renta)
    {
        $renta->update($request->validated());
        return redirect()->route('admin.rentas.index')->with('success', 'Renta actualizada.');
    }

    public function destroy(Renta $renta)
    {
        // Devolver copia al eliminar
        $renta->pelicula->increment('copias_disponibles');
        $renta->delete();
        return redirect()->route('admin.rentas.index')->with('success', 'Renta eliminada.');
    }
}
