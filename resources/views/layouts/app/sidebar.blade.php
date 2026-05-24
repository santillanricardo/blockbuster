<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-[#0a0a0a]">

    <flux:sidebar sticky collapsible="mobile" class="border-e border-red-900/20 bg-[#0f0f0f]">
        <flux:sidebar.header class="border-b border-red-900/20 pb-4">
            <div class="flex items-center gap-3 px-2 py-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-white tracking-wide">BLOCKBUSTER</p>
                    <p class="text-[10px] text-red-400/70 tracking-widest uppercase">Video Club</p>
                </div>
            </div>
            <flux:sidebar.collapse class="lg:hidden text-white" />
        </flux:sidebar.header>

        <flux:sidebar.nav class="mt-4">
            <flux:sidebar.group :heading="__('Menú principal')" class="grid">

                @if (auth()->user()->hasRole('admin'))
                    <flux:sidebar.item icon="home" :href="route('admin.dashboard')"
                        :current="request()->routeIs('admin.dashboard')" wire:navigate>
                        Dashboard
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="film" :href="route('admin.peliculas.index')"
                        :current="request()->routeIs('admin.peliculas.*')" wire:navigate>
                        Películas
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="users" :href="route('admin.clientes.index')"
                        :current="request()->routeIs('admin.clientes.*')" wire:navigate>
                        Clientes
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="ticket" :href="route('admin.rentas.index')"
                        :current="request()->routeIs('admin.rentas.*')" wire:navigate>
                        Rentas
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="document-arrow-down" :href="route('admin.pdf.rentas')">
                        Reporte PDF
                    </flux:sidebar.item>
                @else
                    <flux:sidebar.item icon="home" :href="route('cliente.dashboard')"
                        :current="request()->routeIs('cliente.dashboard')" wire:navigate>
                        Mi Dashboard
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="film" :href="route('cliente.catalogo')"
                        :current="request()->routeIs('cliente.catalogo')" wire:navigate>
                        Catálogo
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="ticket" :href="route('cliente.mis-rentas')"
                        :current="request()->routeIs('cliente.mis-rentas')" wire:navigate>
                        Mis Rentas
                    </flux:sidebar.item>
                @endif

            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <div class="px-3 pb-4 border-t border-red-900/20 pt-4">
            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </div>
    </flux:sidebar>

    <!-- Mobile header -->
    <flux:header class="lg:hidden border-b border-red-900/20 bg-[#0f0f0f]">
        <flux:sidebar.toggle class="lg:hidden text-white" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <flux:menu.radio.group>
                    <flux:menu.item :href="route('perfil.edit')" icon="user-circle" wire:navigate>
                        Mi Perfil
                    </flux:menu.item>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer">
                        Log out
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    
        {{ $slot }}
    

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
