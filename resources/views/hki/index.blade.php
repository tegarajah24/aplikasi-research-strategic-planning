<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold text-slate-800 leading-tight">HKI</h1>
            <p class="text-sm text-slate-400 mt-0.5">Halaman manajemen Hak Kekayaan Intelektual</p>
        </div>
    </x-slot>

    <div class="py-8 min-h-full" x-data="{
        showCreateModal: false,
        showEditModal: false,
        showImportModal: false,
        editData: { id: '', judul: '', pencipta: '', jenis_hki: '', nomor_pendaftaran: '', tahun: '' }
    }" @open-create-modal.window="showCreateModal = true" @open-import-modal.window="showImportModal = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @include('hki._flash')

            <div class="glass-panel shadow-sm">
                @include('hki._toolbar')

                @include('hki._table')
            </div>
        </div>

        @include('hki.modals.create-edit')
        @include('hki.modals.import')
    </div>
</x-app-layout>
