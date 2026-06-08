<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RSP-UHB — Research & Strategic Planning Universitas Harapan Bangsa</title>
    <meta name="description" content="Sistem informasi cerdas untuk merencanakan, mengelola, dan memonitor strategi penelitian di lingkungan Universitas Harapan Bangsa.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        * { font-family: 'Inter', sans-serif; }

        /* Animated gradient hero text */
        .hero-gradient-text {
            background: linear-gradient(135deg, #2563eb 0%, #7c3aed 50%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% auto;
            animation: shimmer 4s linear infinite;
        }
        @keyframes shimmer {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        /* Card hover lift */
        .feature-card {
            transition: transform 0.25s cubic-bezier(.4,0,.2,1), box-shadow 0.25s cubic-bezier(.4,0,.2,1);
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -10px rgba(15,23,42,.12), 0 4px 10px -4px rgba(15,23,42,.06);
        }

        /* Stat card */
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
        }

        /* Noise texture overlay for hero */
        .hero-bg {
            background-color: #f8fafc;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(37,99,235,0.06) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(124,58,237,0.06) 0%, transparent 60%),
                radial-gradient(ellipse at 60% 80%, rgba(13,148,136,0.05) 0%, transparent 50%);
        }

        /* Section divider dot */
        .section-eyebrow::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            margin-right: 8px;
            vertical-align: middle;
        }

        /* Smooth nav */
        nav { backdrop-filter: blur(12px); }

        /* Badge pulse */
        .live-badge::before {
            content: '';
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
            margin-right: 6px;
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        /* Module card accent bar */
        .module-card { position: relative; overflow: hidden; }
        .module-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .module-card:hover::after { opacity: 1; }
        .module-card-blue::after { background: linear-gradient(90deg, #2563eb, #60a5fa); }
        .module-card-violet::after { background: linear-gradient(90deg, #7c3aed, #a78bfa); }
        .module-card-amber::after { background: linear-gradient(90deg, #d97706, #fbbf24); }
        .module-card-teal::after { background: linear-gradient(90deg, #0d9488, #2dd4bf); }
    </style>
</head>

<body class="antialiased text-slate-800 bg-slate-50">

    {{-- ══════════════════════════════════════
         NAVIGATION BAR
    ══════════════════════════════════════ --}}
    <header class="sticky top-0 z-50 bg-white/80 border-b border-slate-200/70" style="backdrop-filter:blur(12px)">
        <nav class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 group">
                <img src="https://uhb.ac.id/wp-content/uploads/2024/03/logo_UHB_r-1.png" alt="Logo UHB" class="h-9 w-auto object-contain">
                <div class="h-9 w-9 rounded-xl bg-blue-600 flex items-center justify-center shadow-md shadow-blue-600/25 group-hover:shadow-blue-600/40 transition-shadow">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-sm font-bold text-slate-800 leading-none tracking-tight">RSP-UHB</span>
                    <p class="text-[10px] text-slate-400 leading-none mt-0.5">Research & Strategic Planning</p>
                </div>
            </a>

            {{-- Nav Links & Auth --}}
            <div class="flex items-center gap-5">
                <a href="#features" class="hidden sm:block text-sm text-slate-500 hover:text-slate-800 transition-colors font-medium">Fitur</a>
                <a href="#modules" class="hidden sm:block text-sm text-slate-500 hover:text-slate-800 transition-colors font-medium">Modul</a>
                <a href="#stats" class="hidden sm:block text-sm text-slate-500 hover:text-slate-800 transition-colors font-medium">Statistik</a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-blue-600/25 hover:bg-blue-700 hover:shadow-blue-600/40 transition-all duration-200">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-blue-600/25 hover:bg-blue-700 hover:shadow-blue-600/40 transition-all duration-200">
                            Masuk
                        </a>
                    @endauth
                @endif
            </div>
        </nav>
    </header>


    {{-- ══════════════════════════════════════
         HERO SECTION
    ══════════════════════════════════════ --}}
    <section class="hero-bg relative overflow-hidden">
        {{-- Decorative grid --}}
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:4rem_4rem] opacity-30 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24 lg:pt-28 lg:pb-32">
            <div class="max-w-3xl mx-auto text-center">

                {{-- Eyebrow badge --}}
                <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 border border-blue-100 px-4 py-1.5 mb-8">
                    <span class="text-xs text-blue-700 font-semibold">Semester Genap 2025/2026</span>
                </div>

                {{-- Headline --}}
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight tracking-tight mb-6">
                    Kelola Riset &<br>
                    <span class="hero-gradient-text">Perencanaan Strategis</span><br>
                    Universitas
                </h1>

                {{-- Subheadline --}}
                <p class="text-lg text-slate-500 leading-relaxed max-w-xl mx-auto mb-10">
                    Platform terintegrasi untuk merencanakan, mengelola, dan memonitor penelitian, pengabdian masyarakat, dan rencana operasional Universitas Harapan Bangsa.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3.5 text-sm font-semibold text-white shadow-md shadow-blue-600/30 hover:bg-blue-700 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-200">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="w-full sm:w-auto flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3.5 text-sm font-semibold text-white shadow-md shadow-blue-600/30 hover:bg-blue-700 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-200">
                            Masuk ke Sistem
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Hero visual — module pills --}}
            <div class="mt-16 flex flex-wrap items-center justify-center gap-3">
                <span class="flex items-center gap-2 rounded-full bg-white border border-slate-200 shadow-sm px-4 py-2 text-xs font-semibold" style="color: #0f766e;">
                    <span class="w-2 h-2 rounded-full" style="background-color: #14b8a6;"></span>HKI & Publikasi
                </span>
                <span class="flex items-center gap-2 rounded-full bg-white border border-slate-200 shadow-sm px-4 py-2 text-xs font-semibold" style="color: #047857;">
                    <span class="w-2 h-2 rounded-full" style="background-color: #10b981;"></span>Kerja Sama
                </span>
            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         STATS SECTION
    ══════════════════════════════════════ --}}
    <section id="stats" class="bg-white border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         FEATURES SECTION
    ══════════════════════════════════════ --}}
    <section id="features" class="bg-slate-50 py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section header --}}
            <div class="text-center mb-14">
                <p class="section-eyebrow text-xs font-bold uppercase tracking-widest text-blue-600 mb-3">Kenapa RSP-UHB?</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">Dirancang untuk Kemudahan Pengelolaan Riset</h2>
                <p class="text-slate-500 max-w-xl mx-auto text-base leading-relaxed">
                    Sistem yang terstruktur dan mudah digunakan, membantu setiap civitas akademika dalam mengelola data penelitian secara efisien.
                </p>
            </div>

            {{-- Feature grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Perencanaan --}}
                <div class="feature-card bg-white rounded-2xl p-7 border border-slate-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-5 border border-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-2">Perencanaan Strategis</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Susun rencana operasional per-fakultas dan program studi secara sistematis, dengan target dan indikator yang terukur.
                    </p>
                </div>

                {{-- Kolaborasi --}}
                <div class="feature-card bg-white rounded-2xl p-7 border border-slate-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center mb-5 border border-violet-100">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-2">Kolaborasi Peneliti</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Fasilitasi sinergi antar dosen dan program studi dalam menjalankan penelitian dan pengabdian masyarakat bersama.
                    </p>
                </div>

                {{-- Monitoring --}}
                <div class="feature-card bg-white rounded-2xl p-7 border border-slate-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 flex items-center justify-center mb-5 border border-teal-100">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-2">Monitoring & Evaluasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Pantau progress penelitian, realisasi anggaran, dan capaian target strategis secara real-time dari satu dashboard.
                    </p>
                </div>

                {{-- HKI & Publikasi --}}
                <div class="feature-card bg-white rounded-2xl p-7 border border-slate-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center mb-5 border border-amber-100">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-2">HKI & Publikasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Catat dan kelola kekayaan intelektual, artikel ilmiah, dan buku karya dosen secara terpusat dan terarsip.
                    </p>
                </div>

                {{-- Kerja Sama --}}
                <div class="feature-card bg-white rounded-2xl p-7 border border-slate-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-5 border border-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-2">Kerja Sama & MOU</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Manajemen data kerja sama dan MOU dengan institusi lain secara terstruktur dan mudah diakses kapan saja.
                    </p>
                </div>

                {{-- Prestasi --}}
                <div class="feature-card bg-white rounded-2xl p-7 border border-slate-200/80 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center mb-5 border border-violet-100">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-2">Pencatatan Prestasi</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Dokumentasikan prestasi akademik dan non-akademik dosen maupun mahasiswa sebagai bukti capaian unggulan universitas.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- ══════════════════════════════════════
         MODULES SECTION
    ══════════════════════════════════════ --}}
    <section id="modules" class="bg-white py-20 lg:py-28 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">

                {{-- Left: text --}}
                <div>
                    <p class="section-eyebrow text-xs font-bold uppercase tracking-widest text-violet-600 mb-3">Modul Utama</p>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-5">
                        Dua Modul Inti yang Saling Terintegrasi
                    </h2>
                    <p class="text-slate-500 text-base leading-relaxed mb-8">
                        RSP-UHB dibangun atas dua pilar utama yang saling mendukung dan memperkuat ekosistem riset Universitas Harapan Bangsa.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-blue-50 border border-blue-100">
                            <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm shadow-blue-600/30">
                                <svg class="w-4.5 h-4.5 text-white w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Modul Riset & Inovasi</h4>
                                <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">Pengelolaan HKI, buku, publikasi ilmiah dosen, dan pengembangan inovasi akademik.</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Right: module cards --}}
                <div class="mt-12 lg:mt-0 grid grid-cols-2 gap-4">

                    <div class="module-card feature-card bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center mb-4 border border-rose-100">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-800">HKI</div>
                        <div class="text-xs font-semibold text-rose-600 mt-0.5">Hak Kekayaan Intelektual</div>
                    </div>

                    <div class="module-card feature-card bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-fuchsia-50 flex items-center justify-center mb-4 border border-fuchsia-100">
                            <svg class="w-5 h-5 text-fuchsia-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-extrabold text-slate-800">Publikasi</div>
                        <div class="text-xs font-semibold text-fuchsia-600 mt-0.5">Buku & Artikel Ilmiah</div>
                    </div>


                </div>
            </div>
        </div>
    </section>





    {{-- ══════════════════════════════════════
         FOOTER
    ══════════════════════════════════════ --}}
    <footer class="bg-white border-t border-slate-200/80 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2.5">
                    <div class="h-7 w-7 rounded-lg bg-blue-600 flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700">RSP-UHB</span>
                </div>
                <p class="text-xs text-slate-400 text-center">
                    &copy; {{ date('Y') }} Universitas Harapan Bangsa. Research & Strategic Planning System.
                </p>
                <div class="flex items-center gap-1.5 text-[10px] font-semibold text-slate-400 bg-slate-50 border border-slate-200 px-2.5 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    v1.0.0
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
