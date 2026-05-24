<x-layouts::app :title="__('Catálogo')">
<div class="max-w-6xl mx-auto px-6 py-8">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="h-7 w-1 rounded-full bg-red-600"></div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Catálogo</h1>
            </div>
            <p class="text-sm text-zinc-500 ml-4">Explora nuestras películas disponibles</p>
        </div>
        <button onclick="document.getElementById('modal-ia').classList.remove('hidden')"
            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-4 py-2.5 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
            </svg>
            Asistente IA
        </button>
    </div>

    @if(session('success'))
        <div class="mb-5 flex items-center gap-3 text-sm text-green-400 bg-green-500/10 border border-green-500/20 rounded-xl px-4 py-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 flex items-center gap-3 text-sm text-red-400 bg-red-500/10 border border-red-500/20 rounded-xl px-4 py-3">
            {{ session('error') }}
        </div>
    @endif

    {{-- Buscador --}}
    <div class="mb-6">
        <input type="text" id="buscador"
            placeholder="Buscar película por título..."
            class="w-full bg-[#141414] border border-zinc-700 focus:border-red-600 rounded-xl px-4 py-3 text-sm text-white outline-none transition-colors"
            onkeyup="filtrarPeliculas()">
    </div>

    {{-- Grid --}}
    <div id="grid-peliculas" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($peliculas as $pelicula)
        <div class="pelicula-card bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden hover:border-zinc-600 transition-all group cursor-pointer"
             data-titulo="{{ strtolower($pelicula->titulo) }}"
             onclick="abrirModal({{ $pelicula->id }}, '{{ addslashes($pelicula->titulo) }}', {{ $pelicula->copias_disponibles }})">

            <div class="relative aspect-[2/3] bg-zinc-900">
                @if($pelicula->imagen)
                    <img src="{{ Storage::url($pelicula->imagen) }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-zinc-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                    </div>
                @endif
                <div class="absolute top-2 right-2">
                    @if($pelicula->copias_disponibles > 0)
                        <span class="flex items-center gap-1 text-xs font-semibold bg-green-500/20 text-green-400 border border-green-500/30 rounded-full px-2 py-0.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span> Disponible
                        </span>
                    @else
                        <span class="flex items-center gap-1 text-xs font-semibold bg-red-500/20 text-red-400 border border-red-500/30 rounded-full px-2 py-0.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span> Sin stock
                        </span>
                    @endif
                </div>
            </div>
            <div class="p-3">
                <h3 class="font-bold text-white text-sm mb-1 truncate">{{ $pelicula->titulo }}</h3>
                <div class="flex items-center gap-2">
                    <span class="text-xs px-2 py-0.5 rounded-full bg-zinc-800 text-zinc-400 border border-zinc-700">{{ $pelicula->genero }}</span>
                    <span class="text-xs text-zinc-600">{{ $pelicula->anio }}</span>
                </div>
                @if($pelicula->sinopsis)
                <p class="text-xs text-zinc-500 mt-2 line-clamp-2">{{ $pelicula->sinopsis }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-4 text-center py-16 text-zinc-600">No hay películas disponibles.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $peliculas->links() }}</div>
</div>

{{-- Modal Rentar --}}
<div id="modal-rentar" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center px-4">
    <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden w-full max-w-md shadow-2xl">
        <div class="h-[3px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
        <div class="px-6 py-4 border-b border-zinc-800 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-white">Rentar película</h2>
            <button onclick="cerrarModal()" class="text-zinc-500 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <div class="mb-4">
                <p class="text-xs text-zinc-500 uppercase tracking-widest mb-1">Película seleccionada</p>
                <p id="modal-titulo" class="text-white font-semibold"></p>
            </div>
            <div id="modal-sin-stock" class="hidden mb-4 text-sm text-red-400 bg-red-500/10 border border-red-500/20 rounded-xl px-4 py-3">
                Esta película no tiene copias disponibles.
            </div>
            <form id="form-rentar" method="POST" action="{{ route('cliente.rentar') }}">
                @csrf
                <input type="hidden" name="pelicula_id" id="modal-pelicula-id">
                <div class="flex flex-col gap-1.5 mb-5">
                    <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Fecha de devolución</label>
                    <input type="date" name="fecha_devolucion" id="modal-fecha"
                        min="{{ now()->addDay()->toDateString() }}"
                        class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                        required>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="cerrarModal()"
                        class="w-full text-center bg-transparent border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white text-sm font-medium rounded-lg px-5 py-2.5 transition-all">
                        Cancelar
                    </button>
                    <button type="submit" id="btn-rentar"
                        class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-5 py-2.5 transition-colors shadow-lg shadow-red-900/30">
                        Confirmar renta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Asistente IA --}}
