<x-mail::message>
# 🎬 ¡Bienvenido a Blockbuster, {{ $nombre }}!

Tu cuenta ha sido creada por el administrador. Ya puedes acceder al sistema con las siguientes credenciales:

<x-mail::panel>
📧 **Correo:** {{ $email }}
🔑 **Contraseña:** {{ $password }}
</x-mail::panel>

Te recomendamos cambiar tu contraseña después de iniciar sesión por primera vez.

<x-mail::button url="{{ config('app.url') }}/login" color="error">
Iniciar sesión
</x-mail::button>

Gracias,
**El equipo de Blockbuster Video Club**
</x-mail::message>