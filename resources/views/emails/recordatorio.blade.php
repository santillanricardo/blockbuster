<x-mail::message>
# 🎬 Recordatorio de devolución

Hola, **{{ $renta->cliente->nombre }}**,

Te recordamos que tienes una película pendiente de devolver en **Blockbuster Video Club**.

<x-mail::panel>
🎞️ **Película:** {{ $renta->pelicula->titulo }}
📅 **Fecha de devolución:** {{ \Carbon\Carbon::parse($renta->fecha_devolucion)->format('d/m/Y') }}
</x-mail::panel>

Por favor devuélvela a tiempo para evitar cargos adicionales.

Si ya la devolviste, ignora este mensaje.

<x-mail::button url="{{ config('app.url') }}" color="error">
Ver mi cuenta
</x-mail::button>

Gracias por ser cliente de Blockbuster,
**El equipo de Blockbuster Video Club**
</x-mail::message>