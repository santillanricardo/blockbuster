<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockbuster Video Club</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0a0a0a] min-h-screen flex flex-col overflow-x-hidden">

    {{-- Navbar --}}
    <nav class="border-b border-zinc-800 px-6 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-lg bg-red-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-white tracking-wide">BLOCKBUSTER</p>
                    <p class="text-[10px] text-red-400/70 tracking-widest uppercase">Video Club</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="text-sm text-zinc-400 hover:text-white transition-colors px-4 py-2">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}"
                    class="text-sm font-semibold bg-red-600 hover:bg-red-700 text-white rounded-lg px-4 py-2 transition-colors">
                    Registrarse
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <main class="flex-1 flex items-center">
        <div class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div>
                <div
                    class="inline-flex items-center gap-2 bg-red-600/10 border border-red-600/20 rounded-full px-3 py-1 mb-6">
                    <span class="h-1.5 w-1.5 rounded-full bg-red-500 animate-pulse"></span>
                    <span class="text-xs text-red-400 font-medium">Disponible ahora</span>
                </div>

                <h1 class="text-5xl font-bold text-white leading-tight mb-4">
                    Tu videoteca<br>
                    <span class="text-red-600">favorita</span>,<br>
                    ahora en línea.
                </h1>

                <p class="text-zinc-400 text-lg mb-8 leading-relaxed">
                    Renta tus películas favoritas desde casa. Catálogo actualizado, entregas rápidas y el mejor servicio
                    de Blockbuster.
                </p>

                <div class="flex items-center gap-4">
                    <a href="{{ route('register') }}"
                        class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl px-6 py-3 transition-colors shadow-lg shadow-red-900/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Crear cuenta gratis
                    </a>
                    <a href="{{ route('login') }}"
                        class="text-zinc-400 hover:text-white text-sm font-medium transition-colors">
                        Ya tengo cuenta →
                    </a>
                </div>

                {{-- Stats --}}
                <div class="flex items-center gap-8 mt-12 pt-8 border-t border-zinc-800">
                    <div>
                        <p class="text-2xl font-bold text-white">{{ \App\Models\Pelicula::count() }}+</p>
                        <p class="text-xs text-zinc-500">Películas</p>
                    </div>
                    <div class="h-8 w-px bg-zinc-800"></div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ \App\Models\Cliente::count() }}+</p>
                        <p class="text-xs text-zinc-500">Clientes</p>
                    </div>
                    <div class="h-8 w-px bg-zinc-800"></div>
                    <div>
                        <p class="text-2xl font-bold text-white">{{ \App\Models\Renta::count() }}+</p>
                        <p class="text-xs text-zinc-500">Rentas</p>
                    </div>
                </div>
            </div>

            {{-- Catálogo preview --}}
            <div class="hidden lg:grid grid-cols-2 gap-4">
                @foreach (\App\Models\Pelicula::take(4)->get() as $pelicula)
                    <div
                        class="bg-[#141414] border border-zinc-800 rounded-2xl p-4 hover:border-red-600/30 transition-all relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-red-600 to-transparent">
                        </div>
                        <div
                            class="h-10 w-10 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-white mb-1">{{ $pelicula->titulo }}</p>
                        <p class="text-xs text-zinc-500 mb-2">{{ $pelicula->genero }} · {{ $pelicula->anio }}</p>
                        @if ($pelicula->copias_disponibles > 0)
                            <span class="flex items-center gap-1 text-xs text-green-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span> Disponible
                            </span>
                        @else
                            <span class="flex items-center gap-1 text-xs text-red-400">
                                <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span> Sin stock
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </main>

    {{-- Footer --}}
    <footer class="border-t border-zinc-800 px-6 py-4">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <p class="text-xs text-zinc-600">© {{ date('Y') }} Blockbuster Video Club. Todos los derechos
                reservados.</p>
            <p class="text-xs text-zinc-600">Hecho con ❤️ en Laravel</p>
        </div>
    </footer>

</body>

</html>
