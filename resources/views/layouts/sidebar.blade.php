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

        {{-- Divider + Section: Akademik --}}
        <div class="!mt-4 !mb-1 border-t border-slate-800/60"></div>
        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-500 select-none">
            Akademik
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

        {{-- Pengabdian --}}
        @php $isPengabdian = request()->is('pengabdian*'); @endphp
        <a href="/pengabdian"
           class="group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                  transition-all duration-150
                  {{ $isPengabdian
                       ? 'bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-md shadow-blue-900/30'
                       : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
           aria-current="{{ $isPengabdian ? 'page' : 'false' }}">
            @if($isPengabdian)
                <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] bg-blue-300 rounded-full"></span>
            @endif
            <svg class="w-[18px] h-[18px] flex-shrink-0 {{ $isPengabdian ? 'text-blue-200' : 'text-slate-400 group-hover:text-slate-200' }} transition-colors"
                 fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
            </svg>
            <span>Pengabdian</span>
        </a>

        {{-- Divider + Section: Perencanaan --}}
        <div class="!mt-4 !mb-1 border-t border-slate-800/60"></div>
        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-500 select-none">
            Perencanaan
        </p>

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
