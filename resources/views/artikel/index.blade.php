<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold text-slate-800 leading-tight">Artikel</h1>
            <p class="text-sm text-slate-400 mt-0.5">Halaman manajemen Artikel</p>
        </div>
    </x-slot>

    <div class="py-8 min-h-full" x-data="{
        showCreateModal: false,
        showEditModal: false,
        showImportModal: false,
        editData: { id: '', judul: '', penulis: '', tahun: '', penerbit: '', doi: '' }
    }" @open-create-modal.window="showCreateModal = true" @open-import-modal.window="showImportModal = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @include('artikel._flash')

            <div class="glass-panel shadow-sm">
                @include('artikel._toolbar')

                @include('artikel._table')
            </div>
        </div>

        @include('artikel.modals.create-edit')
        @include('artikel.modals.import')
    </div>
</x-app-layout>

<script>
function filterTable() {
    const q = (document.getElementById('search-input').value || '').toLowerCase();
    document.querySelectorAll('#table-body tr[data-search]').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>
