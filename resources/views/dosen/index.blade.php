<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 leading-tight">
        {{ __('Data Dosen') }}
    </h2>
</x-slot>

<div x-data="dosenPage()" @open-create-modal.window="showCreateModal = true">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-panel shadow-sm">
                @include('dosen._flash')

                @include('dosen._toolbar')

                @include('dosen._table')
            </div>
        </div>
    </div>

    @include('dosen.modals.create-edit')
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('dosenPage', () => ({
        showCreateModal: false,
        showEditModal: false,
        editData: {},
    }));
});
</script>
</x-app-layout>
