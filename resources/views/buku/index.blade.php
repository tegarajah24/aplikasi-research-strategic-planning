<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold text-slate-800 leading-tight">Buku</h1>
            <p class="text-sm text-slate-400 mt-0.5">Halaman manajemen Buku</p>
        </div>
    </x-slot>

    <div class="py-8 min-h-full" x-data="{
        showCreateModal: false,
        showEditModal: false,
        showImportModal: false,
        editData: { id: '', judul: '', penulis: '', penerbit: '', tahun_terbit: '', isbn: '' }
    }" @open-create-modal.window="showCreateModal = true" @open-import-modal.window="showImportModal = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @include('buku._flash')

            <div class="glass-panel shadow-sm">
                @include('buku._toolbar')

                @include('buku._table')
            </div>
        </div>

        @include('buku.modals.create-edit')
        @include('buku.modals.import')
    </div>
</x-app-layout>
