<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse min-w-[900px]">
        <thead>
            <tr class="bg-slate-50/70 border-b border-slate-100">
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center w-10">No</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-24">Kode</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider min-w-[200px]">Nama Kegiatan</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider min-w-[180px]">Indikator Kinerja</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-24">Target</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Penanggung Jawab</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider min-w-[160px]">Waktu Pelaksanaan</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider min-w-[140px]">Kebutuhan Anggaran</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Status</th>
                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right w-28">Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body" class="divide-y divide-slate-100">
            @forelse($kegiatans as $index => $kegiatan)
            <tr class="hover:bg-slate-50/50 transition-colors duration-100 group"
                data-search="{{ $kegiatan->kode_kegiatan }} {{ $kegiatan->nama_kegiatan }} {{ $kegiatan->penanggung_jawab }}"
                data-tahun="{{ $kegiatan->tahun_akademik }}"
                data-pj="{{ $kegiatan->penanggung_jawab }}"
                data-status="{{ $kegiatan->status }}">
                <td class="py-4 px-4 text-sm text-slate-500 text-center font-medium">
                    {{ $kegiatans->firstItem() + $index }}
                </td>
                <td class="py-4 px-4">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100 font-mono">
                        {{ $kegiatan->kode_kegiatan }}
                    </span>
                </td>
                <td class="py-4 px-4">
                    <div class="text-sm font-semibold text-slate-800 leading-snug line-clamp-2 max-w-[220px]">
                        {{ $kegiatan->nama_kegiatan }}
                    </div>
                    @if($kegiatan->tahun_akademik)
                        <div class="text-xs text-slate-400 mt-1">TA: {{ $kegiatan->tahun_akademik }}</div>
                    @endif
                </td>
                <td class="py-4 px-4">
                    <div class="text-sm text-slate-600 line-clamp-2 max-w-[200px]">
                        {{ $kegiatan->indikator_kinerja }}
                    </div>
                </td>
                <td class="py-4 px-4">
                    <span class="text-sm font-semibold text-slate-700">{{ $kegiatan->target_kegiatan }}</span>
                </td>
                <td class="py-4 px-4">
                    <div class="flex items-center gap-1.5">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-[10px] font-bold text-white flex-shrink-0">
                            {{ strtoupper(substr($kegiatan->penanggung_jawab, 0, 2)) }}
                        </div>
                        <span class="text-sm text-slate-700 font-medium">{{ $kegiatan->penanggung_jawab }}</span>
                    </div>
                </td>
                <td class="py-4 px-4">
                    <div class="flex items-start gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                        <span class="text-sm text-slate-600 leading-snug">{{ $kegiatan->waktu_pelaksanaan }}</span>
                    </div>
                </td>
                <td class="py-4 px-4">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75"/>
                        </svg>
                        <span class="text-sm text-slate-600">{{ $kegiatan->kebutuhan_anggaran_formatted }}</span>
                    </div>
                </td>
                <td class="py-4 px-4">
                    @php
                        $statusConfig = match($kegiatan->status) {
                            'perencanaan' => ['label' => 'Perencanaan', 'classes' => 'bg-blue-50 text-blue-700 border-blue-200', 'dot' => 'bg-blue-400'],
                            'berjalan'    => ['label' => 'Berjalan',    'classes' => 'bg-amber-50 text-amber-700 border-amber-200', 'dot' => 'bg-amber-400'],
                            'selesai'     => ['label' => 'Selesai',     'classes' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' => 'bg-emerald-400'],
                            'tertunda'    => ['label' => 'Tertunda',    'classes' => 'bg-rose-50 text-rose-700 border-rose-200', 'dot' => 'bg-rose-400'],
                            default       => ['label' => '-',           'classes' => 'bg-slate-50 text-slate-600 border-slate-200', 'dot' => 'bg-slate-400'],
                        };
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusConfig['classes'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }} {{ $kegiatan->status === 'berjalan' ? 'animate-pulse' : '' }}"></span>
                        {{ $statusConfig['label'] }}
                    </span>
                </td>
                <td class="py-4 px-4 text-right">
                    <div class="flex items-center justify-end gap-1 opacity-70 group-hover:opacity-100 transition-opacity">
                        <button type="button" id="btn-detail-{{ $kegiatan->id }}"
                            @click="detailData = {{ json_encode($kegiatan->toArray()) }}; showDetailModal = true"
                            class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                            title="Lihat Detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                        @if(auth()->user()->canWrite('kegiatan'))
                        <button type="button" id="btn-edit-{{ $kegiatan->id }}"
                            @click="const d = {{ json_encode($kegiatan->toArray()) }}; if (d.tgl_mulai_pelaksanaan) d.tgl_mulai_pelaksanaan = d.tgl_mulai_pelaksanaan.substring(0, 7); if (d.tgl_selesai_pelaksanaan) d.tgl_selesai_pelaksanaan = d.tgl_selesai_pelaksanaan.substring(0, 7); d.kebutuhan_anggaran = d.kebutuhan_anggaran / 1000000; editData = d; showEditModal = true"
                            class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                            title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <form action="{{ route('kegiatan.destroy', $kegiatan) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?\n\n{{ addslashes($kegiatan->nama_kegiatan) }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="btn-hapus-{{ $kegiatan->id }}"
                                class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="py-16 px-6 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-800 mb-1">Tidak ada kegiatan ditemukan</h3>
                        <p class="text-sm text-slate-500 mb-4">
                            @if(request()->hasAny(['search', 'tahun_akademik', 'penanggung_jawab', 'status']))
                                Coba ubah filter pencarian Anda.
                            @else
                                Mulai dengan menambahkan data kegiatan baru.
                            @endif
                        </p>
                        @if(!request()->hasAny(['search', 'tahun_akademik', 'penanggung_jawab', 'status']))
                            <button @click="showCreateModal = true"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Kegiatan Pertama
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Filter empty state --}}
<div id="filter-empty-state" class="hidden px-5 py-16 text-center">
    <div class="flex flex-col items-center justify-center">
        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
            </svg>
        </div>
        <h3 class="text-sm font-semibold text-slate-800 mb-1">Tidak ada kegiatan ditemukan</h3>
        <p class="text-sm text-slate-500">Coba ubah filter atau kata kunci pencarian Anda.</p>
    </div>
</div>

@if($kegiatans->hasPages())
    <div class="p-4 border-t border-slate-100 flex items-center justify-between gap-4">
        <p class="text-xs text-slate-500">
            Menampilkan <span class="font-semibold text-slate-700">{{ $kegiatans->firstItem() }}</span>–<span class="font-semibold text-slate-700">{{ $kegiatans->lastItem() }}</span>
            dari <span class="font-semibold text-slate-700">{{ $kegiatans->total() }}</span> kegiatan
        </p>
        {{ $kegiatans->links() }}
    </div>
@else
    <div class="p-4 border-t border-slate-100">
        <p class="text-xs text-slate-500">
            Menampilkan {{ $kegiatans->count() }} kegiatan
        </p>
    </div>
@endif
