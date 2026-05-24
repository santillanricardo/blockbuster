<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use App\Models\Cliente;
use App\Models\Renta;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'peliculas' => Pelicula::count(),
            'clientes'  => Cliente::count(),
            'activas'   => Renta::where('estatus', 'activa')->count(),
            'vencidas'  => Renta::where('estatus', 'vencida')->count(),
        ];

        $ultimasRentas = Renta::with(['cliente', 'pelicula'])->latest()->take(5)->get();

        // Datos para gráfico — rentas por mes (últimos 6 meses)
        $rentasPorMes = Renta::selectRaw("strftime('%m', created_at) as mes, COUNT(*) as total")
            ->whereRaw("created_at >= date('now', '-6 months')")
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->pluck('total', 'mes');

        // Datos para gráfico — películas por género
        $porGenero = Pelicula::selectRaw('genero, COUNT(*) as total')
            ->groupBy('genero')
            ->get();

        return view('admin.dashboard', compact('stats', 'ultimasRentas', 'rentasPorMes', 'porGenero'));
    }
}