<x-app-layout>
    <x-slot name="header">
        <div x-data class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Data Kegiatan Penelitian</h1>
                <p class="text-sm text-slate-400 mt-0.5">Manajemen program kerja penelitian &amp; pengabdian masyarakat berdasarkan Renstra</p>
            </div>
            <div class="flex items-center gap-2">
                <button @click="$dispatch('open-create-modal')"
                    id="btn-tambah-kegiatan"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 active:scale-95 transition-all shadow-sm shadow-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kegiatan
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 min-h-full" x-data="{
        showCreateModal: false,
        showEditModal: false,
        showDetailModal: false,
        editData: {
            id: '', kode_kegiatan: '', nama_kegiatan: '', indikator_kinerja: '',
            target_kegiatan: '', penanggung_jawab: '', waktu_pelaksanaan: '',
            tahun_akademik: '', kebutuhan_anggaran: '', status: '', catatan: ''
        },
        detailData: {
            kode_kegiatan: '', nama_kegiatan: '', indikator_kinerja: '',
            target_kegiatan: '', penanggung_jawab: '', waktu_pelaksanaan: '',
            tahun_akademik: '', kebutuhan_anggaran: '', status: '', catatan: ''
        }
    }" @open-create-modal.window="showCreateModal = true">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @include('kegiatan._flash')

            @include('kegiatan._stats')

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                @include('kegiatan._toolbar')

                @include('kegiatan._table')
            </div>
        </div>

        @include('kegiatan.modals.create-edit')
        @include('kegiatan.modals.detail')
    </div>
</x-app-layout>
