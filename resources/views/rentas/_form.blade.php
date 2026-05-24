<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

    <div class="flex flex-col gap-1.5">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Cliente</label>
        <select name="cliente_id" required
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
            <option value="">-- Selecciona un cliente --</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('cliente_id', $renta->cliente_id ?? '') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nombre }}
                </option>
            @endforeach
        </select>
        @error('cliente_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Película</label>
        <select name="pelicula_id" required
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
            <option value="">-- Selecciona una película --</option>
            @foreach($peliculas as $pelicula)
                <option value="{{ $pelicula->id }}" {{ old('pelicula_id', $renta->pelicula_id ?? '') == $pelicula->id ? 'selected' : '' }}>
                    {{ $pelicula->titulo }} ({{ $pelicula->copias_disponibles }} copias)
                </option>
            @endforeach
        </select>
        @error('pelicula_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Fecha de renta</label>
        <input type="date" name="fecha_renta" value="{{ old('fecha_renta', isset($renta) ? \Carbon\Carbon::parse($renta->fecha_renta)->format('Y-m-d') : date('Y-m-d')) }}" required
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
        @error('fecha_renta') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Fecha de devolución</label>
        <input type="date" name="fecha_devolucion" value="{{ old('fecha_devolucion', isset($renta) ? \Carbon\Carbon::parse($renta->fecha_devolucion)->format('Y-m-d') : '') }}" required
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
        @error('fecha_devolucion') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-1.5 sm:col-span-2">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Estatus</label>
        <div class="grid grid-cols-3 gap-3">
            @foreach(['activa' => ['text' => 'Activa', 'color' => 'blue'], 'devuelta' => ['text' => 'Devuelta', 'color' => 'green'], 'vencida' => ['text' => 'Vencida', 'color' => 'red']] as $val => $opt)
            <label class="relative cursor-pointer">
                <input type="radio" name="estatus" value="{{ $val }}"
                    {{ old('estatus', $renta->estatus ?? 'activa') == $val ? 'checked' : '' }}
                    class="peer sr-only">
                <div class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg border border-zinc-700 peer-checked:border-{{ $opt['color'] }}-500 peer-checked:bg-{{ $opt['color'] }}-500/10 text-zinc-400 peer-checked:text-{{ $opt['color'] }}-400 text-sm font-medium transition-all">
                    <span class="h-2 w-2 rounded-full bg-{{ $opt['color'] }}-400"></span>
                    {{ $opt['text'] }}
                </div>
            </label>
            @endforeach
        </div>
    </div>

    <div class="flex gap-3 sm:col-span-2 pt-2">
        <a href="{{ route('admin.rentas.index') }}"
            class="w-full text-center bg-transparent border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white text-sm font-medium rounded-lg px-5 py-2.5 transition-all">
            Cancelar
        </a>
        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-5 py-2.5 transition-colors shadow-lg shadow-red-900/30">
            Guardar
        </button>
    </div>

</div>