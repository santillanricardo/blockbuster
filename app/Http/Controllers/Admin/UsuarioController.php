<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8',
            'telefono'  => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('cliente');

        Cliente::where('correo', $user->email)->update([
            'telefono'  => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        // Enviar correo con credenciales
        Mail::to($user->email)->send(new \App\Mail\BienvenidaUsuario(
            $user->name,
            $user->email,
            $request->password
        ));

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Usuario creado y correo enviado.');
    }
}