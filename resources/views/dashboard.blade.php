<x-layouts::app :title="__('Dashboard')">
<div class="max-w-6xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <div class="h-7 w-1 rounded-full bg-red-600"></div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Dashboard</h1>
        </div>
        <p class="text-sm text-zinc-500 ml-4">Bienvenido, {{ auth()->user()->name }} — {{ now()->format('d/m/Y') }}</p>
    </div>

    {{-- Cards de estadísticas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        {{-- Películas --}}
        <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold uppercase tracking-widest text-zinc-500">Películas</span>
                <div class="h-8 w-8 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-white">{{ \App\Models\Pelicula::count() }}</p>
            <p class="text-xs text-zinc-500 mt-1">en el catálogo</p>
        </div>

        {{-- Clientes --}}
        <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold uppercase tracking-widest text-zinc-500">Clientes</span>
                <div class="h-8 w-8 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-white">{{ \App\Models\Cliente::count() }}</p>
            <p class="text-xs text-zinc-500 mt-1">registrados</p>
        </div>

        {{-- Rentas activas --}}
        <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-blue-600 to-transparent"></div>
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold uppercase tracking-widest text-zinc-500">Rentas activas</span>
                <div class="h-8 w-8 rounded-lg bg-blue-600/10 border border-blue-600/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-white">{{ \App\Models\Renta::where('estatus','activa')->count() }}</p>
            <p class="text-xs text-zinc-500 mt-1">en curso</p>
        </div>

        {{-- Rentas vencidas --}}
        <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-yellow-600 to-transparent"></div>
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold uppercase tracking-widest text-zinc-500">Vencidas</span>
                <div class="h-8 w-8 rounded-lg bg-yellow-600/10 border border-yellow-600/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold text-white">{{ \App\Models\Renta::where('estatus','vencida')->count() }}</p>
            <p class="text-xs text-zinc-500 mt-1">por resolver</p>
        </div>

    </div>

    {{-- Fila inferior: últimas rentas + accesos rápidos --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Últimas rentas --}}
        <div class="lg:col-span-2 bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="h-[2px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
            <div class="px-6 py-4 border-b border-zinc-800 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-white">Últimas rentas</h2>
                <a href="{{ route('rentas.index') }}" class="text-xs text-red-400 hover:text-red-300 transition-colors">Ver todas →</a>
            </div>
            <div class="divide-y divide-zinc-800/50">
                @forelse(\App\Models\Renta::with(['cliente','pelicula'])->latest()->take(5)->get() as $renta)
                @php
                    $badge = match($renta->estatus) {
                        'activa'   => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                        'devuelta' => 'bg-green-500/10 text-green-400 border-green-500/20',
                        'vencida'  => 'bg-red-500/10 text-red-400 border-red-500/20',
                        default    => '',
                    };
                @endphp
                <div class="px-6 py-3 flex items-center justify-between hover:bg-white/[0.02] transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                            {{ strtoupper(substr($renta->cliente->nombre, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">{{ $renta->cliente->nombre }}</p>
                            <p class="text-xs text-zinc-500">{{ $renta->pelicula->titulo }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-zinc-600">{{ \Carbon\Carbon::parse($renta->fecha_devolucion)->format('d/m/Y') }}</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium border {{ $badge }}">
                            {{ ucfirst($renta->estatus) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-zinc-600 text-sm">Sin rentas registradas.</div>
                @endforelse
            </div>
        </div>

        {{-- Accesos rápidos --}}
        <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden">
            <div class="h-[2px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
            <div class="px-6 py-4 border-b border-zinc-800">
                <h2 class="text-sm font-semibold text-white">Accesos rápidos</h2>
            </div>
            <div class="p-4 flex flex-col gap-2">

                <a href="{{ route('peliculas.create') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700/50 hover:border-zinc-600 transition-all group">
                    <div class="h-8 w-8 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">Nueva película</p>
                        <p class="text-xs text-zinc-500">Agregar al catálogo</p>
                    </div>
                </a>

                <a href="{{ route('clientes.create') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700/50 hover:border-zinc-600 transition-all">
                    <div class="h-8 w-8 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">Nuevo cliente</p>
                        <p class="text-xs text-zinc-500">Registrar cliente</p>
                    </div>
                </a>

                <a href="{{ route('rentas.create') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700/50 hover:border-zinc-600 transition-all">
                    <div class="h-8 w-8 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">Nueva renta</p>
                        <p class="text-xs text-zinc-500">Registrar renta</p>
                    </div>
                </a>

                <a href="{{ route('pdf.rentas') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700/50 hover:border-zinc-600 transition-all">
                    <div class="h-8 w-8 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">Reporte PDF</p>
                        <p class="text-xs text-zinc-500">Descargar reporte</p>
                    </div>
                </a>

            </div>
        </div>

    </div>
</div>
</x-layouts::app>