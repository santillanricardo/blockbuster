<x-layouts::auth :title="__('Crear cuenta')">
<div class="min-h-screen bg-[#0a0a0a] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="flex flex-col items-center mb-8">
            <div class="h-14 w-14 rounded-2xl bg-red-600 flex items-center justify-center mb-4 shadow-lg shadow-red-900/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-wide">BLOCKBUSTER</h1>
            <p class="text-xs text-red-400/70 tracking-widest uppercase mt-0.5">Video Club</p>
        </div>

        {{-- Card --}}
        <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="h-[3px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
            <div class="p-8">

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-white">Crear cuenta</h2>
                    <p class="text-sm text-zinc-500 mt-1">Regístrate para rentar tus películas favoritas</p>
                </div>

                <x-auth-session-status class="mb-4 text-sm text-green-400" :status="session('status')" />

                <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
                    @csrf

                    {{-- Nombre --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Nombre completo</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors placeholder-zinc-600"
                            placeholder="Ej. Juan Pérez">
                        @error('name') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Correo --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors placeholder-zinc-600"
                            placeholder="correo@ejemplo.com">
                        @error('email') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Teléfono y Dirección --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono') }}" required
                                class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors placeholder-zinc-600"
                                placeholder="4441234567">
                            @error('telefono') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Dirección</label>
                            <input type="text" name="direccion" value="{{ old('direccion') }}" required
                                class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors placeholder-zinc-600"
                                placeholder="Av. Juárez 100">
                            @error('direccion') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Contraseña --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Contraseña</label>
                        <input type="password" name="password" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors placeholder-zinc-600"
                            placeholder="Mínimo 8 caracteres">
                        @error('password') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Confirmar contraseña --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors placeholder-zinc-600"
                            placeholder="Repite tu contraseña">
                    </div>

                    <button type="submit" data-test="register-user-button"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg px-5 py-2.5 transition-colors shadow-lg shadow-red-900/30 mt-2">
                        Crear cuenta
                    </button>
                </form>
            </div>
        </div>

        <p class="text-center text-sm text-zinc-600 mt-6">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-red-400 hover:text-red-300 font-medium transition-colors">
                Inicia sesión
            </a>
        </p>

    </div>
</div>
</x-layouts::auth>