<x-layouts::app :title="__('Nueva Renta')">
<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <div class="h-7 w-1 rounded-full bg-red-600"></div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Nueva Renta</h1>
        </div>
        <p class="text-sm text-zinc-500 ml-4">Registra una nueva renta de película</p>
    </div>

    <div class="bg-[#141414] border border-zinc-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="h-[3px] bg-gradient-to-r from-red-600 via-red-500 to-transparent"></div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.rentas.store') }}">
                @csrf
                @include('rentas._form')
            </form>
        </div>
    </div>
</div>
</x-layouts::app>