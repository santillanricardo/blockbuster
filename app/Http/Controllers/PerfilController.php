<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente;

class PerfilController extends Controller
{
    public function edit()
    {
        return view('perfil.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email,' . $user->id,
        'foto'      => 'nullable|image|max:2048',
        'telefono'  => 'required|string|max:20',
        'direccion' => 'required|string|max:255',
    ]);

    // Guardar correo viejo antes de actualizar
    $correoViejo = $user->email;

    // Subir foto si viene
    if ($request->hasFile('foto')) {
        if ($user->foto) Storage::disk('public')->delete($user->foto);
        $path = $request->file('foto')->store('fotos', 'public');
        $user->foto = $path;
    }

    $user->name  = $request->name;
    $user->email = $request->email;
    $user->save();

    // Actualizar cliente usando el correo viejo
    \App\Models\Cliente::where('correo', $correoViejo)->update([
        'nombre'    => $request->name,
        'correo'    => $request->email,
        'telefono'  => $request->telefono,
        'direccion' => $request->direccion,
    ]);

    return back()->with('success', 'Perfil actualizado correctamente.');
}
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success_password', 'Contraseña actualizada correctamente.');
    }
}