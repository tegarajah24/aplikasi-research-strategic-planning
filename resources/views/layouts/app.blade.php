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
            #sidebar { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
            #sidebar::-webkit-scrollbar { width: 4px; }
            #sidebar::-webkit-scrollbar-track { background: transparent; }
            #sidebar::-webkit-scrollbar-thumb { background: #334155; border-radius: 9999px; }
            
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
                body.desktop-sidebar-collapsed #sidebar > nav > div > details > summary,
                body.desktop-sidebar-collapsed #sidebar > nav > div > details > summary > div,
                body.desktop-sidebar-collapsed #sidebar .brand-container {
                    justify-content: center !important;
                    padding-left: 0 !important;
                    padding-right: 0 !important;
                }

                /* Popover for dropdowns */
                body.desktop-sidebar-collapsed #sidebar details > div {
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
                    display: none !important; /* Sembunyikan meski statusnya 'open' dari server */
                }
                body.desktop-sidebar-collapsed #sidebar details:hover > div {
                    display: block !important; /* Hanya tampilkan saat dihover */
                }
                /* Hide chevron arrow in mini mode */
                body.desktop-sidebar-collapsed #sidebar details > summary > svg:last-child {
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
    <body class="font-sans antialiased bg-slate-50 text-slate-800">
        
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
