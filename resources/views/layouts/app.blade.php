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

        <!-- TomSelect CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
            body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
            #sidebar { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
            #sidebar::-webkit-scrollbar { width: 4px; }
            #sidebar::-webkit-scrollbar-track { background: transparent; }
            #sidebar::-webkit-scrollbar-thumb { background: #334155; border-radius: 9999px; }

            /* TomSelect Custom Animations & Styling */
            .ts-wrapper { width: 100%; position: relative; }
            .ts-wrapper::after { content: ""; position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); width: 1.2em; height: 1.2em; background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: center; pointer-events: none; transition: transform 0.2s ease; z-index: 1; }
            .ts-wrapper.focus::after { transform: translateY(-50%) rotate(180deg); background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='%236366f1'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5' /%3E%3C/svg%3E"); }
            .ts-control { border-radius: 0.5rem !important; border-color: #cbd5e1 !important; padding: 0.5rem 2.5rem 0.5rem 0.75rem !important; min-height: 2.5rem !important; display: flex; align-items: center; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05) !important; font-size: 0.875rem !important; line-height: 1.25rem !important; background-color: #fff !important; cursor: pointer; }
            .ts-control.focus { border-color: #6366f1 !important; box-shadow: 0 0 0 2px #e0e7ff !important; outline: none !important; }
            .ts-dropdown { border-radius: 0.5rem !important; border: 1px solid #e2e8f0 !important; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1) !important; margin-top: 0.25rem !important; animation: ts-slide-down 0.2s cubic-bezier(0.16, 1, 0.3, 1) forwards; transform-origin: top; overflow: hidden; background-color: #fff !important; }
            @keyframes ts-slide-down {
                0% { opacity: 0; transform: translateY(-5px) scaleY(0.95); }
                100% { opacity: 1; transform: translateY(0) scaleY(1); }
            }
            .ts-dropdown .option { padding: 0.5rem 0.75rem !important; font-size: 0.875rem !important; transition: background-color 0.1s ease; }
            .ts-dropdown .option.active, .ts-dropdown .option:hover { background-color: #eff6ff !important; color: #1d4ed8 !important; }
            .ts-dropdown .dropdown-input { border-radius: 0.375rem !important; border: 1px solid #cbd5e1 !important; margin: 0.5rem !important; width: calc(100% - 1rem) !important; font-size: 0.875rem !important; padding: 0.375rem 0.75rem !important; }
            .ts-dropdown .dropdown-input:focus { border-color: #6366f1 !important; outline: none !important; ring: 2px; }

            /* ── Glassmorphism ── */
            .glass-panel {
                background: rgba(255, 255, 255, 0.55);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.4);
                border-radius: 1rem;
                box-shadow: 0 8px 32px rgba(59, 130, 246, 0.08);
                transition: all 0.3s ease;
            }
            .glass-panel:hover {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(16px);
                border-color: rgba(59, 130, 246, 0.3);
                box-shadow: 0 12px 40px rgba(59, 130, 246, 0.12);
            }
            .glass-flat {
                background: rgba(255, 255, 255, 0.55);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.4);
                box-shadow: 0 8px 32px rgba(59, 130, 246, 0.08);
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.45);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.35);
                border-radius: 1rem;
                box-shadow: 0 8px 32px rgba(59, 130, 246, 0.06);
                transition: all 0.3s ease;
            }
            .glass-card:hover {
                background: rgba(255, 255, 255, 0.65);
                backdrop-filter: blur(16px);
                border-color: rgba(59, 130, 246, 0.35);
                box-shadow: 0 12px 40px rgba(59, 130, 246, 0.15);
            }

            /* Sidebar Collapsed Styles */
            @media (min-width: 1024px) {
                body.desktop-sidebar-collapsed #sidebar {
                    width: 4.5rem !important; /* 72px */
                    overflow-y: visible !important; /* allow popovers to show */
                    overflow-x: visible !important;
                }
                body.desktop-sidebar-collapsed #sidebar-backdrop {
                    display: none !important;
                }
                body.desktop-sidebar-collapsed #main-content {
                    padding-left: 4.5rem !important;
                }
                body.desktop-sidebar-collapsed #desktop-sidebar-toggle {
                    left: 60px !important; /* Menggeser posisi tombol mengikuti lebar mini sidebar */
                }
                body.desktop-sidebar-collapsed #sidebar-toggle-icon {
                    transform: rotate(180deg);
                }
                #desktop-sidebar-toggle {
                    transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.3s;
                }

                /* Hiding texts */
                body.desktop-sidebar-collapsed .brand-text,
                body.desktop-sidebar-collapsed .nav-heading,
                body.desktop-sidebar-collapsed .menu-text,
                body.desktop-sidebar-collapsed .user-info,
                body.desktop-sidebar-collapsed form[action$="logout"] {
                    display: none !important;
                }

                /* Center icons only for main menu, not submenus */
                body.desktop-sidebar-collapsed #sidebar > nav > a,
                body.desktop-sidebar-collapsed #sidebar > nav > div > button,
                body.desktop-sidebar-collapsed #sidebar > nav > div > button > div,
                body.desktop-sidebar-collapsed #sidebar .brand-container {
                    justify-content: center !important;
                    padding-left: 0 !important;
                    padding-right: 0 !important;
                }

                /* Popover for dropdowns */
                body.desktop-sidebar-collapsed #sidebar .submenu-wrapper {
                    position: absolute;
                    left: 100%; /* Nempel persis di sisi kanan elemen menu */
                    top: 0;
                    width: max-content;
                    min-width: 12rem;
                    background-color: #1e293b; /* slate-800 */
                    border: 1px solid #334155; /* slate-700 */
                    border-radius: 0.75rem;
                    padding: 0.5rem;
                    margin-left: 0 !important;
                    z-index: 50;
                    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.3);
                }
                /* Hide chevron arrow in mini mode */
                body.desktop-sidebar-collapsed #sidebar .dropdown-chevron {
                    display: none !important;
                }
                /* Ensure relative positioning for popovers */
                body.desktop-sidebar-collapsed #sidebar .relative {
                    position: relative;
                }
                
                body.desktop-sidebar-collapsed #sidebar nav {
                    overflow-y: visible !important;
                    overflow-x: visible !important;
                }
            }
        </style>
        
        <script>
            // Prevent flicker on load
            if (localStorage.getItem('desktop-sidebar-collapsed') === 'true') {
                document.documentElement.classList.add('desktop-sidebar-collapsed-html'); // For immediate styling if needed
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-white via-blue-50 to-blue-100 text-slate-800">
        
        {{-- Global Loader Overlay --}}
        <div id="global-loader" class="fixed inset-0 z-[9999] bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center transition-opacity duration-300 opacity-0">
            <div class="bg-white/90 backdrop-blur-md p-5 rounded-2xl shadow-2xl flex flex-col items-center justify-center gap-3">
                <svg class="animate-spin h-10 w-10 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-xs font-semibold text-slate-500 tracking-widest animate-pulse">MEMUAT...</p>
            </div>
        </div>

        <script>
            if (localStorage.getItem('desktop-sidebar-collapsed') === 'true') {
                document.body.classList.add('desktop-sidebar-collapsed');
            }

            document.addEventListener('DOMContentLoaded', () => {
                const loader = document.getElementById('global-loader');
                
                function showLoader() {
                    loader.classList.remove('hidden');
                    loader.classList.add('flex');
                    requestAnimationFrame(() => {
                        loader.classList.remove('opacity-0');
                        loader.classList.add('opacity-100');
                    });
                }

                function hideLoader() {
                    loader.classList.remove('opacity-100');
                    loader.classList.add('opacity-0');
                    setTimeout(() => {
                        loader.classList.remove('flex');
                        loader.classList.add('hidden');
                    }, 300);
                }

                // Sembunyikan loader saat kembali dari BFCache (tombol back browser)
                window.addEventListener('pageshow', (event) => {
                    hideLoader();
                });

                // Tampilkan loader saat link diklik
                document.querySelectorAll('a').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        const href = this.getAttribute('href');
                        // Abaikan jika open in new tab, link kosong, anchor link, js, atau ctrl+click
                        if (!href || this.target === '_blank' || href.startsWith('#') || href.startsWith('javascript') || e.ctrlKey || e.metaKey || e.defaultPrevented) {
                            return;
                        }
                        showLoader();
                    });
                });

                // Tampilkan loader saat form disubmit
                document.querySelectorAll('form').forEach(form => {
                    form.addEventListener('submit', function (e) {
                        if (this.target === '_blank' || e.defaultPrevented) return;
                        
                        const submitBtn = this.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            const btnText = submitBtn.textContent.trim().toLowerCase();
                            // Khusus untuk tombol yang mengandung kata "simpan" (di dalam modal/input)
                            if (btnText.includes('simpan')) {
                                // Cegah double submit
                                if (submitBtn.disabled) {
                                    e.preventDefault();
                                    return;
                                }
                                submitBtn.disabled = true;
                                submitBtn.classList.add('opacity-80', 'cursor-not-allowed', 'pointer-events-none');
                                // Ubah isi tombol menjadi spinner kecil
                                submitBtn.innerHTML = `
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="align-middle">Menyimpan...</span>
                                `;
                            } else {
                                // Untuk form lain (misal hapus atau logout), gunakan global loader
                                showLoader();
                            }
                        } else {
                            showLoader();
                        }
                    });
                });
            });
        </script>

        <x-banner />

        <div class="min-h-screen flex overflow-x-hidden">

            {{-- ── Sidebar (partial) ── --}}
            @include('layouts.sidebar')

            {{-- ── Main content wrapper ── --}}
            <div id="main-content" class="flex-1 flex flex-col min-h-screen lg:pl-64 transition-all duration-300 ease-in-out w-full">

                {{-- Spacer for mobile top bar --}}
                <div class="h-14 lg:hidden flex-shrink-0"></div>

                {{-- Top Navbar --}}
                <nav class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16 flex-shrink-0 z-50 glass-flat">
                    {{-- Left: Page title (from header slot) --}}
                    @if (isset($header))
                        {{ $header }}
                    @endif

                    {{-- Right: Actions --}}
                    <div class="flex items-center gap-1">
                        {{-- Chat (placeholder) --}}
                        <button title="Chat" class="p-2 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-slate-100/50 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
                            </svg>
                        </button>

                        {{-- Notification (placeholder) --}}
                        <button title="Notifikasi" class="p-2 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-slate-100/50 transition-colors relative">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                            </svg>
                        </button>

                        {{-- Profile Dropdown --}}
                        <div class="ms-2 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-800 p-1.5 rounded-lg hover:bg-slate-100/50 transition-colors">
                                        <div class="size-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold text-xs">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                        <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                                        <svg class="hidden sm:block size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-slate-400">{{ __('Manage Account') }}</div>
                                    <x-dropdown-link href="{{ route('profile.show') }}">{{ __('Profile') }}</x-dropdown-link>
                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</x-dropdown-link>
                                    @endif
                                    <div class="border-t border-slate-200"></div>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </nav>

                {{-- Page Content --}}
                <main class="flex-1">
                    {{ $slot }}
                </main>

            </div>
        </div>

        @stack('modals')

        @livewireScripts

        <!-- TomSelect JS -->
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
        <script>
            // Initialize TomSelect globally
            function initTomSelects() {
                document.querySelectorAll('select:not(.tomselected)').forEach(selectEl => {
                    // Cek opsi: jika sedikit, matikan fitur pencarian agar benar-benar "simple"
                    const optionsCount = selectEl.querySelectorAll('option').length;
                    
                    new TomSelect(selectEl, {
                        create: false,
                        sortField: {
                            field: "text",
                            direction: "asc"
                        },
                        // Matikan search box jika item kurang dari 8 (opsional)
                        controlInput: optionsCount > 8 ? '<input>' : null,
                        maxOptions: 50,
                        render: {
                            no_results: function(data, escape) {
                                return '<div class="no-results" style="padding: 0.5rem 0.75rem; color: #64748b; font-size: 0.875rem;">Tidak ada hasil ditemukan</div>';
                            }
                        }
                    });
                });
            }

            document.addEventListener('DOMContentLoaded', initTomSelects);
            
            // Re-initialize for dynamically added elements (Livewire / Alpine modals)
            if (typeof Livewire !== 'undefined') {
                Livewire.hook('message.processed', (message, component) => {
                    initTomSelects();
                });
            }
            
            // MutationObserver to catch Alpine.js x-show modals appearing or elements added
            const observer = new MutationObserver((mutations) => {
                let shouldInit = false;
                for (const mutation of mutations) {
                    if (mutation.addedNodes.length > 0 || mutation.attributeName === 'style' || mutation.attributeName === 'class') {
                        shouldInit = true;
                        break;
                    }
                }
                if (shouldInit) {
                    // Small delay to let DOM settle
                    setTimeout(initTomSelects, 50);
                }
            });
            observer.observe(document.body, { childList: true, subtree: true, attributes: true, attributeFilter: ['style', 'class'] });
        </script>

    </body>
</html>
