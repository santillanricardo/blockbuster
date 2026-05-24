<x-layouts::app :title="__('Nuevo Usuario')">
<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <div class="h-7 w-1 rounded-full bg-red-600"></div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Nuevo Usuario</h1>
        </div>
        <p class="text-sm text-zinc-500 ml-4">Crea un usuario cliente y envía sus credenciales por correo</p>
    </div>

    <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="h-[3px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
        <div class="p-6">

            @if($errors->any())
                <div class="mb-5 text-sm text-red-400 bg-red-500/10 border border-red-500/20 rounded-xl px-4 py-3">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.usuarios.store') }}">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div class="flex flex-col gap-1.5 sm:col-span-2">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Nombre completo</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                            placeholder="Ej. Juan Pérez">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                            placeholder="correo@ejemplo.com">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Contraseña temporal</label>
                        <input type="text" name="password" value="{{ old('password') }}" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                            placeholder="Mínimo 8 caracteres">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}"
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                            placeholder="Ej. 4441234567">
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Dirección</label>
                        <input type="text" name="direccion" value="{{ old('direccion') }}"
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors"
                            placeholder="Ej. Av. Juárez 100">
                    </div>

                    <div class="flex gap-3 sm:col-span-2 pt-2">
                        <a href="{{ route('admin.clientes.index') }}"
                            class="w-full text-center bg-transparent border border-zinc-700 hover:border-zinc-500 text-zinc-400 hover:text-white text-sm font-medium rounded-lg px-5 py-2.5 transition-all">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg px-5 py-2.5 transition-colors shadow-lg shadow-red-900/30">
                            Crear usuario y enviar correo
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</x-layouts::app>