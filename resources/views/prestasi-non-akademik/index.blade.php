<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Prestasi Non-Akademik</h1>
                <p class="text-sm text-slate-400 mt-0.5">Rekapitulasi capaian prestasi non-akademik per tahun</p>
            </div>
        </div>
    </x-slot>

    @include('prestasi-non-akademik.css')

    <div class="py-8 min-h-full" x-data="{
        showCreateModal: false,
        showEditModal: false,
        showImportModal: false,
        editData: { id: '', tahun: '', regional: 0, nasional: 0, internasional: 0 }
    }" @open-create-modal.window="showCreateModal = true" @open-import-modal.window="showImportModal = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @include('prestasi-non-akademik._flash')
            @include('prestasi-non-akademik._stats')

            <div class="glass-panel shadow-sm">
                @include('prestasi-non-akademik._toolbar')
                @include('prestasi-non-akademik._table')
            </div>
        </div>

        @include('prestasi-non-akademik.modals.create-edit')
    </div>
</x-app-layout>
