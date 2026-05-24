<x-layouts::auth :title="__('Iniciar sesión')">
<div class="min-h-screen bg-[#0a0a0a] flex items-center justify-center px-4">
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
                    <h2 class="text-xl font-bold text-white">Iniciar sesión</h2>
                    <p class="text-sm text-zinc-500 mt-1">Ingresa tus credenciales para continuar</p>
                </div>

                <x-auth-session-status class="mb-4 text-sm text-green-400" :status="session('status')" />

                <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
                    @csrf

                    <div class="flex flex-col gap-1.5">
                        <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors placeholder-zinc-600"
                            placeholder="correo@ejemplo.com">
                        @error('email') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <div class="flex items-center justify-between">
                            <label class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500">Contraseña</label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-red-400 hover:text-red-300 transition-colors">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                        <input type="password" name="password" required
                            class="bg-[#0d0d0d] border border-zinc-700 focus:border-red-600 rounded-lg px-4 py-2.5 text-sm text-white outline-none transition-colors placeholder-zinc-600"
                            placeholder="••••••••">
                        @error('password') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember" class="rounded border-zinc-700 bg-zinc-800 text-red-600">
                        <label for="remember" class="text-sm text-zinc-400">Recordarme</label>
                    </div>

                    <button type="submit" data-test="login-button"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg px-5 py-2.5 transition-colors shadow-lg shadow-red-900/30 mt-2">
                        Iniciar sesión
                    </button>
                </form>
            </div>
        </div>

        @if(Route::has('register'))
        <p class="text-center text-sm text-zinc-600 mt-6">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-red-400 hover:text-red-300 font-medium transition-colors">
                Regístrate
            </a>
        </p>
        @endif

    </div>
</div>
</x-layouts::auth>