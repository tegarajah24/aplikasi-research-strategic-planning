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

            <div class="glass-panel shadow-sm">
                @include('kegiatan._toolbar')

                @include('kegiatan._table')
            </div>
        </div>

        @include('kegiatan.modals.create-edit')
        @include('kegiatan.modals.detail')
    </div>

    <style>
        @include('kegiatan.css')
    </style>

    <script>
    function filterTable() {
        const q = (document.getElementById('search-input').value || '').toLowerCase();
        const tahun = document.getElementById('filter-tahun').value;
        const pj = document.getElementById('filter-pj').value;
        const status = document.getElementById('filter-status').value;
        let visible = 0;

        document.querySelectorAll('#table-body tr[data-search]').forEach(row => {
            const matchSearch = !q || row.getAttribute('data-search').toLowerCase().includes(q);
            const matchTahun = !tahun || row.getAttribute('data-tahun') === tahun;
            const matchPj = !pj || row.getAttribute('data-pj') === pj;
            const matchStatus = !status || row.getAttribute('data-status') === status;
            const show = matchSearch && matchTahun && matchPj && matchStatus;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        const empty = document.getElementById('filter-empty-state');
        if (empty) empty.classList.toggle('hidden', visible > 0);
    }
    </script>
</x-app-layout>
