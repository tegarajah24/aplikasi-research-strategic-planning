<x-app-layout>
    @include('pengguna._toolbar')

    @include('pengguna.css')

    @include('pengguna._flash')

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @include('pengguna._table')
                @include('pengguna._audit-log')
            </div>
        </div>
    </div>

    @include('pengguna.modals.create-edit')
    @include('pengguna.modals.view')

    @include('pengguna._scripts')
</x-app-layout>
