<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'password'  => $this->passwordRules(),
            'telefono'  => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:255'],
        ])->validate();

        $user = User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // Actualizar cliente creado por el Observer con teléfono y dirección
        Cliente::where('correo', $user->email)->update([
            'telefono'  => $input['telefono'] ?? null,
            'direccion' => $input['direccion'] ?? null,
        ]);

        return $user;
    }
}