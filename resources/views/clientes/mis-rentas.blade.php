<x-layouts::app :title="__('Mis Rentas')">
    <div class="max-w-4xl mx-auto px-6 py-8">

        <div class="mb-8">
            <div class="flex items-center gap-3 mb-1">
                <div class="h-7 w-1 rounded-full bg-red-600"></div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Mis Rentas</h1>
            </div>
            <p class="text-sm text-zinc-500 ml-4">Historial completo de tus rentas</p>
        </div>

        <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-800 bg-[#0f0f0f]">
                        <th
                            class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                            Película</th>
                        <th
                            class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                            Fecha renta</th>
                        <th
                            class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                            Devolución</th>
                        <th
                            class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                            Estatus</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800/50">
                    @forelse($rentas as $renta)
                        @php
                            $badge = match ($renta->estatus) {
                                'activa' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                'devuelta' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                'vencida' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                default => '',
                            };
                        @endphp
                        <tr class="hover:bg-white/[0.02]">
                            <td class="px-6 py-4 font-medium text-white">{{ $renta->pelicula->titulo }}</td>
                            <td class="px-6 py-4 text-zinc-400 text-xs">
                                {{ \Carbon\Carbon::parse($renta->fecha_renta)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-zinc-400 text-xs">
                                {{ \Carbon\Carbon::parse($renta->fecha_devolucion)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-0.5 rounded-full text-xs font-medium border {{ $badge }}">{{ ucfirst($renta->estatus) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-zinc-600">No tienes rentas
                                registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts::app>
