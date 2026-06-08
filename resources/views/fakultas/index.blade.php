<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 leading-tight">
        {{ __('Data Fakultas') }}
    </h2>
</x-slot>

<div x-data="fakultasPage()" @open-create-modal.window="showCreateModal = true">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
                @include('fakultas._flash')

                @include('fakultas._toolbar')

                @include('fakultas._table')
            </div>
        </div>
    </div>

    @include('fakultas.modals.create-edit')
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('fakultasPage', () => ({
        showCreateModal: false,
        showEditModal: false,
        editData: {},
    }));
});
</script>
</x-app-layout>
