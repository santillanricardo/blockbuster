<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

    <div class="flex flex-col gap-1.5 sm:col-span-2">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo', $pelicula->titulo ?? '') }}" required
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
            placeholder="Ej. El Padrino">
        @error('titulo') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Género</label>
        <select name="genero"
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
            @foreach(['Acción','Comedia','Drama','Terror','Romance','Ciencia Ficción','Animación','Crimen','Thriller'] as $g)
                <option value="{{ $g }}" {{ old('genero', $pelicula->genero ?? '') == $g ? 'selected' : '' }}>{{ $g }}</option>
            @endforeach
        </select>
        @error('genero') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Año</label>
        <input type="number" name="anio" value="{{ old('anio', $pelicula->anio ?? date('Y')) }}" min="1888" max="{{ date('Y') }}" required
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
        @error('anio') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-1.5">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Copias disponibles</label>
        <input type="number" name="copias_disponibles" value="{{ old('copias_disponibles', $pelicula->copias_disponibles ?? 1) }}" min="0" required
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
        @error('copias_disponibles') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-1.5 sm:col-span-2">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Sinopsis</label>
        <textarea name="sinopsis" rows="3"
            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors resize-none"
            placeholder="Descripción breve de la película...">{{ old('sinopsis', $pelicula->sinopsis ?? '') }}</textarea>
    </div>

    {{-- Imagen / Poster --}}
    <div class="flex flex-col gap-1.5 sm:col-span-2">
        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Poster / Imagen</label>
        <div class="flex items-center gap-4">
            {{-- Preview actual --}}
            <div id="preview-container" class="shrink-0">
                @if(isset($pelicula) && $pelicula->imagen)
                    <img id="preview-img" src="{{ Storage::url($pelicula->imagen) }}"
                         class="h-32 w-24 object-cover rounded-lg border border-zinc-700">
                @else
                    <div id="preview-placeholder" class="h-32 w-24 rounded-lg border border-dashed border-zinc-600 flex items-center justify-center bg-zinc-800/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <img id="preview-img" src="" class="h-32 w-24 object-cover rounded-lg border border-zinc-700 hidden">
                @endif
            </div>
            <div class="flex-1">
                <label for="imagen" class="flex items-center gap-2 cursor-pointer bg-zinc-800 hover:bg-zinc-700 border border-zinc-700 text-zinc-300 hover:text-white text-sm font-medium rounded-lg px-4 py-2.5 transition-all w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Subir imagen
                </label>
                <input type="file" id="imagen" name="imagen" accept="image/*" class="hidden" onchange="previewImagen(this)">
                <p class="text-xs text-zinc-600 mt-2">JPG, PNG. Máx 2MB. Recomendado: 300x450px</p>
            </div>
        </div>
        @error('imagen') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="flex gap-3 sm:col-span-2 pt-2">
        <a href="{{ route('admin.peliculas.index') }}"
            class="w-full text-center bg-transparent border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white text-sm font-medium rounded-lg px-5 py-2.5 transition-all">
            Cancelar
        </a>
        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-5 py-2.5 transition-colors shadow-lg shadow-red-900/30">
            Guardar
        </button>
    </div>

</div>

<script>
function previewImagen(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('preview-img');
            const placeholder = document.getElementById('preview-placeholder');
            img.src = e.target.result;
            img.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>