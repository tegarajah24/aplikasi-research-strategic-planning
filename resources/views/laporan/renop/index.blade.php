@php
    $no = 0;
    $totalAnggaran = 0;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Laporan RENOP Tahunan</h1>
                <p class="text-sm text-slate-400 mt-0.5">Matriks Rencana Operasional — Program & Kegiatan per Bidang</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Filter --}}
            <div class="glass-panel shadow-sm">
                <div class="flex items-center justify-between gap-3 px-5 py-4 flex-wrap bg-slate-50/50 border-b border-slate-100 rounded-t-2xl">
                    <div class="flex items-center gap-3">
                        <label class="text-xs font-semibold text-slate-600">Tahun Akademik</label>
                        <select id="filter-ta" onchange="filterLaporan()"
                            class="simple-select border border-slate-200 rounded-xl px-3 py-2.5 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer">
                            @foreach($tahunAkademikOptions as $opt)
                                <option value="{{ $opt }}" {{ $opt === $tahunAkademik ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="window.location='{{ route('laporan.renop.export', $tahunAkademik) }}'"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm"
                            style="background:#0ea5e9">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>

                {{-- Table --}}
                <div class="p-6 overflow-x-auto">
                    @if($grouped->isEmpty())
                        <div class="py-16 text-center">
                            <p class="text-sm font-semibold text-slate-600">Tidak ada data kegiatan untuk tahun akademik ini.</p>
                        </div>
                    @else
                        <table class="w-full text-left border-collapse min-w-[1100px]">
                            <thead>
                                <tr class="bg-slate-800 text-white">
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-center w-10">No</th>
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider w-32">Bidang</th>
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider w-36">Program</th>
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider min-w-[200px]">Kegiatan</th>
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider min-w-[180px]">Indikator Kinerja</th>
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider w-20">Target</th>
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider w-28">Penanggung Jawab</th>
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider w-28">Waktu</th>
                                    <th class="py-3 px-3 text-xs font-bold uppercase tracking-wider text-right w-28">Anggaran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach($grouped as $bidang => $programs)
                                    @php
                                        $bidangRowCount = $programs->sum(fn($items) => $items->count());
                                        $bidangFirst = true;
                                    @endphp
                                    @foreach($programs->sortKeys() as $program => $items)
                                        @php $programFirst = true; @endphp
                                        @foreach($items->sortBy('nama_kegiatan') as $kegiatan)
                                            @php
                                                $no++;
                                                $totalAnggaran += $kegiatan->kebutuhan_anggaran;
                                            @endphp
                                            <tr class="hover:bg-slate-50/50 transition-colors">
                                                <td class="py-2.5 px-3 text-sm text-slate-500 text-center font-medium">{{ $no }}</td>
                                                @if($bidangFirst && $programFirst)
                                                    <td class="py-2.5 px-3 text-sm font-bold text-slate-700 bg-blue-50/50"
                                                        rowspan="{{ $bidangRowCount }}">{{ $bidang }}</td>
                                                @endif
                                                @if($programFirst)
                                                    <td class="py-2.5 px-3 text-sm font-semibold text-slate-600 bg-sky-50/30"
                                                        rowspan="{{ $items->count() }}">{{ $program }}</td>
                                                    @php $programFirst = false; $bidangFirst = false; @endphp
                                                @endif
                                                <td class="py-2.5 px-3 text-sm text-slate-800">{{ $kegiatan->nama_kegiatan }}</td>
                                                <td class="py-2.5 px-3 text-sm text-slate-600 max-w-[220px] leading-snug">{{ $kegiatan->indikator_kinerja }}</td>
                                                <td class="py-2.5 px-3 text-sm font-semibold text-slate-700">{{ $kegiatan->target_kegiatan }}</td>
                                                <td class="py-2.5 px-3 text-sm text-slate-700">{{ $kegiatan->penanggung_jawab }}</td>
                                                <td class="py-2.5 px-3 text-sm text-slate-600">{{ $kegiatan->waktu_pelaksanaan }}</td>
                                                <td class="py-2.5 px-3 text-sm text-slate-700 text-right font-medium whitespace-nowrap">
                                                    Rp {{ number_format($kegiatan->kebutuhan_anggaran, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-slate-800 text-white font-bold">
                                    <td colspan="8" class="py-3 px-3 text-sm text-right uppercase tracking-wider">Total Anggaran</td>
                                    <td class="py-3 px-3 text-sm text-right whitespace-nowrap">
                                        Rp {{ number_format($totalAnggaran, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        #filter-ta {
            min-width: 140px;
        }
    </style>

    <script>
    function filterLaporan() {
        const ta = document.getElementById('filter-ta').value;
        window.location = '{{ route('laporan.renop') }}?tahun_akademik=' + encodeURIComponent(ta);
    }
    </script>
</x-app-layout>
