{{-- ─────────────────────────────────────────────────────────────── --}}
{{-- RSP-UHB Sidebar Partial                                        --}}
{{-- Usage: @include('layouts.sidebar')  in app.blade.php           --}}
{{-- ─────────────────────────────────────────────────────────────── --}}
<style>
    #sidebar::-webkit-scrollbar { display: none; }
    #sidebar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    #sidebar-backdrop {
        transition: opacity .25s ease, visibility .25s ease;
    }
</style>

{{-- Mobile Backdrop --}}
<div id="sidebar-backdrop"
     class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden opacity-0 invisible"
     onclick="closeSidebar()"></div>

{{-- ── Sidebar ── --}}
<aside id="sidebar"
       class="fixed top-0 left-0 z-30 h-full w-64 bg-slate-900 flex flex-col overflow-y-auto
              -translate-x-full lg:translate-x-0
              transition-transform duration-[250ms] ease-in-out">

    {{-- ── Brand / Logo ── --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-slate-800/70 flex-shrink-0">
        <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-900/40">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
            </svg>
        </div>
        <div class="min-w-0">
            <p class="text-sm font-bold text-white leading-tight tracking-tight">RSP-UHB</p>
            <p class="text-[10px] font-medium text-slate-400 leading-tight truncate">Research Strategic Planning</p>
        </div>
    </div>

    {{-- ── Navigation ── --}}
    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto" aria-label="Navigasi utama">

        {{-- Section: Utama --}}
        <p class="px-3 pt-1 pb-2 text-[10px] font-semibold uppercase tracking-widest text-white select-none">
            Menu Utama
        </p>

        {{-- Dashboard --}}
        @php $isDashboard = request()->routeIs('dashboard'); @endphp
        <a href="{{ route('dashboard') }}"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isDashboard
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isDashboard ? 'page' : 'false' }}">
            @if($isDashboard)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <span>Dashboard</span>
        </a>

        {{-- Divider --}}
        <div class="!mt-4 !mb-1 border-t border-slate-800/60"></div>

        {{-- Master Data Accordion --}}
        @php
            $isFakultas = request()->is('fakultas*');
            $isProdi = request()->is('prodi*');
            $isDosen = request()->is('dosen*');
            $isBidang = request()->is('bidang') || request()->is('bidang/*');
            $isProgram = request()->is('program*');
            $isRenstra = request()->is('renstra*');
            $isMasterDataActive = $isFakultas || $isProdi || $isDosen || $isBidang || $isProgram || $isRenstra;
        @endphp
        <div class="relative">
            <details class="group cursor-pointer" {{ $isMasterDataActive ? 'open' : '' }}>
                <summary class="flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                                transition-all duration-150
                                {{ $isMasterDataActive
                                     ? 'text-white bg-slate-800/50'
                                     : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
                                list-none [&::-webkit-details-marker]:hidden">
                    <div class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isMasterDataActive ? 'text-blue-400' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18a2.25 2.25 0 012.25 2.25v4.5A2.25 2.25 0 0118 21.75H6a2.25 2.25 0 01-2.25-2.25V15.75A2.25 2.25 0 012.25 13.5zm0-6h18a2.25 2.25 0 012.25 2.25v4.5A2.25 2.25 0 0118 15.75H6a2.25 2.25 0 01-2.25-2.25V9.75A2.25 2.25 0 012.25 7.5zm0-6h18a2.25 2.25 0 012.25 2.25v4.5A2.25 2.25 0 0118 9.75H6a2.25 2.25 0 01-2.25-2.25V3.75A2.25 2.25 0 012.25 1.5z"/>
                        </svg>
                        <span>Master Data</span>
                    </div>
                    <svg class="w-3.5 h-3.5 opacity-60 transition-transform duration-200 group-open:rotate-90"
                         fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </summary>

                <div class="mt-1 pl-6 space-y-0.5 border-l-2 border-slate-800/80 ml-5">
                    {{-- Fakultas --}}
                    @if(auth()->user()->isAdmin() || auth()->user()->isDekan())
                    <a href="/fakultas"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isFakultas
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isFakultas ? 'page' : 'false' }}">
                        @if($isFakultas)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isFakultas ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                        </svg>
                        <span>Fakultas</span>
                    </a>
                    @endif

                    {{-- Prodi --}}
                    @if(auth()->user()->isAdmin() || auth()->user()->isDekan())
                    <a href="/prodi"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isProdi
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isProdi ? 'page' : 'false' }}">
                        @if($isProdi)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isProdi ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                        </svg>
                        <span>Prodi</span>
                    </a>
                    @endif

                    {{-- Dosen --}}
                    <a href="/dosen"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isDosen
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isDosen ? 'page' : 'false' }}">
                        @if($isDosen)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isDosen ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5a2.25 2.25 0 002.25 2.25zm.908-2.293a3.375 3.375 0 016.684 0v.093A3.375 3.375 0 0112 18H5.25a3.375 3.375 0 01-.092-.593zM8.625 10.5a1.875 1.875 0 113.75 0 1.875 1.875 0 01-3.75 0z"/>
                        </svg>
                        <span>Dosen</span>
                    </a>

                    {{-- Bidang --}}
                    @if(auth()->user()->isAdmin() || auth()->user()->isLppm())
                    <a href="/bidang"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isBidang
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isBidang ? 'page' : 'false' }}">
                        @if($isBidang)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isBidang ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 003.182 0l5.178-5.178a2.25 2.25 0 000-3.182l-9.581-9.581A2.25 2.25 0 009.568 3z"/>
                        </svg>
                        <span>Bidang</span>
                    </a>
                    @endif

                    {{-- Program --}}
                    @if(auth()->user()->isAdmin() || auth()->user()->isLppm())
                    <a href="/program"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isProgram
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isProgram ? 'page' : 'false' }}">
                        @if($isProgram)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isProgram ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5"/>
                        </svg>
                        <span>Program</span>
                    </a>
                    @endif

                    {{-- RENSTRA --}}
                    @if(auth()->user()->isAdmin() || auth()->user()->isDekan())
                    <a href="/renstra"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isRenstra
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isRenstra ? 'page' : 'false' }}">
                        @if($isRenstra)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isRenstra ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75 2.25 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                        </svg>
                        <span>RENSTRA</span>
                    </a>
                    @endif
                </div>
            </details>
        </div>
        {{-- Akademik & Riset Accordion --}}
        @php
            $isHki = request()->is('hki*');
            $isBuku = request()->is('buku*');
            $isArtikel = request()->is('artikel*');
            $isAkademikRisetActive = $isHki || $isBuku || $isArtikel;
        @endphp
        <div class="relative">
            <details class="group cursor-pointer" {{ $isAkademikRisetActive ? 'open' : '' }}>
                <summary class="flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                                transition-all duration-150
                                {{ $isAkademikRisetActive
                                     ? 'text-white bg-slate-800/50'
                                     : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
                                list-none [&::-webkit-details-marker]:hidden">
                    <div class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isAkademikRisetActive ? 'text-blue-400' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                        <span>Akademik & Riset</span>
                    </div>
                    <svg class="w-3.5 h-3.5 opacity-60 transition-transform duration-200 group-open:rotate-90"
                         fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </summary>

                <div class="mt-1 pl-6 space-y-0.5 border-l-2 border-slate-800/80 ml-5">

                    {{-- HKI --}}
                    <a href="/hki"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isHki
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isHki ? 'page' : 'false' }}">
                        @if($isHki)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isHki ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                        </svg>
                        <span>HKI</span>
                    </a>

                    {{-- Buku --}}
                    <a href="/buku"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isBuku
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isBuku ? 'page' : 'false' }}">
                        @if($isBuku)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isBuku ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                        <span>Buku</span>
                    </a>

                    {{-- Artikel --}}
                    <a href="/artikel"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isArtikel
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isArtikel ? 'page' : 'false' }}">
                        @if($isArtikel)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isArtikel ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        <span>Artikel</span>
                    </a>
                </div>
            </details>
        </div>

        {{-- RKT Accordion --}}
        @php
            $isRktKegiatan = request()->is('rkt/kegiatan*');
            $isRktKalender = request()->is('rkt/kalender*');
            $isRktActive = $isRktKegiatan || $isRktKalender;
        @endphp
        <div class="relative">
            <details class="group cursor-pointer" {{ $isRktActive ? 'open' : '' }}>
                <summary class="flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                                transition-all duration-150
                                {{ $isRktActive
                                     ? 'text-white bg-slate-800/50'
                                     : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
                                list-none [&::-webkit-details-marker]:hidden">
                    <div class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isRktActive ? 'text-blue-400' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                        <span>RKT</span>
                    </div>
                    <svg class="w-3.5 h-3.5 opacity-60 transition-transform duration-200 group-open:rotate-90"
                         fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </summary>

                <div class="mt-1 pl-6 space-y-0.5 border-l-2 border-slate-800/80 ml-5">
                    {{-- Data Kegiatan --}}
                    <a href="/rkt/kegiatan"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isRktKegiatan
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isRktKegiatan ? 'page' : 'false' }}">
                        @if($isRktKegiatan)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isRktKegiatan ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75 2.25 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                        </svg>
                        <span>Data Kegiatan</span>
                    </a>

                    {{-- Kalender Kegiatan --}}
                    <a href="/rkt/kalender"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isRktKalender
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isRktKalender ? 'page' : 'false' }}">
                        @if($isRktKalender)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <svg class="w-4 h-4 flex-shrink-0 {{ $isRktKalender ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                        <span>Kalender Kegiatan</span>
                    </a>
                </div>
            </details>
        </div>


        {{-- Divider + Section: Kemitraan & Prestasi --}}
        <div class="!mt-4 !mb-1 border-t border-slate-800/60"></div>
        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-widest text-white select-none">
            Kemitraan & Prestasi
        </p>

        {{-- Kerja Sama / MOU --}}
        @php $isKerjasama = request()->is('kerjasama*'); @endphp
        @if(auth()->user()->isAdmin() || auth()->user()->isDekan() || auth()->user()->isLppm())
        <a href="/kerjasama"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isKerjasama
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isKerjasama ? 'page' : 'false' }}">
            @if($isKerjasama)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isKerjasama ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
            </svg>
                        <span>Kerja Sama / MOU</span>
                    </a>
                    @endif

        {{-- Prestasi Accordion --}}
        @php
            $isPrestasiAkademik = request()->is('prestasi-akademik*');
            $isPrestasiNonAkademik = request()->is('prestasi-non-akademik*');
            $isPrestasiActive = $isPrestasiAkademik || $isPrestasiNonAkademik;
        @endphp
        <div class="relative">
            <details class="group cursor-pointer" {{ $isPrestasiActive ? 'open' : '' }}>
                <summary class="flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                                transition-all duration-150
                                {{ $isPrestasiActive
                                     ? 'text-white bg-slate-800/50'
                                     : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}
                                list-none [&::-webkit-details-marker]:hidden">
                    <div class="flex items-center gap-3">
                        <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isPrestasiActive ? 'text-blue-400' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                             fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c1.04-.518 1.75-1.59 1.75-2.822v-6.75h1.5a1.5 1.5 0 001.5-1.5V1.5a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 1.5v3a1.5 1.5 0 001.5 1.5h1.5v6.75c0 1.232.71 2.304 1.75 2.822v3.375m9 0h-9"/>
                        </svg>
                        <span>Prestasi</span>
                    </div>
                    <svg class="w-3.5 h-3.5 opacity-60 transition-transform duration-200 group-open:rotate-90"
                         fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </summary>

                <div class="mt-1 pl-6 space-y-0.5 border-l-2 border-slate-800/80 ml-5">
                    {{-- Prestasi Akademik --}}
                    @if(auth()->user()->isAdmin() || auth()->user()->isDekan() || auth()->user()->isKaprodi())
                    <a href="/prestasi-akademik"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isPrestasiAkademik
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isPrestasiAkademik ? 'page' : 'false' }}">
                        @if($isPrestasiAkademik)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <span>Akademik</span>
                    </a>
                    @endif

                    {{-- Prestasi Non-Akademik --}}
                    @if(auth()->user()->isAdmin() || auth()->user()->isDekan() || auth()->user()->isKaprodi())
                    <a href="/prestasi-non-akademik"
                       class="group relative flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium
                              transition-all duration-150
                              {{ $isPrestasiNonAkademik
                                   ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                                   : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}"
                       aria-current="{{ $isPrestasiNonAkademik ? 'page' : 'false' }}">
                        @if($isPrestasiNonAkademik)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-4 w-[2px] bg-blue-300 rounded-full"></span>
                        @endif
                        <span>Non-Akademik</span>
                    </a>
                    @endif
                </div>
            </details>
        </div>

        @if(auth()->user()->isAdmin())
        {{-- Divider + Section: Pengguna --}}
        <div class="!mt-4 !mb-1 border-t border-slate-800/60"></div>
        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-widest text-white select-none">
            Pengguna & Akses
        </p>

        {{-- Manajemen User --}}
        @php
            $isPengguna = request()->is('pengguna*');
        @endphp
        @if(auth()->user()->isAdmin())
        <a href="/pengguna"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isPengguna
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isPengguna ? 'page' : 'false' }}">
            @if($isPengguna)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isPengguna ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
                    <span>Manajemen User</span>
                </a>
                @endif
                @endif

    </nav>

    {{-- ── User Profile Footer ── --}}
    @auth
    <div class="flex-shrink-0 border-t border-slate-800/70 p-3">
        <div class="flex items-center gap-3 px-2 py-2 rounded-xl hover:bg-slate-800 transition-colors duration-150 group">
            {{-- Avatar initial --}}
            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-700
                        flex items-center justify-center text-xs font-bold text-white shadow">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold text-slate-200 truncate leading-snug">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 truncate leading-snug">{{ Auth::user()->email }}</p>
            </div>
            {{-- Logout button --}}
            <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                @csrf
                <button type="submit"
                        title="Logout"
                        class="p-1 text-slate-500 hover:text-red-400 transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    @endauth
</aside>

{{-- ── Mobile Top Bar ── --}}
<div class="lg:hidden fixed top-0 left-0 right-0 z-20 h-14 bg-white border-b border-slate-200
            flex items-center gap-3 px-4 shadow-sm">
    <button id="sidebar-open-btn"
            onclick="openSidebar()"
            class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition-colors duration-150"
            aria-label="Buka sidebar" aria-expanded="false" aria-controls="sidebar">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
        </svg>
    </button>
    <div class="flex items-center gap-2">
        <div class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center">
            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
            </svg>
        </div>
        <span class="text-sm font-bold text-slate-800 tracking-tight">RSP-UHB</span>
    </div>
</div>

{{-- ── Sidebar JS ── --}}
<script>
    function openSidebar() {
        const sidebar  = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const btn      = document.getElementById('sidebar-open-btn');
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('opacity-0', 'invisible');
        btn && btn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        const sidebar  = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const btn      = document.getElementById('sidebar-open-btn');
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('opacity-0', 'invisible');
        btn && btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSidebar();
    });
</script>
