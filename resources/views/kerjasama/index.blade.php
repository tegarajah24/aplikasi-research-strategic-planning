<x-app-layout>
    <x-slot name="header">
        <div x-data class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Kerja Sama (MoU)</h1>
                <p class="text-sm text-slate-400 mt-0.5">Halaman manajemen data Cooperations (MoU)</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="$dispatch('open-create-modal')" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-indigo-700 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Cooperation
                </button>
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

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                @include('kerjasama._toolbar')
                @include('kerjasama._table')
            </div>
        </div>

        @include('kerjasama.modals.create-edit')
    </div>
</x-app-layout>
