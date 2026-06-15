<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Dashboard Utama</h1>
                <p class="text-sm text-slate-400 mt-0.5">Selamat datang kembali — ringkasan sistem RSP-UHB</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- ════════════════ BARIS 1: METRIC CARDS ════════════════ --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">

                {{-- Card 1: Fakultas --}}
                <a href="{{ route('fakultas.index') }}" class="block glass-panel p-5 hover:shadow-lg transition-all duration-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalFakultas }}</p>
                    <p class="text-xs text-slate-400 mt-1">Fakultas</p>
                </a>

                {{-- Card 2: Prodi --}}
                <a href="{{ route('prodi.index') }}" class="block glass-panel shadow-sm p-5 hover:shadow-md hover:border-blue-400 transition-all duration-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center group-hover:bg-violet-100 transition-colors">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalProdi }}</p>
                    <p class="text-xs text-slate-400 mt-1">Program Studi</p>
                </a>

                {{-- Card 3: Dosen Terdaftar --}}
                <a href="{{ route('dosen.index') }}" class="block glass-panel shadow-sm p-5 hover:shadow-md hover:border-blue-400 transition-all duration-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center group-hover:bg-cyan-100 transition-colors">
                            <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5a2.25 2.25 0 002.25 2.25zm.908-2.293a3.375 3.375 0 016.684 0v.093A3.375 3.375 0 0112 18H5.25a3.375 3.375 0 01-.092-.593zM8.625 10.5a1.875 1.875 0 113.75 0 1.875 1.875 0 01-3.75 0z"/>
                            </svg>
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">Dosen Aktif</span>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalDosen }}</p>
                    <p class="text-xs text-slate-400 mt-1">Dosen Terdaftar</p>
                </a>

                {{-- Card 4: Total Luaran Ilmiah --}}
                <a href="{{ route('hki.index') }}" class="block glass-panel shadow-sm p-5 hover:shadow-md hover:border-blue-400 transition-all duration-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalLuaran }}</p>
                    <p class="text-xs text-slate-400 mt-1">HKI, Buku & Artikel</p>
                </a>

                {{-- Card 5: Kerjasama & Prestasi --}}
                <a href="{{ route('kerjasama.index') }}" class="block glass-panel shadow-sm p-5 hover:shadow-md hover:border-blue-400 transition-all duration-200 group">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center group-hover:bg-rose-100 transition-colors">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-slate-800">{{ $totalKerjasama }} / {{ $totalPrestasi }}</p>
                    <p class="text-xs text-slate-400 mt-1">Mitra MoU / Prestasi Mhs</p>
                </a>

            </div>

            {{-- ════════════════ BARIS 2: VISUAL CHARTS ════════════════ --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Kolom 1 & 2: Tren Publikasi --}}
                <div class="lg:col-span-2 glass-panel shadow-sm overflow-hidden">
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
                        <canvas id="pubChart" class="w-full h-72"></canvas>
                    </div>
                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const ctx = document.getElementById('pubChart')?.getContext('2d');
                        if (!ctx) return;
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: @json($chartLabels),
                                datasets: [
                                    { label: 'Artikel', data: @json($chartArtikel), backgroundColor: '#3b82f6', borderRadius: 4 },
                                    { label: 'Buku', data: @json($chartBuku), backgroundColor: '#f59e0b', borderRadius: 4 },
                                    { label: 'HKI', data: @json($chartHki), backgroundColor: '#10b981', borderRadius: 4 },
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: { backgroundColor: '#1e293b', titleFont: { size: 12 }, bodyFont: { size: 12 }, cornerRadius: 8 }
                                },
                                scales: {
                                    x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                                    y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: '#f1f5f9' } }
                                }
                            }
                        });
                    });
                    </script>
                </div>

                {{-- Kolom 3: Status Capaian Renstra --}}
                <div class="glass-panel shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-700">Status Capaian Renstra</h2>
                        <p class="text-[11px] text-slate-400 mt-0.5">Proporsi capaian sasaran strategis</p>
                    </div>
                    <div class="p-6 flex flex-col items-center">
                        @php
                            $tercapai = $renstraStatus['tercapai'] ?? 0;
                            $dalamProses = $renstraStatus['dalam_proses'] ?? 0;
                            $belumTercapai = $renstraStatus['belum_tercapai'] ?? 0;
                            $total = max($totalRenstra, 1);
                            $pTer = round($tercapai / $total * 100);
                            $pPro = round($dalamProses / $total * 100);
                            $pBel = round($belumTercapai / $total * 100);
                        @endphp
                        <div class="w-44 h-44 rounded-full relative flex items-center justify-center mb-5">
                            <canvas id="statusDonut" class="w-44 h-44"></canvas>
                            <div class="absolute inset-0 flex items-center justify-center flex-col">
                                <span class="text-2xl font-extrabold text-slate-700">{{ $totalRenstra }}</span>
                                <span class="text-[10px] font-medium text-slate-400">Total</span>
                            </div>
                        </div>
                        <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const ctx = document.getElementById('statusDonut')?.getContext('2d');
                            if (!ctx) return;
                            new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Tercapai', 'Dalam Proses', 'Belum Tercapai'],
                                    datasets: [{
                                        data: [{{ $tercapai }}, {{ $dalamProses }}, {{ $belumTercapai }}],
                                        backgroundColor: ['#10b981', '#f59e0b', '#94a3b8'],
                                        borderWidth: 0,
                                    }]
                                },
                                options: {
                                    cutout: '72%',
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { display: false },
                                        tooltip: { enabled: false },
                                    }
                                }
                            });
                        });
                        </script>
                        <div class="w-full space-y-2.5">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                    <span class="text-slate-600">Tercapai</span>
                                </div>
                                <span class="font-semibold text-slate-700">{{ $pTer }}%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                    <span class="text-slate-600">Dalam Proses</span>
                                </div>
                                <span class="font-semibold text-slate-700">{{ $pPro }}%</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>
                                    <span class="text-slate-600">Belum Tercapai</span>
                                </div>
                                <span class="font-semibold text-slate-700">{{ $pBel }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ════════════════ BARIS 3: AGENDA & AKTIVITAS ════════════════ --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Kolom Kiri: Agenda & Kalender --}}
                <div class="glass-panel shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Agenda & Kalender Kegiatan Terdekat</h2>
                            <p class="text-[11px] text-slate-400 mt-0.5">Jadwal kegiatan RKT terdekat</p>
                        </div>
                        <a href="{{ route('rkt.kalender') }}" class="text-[11px] font-semibold text-blue-600 hover:text-blue-700 transition">Lihat Semua</a>
                    </div>
                    <div class="p-5 space-y-3">
                        @forelse ($upcomingKegiatans as $kegiatan)
                        <div class="flex items-start gap-4 p-3 rounded-xl {{ $loop->index > 0 ? 'opacity-100' : '' }}">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-blue-50 flex flex-col items-center justify-center text-center border border-blue-100">
                                <span class="text-[9px] font-bold text-blue-600 uppercase leading-tight">{{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('d') }}</span>
                                <span class="text-[8px] font-medium text-blue-400 leading-tight">{{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->locale('id')->isoFormat('MMM') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-700 truncate">{{ $kegiatan->nama_kegiatan }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $kegiatan->program?->nama_program ?? '-' }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <p class="text-sm text-slate-400">Belum ada agenda kegiatan</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Kolom Kanan: Log Aktivitas --}}
                <div class="glass-panel shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h2 class="text-sm font-bold text-slate-700">Log Aktivitas Terbaru</h2>
                        <p class="text-[11px] text-slate-400 mt-0.5">Riwayat perubahan data oleh pengguna</p>
                    </div>
                    <div class="p-5">
                        @forelse ($recentLogs as $log)
                        <div class="flex items-start gap-3 py-2.5 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-500 flex-shrink-0">
                                {{ strtoupper(substr($log->user?->name ?? '?', 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-slate-600">
                                    <span class="font-semibold text-slate-700">{{ $log->user?->name ?? 'System' }}</span>
                                    {{ $log->aktivitas }}
                                </p>
                                <p class="text-[11px] text-slate-400 mt-0.5">{{ $log->modul }} · {{ $log->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="w-14 h-14 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm font-semibold text-slate-500">Belum ada aktivitas terbaru</p>
                            <p class="text-xs text-slate-400 mt-1">Sistem berjalan normal.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>