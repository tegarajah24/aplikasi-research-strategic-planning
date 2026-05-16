<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RSP-UHB') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
            body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
            #sidebar { transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
            #sidebar::-webkit-scrollbar { width: 4px; }
            #sidebar::-webkit-scrollbar-track { background: transparent; }
            #sidebar::-webkit-scrollbar-thumb { background: #334155; border-radius: 9999px; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800">

        <x-banner />

        <div class="min-h-screen flex">

            {{-- ── Sidebar (partial) ── --}}
            @include('layouts.sidebar')

            {{-- ── Main content wrapper ── --}}
            <div class="flex-1 flex flex-col min-h-screen lg:pl-64">

                {{-- Spacer for mobile top bar --}}
                <div class="h-14 lg:hidden flex-shrink-0"></div>

                {{-- Page Heading --}}
                @if (isset($header))
                    <header class="bg-white border-b border-slate-200 flex-shrink-0">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                {{-- Page Content --}}
                <main class="flex-1">
                    {{ $slot }}
                </main>

                {{-- Footer --}}
                <footer class="flex-shrink-0 py-3 px-6 text-center text-xs text-slate-400 border-t border-slate-200 bg-white">
                    &copy; {{ date('Y') }} <span class="font-medium text-slate-500">RSP-UHB</span> &mdash; Research Strategic Planning
                </footer>

            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
