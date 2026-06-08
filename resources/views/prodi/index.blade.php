<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 leading-tight">
        {{ __('Data Program Studi') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
            @include('prodi._flash')

            @include('prodi._toolbar')

            @include('prodi._table')
        </div>
    </div>
</div>

@include('prodi.modals.create-edit')

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('prodiPage', () => ({
        showCreateModal: false,
        showEditModal: false,
        editData: {},
    }));
});
</script>
</x-app-layout>
