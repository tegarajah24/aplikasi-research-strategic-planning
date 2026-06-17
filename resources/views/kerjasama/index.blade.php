<x-app-layout>
    <x-slot name="header">
        <div x-data class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Kerja Sama (MoU)</h1>
                <p class="text-sm text-slate-400 mt-0.5">Halaman manajemen data Cooperations (MoU)</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 min-h-full" x-data="{
        showCreateModal: false,
        showEditModal: false,
        showImportModal: false,
        editData: { id: '', nomor_surat: '', tanggal: '', mitra: '', jenis: '', tingkat: '', pic: '', program_studi: '' }
    }" @open-create-modal.window="showCreateModal = true" @open-import-modal.window="showImportModal = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @include('kerjasama._flash')

            <div class="glass-panel shadow-sm">
                @include('kerjasama._toolbar')
                @include('kerjasama._table')
            </div>
        </div>

        @include('kerjasama.modals.create-edit')
    </div>

    @push('scripts')
    <script>
        function filterTable() {
            const input = document.getElementById('search-input');
            const filter = input.value.toLowerCase().trim();
            const tableBody = document.getElementById('table-body');
            const rows = tableBody.querySelectorAll('tr[data-search]');
            let visibleCount = 0;
            rows.forEach(row => {
                const text = row.getAttribute('data-search') || '';
                if (text.includes(filter)) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });
            document.getElementById('filter-empty-state').classList.toggle('hidden', visibleCount > 0);
        }
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('search-input');
            if (input) input.addEventListener('input', filterTable);
        });
    </script>
    @endpush
</x-app-layout>
