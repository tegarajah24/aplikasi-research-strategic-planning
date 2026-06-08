<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Dashboard Utama</h1>
                <p class="text-sm text-slate-400 mt-0.5">Selamat datang kembali — ringkasan sistem RSP-UHB</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-xs text-slate-400 hidden sm:block">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- ════════════════ BARIS 1: METRIC CARDS ════════════════ --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">

                {{-- Card 1: Total Pengguna --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 hover:shadow-md hover:border-slate-300 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                            </svg>
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">User Aktif</span>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">0</p>
                    <p class="text-xs text-slate-400 mt-1">Total Pengguna</p>
                </div>

                {{-- Card 2: Fakultas & Prodi --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 hover:shadow-md hover:border-slate-300 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">0 / 0</p>
                    <p class="text-xs text-slate-400 mt-1">Fakultas / Program Studi</p>
                </div>

                {{-- Card 3: Dosen Terdaftar --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 hover:shadow-md hover:border-slate-300 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5a2.25 2.25 0 002.25 2.25zm.908-2.293a3.375 3.375 0 016.684 0v.093A3.375 3.375 0 0112 18H5.25a3.375 3.375 0 01-.092-.593zM8.625 10.5a1.875 1.875 0 113.75 0 1.875 1.875 0 01-3.75 0z"/>
                            </svg>
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">Dosen Aktif</span>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">0</p>
                    <p class="text-xs text-slate-400 mt-1">Dosen Terdaftar</p>
                </div>

                {{-- Card 4: Total Luaran Ilmiah --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 hover:shadow-md hover:border-slate-300 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">0</p>
                    <p class="text-xs text-slate-400 mt-1">HKI, Buku & Artikel</p>
                </div>

                {{-- Card 5: Kerjasama & Prestasi --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 hover:shadow-md hover:border-slate-300 transition-all duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">0 / 0</p>
                    <p class="text-xs text-slate-400 mt-1">Mitra MoU / Prestasi Mhs</p>
                </div>

            </div>

            {{-- ════════════════ BARIS 2: VISUAL CHARTS ════════════════ --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Kolom 1 & 2: Tren Publikasi --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Tren Publikasi & Luaran Ilmiah</h2>
                            <p class="text-[11px] text-slate-400 mt-0.5">Grafik perbandingan Artikel vs Buku vs HKI per tahun</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1.5 text-[11px] font-medium text-slate-500">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>Artikel
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] font-medium text-slate-500">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>Buku
                            </span>
                            <span class="flex items-center gap-1.5 text-[11px] font-medium text-slate-500">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>HKI
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="w-full h-72 bg-slate-50/50 rounded-xl border border-dashed border-slate-200 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                                </svg>
                                <p class="text-sm font-medium text-slate-400">Chart Placeholder</p>
                                <p class="text-xs text-slate-300 mt-1">Bar Chart — Artikel vs Buku vs HKI</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom 3: Status Capaian Renstra --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-700">Status Capaian Renstra</h2>
                        <p class="text-[11px] text-slate-400 mt-0.5">Proporsi capaian sasaran strategis</p>
                    </div>
                    <div class="p-6 flex flex-col items-center">
                        <div class="w-44 h-44 rounded-full bg-slate-50/50 border border-dashed border-slate-200 flex items-center justify-center mb-5">
                            <div class="text-center">
                                <svg class="w-10 h-10 mx-auto text-slate-200 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 3H12v6h6V7.5A4.5 4.5 0 0013.5 3z"/>
                                </svg>
                                <p class="text-xs text-slate-300">Pie Chart</p>
                            </div>
                        </div>
                        <div class="w-full space-y-2.5">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                    <span class="text-slate-600">Tercapai</span>
                                </div>
                                <span class="font-semibold text-slate-700">0%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                    <span class="text-slate-600">Dalam Proses</span>
                                </div>
                                <span class="font-semibold text-slate-700">0%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>
                                    <span class="text-slate-600">Belum Tercapai</span>
                                </div>
                                <span class="font-semibold text-slate-700">0%</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ════════════════ BARIS 3: AGENDA & AKTIVITAS ════════════════ --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Kolom Kiri: Agenda & Kalender --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Agenda & Kalender Kegiatan Terdekat</h2>
                            <p class="text-[11px] text-slate-400 mt-0.5">Jadwal kegiatan RKT terdekat</p>
                        </div>
                        <a href="{{ route('rkt.kalender') }}" class="text-[11px] font-semibold text-blue-600 hover:text-blue-700 transition">Lihat Semua</a>
                    </div>
                    <div class="p-5 space-y-3">
                        @for ($i = 0; $i < 5; $i++)
                        <div class="flex items-start gap-4 p-3 rounded-xl {{ $i > 0 ? 'opacity-30' : '' }}">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-slate-100 flex flex-col items-center justify-center text-center">
                                <span class="text-[9px] font-bold text-slate-400 uppercase leading-tight">{{ $i === 0 ? '—' : 'DD' }}</span>
                                <span class="text-[8px] font-medium text-slate-300 leading-tight">{{ $i === 0 ? '' : 'Mon' }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="h-3.5 bg-slate-100 rounded w-3/4 mb-1.5"></div>
                                <div class="h-3 bg-slate-50 rounded w-1/2"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                {{-- Kolom Kanan: Log Aktivitas --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-700">Log Aktivitas Terbaru</h2>
                        <p class="text-[11px] text-slate-400 mt-0.5">Riwayat perubahan data oleh pengguna</p>
                    </div>
                    <div class="p-5">
                        <div class="text-center py-12">
                            <svg class="w-14 h-14 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm font-semibold text-slate-500">Belum ada aktivitas terbaru</p>
                            <p class="text-xs text-slate-400 mt-1">Sistem berjalan normal.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>