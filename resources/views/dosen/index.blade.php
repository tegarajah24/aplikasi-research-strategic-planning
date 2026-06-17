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
    
    const dbEmptyState = document.getElementById('filter-empty-state-db');
    if (dbEmptyState) {
        if (filter !== '') {
            dbEmptyState.classList.add('hidden');
        } else {
            const actualRows = Array.from(rows).length;
            if (actualRows === 0) {
                dbEmptyState.classList.remove('hidden');
            }
        }
    }
    
    document.getElementById('filter-empty-state').classList.toggle('hidden', visibleCount > 0 || (dbEmptyState && !dbEmptyState.classList.contains('hidden')));
}

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('search-input');
    if (input) input.addEventListener('input', filterTable);
});
</script>
</x-app-layout>
