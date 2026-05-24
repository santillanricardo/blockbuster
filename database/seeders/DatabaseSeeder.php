<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pelicula;
use App\Models\Cliente;
use App\Models\Renta;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- Roles ---
        $admin  = Role::firstOrCreate(['name' => 'admin']);
        $cliente = Role::firstOrCreate(['name' => 'cliente']);

        // --- Usuario Admin ---
        $admin_user = User::firstOrCreate(
            ['email' => 'admin@blockbuster.com'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin_user->assignRole($admin);

        // --- Usuario Cliente ---
        $cliente_user = User::firstOrCreate(
            ['email' => 'cliente@blockbuster.com'],
            [
                'name'     => 'Juan Pérez',
                'password' => Hash::make('12345678'),
            ]
        );
        $cliente_user->assignRole($cliente);

        // --- Películas ---
        $peliculas = [
            ['titulo' => 'El Padrino',         'genero' => 'Drama',    'anio' => 1972, 'sinopsis' => 'La historia de la familia Corleone.', 'copias_disponibles' => 3],
            ['titulo' => 'Pulp Fiction',        'genero' => 'Crimen',   'anio' => 1994, 'sinopsis' => 'Historias entrelazadas en Los Ángeles.', 'copias_disponibles' => 2],
            ['titulo' => 'El Rey León',         'genero' => 'Animación','anio' => 1994, 'sinopsis' => 'Simba debe reclamar su reino.', 'copias_disponibles' => 4],
            ['titulo' => 'Interstellar',        'genero' => 'Ciencia Ficción', 'anio' => 2014, 'sinopsis' => 'Viaje a través del espacio-tiempo.', 'copias_disponibles' => 2],
            ['titulo' => 'Titanic',             'genero' => 'Romance',  'anio' => 1997, 'sinopsis' => 'Amor en el barco más famoso del mundo.', 'copias_disponibles' => 1],
        ];

        foreach ($peliculas as $p) {
            Pelicula::firstOrCreate(['titulo' => $p['titulo']], $p);
        }

        // --- Clientes ---
        $clientes = [
            ['nombre' => 'María López',   'correo' => 'maria@mail.com',  'telefono' => '4441234567', 'direccion' => 'Av. Juárez 100'],
            ['nombre' => 'Carlos Ruiz',   'correo' => 'carlos@mail.com', 'telefono' => '4449876543', 'direccion' => 'Calle Morelos 45'],
            ['nombre' => 'Ana González',  'correo' => 'ana@mail.com',    'telefono' => '4445555555', 'direccion' => 'Blvd. Carranza 200'],
        ];

        foreach ($clientes as $c) {
            Cliente::firstOrCreate(['correo' => $c['correo']], $c);
        }

        // --- Rentas de ejemplo ---
        $p1 = Pelicula::where('titulo', 'El Padrino')->first();
        $p2 = Pelicula::where('titulo', 'Interstellar')->first();
        $c1 = Cliente::where('correo', 'maria@mail.com')->first();
        $c2 = Cliente::where('correo', 'carlos@mail.com')->first();

        Renta::firstOrCreate(
            ['cliente_id' => $c1->id, 'pelicula_id' => $p1->id],
            ['fecha_renta' => now()->subDays(5), 'fecha_devolucion' => now()->addDays(2), 'estatus' => 'activa']
        );

        Renta::firstOrCreate(
            ['cliente_id' => $c2->id, 'pelicula_id' => $p2->id],
            ['fecha_renta' => now()->subDays(10), 'fecha_devolucion' => now()->subDays(3), 'estatus' => 'vencida']
        );
    }
}