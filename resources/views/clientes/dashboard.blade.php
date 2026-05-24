<x-layouts::app :title="__('Mi Dashboard')">
<div class="max-w-4xl mx-auto px-6 py-8">

    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <div class="h-7 w-1 rounded-full bg-red-600"></div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Mi cuenta</h1>
        </div>
        <p class="text-sm text-zinc-500 ml-4">Hola, {{ auth()->user()->name }}</p>
    </div>

    {{-- Stats cliente --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-red-600"></div>
            <p class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500 mb-3">Total rentas</p>
            <p class="text-4xl font-bold text-white">{{ $totalRentas }}</p>
            <p class="text-xs text-zinc-600 mt-1">historial completo</p>
        </div>
        <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-blue-600"></div>
            <p class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500 mb-3">Rentas activas</p>
            <p class="text-4xl font-bold text-white">{{ $rentasActivas }}</p>
            <p class="text-xs text-zinc-600 mt-1">en curso</p>
        </div>
    </div>

    {{-- Mis últimas rentas --}}
    <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden mb-4">
        <div class="h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
        <div class="px-6 py-4 border-b border-zinc-800 flex justify-between items-center">
            <h2 class="text-sm font-semibold text-white">Mis últimas rentas</h2>
            <a href="{{ route('cliente.mis-rentas') }}" class="text-xs text-red-400 hover:text-red-300">Ver todas →</a>
        </div>
        <div class="divide-y divide-zinc-800/50">
            @forelse($misRentas as $renta)
            @php $badge = match($renta->estatus) { 'activa'=>'bg-blue-500/10 text-blue-400 border-blue-500/20','devuelta'=>'bg-green-500/10 text-green-400 border-green-500/20','vencida'=>'bg-red-500/10 text-red-400 border-red-500/20',default=>'' }; @endphp
            <div class="px-6 py-4 flex items-center justify-between hover:bg-white/[0.02]">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">{{ $renta->pelicula->titulo }}</p>
                        <p class="text-xs text-zinc-500">Devolver: {{ \Carbon\Carbon::parse($renta->fecha_devolucion)->format('d/m/Y') }}</p>
                    </div>
                </div>
                <span class="px-2 py-0.5 rounded-full text-xs font-medium border {{ $badge }}">{{ ucfirst($renta->estatus) }}</span>
            </div>
            @empty
            <div class="px-6 py-10 text-center text-zinc-600 text-sm">No tienes rentas registradas.</div>
            @endforelse
        </div>
    </div>

    <a href="{{ route('cliente.catalogo') }}"
       class="flex items-center justify-center gap-2 w-full bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl px-5 py-3 transition-colors shadow-lg shadow-red-900/30">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
        </svg>
        Ver catálogo de películas
    </a>
</div>
</x-layouts::app>