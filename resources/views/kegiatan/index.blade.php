<x-app-layout>
    <x-slot name="header">
        <div x-data class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Data Kegiatan Penelitian</h1>
                <p class="text-sm text-slate-400 mt-0.5">Manajemen program kerja penelitian &amp; pengabdian masyarakat berdasarkan Renstra</p>
            </div>

        </div>
    </x-slot>

    <div class="py-8 min-h-full" x-data="{
        showCreateModal: false,
        showEditModal: false,
        showDetailModal: false,
        showTableModal: false,
        editData: {
            id: '', program_id: '', kode_kegiatan: '', nama_kegiatan: '', indikator_kinerja: '',
            target_kegiatan: '', penanggung_jawab: '', tgl_mulai_pelaksanaan: '', tgl_selesai_pelaksanaan: '',
            tahun_akademik: '', kebutuhan_anggaran: '', status: '', catatan: ''
        },
        detailData: {
            program_id: '', kode_kegiatan: '', nama_kegiatan: '', indikator_kinerja: '',
            target_kegiatan: '', penanggung_jawab: '', waktu_pelaksanaan: '',
            tahun_akademik: '', kebutuhan_anggaran: '', status: '', catatan: ''
        }
    }" @open-create-modal.window="showCreateModal = true">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @include('kegiatan._flash')

            @include('kegiatan._stats')

            <div class="glass-panel shadow-sm">
                @include('kegiatan._toolbar')

                @include('kegiatan._table')
            </div>
        </div>

        @include('kegiatan.modals.create-edit')
        @include('kegiatan.modals.detail')
        @include('kegiatan._table_modal')
    </div>

    <style>
        @include('kegiatan.css')
    </style>

    <script>
    function filterTable() {
        const q = (document.getElementById('search-input').value || '').toLowerCase().trim();
        const status = (document.getElementById('filter-status').value || '').trim();
        let visible = 0;

        document.querySelectorAll('#table-body tr[data-search]').forEach(row => {
            const text = (row.getAttribute('data-search') || '').toLowerCase();
            const rowStatus = (row.getAttribute('data-status') || '').trim();

            const matchSearch = !q || text.includes(q);
            const matchStatus = !status || rowStatus === status;
            const show = matchSearch && matchStatus;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        const empty = document.getElementById('filter-empty-state');
        if (empty) empty.classList.toggle('hidden', visible > 0);
    }
    </script>
</x-app-layout>
