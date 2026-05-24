<x-layouts::app :title="__('Rentas')">
    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <div class="h-7 w-1 rounded-full bg-red-600"></div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">Rentas</h1>
                </div>
                <p class="text-sm text-zinc-500 ml-4">Historial de rentas del sistema</p>
            </div>
            <a href="{{ route('admin.rentas.create') }}"
                class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-5 py-2.5 transition-colors shadow-lg shadow-red-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nueva renta
            </a>
        </div>

        @if (session('success'))
            <div
                class="mb-5 flex items-center gap-3 text-sm text-green-400 bg-green-500/10 border border-green-500/20 rounded-xl px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="h-[3px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm min-w-[800px]">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-[#0f0f0f]">
                            <th
                                class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                                #</th>
                            <th
                                class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                                Cliente</th>
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
                            <th
                                class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50">
                        @forelse($rentas as $renta)
                            @php
                                $badge = match ($renta->estatus) {
                                    'activa' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'devuelta' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    'vencida' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                    default => 'bg-zinc-500/10 text-zinc-400 border-zinc-500/20',
                                };
                                $dot = match ($renta->estatus) {
                                    'activa' => 'bg-blue-400',
                                    'devuelta' => 'bg-green-400',
                                    'vencida' => 'bg-red-400',
                                    default => 'bg-zinc-400',
                                };
                            @endphp
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4 text-zinc-600 font-mono text-xs">{{ $renta->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="h-7 w-7 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                                            {{ strtoupper(substr($renta->cliente->nombre, 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-white">{{ $renta->cliente->nombre }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-zinc-300">{{ $renta->pelicula->titulo }}</td>
                                <td class="px-6 py-4 text-zinc-400 text-xs">
                                    {{ \Carbon\Carbon::parse($renta->fecha_renta)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-zinc-400 text-xs">
                                    {{ \Carbon\Carbon::parse($renta->fecha_devolucion)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="flex items-center gap-1.5 w-fit px-2.5 py-1 rounded-full text-xs font-semibold border {{ $badge }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $dot }}"></span>
                                        {{ ucfirst($renta->estatus) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.rentas.edit', $renta) }}"
                                            class="text-xs font-medium bg-zinc-800 hover:bg-zinc-700 text-zinc-300 hover:text-white border border-zinc-700 rounded-lg px-3 py-1.5 transition-all">
                                            Editar
                                        </a>
                                        <form method="POST" action="{{ route('admin.rentas.destroy', $renta) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Eliminar esta renta?')"
                                                class="text-xs font-medium bg-red-600/10 hover:bg-red-600/20 text-red-400 hover:text-red-300 border border-red-600/20 rounded-lg px-3 py-1.5 transition-all">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div
                                            class="h-12 w-12 rounded-full bg-zinc-800 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                            </svg>
                                        </div>
                                        <p class="text-zinc-500 text-sm">No hay rentas registradas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-zinc-800">{{ $rentas->links() }}</div>
            </div>
        </div>
</x-layouts::app>
