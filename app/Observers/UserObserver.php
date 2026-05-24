<?php
namespace App\Observers;

use App\Models\User;
use App\Models\Cliente;

class UserObserver
{
    public function created(User $user): void
    {
        // Asignar rol cliente automáticamente
        $user->assignRole('cliente');

        // Crear registro en tabla clientes
        Cliente::firstOrCreate(
            ['correo' => $user->email],
            [
                'nombre'    => $user->name,
                'correo'    => $user->email,
                'telefono'  => null,
                'direccion' => null,
            ]
        );
    }
}