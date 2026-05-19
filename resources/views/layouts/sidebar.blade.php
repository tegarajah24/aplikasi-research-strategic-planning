{{-- ─────────────────────────────────────────────────────────────── --}}
{{-- RSP-UHB Sidebar Partial                                        --}}
{{-- Usage: @include('layouts.sidebar')  in app.blade.php           --}}
{{-- ─────────────────────────────────────────────────────────────── --}}

{{-- Mobile Backdrop --}}
<div id="sidebar-backdrop"
     class="fixed inset-0 z-20 bg-slate-900/50 backdrop-blur-sm hidden lg:hidden"
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
        <p class="px-3 pt-1 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-500 select-none">
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
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isDashboard ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
            </svg>
            <span>Dashboard</span>
        </a>

        {{-- Divider + Section: Akademik & Riset --}}
        <div class="!mt-4 !mb-1 border-t border-slate-800/60"></div>
        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-500 select-none">
            Akademik & Riset
        </p>

        {{-- Penelitian --}}
        @php $isPenelitian = request()->is('penelitian*'); @endphp
        <a href="/penelitian"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isPenelitian
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isPenelitian ? 'page' : 'false' }}">
            @if($isPenelitian)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isPenelitian ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
            </svg>
            <span>Penelitian</span>
        </a>

        {{-- Pengabmas --}}
        @php $isPengabmas = request()->is('pengabmas*'); @endphp
        <a href="/pengabmas"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isPengabmas
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isPengabmas ? 'page' : 'false' }}">
            @if($isPengabmas)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isPengabmas ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
            </svg>
            <span>Pengabmas</span>
        </a>

        {{-- Renop --}}
        @php $isRenop = request()->is('renop*'); @endphp
        <a href="/renop"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isRenop
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isRenop ? 'page' : 'false' }}">
            @if($isRenop)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isRenop ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
            </svg>
            <span>Renop</span>
        </a>

        {{-- HKI --}}
        @php $isHki = request()->is('hki*'); @endphp
        <a href="/hki"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isHki
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isHki ? 'page' : 'false' }}">
            @if($isHki)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isHki ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
            </svg>
            <span>HKI</span>
        </a>

        {{-- Buku --}}
        @php $isBuku = request()->is('buku*'); @endphp
        <a href="/buku"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isBuku
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isBuku ? 'page' : 'false' }}">
            @if($isBuku)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isBuku ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
            </svg>
            <span>Buku</span>
        </a>

        {{-- Artikel --}}
        @php $isArtikel = request()->is('artikel*'); @endphp
        <a href="/artikel"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isArtikel
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isArtikel ? 'page' : 'false' }}">
            @if($isArtikel)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isArtikel ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <span>Artikel</span>
        </a>

        {{-- Divider + Section: Master Data --}}
        <div class="!mt-4 !mb-1 border-t border-slate-800/60"></div>
        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-500 select-none">
            Master Data
        </p>

        {{-- Fakultas --}}
        @php $isFakultas = request()->is('fakultas*'); @endphp
        <a href="/fakultas"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isFakultas
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isFakultas ? 'page' : 'false' }}">
            @if($isFakultas)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isFakultas ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
            </svg>
            <span>Fakultas</span>
        </a>

        {{-- Prodi --}}
        @php $isProdi = request()->is('prodi*'); @endphp
        <a href="/prodi"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isProdi
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isProdi ? 'page' : 'false' }}">
            @if($isProdi)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isProdi ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
            </svg>
            <span>Prodi</span>
        </a>

        {{-- Bidang Keahlian --}}
        @php $isBidangKeahlian = request()->is('bidang-keahlian*'); @endphp
        <a href="/bidang-keahlian"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isBidangKeahlian
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isBidangKeahlian ? 'page' : 'false' }}">
            @if($isBidangKeahlian)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isBidangKeahlian ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 003.182 0l5.178-5.178a2.25 2.25 0 000-3.182l-9.581-9.581A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z"/>
            </svg>
            <span>Bidang Keahlian</span>
        </a>

        {{-- Dosen --}}
        @php $isDosen = request()->is('dosen*'); @endphp
        <a href="/dosen"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isDosen
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isDosen ? 'page' : 'false' }}">
            @if($isDosen)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isDosen ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5a2.25 2.25 0 002.25 2.25zm.908-2.293a3.375 3.375 0 016.684 0v.093A3.375 3.375 0 0112 18H5.25a3.375 3.375 0 01-.092-.593zM8.625 10.5a1.875 1.875 0 113.75 0 1.875 1.875 0 01-3.75 0z"/>
            </svg>
            <span>Dosen</span>
        </a>

        {{-- Pengguna --}}
        @php $isPengguna = request()->is('pengguna*'); @endphp
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
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
            <span>Pengguna</span>
        </a>

        {{-- Divider + Section: Kemitraan & Prestasi --}}
        <div class="!mt-4 !mb-1 border-t border-slate-800/60"></div>
        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-500 select-none">
            Kemitraan & Prestasi
        </p>

        {{-- Kerja Sama / MOU --}}
        @php $isKerjasama = request()->is('kerjasama*'); @endphp
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

        {{-- Prestasi Akademik --}}
        @php $isPrestasiAkademik = request()->is('prestasi-akademik*'); @endphp
        <a href="/prestasi-akademik"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isPrestasiAkademik
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isPrestasiAkademik ? 'page' : 'false' }}">
            @if($isPrestasiAkademik)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isPrestasiAkademik ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
            </svg>
            <span>Prestasi Akademik</span>
        </a>

        {{-- Prestasi Non-Akademik --}}
        @php $isPrestasiNonAkademik = request()->is('prestasi-non-akademik*'); @endphp
        <a href="/prestasi-non-akademik"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isPrestasiNonAkademik
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isPrestasiNonAkademik ? 'page' : 'false' }}">
            @if($isPrestasiNonAkademik)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isPrestasiNonAkademik ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c1.04-.518 1.75-1.59 1.75-2.822v-6.75h1.5a1.5 1.5 0 001.5-1.5V1.5a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 1.5v3a1.5 1.5 0 001.5 1.5h1.5v6.75c0 1.232.71 2.304 1.75 2.822v3.375m9 0h-9"/>
            </svg>
            <span>Prestasi Non-Akademik</span>
        </a>

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
        backdrop.classList.remove('hidden');
        btn && btn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        const sidebar  = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const btn      = document.getElementById('sidebar-open-btn');
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
        btn && btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSidebar();
    });
</script>
