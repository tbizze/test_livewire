<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }} - {{config('app.name')}}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        {{-- The navbar with `sticky` and `full-width` --}}
        <x-mary-nav full-width class="">
     
            <x-slot:brand>
                {{-- Drawer toggle for "main-drawer" --}}
                <label for="main-drawer" class="lg:hidden mr-3">
                    <x-mary-icon name="o-bars-3" class="cursor-pointer" />
                </label>
     
                {{-- Brand --}}
                <img src="{{asset('imgs/logo.png')}}" class=" h-14" alt="logo" />
            </x-slot:brand>
     
            {{-- Right side actions --}}
            <x-slot:actions>
                <x-mary-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
                <x-mary-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
    
    
                <x-mary-dropdown label="{{ Auth::user()->name }}" class="btn-ghost btn-sm" right >
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>
                    <x-mary-menu-item title="{{ __('Profile') }}" link="{{ route('profile.show') }}" icon="o-user" class=" w-40" />
    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-mary-menu-item title="{{ __('Log Out') }}" link="{{ route('logout') }}" @click.prevent="$root.submit();" icon="o-power" />
                    </form>
                </x-mary-dropdown>
            </x-slot:actions>
        </x-mary-nav>
    
        {{-- The main content with `full-width` --}}
        <x-mary-main full-width>
     
            {{-- This is a sidebar that works also as a drawer on small screens --}}
            {{-- Notice the `main-drawer` reference here --}}
            {{-- <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200 h-screen"> --}}
            <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-300/65">
     
                {{-- User --}}
                @if($user = auth()->user())
                    <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="">
                        <x-slot:actions>
                            <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-mary-list-item>
     
                    <x-mary-menu-separator />
                @endif
     
                {{-- Activates the menu item when a route matches the `link` property --}}
                <x-mary-menu activate-by-route>
                    <x-mary-menu-item title="Home" icon="o-home" link="/dashboard" />
                    
                    {{-- <x-mary-menu-item title="Faturas" icon="o-document-text" :link="route('faturas.index')" wire:navigate.hover /> --}}
                    {{-- <x-mary-menu-item title="Eventos" icon="o-calendar-days" :link="route('eventos.index')" wire:navigate.hover />  --}}
                    {{-- <x-mary-menu-item title="Calendário" icon="o-calendar-days" :link="route('evento.calendar',['mes' => '3','local' => '1','grupo' => '2'])" />  --}}
    
                    <x-mary-menu-sub title="Previsão" icon="m-adjustments-horizontal">
                        <x-mary-menu-item title="Despesas" icon="m-arrow-small-right" :link="route('prev.despesas.index')" wire:navigate />
                        <x-mary-menu-item title="Receitas" icon="m-arrow-small-right" :link="route('prev.receitas.index')" wire:navigate />
                    </x-mary-menu-sub>

                    <x-mary-menu-sub title="Documentos" icon="m-adjustments-horizontal">
                        <x-mary-menu-item title="Despesas" icon="m-arrow-small-right" :link="route('doc.despesas.index')" wire:navigate />
                        <x-mary-menu-item title="Receitas" icon="m-arrow-small-right" :link="route('doc.receitas.index')" wire:navigate />
                        <x-mary-menu-item title="Tarifas" icon="m-arrow-small-right" :link="route('doc.tarifas.index')" wire:navigate />
                        <x-mary-menu-item title="Movimento Titular" icon="m-arrow-small-right" :link="route('doc.mov-titular.index')" wire:navigate />
                    </x-mary-menu-sub>
    
                    {{-- <x-mary-menu-sub title="Recursos" icon="m-adjustments-horizontal">
                        <x-mary-menu-item title="Fatura grupos" icon="m-arrow-small-right" :link="route('fatura.grupos.index')" wire:navigate />
                        <x-mary-menu-item title="Fatura emissores" icon="m-arrow-small-right" :link="route('fatura.emissoras.index')" wire:navigate />
                        <x-mary-menu-item title="Movimento grupos" icon="m-arrow-small-right" :link="route('movimento.grupos.index')" wire:navigate />
                        <x-mary-menu-item title="Tipos pgtos" icon="m-arrow-small-right" :link="route('admin.pgto_tipos.index')" wire:navigate />
                        <x-mary-menu-item title="Status" icon="m-arrow-small-right" :link="route('admin.status.index')" wire:navigate />
                    </x-mary-menu-sub> --}}
    
                    <x-mary-menu-sub title="Configurações" icon="o-cog-6-tooth">
                        {{-- <x-mary-menu-item title="Funções" icon="m-arrow-small-right" :link="route('admin.roles.index')" wire:navigate />
                        <x-mary-menu-item title="Permissões" icon="m-arrow-small-right" :link="route('admin.permissions.index')" wire:navigate />
                        <x-mary-menu-item title="Funções por usuário" icon="m-arrow-small-right" :link="route('admin.user-has-roles.index')" wire:navigate /> --}}
                    </x-mary-menu-sub>
                </x-mary-menu>
            </x-slot:sidebar>
     
            {{-- The `$slot` goes here --}}
            <x-slot:content class=" bg-base-200/35">
                {{ $slot }}
            </x-slot:content>
        </x-mary-main>
     
        {{--  TOAST area --}}
        <x-mary-toast />
    </body>
</html>
