<x-layouts::app :title="__('Mi Perfil')">
<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <div class="h-7 w-1 rounded-full bg-red-600"></div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Mi Perfil</h1>
        </div>
        <p class="text-sm text-zinc-500 ml-4">Administra tu información personal</p>
    </div>

    {{-- Datos personales --}}
    <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden shadow-xl mb-5">
        <div class="h-[3px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
        <div class="px-6 py-4 border-b border-zinc-800">
            <h2 class="text-sm font-semibold text-white">Información personal</h2>
        </div>
        <div class="p-6">

            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 text-sm text-green-400 bg-green-500/10 border border-green-500/20 rounded-xl px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="flex items-center gap-6 mb-6">

                    {{-- Avatar --}}
                    <div class="relative shrink-0">
                        @if($user->foto)
                            <img src="{{ Storage::url($user->foto) }}"
                                 class="h-20 w-20 rounded-full object-cover border-2 border-red-600">
                        @else
                            <div class="h-20 w-20 rounded-full bg-red-600 flex items-center justify-center text-white text-2xl font-bold border-2 border-red-700">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <label for="foto" class="absolute bottom-0 right-0 h-6 w-6 rounded-full bg-zinc-700 hover:bg-zinc-600 border border-zinc-600 flex items-center justify-center cursor-pointer transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                        <input type="file" id="foto" name="foto" accept="image/*" class="hidden"
                            onchange="previewFoto(this)">
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                        <p class="text-xs text-zinc-500">{{ $user->email }}</p>
                        <p class="text-xs text-red-400 mt-1 capitalize">{{ $user->getRoleNames()->first() }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
                        @error('name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
                        @error('email') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if(auth()->user()->hasRole('cliente'))
                    @php $clienteData = \App\Models\Cliente::where('correo', auth()->user()->email)->first(); @endphp
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $clienteData->telefono ?? '') }}" required
                                class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                                placeholder="Ej. 4441234567" >
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Dirección</label>
                            <input type="text" name="direccion" value="{{ old('direccion', $clienteData->direccion ?? '') }}" required
                                class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                                placeholder="Ej. Av. Juárez 100">
                        </div>
                    @endif

                </div>

                <div class="flex justify-end mt-5">
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-6 py-2.5 transition-colors">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Cambiar contraseña --}}
    <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="h-[3px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
        <div class="px-6 py-4 border-b border-zinc-800">
            <h2 class="text-sm font-semibold text-white">Cambiar contraseña</h2>
        </div>
        <div class="p-6">

            @if(session('success_password'))
                <div class="mb-5 flex items-center gap-3 text-sm text-green-400 bg-green-500/10 border border-green-500/20 rounded-xl px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success_password') }}
                </div>
            @endif

            <form method="POST" action="{{ route('perfil.password') }}">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 gap-4">

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Contraseña actual</label>
                        <input type="password" name="current_password"
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
                        @error('current_password') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Nueva contraseña</label>
                        <input type="password" name="password"
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
                        @error('password') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation"
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors">
                    </div>

                </div>

                <div class="flex justify-end mt-5">
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-6 py-2.5 transition-colors">
                        Actualizar contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.querySelector('img.rounded-full') || document.querySelector('.h-20.w-20.rounded-full');
            if (img && img.tagName === 'IMG') {
                img.src = e.target.result;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</x-layouts::app>