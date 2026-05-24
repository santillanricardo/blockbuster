<x-layouts::app :title="__('Clientes')">
    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <div class="h-7 w-1 rounded-full bg-red-600"></div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">Clientes</h1>
                </div>
                <p class="text-sm text-zinc-500 ml-4">Listado de clientes registrados</p>
            </div>
            <a href="{{ route('admin.usuarios.create') }}"
                class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-5 py-2.5 transition-colors shadow-lg shadow-red-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Crear usuario
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
                <table class="w-full text-sm min-w-[700px]">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-[#0f0f0f]">
                            <th
                                class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                                Nombre</th>
                            <th
                                class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                                Correo</th>
                            <th
                                class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                                Teléfono</th>
                            <th
                                class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                                Dirección</th>
                            <th
                                class="px-6 py-4 text-left text-[10px] font-semibold uppercase tracking-widest text-zinc-500">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50">
                        @forelse($clientes as $cliente)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-red-600 flex items-center justify-center shrink-0 text-white text-xs font-bold">
                                            {{ strtoupper(substr($cliente->nombre, 0, 1)) }}
                                        </div>
                                        <span class="font-semibold text-white">{{ $cliente->nombre }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-zinc-400">{{ $cliente->correo }}</td>
                                <td class="px-6 py-4 text-zinc-400">{{ $cliente->telefono ?? '—' }}</td>
                                <td class="px-6 py-4 text-zinc-400">{{ $cliente->direccion ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.clientes.edit', $cliente) }}"
                                            class="text-xs font-medium bg-zinc-800 hover:bg-zinc-700 text-zinc-300 hover:text-white border border-zinc-700 rounded-lg px-3 py-1.5 transition-all">
                                            Editar
                                        </a>
                                        <form method="POST" action="{{ route('admin.clientes.destroy', $cliente) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Eliminar este cliente?')"
                                                class="text-xs font-medium bg-red-600/10 hover:bg-red-600/20 text-red-400 hover:text-red-300 border border-red-600/20 rounded-lg px-3 py-1.5 transition-all">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div
                                            class="h-12 w-12 rounded-full bg-zinc-800 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-zinc-500 text-sm">No hay clientes registrados.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-zinc-800">{{ $clientes->links() }}</div>
            </div>
        </div>
</x-layouts::app>
