<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Dashboard</h1>
                <p class="text-sm text-slate-400 mt-0.5">Selamat datang kembali — ringkasan sistem RSP-UHB</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-400 hidden sm:block">{{ now()->translatedFormat('l, d F Y') }}</span>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-medium border border-emerald-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Online
                </span>
            </div>
        </div>
    </x-slot>

    <style>
        .dash-card {
            transition: transform .25s cubic-bezier(.4,0,.2,1), box-shadow .25s cubic-bezier(.4,0,.2,1);
        }
        .dash-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px -6px rgba(15,23,42,.10), 0 2px 6px -2px rgba(15,23,42,.06);
        }
        .action-link {
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .action-link:hover {
            transform: translateY(-1px);
        }
    </style>

    <div class="py-8 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ════════════════ STATS GRID ════════════════ --}}
            <section>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    {{-- Penelitian --}}
                    <div class="dash-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="h-1 bg-blue-500"></div>
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                </div>
                                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">+6</span>
                            </div>
                            <p class="text-2xl font-bold text-slate-800 tracking-tight">48</p>
                            <p class="text-xs text-slate-400 mt-1">Total Penelitian</p>
                        </div>
                    </div>

                    {{-- Pengabmas --}}
                    <div class="dash-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="h-1 bg-violet-500"></div>
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                                </div>
                                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">+4</span>
                            </div>
                            <p class="text-2xl font-bold text-slate-800 tracking-tight">32</p>
                            <p class="text-xs text-slate-400 mt-1">Total Pengabmas</p>
                        </div>
                    </div>

                    {{-- Dosen Aktif --}}
                    <div class="dash-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="h-1 bg-teal-500"></div>
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                </div>
                                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">+3</span>
                            </div>
                            <p class="text-2xl font-bold text-slate-800 tracking-tight">124</p>
                            <p class="text-xs text-slate-400 mt-1">Dosen Aktif</p>
                        </div>
                    </div>

                </div>
            </section>

            {{-- ════════════════ MAIN CONTENT (2-COL) ════════════════ --}}
            <section>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- LEFT: Activity Feed --}}
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <h2 class="text-sm font-semibold text-slate-700">Aktivitas Terbaru</h2>
                                <p class="text-[11px] text-slate-400 mt-0.5">Log perubahan terakhir pada sistem</p>
                            </div>
                            <span class="text-[11px] font-medium px-2.5 py-1 rounded-lg bg-slate-50 text-slate-400 border border-slate-100">Mei 2026</span>
                        </div>

                        <div class="p-6 space-y-1">
                            @php
                            $activities = [
                                ['module'=>'penelitian','color'=>'blue', 'title'=>'Penelitian baru ditambahkan',
                                 'desc'=>'Analisis Dampak AI terhadap Kualitas Pendidikan Tinggi',
                                 'author'=>'Dr. Andi Saputra, M.Kom','time'=>'2 jam lalu'],
                                ['module'=>'pengabmas','color'=>'violet', 'title'=>'Pengabmas selesai divalidasi',
                                 'desc'=>'Pelatihan Literasi Digital bagi Masyarakat Desa Karangsari',
                                 'author'=>'Siti Rahayu, M.Pd','time'=>'5 jam lalu'],
                                ['module'=>'penelitian','color'=>'blue', 'title'=>'Penelitian diperbarui',
                                 'desc'=>'Optimasi Algoritma K-Means untuk Pengelompokan Data Mahasiswa',
                                 'author'=>'Budi Hartono, M.T','time'=>'2 hari lalu'],
                                ['module'=>'pengabmas','color'=>'violet', 'title'=>'Pengabmas baru diajukan',
                                 'desc'=>'Sosialisasi PHBS di Kelurahan Purwokerto Kidul',
                                 'author'=>'Ns. Dewi Lestari, M.Kep','time'=>'3 hari lalu'],
                            ];
                            @endphp

                            @foreach($activities as $act)
                            @php
                                $dotMap   = ['blue'=>'bg-blue-500','violet'=>'bg-violet-500','amber'=>'bg-amber-500'];
                                $badgeBg  = ['blue'=>'bg-blue-50 text-blue-600 border-blue-100','violet'=>'bg-violet-50 text-violet-600 border-violet-100','amber'=>'bg-amber-50 text-amber-600 border-amber-100'];
                            @endphp
                            <div class="flex gap-4 group">
                                {{-- Timeline line + dot --}}
                                <div class="flex flex-col items-center pt-1.5">
                                    <div class="w-2.5 h-2.5 rounded-full {{ $dotMap[$act['color']] }} ring-4 ring-white flex-shrink-0"></div>
                                    @if(!$loop->last)
                                    <div class="w-px flex-1 bg-slate-100 mt-1"></div>
                                    @endif
                                </div>
                                {{-- Content --}}
                                <div class="flex-1 pb-6 last:pb-0">
                                    <div class="rounded-xl px-4 py-3 hover:bg-slate-50/80 transition-colors duration-150 -ml-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <p class="text-[13px] font-semibold text-slate-700">{{ $act['title'] }}</p>
                                            <span class="text-[10px] font-medium px-1.5 py-0.5 rounded-md border {{ $badgeBg[$act['color']] }}">{{ ucfirst($act['module']) }}</span>
                                            <span class="text-[11px] text-slate-400 ml-auto flex-shrink-0">{{ $act['time'] }}</span>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $act['desc'] }}</p>
                                        <p class="text-[11px] text-slate-400 mt-1.5">{{ $act['author'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- RIGHT: Actions + Info --}}
                    <div class="space-y-5">

                        {{-- Quick Actions --}}
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                            <div class="px-5 py-4 border-b border-slate-100">
                                <h2 class="text-sm font-semibold text-slate-700">Aksi Cepat</h2>
                            </div>
                            <div class="p-4 space-y-2">
                                <a href="/penelitian" class="action-link flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium shadow-sm hover:shadow-md hover:shadow-blue-600/20">
                                    <svg class="w-4 h-4 opacity-80" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                    <span class="flex-1">Penelitian</span>
                                    <svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                </a>

                                <a href="/pengabmas" class="action-link flex items-center gap-3 px-4 py-3 rounded-xl bg-white hover:bg-violet-50 border border-slate-200 hover:border-violet-200 text-slate-600 hover:text-violet-700 text-sm font-medium hover:shadow-sm hover:shadow-violet-500/10">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                                    <span class="flex-1">Pengabmas</span>
                                    <svg class="w-3.5 h-3.5 opacity-40" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                </a>

                            </div>
                        </div>

                        {{-- System Info --}}
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-4">
                            <h2 class="text-sm font-semibold text-slate-700">Informasi Sistem</h2>

                            <div class="space-y-3 text-xs">
                                <div class="flex justify-between"><span class="text-slate-400">Semester</span><span class="font-medium text-slate-700">Genap 2025/2026</span></div>
                                <div class="flex justify-between"><span class="text-slate-400">Tahun Akademik</span><span class="font-medium text-slate-700">2025 / 2026</span></div>
                                <div class="flex justify-between"><span class="text-slate-400">Versi</span><span class="font-medium text-slate-500 bg-slate-50 px-2 py-0.5 rounded-md border border-slate-100">v1.0.0</span></div>
                            </div>

                            <div class="pt-4 border-t border-slate-100">
                                <div class="flex justify-between mb-2">
                                    <span class="text-xs text-slate-400">Kelengkapan Data</span>
                                    <span class="text-xs font-semibold text-slate-600">78%</span>
                                </div>
                                <div class="h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-blue-500 transition-all duration-500" style="width: 78%"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
