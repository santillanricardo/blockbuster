<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RentaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboard;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\Admin\UsuarioController;

Route::view('/', 'welcome')->name('home');

// Rutas Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('peliculas', PeliculaController::class);
    Route::resource('clientes', ClienteController::class)->except(['create', 'store']);
    Route::resource('rentas', RentaController::class);
    Route::get('/pdf/rentas', [PdfController::class, 'reporteRentas'])->name('pdf.rentas');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
});

// Rutas Cliente
Route::middleware(['auth', 'role:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/dashboard', [ClienteDashboard::class, 'index'])->name('dashboard');
    Route::get('/catalogo', [ClienteDashboard::class, 'catalogo'])->name('catalogo');
    Route::get('/mis-rentas', [ClienteDashboard::class, 'misRentas'])->name('mis-rentas');
    Route::post('/recomendar', [ClienteDashboard::class, 'recomendar'])->name('recomendar');
    Route::post('/rentar', [ClienteDashboard::class, 'rentar'])->name('rentar');
});

// Rutas compartidas
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    Route::put('/perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.password');

    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('cliente.dashboard');
    })->name('dashboard');
});

require __DIR__ . '/settings.php';
