<div x-show="showTableModal"
     x-transition:enter="transition ease-out duration-250"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-slate-900/60" @click="showTableModal = false"></div>
        <div x-show="showTableModal"
             x-transition:enter="ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-250"
             x-transition:enter-start="opacity-0 scale-95 translate-y-3"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-3"
             class="relative bg-white rounded-2xl shadow-2xl w-full max-w-6xl border border-slate-100 z-10">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c.621 0 1.125-.504 1.125-1.125m-1.125 1.125v1.5m-7.5 0A1.125 1.125 0 013.375 12m9.75 0a1.125 1.125 0 011.125-1.125"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900">Tabel Data Kegiatan</h3>
                        <p class="text-xs text-slate-500">Rekapitulasi kegiatan berdasarkan bidang &amp; program</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('kegiatan.export.excel') }}"
                       data-no-loader
                       class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold text-white hover:opacity-90 transition shadow-sm"
                       style="background:#0ea5e9">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Excel
                    </a>
                    <a href="{{ route('kegiatan.export.word') }}"
                       data-no-loader
                       class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold text-white hover:opacity-90 transition shadow-sm"
                       style="background:#2563eb">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        Word
                    </a>
                    <button type="button" @click="showTableModal = false"
                        class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-5 max-h-[65vh] overflow-auto">
                <div class="overflow-x-auto shadow-sm border border-slate-200 rounded-xl bg-white">
                    <table class="w-full align-middle" style="min-width: 1000px; border-collapse: collapse;">
                        <thead style="background-color: #1a202c; color: #fff; text-align: center;">
                            <tr>
                                <th style="width: 7%; padding: 12px 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #334155;">No.</th>
                                <th style="width: 25%; padding: 12px 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #334155;">Kegiatan</th>
                                <th style="width: 25%; padding: 12px 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #334155;">Indikator Kinerja Kegiatan</th>
                                <th style="width: 12%; padding: 12px 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #334155;">Target Kegiatan</th>
                                <th style="width: 12%; padding: 12px 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #334155;">Penanggung Jawab</th>
                                <th style="width: 11%; padding: 12px 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #334155;">Waktu Pelaksanaan</th>
                                <th style="width: 8%; padding: 12px 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #334155;">Anggaran (Juta Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotalAnggaran = 0; @endphp

                            @forelse($groupedKegiatans as $namaBidang => $programs)
                                <tr style="background-color: #1e3a8a; color: #ffffff;">
                                    <td colspan="7" style="padding: 14px 16px; font-size: 1.1rem; font-weight: 700; border: 1px solid #cbd5e1;">
                                        {{ $namaBidang }}
                                    </td>
                                </tr>

                                @foreach($programs as $namaProgram => $kegiatans)
                                    <tr style="background-color: #e2e8f0; color: #0f172a;">
                                        <td colspan="7" style="padding: 10px 16px; font-weight: 600; font-style: italic; border: 1px solid #cbd5e1;">
                                            {{ $namaProgram }}
                                        </td>
                                    </tr>

                                    @foreach($kegiatans as $kegiatan)
                                        @php
                                            $anggaranNumeric = is_numeric($kegiatan->kebutuhan_anggaran) ? (float) $kegiatan->kebutuhan_anggaran : 0;
                                            $grandTotalAnggaran += $anggaranNumeric;
                                        @endphp
                                        <tr>
                                            <td style="padding: 12px 8px; text-align: center; font-weight: 500; color: #64748b; font-size: 0.9rem; border: 1px solid #cbd5e1;">
                                                {{ $kegiatan->kode_kegiatan }}
                                            </td>
                                            <td style="padding: 12px 16px; font-weight: 500; border: 1px solid #cbd5e1;">{{ $kegiatan->nama_kegiatan }}</td>
                                            <td style="padding: 12px 16px; color: #64748b; font-size: 0.95rem; border: 1px solid #cbd5e1;">{{ $kegiatan->indikator_kinerja }}</td>
                                            <td style="padding: 12px 8px; text-align: center; font-weight: 600; color: #047857; border: 1px solid #cbd5e1;">{{ $kegiatan->target_kegiatan }}</td>
                                            <td style="padding: 12px 8px; text-align: center; font-size: 0.875rem; border: 1px solid #cbd5e1;">{{ $kegiatan->penanggung_jawab }}</td>
                                            <td style="padding: 12px 8px; text-align: center; font-size: 0.875rem; color: #64748b; border: 1px solid #cbd5e1;">{{ $kegiatan->waktu_pelaksanaan }}</td>
                                            <td style="padding: 12px 8px; text-align: right; font-weight: 700; color: #2563eb; border: 1px solid #cbd5e1;">
                                                {{ number_format($anggaranNumeric / 1_000_000, 1) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="7" style="padding: 40px 16px; text-align: center; color: #64748b; font-style: italic; background-color: #f9fafb; border: 1px solid #cbd5e1;">
                                        Tidak ada data kegiatan.
                                    </td>
                                </tr>
                            @endforelse

                            @if($grandTotalAnggaran > 0)
                                <tr style="background-color: #fef08a; border-top: 2px solid #000000;">
                                    <td colspan="6" style="padding: 14px 16px; text-align: center; font-weight: 700; text-transform: uppercase; border: 1px solid #cbd5e1;">TOTAL KEBUTUHAN ANGGARAN FAKULTAS</td>
                                    <td style="padding: 14px 8px; text-align: right; font-weight: 700; color: #dc2626; font-size: 1.05rem; border: 1px solid #cbd5e1;">
                                        {{ number_format($grandTotalAnggaran / 1_000_000, 1) }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50">
                <button type="button" @click="showTableModal = false"
                    class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-200 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
