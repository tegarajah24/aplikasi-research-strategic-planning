<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-blue-500 mb-0.5">RSP-UHB</p>
                <h1 class="text-2xl font-extrabold text-slate-900 leading-tight tracking-tight">Dashboard</h1>
                <p class="text-sm text-slate-500 mt-0.5">Research &amp; Strategic Planning — Universitas Harapan Bangsa</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sistem Aktif
                </span>
                <span class="text-xs text-slate-400 hidden sm:block">{{ now()->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    {{-- Inline micro-interaction styles --}}
    <style>
        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px -4px rgba(0,0,0,.10); }
        .stat-card:hover.border-blue-100   { border-color: #93c5fd; }
        .stat-card:hover.border-violet-100 { border-color: #c4b5fd; }
        .stat-card:hover.border-amber-100  { border-color: #fcd34d; }
        .stat-card:hover.border-teal-100   { border-color: #5eead4; }
        .quick-btn { transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease; }
        .quick-btn:hover { transform: scale(1.02); }
        .quick-btn-blue:hover  { background-color: #1d4ed8; box-shadow: 0 4px 16px -2px rgba(37,99,235,.4); }
        .quick-btn-violet:hover{ background-color: #ede9fe; box-shadow: 0 4px 16px -2px rgba(124,58,237,.2); }
        .quick-btn-amber:hover { background-color: #fef3c7; box-shadow: 0 4px 16px -2px rgba(217,119,6,.2); }
    </style>

    <div class="py-8 bg-slate-50 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-7">

            {{-- ═══════════════════ STAT CARDS ═══════════════════ --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

                @php
                $stats = [
                    ['label'=>'Total Penelitian', 'value'=>'48', 'delta'=>'+6','sub'=>'bulan ini','color'=>'blue',  'strip'=>'bg-blue-500',
                     'icon_color'=>'text-blue-600','icon_bg'=>'bg-blue-50','border'=>'border-blue-100',
                     'icon'=>'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25'],
                    ['label'=>'Total Pengabmas', 'value'=>'32', 'delta'=>'+4','sub'=>'bulan ini','color'=>'violet','strip'=>'bg-violet-500',
                     'icon_color'=>'text-violet-600','icon_bg'=>'bg-violet-50','border'=>'border-violet-100',
                     'icon'=>'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'],
                    ['label'=>'Total Renop',    'value'=>'17', 'delta'=>'+2','sub'=>'bulan ini','color'=>'amber', 'strip'=>'bg-amber-500',
                     'icon_color'=>'text-amber-600','icon_bg'=>'bg-amber-50','border'=>'border-amber-100',
                     'icon'=>'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z'],
                    ['label'=>'Dosen Aktif',    'value'=>'124','delta'=>'+3','sub'=>'semester ini','color'=>'teal','strip'=>'bg-teal-500',
                     'icon_color'=>'text-teal-600','icon_bg'=>'bg-teal-50','border'=>'border-teal-100',
                     'icon'=>'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
                ];
                @endphp

                @foreach($stats as $s)
                <div class="stat-card bg-white rounded-2xl border {{ $s['border'] }} shadow-sm overflow-hidden">
                    {{-- Accent strip top --}}
                    <div class="h-1 w-full {{ $s['strip'] }}"></div>
                    <div class="p-5 flex items-start gap-4">
                        <div class="flex-shrink-0 w-11 h-11 rounded-xl {{ $s['icon_bg'] }} flex items-center justify-center">
                            <svg class="w-5 h-5 {{ $s['icon_color'] }}" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">{{ $s['label'] }}</p>
                            <p class="text-3xl font-extrabold text-slate-900 mt-1 leading-none">{{ $s['value'] }}</p>
                            <p class="text-xs text-slate-400 mt-1.5">
                                <span class="text-emerald-600 font-bold">{{ $s['delta'] }}</span> {{ $s['sub'] }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- ═══════════════════ MAIN 2-COL ═══════════════════ --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                {{-- ── Activity Timeline (Left 2/3) ── --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-bold text-slate-800">Aktivitas Terbaru</h2>
                            <p class="text-[11px] text-slate-400 mt-0.5">Log kegiatan sistem RSP-UHB</p>
                        </div>
                        <span class="text-[10px] font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-500">Mei 2026</span>
                    </div>

                    @php
                    $acts = [
                        ['c'=>'blue',  'badge'=>'Penelitian', 'title'=>'Penelitian baru ditambahkan',
                         'desc'=>'Analisis Dampak AI terhadap Kualitas Pendidikan Tinggi',
                         'by'=>'Dr. Andi Saputra, M.Kom','time'=>'2 jam lalu',
                         'dot_bg'=>'bg-blue-500','badge_cls'=>'bg-blue-50 text-blue-700 border-blue-200'],
                        ['c'=>'violet','badge'=>'Pengabmas', 'title'=>'Pengabmas selesai divalidasi',
                         'desc'=>'Pelatihan Literasi Digital bagi Masyarakat Desa Karangsari',
                         'by'=>'Siti Rahayu, M.Pd','time'=>'5 jam lalu',
                         'dot_bg'=>'bg-violet-500','badge_cls'=>'bg-violet-50 text-violet-700 border-violet-200'],
                        ['c'=>'amber', 'badge'=>'Renop',     'title'=>'Renop periode baru dibuat',
                         'desc'=>'Rencana Operasional Bidang Riset Tahun 2026/2027',
                         'by'=>'Admin RSP-UHB','time'=>'Kemarin, 14:30',
                         'dot_bg'=>'bg-amber-500','badge_cls'=>'bg-amber-50 text-amber-700 border-amber-200'],
                        ['c'=>'blue',  'badge'=>'Penelitian', 'title'=>'Penelitian diperbarui',
                         'desc'=>'Optimasi Algoritma K-Means untuk Pengelompokan Data Mahasiswa',
                         'by'=>'Budi Hartono, M.T','time'=>'Kemarin, 09:15',
                         'dot_bg'=>'bg-blue-500','badge_cls'=>'bg-blue-50 text-blue-700 border-blue-200'],
                        ['c'=>'violet','badge'=>'Pengabmas', 'title'=>'Pengabmas baru diajukan',
                         'desc'=>'Sosialisasi PHBS di Kelurahan Purwokerto Kidul',
                         'by'=>'Ns. Dewi Lestari, M.Kep','time'=>'3 hari lalu',
                         'dot_bg'=>'bg-violet-500','badge_cls'=>'bg-violet-50 text-violet-700 border-violet-200'],
                    ];
                    @endphp

                    <div class="px-6 py-4">
                        <ol class="relative border-l-2 border-slate-100 space-y-0">
                            @foreach($acts as $a)
                            <li class="relative pl-7 pb-6 last:pb-0 group">
                                {{-- Timeline dot --}}
                                <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full border-2 border-white {{ $a['dot_bg'] }} shadow-sm"></span>

                                {{-- Card --}}
                                <div class="bg-slate-50 group-hover:bg-white rounded-xl border border-slate-100 group-hover:border-slate-200 group-hover:shadow-sm px-4 py-3.5 transition-all duration-200">
                                    <div class="flex items-start justify-between gap-2 flex-wrap">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <p class="text-sm font-semibold text-slate-800">{{ $a['title'] }}</p>
                                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $a['badge_cls'] }}">
                                                {{ $a['badge'] }}
                                            </span>
                                        </div>
                                        <span class="text-[11px] text-slate-400 whitespace-nowrap flex-shrink-0">{{ $a['time'] }}</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $a['desc'] }}</p>
                                    <p class="text-[11px] text-slate-400 mt-1.5">oleh <span class="font-medium text-slate-600">{{ $a['by'] }}</span></p>
                                </div>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                {{-- ── Right Column ── --}}
                <div class="flex flex-col gap-5">

                    {{-- Quick Actions --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100">
                            <h2 class="text-sm font-bold text-slate-800">Aksi Cepat</h2>
                            <p class="text-[11px] text-slate-400 mt-0.5">Navigasi ke modul utama</p>
                        </div>
                        <div class="p-4 space-y-3">
                            <a href="/penelitian"
                               class="quick-btn quick-btn-blue flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white text-sm font-semibold shadow-sm">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                                <span class="flex-1">Kelola Penelitian</span>
                                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            </a>

                            <a href="/pengabdian"
                               class="quick-btn quick-btn-violet flex items-center gap-3 px-4 py-3 rounded-xl bg-violet-50 border border-violet-200 text-violet-700 text-sm font-semibold">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                </svg>
                                <span class="flex-1">Kelola Pengabmas</span>
                                <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            </a>

                            <a href="/renop"
                               class="quick-btn quick-btn-amber flex items-center gap-3 px-4 py-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-sm font-semibold">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                                </svg>
                                <span class="flex-1">Kelola Renop</span>
                                <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Info Sistem --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                        <h2 class="text-sm font-bold text-slate-800 mb-3">Informasi Sistem</h2>
                        <ul class="space-y-3 text-xs">
                            <li class="flex justify-between items-center">
                                <span class="text-slate-500">Semester Aktif</span>
                                <span class="font-bold text-slate-800">Genap 2025/2026</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="text-slate-500">Tahun Akademik</span>
                                <span class="font-bold text-slate-800">2025 / 2026</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="text-slate-500">Versi Sistem</span>
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-bold">v1.0.0</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="text-slate-500">Update Terakhir</span>
                                <span class="font-bold text-slate-800">16 Mei 2026</span>
                            </li>
                        </ul>

                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <div class="flex justify-between mb-2">
                                <span class="text-xs text-slate-500">Penyerapan Data</span>
                                <span class="text-xs font-bold text-slate-800">78%</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-blue-400" style="width:78%"></div>
                            </div>
                        </div>

                        {{-- Mini stats row --}}
                        <div class="mt-4 grid grid-cols-3 gap-2 pt-4 border-t border-slate-100">
                            <div class="text-center">
                                <p class="text-base font-extrabold text-blue-600">48</p>
                                <p class="text-[10px] text-slate-400 leading-tight mt-0.5">Penelitian</p>
                            </div>
                            <div class="text-center border-x border-slate-100">
                                <p class="text-base font-extrabold text-violet-600">32</p>
                                <p class="text-[10px] text-slate-400 leading-tight mt-0.5">Pengabmas</p>
                            </div>
                            <div class="text-center">
                                <p class="text-base font-extrabold text-amber-600">17</p>
                                <p class="text-[10px] text-slate-400 leading-tight mt-0.5">Renop</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
