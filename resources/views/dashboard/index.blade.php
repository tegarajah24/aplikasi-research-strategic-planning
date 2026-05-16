<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Dashboard</h1>
                <p class="text-sm text-slate-500 mt-0.5">Sistem Informasi Research & Strategic Planning — Universitas Harapan Bangsa</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Sistem Aktif
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ── Stat Cards ── --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                {{-- Card: Total Penelitian --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-start gap-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Penelitian</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1 leading-none">48</p>
                        <p class="text-xs text-slate-400 mt-1.5">
                            <span class="text-emerald-600 font-semibold">+6</span> bulan ini
                        </p>
                    </div>
                </div>

                {{-- Card: Total Pengabmas --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-start gap-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-violet-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Pengabmas</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1 leading-none">32</p>
                        <p class="text-xs text-slate-400 mt-1.5">
                            <span class="text-emerald-600 font-semibold">+4</span> bulan ini
                        </p>
                    </div>
                </div>

                {{-- Card: Total Renop --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-start gap-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Total Renop</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1 leading-none">17</p>
                        <p class="text-xs text-slate-400 mt-1.5">
                            <span class="text-emerald-600 font-semibold">+2</span> bulan ini
                        </p>
                    </div>
                </div>

                {{-- Card: Total Dosen Aktif --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-start gap-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-teal-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Dosen Aktif</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1 leading-none">124</p>
                        <p class="text-xs text-slate-400 mt-1.5">
                            <span class="text-emerald-600 font-semibold">+3</span> semester ini
                        </p>
                    </div>
                </div>

            </div>

            {{-- ── Main Row: Aktivitas + Quick Action ── --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                {{-- Aktivitas Terbaru --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="text-sm font-semibold text-slate-700">Aktivitas Terbaru</h2>
                        <span class="text-xs text-slate-400">Mei 2026</span>
                    </div>
                    <div class="divide-y divide-slate-50">

                        @php
                        $activities = [
                            [
                                'icon'  => 'blue',
                                'label' => 'Penelitian baru ditambahkan',
                                'desc'  => 'Analisis Dampak AI terhadap Kualitas Pendidikan Tinggi',
                                'by'    => 'Dr. Andi Saputra, M.Kom',
                                'time'  => '2 jam lalu',
                                'badge' => 'Penelitian',
                                'badge_color' => 'blue',
                            ],
                            [
                                'icon'  => 'violet',
                                'label' => 'Pengabmas selesai divalidasi',
                                'desc'  => 'Pelatihan Literasi Digital bagi Masyarakat Desa Karangsari',
                                'by'    => 'Siti Rahayu, S.Pd., M.Pd',
                                'time'  => '5 jam lalu',
                                'badge' => 'Pengabmas',
                                'badge_color' => 'violet',
                            ],
                            [
                                'icon'  => 'amber',
                                'label' => 'Renop periode baru dibuat',
                                'desc'  => 'Rencana Operasional Bidang Riset Tahun 2026/2027',
                                'by'    => 'Admin RSP-UHB',
                                'time'  => 'Kemarin, 14:30',
                                'badge' => 'Renop',
                                'badge_color' => 'amber',
                            ],
                            [
                                'icon'  => 'blue',
                                'label' => 'Penelitian diperbarui',
                                'desc'  => 'Optimasi Algoritma K-Means untuk Pengelompokan Data Mahasiswa',
                                'by'    => 'Budi Hartono, M.T',
                                'time'  => 'Kemarin, 09:15',
                                'badge' => 'Penelitian',
                                'badge_color' => 'blue',
                            ],
                            [
                                'icon'  => 'violet',
                                'label' => 'Pengabmas baru diajukan',
                                'desc'  => 'Sosialisasi PHBS di Kelurahan Purwokerto Kidul',
                                'by'    => 'Ns. Dewi Lestari, M.Kep',
                                'time'  => '3 hari lalu',
                                'badge' => 'Pengabmas',
                                'badge_color' => 'violet',
                            ],
                        ];

                        $badgeMap = [
                            'blue'   => 'bg-blue-50 text-blue-700',
                            'violet' => 'bg-violet-50 text-violet-700',
                            'amber'  => 'bg-amber-50 text-amber-700',
                        ];
                        $iconMap = [
                            'blue'   => 'bg-blue-100 text-blue-600',
                            'violet' => 'bg-violet-100 text-violet-600',
                            'amber'  => 'bg-amber-100 text-amber-600',
                        ];
                        @endphp

                        @foreach($activities as $act)
                        <div class="flex items-start gap-4 px-6 py-4 hover:bg-slate-50/60 transition-colors duration-150">
                            {{-- Dot icon --}}
                            <div class="flex-shrink-0 w-8 h-8 rounded-full {{ $iconMap[$act['icon']] }} flex items-center justify-center mt-0.5">
                                @if($act['icon'] === 'blue')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                @elseif($act['icon'] === 'violet')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                                @endif
                            </div>
                            {{-- Content --}}
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <p class="text-sm font-medium text-slate-700">{{ $act['label'] }}</p>
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $badgeMap[$act['badge_color']] }}">
                                        {{ $act['badge'] }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $act['desc'] }}</p>
                                <p class="text-[11px] text-slate-400 mt-1">{{ $act['by'] }} &middot; {{ $act['time'] }}</p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                {{-- Quick Action + Info --}}
                <div class="flex flex-col gap-5">

                    {{-- Quick Actions --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100">
                            <h2 class="text-sm font-semibold text-slate-700">Aksi Cepat</h2>
                        </div>
                        <div class="p-4 space-y-2.5">

                            <a href="/penelitian"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition-colors duration-150 group">
                                <svg class="w-4 h-4 flex-shrink-0 opacity-90" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                                <span class="flex-1">Kelola Penelitian</span>
                                <svg class="w-4 h-4 opacity-70 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                </svg>
                            </a>

                            <a href="/pengabdian"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-violet-50 border border-slate-200 hover:border-violet-200 text-slate-700 hover:text-violet-700 text-sm font-medium transition-all duration-150 group">
                                <svg class="w-4 h-4 flex-shrink-0 text-violet-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                                </svg>
                                <span class="flex-1">Kelola Pengabmas</span>
                                <svg class="w-4 h-4 opacity-40 group-hover:opacity-70 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                </svg>
                            </a>

                            <a href="/renop"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-200 text-slate-700 hover:text-amber-700 text-sm font-medium transition-all duration-150 group">
                                <svg class="w-4 h-4 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                                </svg>
                                <span class="flex-1">Kelola Renop</span>
                                <svg class="w-4 h-4 opacity-40 group-hover:opacity-70 group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                </svg>
                            </a>

                        </div>
                    </div>

                    {{-- Info Sistem --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                        <h2 class="text-sm font-semibold text-slate-700 mb-3">Informasi Sistem</h2>
                        <ul class="space-y-2.5 text-xs text-slate-500">
                            <li class="flex justify-between items-center">
                                <span>Semester Aktif</span>
                                <span class="font-semibold text-slate-700">Genap 2025/2026</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span>Tahun Akademik</span>
                                <span class="font-semibold text-slate-700">2025 / 2026</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span>Versi Sistem</span>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-semibold">v1.0.0</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span>Update Terakhir</span>
                                <span class="font-semibold text-slate-700">16 Mei 2026</span>
                            </li>
                        </ul>
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs text-slate-500">Penyerapan Data</span>
                                <span class="text-xs font-semibold text-slate-700">78%</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                <div class="h-full rounded-full bg-blue-500" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
