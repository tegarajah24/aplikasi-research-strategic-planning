<div x-show="showDetailModal"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-slate-900/60" @click="showDetailModal = false"></div>
        <div x-show="showDetailModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg border border-slate-100 z-10">

            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-blue-50/50 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900">Detail Kegiatan</h3>
                        <p class="text-xs text-slate-500" x-text="'Kode: ' + detailData.kode_kegiatan"></p>
                    </div>
                </div>
                <button type="button" @click="showDetailModal = false"
                    class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">Nama Kegiatan</p>
                    <p class="text-sm font-semibold text-slate-800" x-text="detailData.nama_kegiatan"></p>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Kode</p>
                        <p class="text-sm font-bold text-slate-800 font-mono" x-text="detailData.kode_kegiatan"></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tahun Akademik</p>
                        <p class="text-sm font-medium text-slate-700" x-text="detailData.tahun_akademik || '-'"></p>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-xl p-3">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Indikator Kinerja</p>
                    <p class="text-sm text-slate-700" x-text="detailData.indikator_kinerja"></p>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3">
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-1">Target</p>
                        <p class="text-lg font-bold text-emerald-700" x-text="detailData.target_kegiatan"></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Penanggung Jawab</p>
                        <p class="text-sm font-semibold text-slate-800" x-text="detailData.penanggung_jawab"></p>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-xl p-3">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Waktu Pelaksanaan</p>
                    <p class="text-sm text-slate-700" x-text="detailData.waktu_pelaksanaan"></p>
                </div>

                <div class="bg-amber-50 border border-amber-100 rounded-xl p-3">
                    <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider mb-1">Kebutuhan Anggaran</p>
                    <p class="text-sm font-medium text-slate-800" x-text="detailData.kebutuhan_anggaran"></p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex-1 bg-slate-50 rounded-xl p-3">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Status</p>
                        <template x-if="detailData.status === 'perencanaan'">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border bg-blue-50 text-blue-700 border-blue-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Perencanaan
                            </span>
                        </template>
                        <template x-if="detailData.status === 'berjalan'">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border bg-amber-50 text-amber-700 border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>Berjalan
                            </span>
                        </template>
                        <template x-if="detailData.status === 'selesai'">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border bg-emerald-50 text-emerald-700 border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Selesai
                            </span>
                        </template>
                        <template x-if="detailData.status === 'tertunda'">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border bg-rose-50 text-rose-700 border-rose-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>Tertunda
                            </span>
                        </template>
                    </div>
                </div>

                <template x-if="detailData.catatan">
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Catatan</p>
                        <p class="text-sm text-slate-700" x-text="detailData.catatan"></p>
                    </div>
                </template>
            </div>

            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50/50 rounded-b-2xl">
                <button type="button"
                    @click="editData = { ...detailData }; showDetailModal = false; showEditModal = true"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </button>
                <button type="button" @click="showDetailModal = false"
                    class="px-4 py-2 border border-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-100 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
