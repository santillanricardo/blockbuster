<x-layouts::app :title="__('Dashboard Admin')">
    <div class="max-w-6xl mx-auto px-3 sm:px-6 py-4 sm:py-8">

        <div class="mb-8">
            <div class="flex items-center gap-3 mb-1">
                <div class="h-7 w-1 rounded-full bg-red-600"></div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Dashboard</h1>
            </div>
            <p class="text-sm text-zinc-500 ml-4">Bienvenido, {{ auth()->user()->name }} — {{ now()->format('d/m/Y') }}
            </p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
                <p class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500 mb-3">Películas</p>
                <p class="text-4xl font-bold text-white">{{ $stats['peliculas'] }}</p>
                <p class="text-xs text-zinc-600 mt-1">en catálogo</p>
            </div>

            <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
                <p class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500 mb-3">Clientes</p>
                <p class="text-4xl font-bold text-white">{{ $stats['clientes'] }}</p>
                <p class="text-xs text-zinc-600 mt-1">registrados</p>
            </div>

            <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-green-500 to-transparent"></div>
                <p class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500 mb-3">Rentas activas</p>
                <p class="text-4xl font-bold text-white">{{ $stats['activas'] }}</p>
                <p class="text-xs text-zinc-600 mt-1">en curso</p>
            </div>

            <div class="bg-[#141414] border border-zinc-800 rounded-2xl p-5 relative overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-yellow-500 to-transparent">
                </div>
                <p class="text-[10px] font-semibold uppercase tracking-widest text-zinc-500 mb-3">Vencidas</p>
                <p class="text-4xl font-bold text-white">{{ $stats['vencidas'] }}</p>
                <p class="text-xs text-zinc-600 mt-1">por resolver</p>
            </div>

        </div>

        {{-- Gráficos --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

            <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
                <div class="px-6 py-4 border-b border-zinc-800">
                    <h2 class="text-sm font-semibold text-white">Rentas por mes</h2>
                </div>
                <div class="p-6">
                    <canvas id="chartRentas"></canvas>
                </div>
            </div>

            <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
                <div class="px-6 py-4 border-b border-zinc-800">
                    <h2 class="text-sm font-semibold text-white">Películas por género</h2>
                </div>
                <div class="p-6 flex items-center justify-center">
                    <canvas id="chartGeneros"></canvas>
                </div>
            </div>

        </div>

        {{-- Últimas rentas + Accesos rápidos --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <div class="lg:col-span-2 bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
                <div class="px-6 py-4 border-b border-zinc-800 flex justify-between items-center">
                    <h2 class="text-sm font-semibold text-white">Últimas rentas</h2>
                    <a href="{{ route('admin.rentas.index') }}" class="text-xs text-red-400 hover:text-red-300">Ver
                        todas →</a>
                </div>
                <div class="divide-y divide-zinc-800/50">
                    @forelse($ultimasRentas as $renta)
                        @php
                            $badge = match ($renta->estatus) {
                                'activa' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                'devuelta' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                'vencida' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                default => '',
                            };
                        @endphp
                        <div class="px-6 py-3 flex items-center justify-between hover:bg-white/[0.02]">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-8 w-8 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($renta->cliente->nombre, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $renta->cliente->nombre }}</p>
                                    <p class="text-xs text-zinc-500">{{ $renta->pelicula->titulo }}</p>
                                </div>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded-full text-xs font-medium border {{ $badge }}">{{ ucfirst($renta->estatus) }}</span>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-zinc-600 text-sm">Sin rentas.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden">
                <div class="h-[2px] bg-gradient-to-r from-red-600 to-transparent"></div>
                <div class="px-6 py-4 border-b border-zinc-800">
                    <h2 class="text-sm font-semibold text-white">Accesos rápidos</h2>
                </div>
                <div class="p-4 flex flex-col gap-2">
                    @foreach ([['href' => route('admin.peliculas.create'), 'label' => 'Nueva película', 'sub' => 'Agregar al catálogo'], ['href' => route('admin.usuarios.create'), 'label' => 'Crear usuario', 'sub' => 'Nuevo cliente con acceso'], ['href' => route('admin.rentas.create'), 'label' => 'Nueva renta', 'sub' => 'Registrar renta'], ['href' => route('admin.pdf.rentas'), 'label' => 'Reporte PDF', 'sub' => 'Descargar reporte']] as $link)
                        <a href="{{ $link['href'] }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700/50 hover:border-zinc-600 transition-all">
                            <div
                                class="h-8 w-8 rounded-lg bg-red-600/10 border border-red-600/20 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">{{ $link['label'] }}</p>
                                <p class="text-xs text-zinc-500">{{ $link['sub'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function inicializarGraficas() {
            const chartRentas = Chart.getChart('chartRentas');
            const chartGeneros = Chart.getChart('chartGeneros');
            if (chartRentas) chartRentas.destroy();
            if (chartGeneros) chartGeneros.destroy();

            const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            const rentasPorMes = @json($rentasPorMes);
            const labels = Object.keys(rentasPorMes).map(m => meses[parseInt(m) - 1]);
            const valores = Object.values(rentasPorMes);

            new Chart(document.getElementById('chartRentas'), {
                type: 'bar',
                data: {
                    labels: labels.length ? labels : ['Sin datos'],
                    datasets: [{
                        label: 'Rentas',
                        data: valores.length ? valores : [0],
                        backgroundColor: 'rgba(99,102,241,0.7)',
                        borderColor: 'rgba(99,102,241,1)',
                        borderWidth: 1,
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2.5,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#71717a'
                            },
                            grid: {
                                color: '#27272a'
                            }
                        },
                        y: {
                            ticks: {
                                color: '#71717a'
                            },
                            grid: {
                                color: '#27272a'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            const generos = @json($porGenero->pluck('total', 'genero'));
            new Chart(document.getElementById('chartGeneros'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(generos),
                    datasets: [{
                        data: Object.values(generos),
                        backgroundColor: [
                            '#6366f1', '#8b5cf6', '#ec4899',
                            '#14b8a6', '#f59e0b', '#3b82f6',
                            '#10b981', '#f97316', '#06b6d4'
                        ],
                        borderColor: '#141414',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 1.8,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#71717a',
                                padding: 10,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', inicializarGraficas);
        document.addEventListener('livewire:navigated', inicializarGraficas);
    </script>
</x-layouts::app>
