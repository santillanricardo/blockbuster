<flux:dropdown position="bottom" align="start">

    {{-- Trigger personalizado con foto --}}
    <button data-test="sidebar-menu-button"
        class="flex w-full items-center gap-3 rounded-lg px-2 py-2 hover:bg-zinc-800 transition-colors">
        @if(auth()->user()->foto)
            <img src="{{ Storage::url(auth()->user()->foto) }}"
                 class="h-8 w-8 rounded-full object-cover shrink-0">
        @else
            <div class="h-8 w-8 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        @endif
        <div class="flex-1 text-start text-sm leading-tight min-w-0">
            <p class="text-white font-medium truncate">{{ auth()->user()->name }}</p>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-zinc-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
        </svg>
    </button>

    <flux:menu>
        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
            @if(auth()->user()->foto)
                <img src="{{ Storage::url(auth()->user()->foto) }}"
                     class="h-8 w-8 rounded-full object-cover">
            @else
                <div class="h-8 w-8 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
            <div class="grid flex-1 text-start text-sm leading-tight">
                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
            </div>
        </div>
        <flux:menu.separator />
        <flux:menu.radio.group>
            <flux:menu.item :href="route('perfil.edit')" icon="user-circle" wire:navigate>
                Mi Perfil
            </flux:menu.item>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer"
                    data-test="logout-button"
                >
                    {{ __('Log out') }}
                </flux:menu.item>
            </form>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>