<div id="modal-ia" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center px-4">
    <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden w-full max-w-lg shadow-2xl">
        <div class="h-[3px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
        <div class="px-6 py-4 border-b border-zinc-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-8 w-8 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h2 class="text-sm font-semibold text-white">Asistente IA — Recomendador</h2>
            </div>
            <button onclick="document.getElementById('modal-ia').classList.add('hidden')" class="text-zinc-500 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">
            <div id="chat-messages" class="mb-4 space-y-3 min-h-[80px] max-h-[250px] overflow-y-auto"></div>
            <form id="chat-form" class="flex gap-3">
                @csrf
                <input type="text" id="chat-input"
                    class="flex-1 bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                    placeholder="Ej: quiero ver algo de acción...">
                <button type="submit" id="chat-btn"
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-5 py-2.5 transition-colors shrink-0">
                    Preguntar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function abrirModal(id, titulo, copias) {
    document.getElementById('modal-pelicula-id').value = id;
    document.getElementById('modal-titulo').textContent = titulo;
    document.getElementById('modal-fecha').value = '';

    if (copias <= 0) {
        document.getElementById('modal-sin-stock').classList.remove('hidden');
        document.getElementById('btn-rentar').disabled = true;
        document.getElementById('btn-rentar').classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        document.getElementById('modal-sin-stock').classList.add('hidden');
        document.getElementById('btn-rentar').disabled = false;
        document.getElementById('btn-rentar').classList.remove('opacity-50', 'cursor-not-allowed');
    }

    document.getElementById('modal-rentar').classList.remove('hidden');
}

function cerrarModal() {
    document.getElementById('modal-rentar').classList.add('hidden');
}

function filtrarPeliculas() {
    const texto = document.getElementById('buscador').value.toLowerCase();
    document.querySelectorAll('.pelicula-card').forEach(card => {
        const titulo = card.getAttribute('data-titulo');
        card.style.display = titulo.includes(texto) ? '' : 'none';
    });
}

// Cerrar modal al hacer clic fuera
document.getElementById('modal-rentar').addEventListener('click', function(e) {
    if (e.target === this) cerrarModal();
});
document.getElementById('modal-ia').addEventListener('click', function(e) {
    if (e.target === this) this.classList.add('hidden');
});

// Chatbot IA
document.getElementById('chat-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const input = document.getElementById('chat-input');
    const btn = document.getElementById('chat-btn');
    const messages = document.getElementById('chat-messages');
    const consulta = input.value.trim();
    if (!consulta) return;

    messages.innerHTML += `<div class="flex justify-end"><div class="bg-red-600/20 border border-red-600/20 text-white text-sm rounded-xl px-4 py-2 max-w-xs">${consulta}</div></div>`;
    input.value = '';
    btn.disabled = true;
    btn.textContent = '...';
    messages.innerHTML += `<div id="loading-msg" class="flex justify-start"><div class="bg-zinc-800 border border-zinc-700 text-zinc-400 text-sm rounded-xl px-4 py-2">🎬 Buscando...</div></div>`;
    messages.scrollTop = messages.scrollHeight;

    try {
        const res = await fetch('{{ route("cliente.recomendar") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ consulta })
        });
        const data = await res.json();
        document.getElementById('loading-msg')?.remove();
        messages.innerHTML += `<div class="flex justify-start"><div class="bg-zinc-800 border border-zinc-700 text-zinc-300 text-sm rounded-xl px-4 py-2 max-w-sm leading-relaxed">🎬 ${data.respuesta.replace(/\n/g, '<br>')}</div></div>`;
    } catch(err) {
        document.getElementById('loading-msg')?.remove();
        messages.innerHTML += `<div class="flex justify-start"><div class="bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded-xl px-4 py-2">Error al conectar.</div></div>`;
    }

    btn.disabled = false;
    btn.textContent = 'Preguntar';
    messages.scrollTop = messages.scrollHeight;
});
</script>
</x-layouts::app>