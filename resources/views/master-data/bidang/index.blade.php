<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Master Data Bidang</h1>
                <p class="text-sm text-slate-400 mt-0.5">Kategori utama dalam RENSTRA/RKT — level teratas hierarki perencanaan</p>
            </div>
        </div>
    </x-slot>

    @include('master-data.bidang.css')

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                <div class="xl:col-span-2">
                    @include('master-data.bidang._table')
                </div>
                <div class="flex flex-col gap-5">
                    @include('master-data.bidang._hierarchy')
                    @include('master-data.bidang._chart')
                </div>
            </div>

        </div>
    </div>

    @include('master-data.bidang.modals.create-edit')
    @include('master-data.bidang.modals.delete')

    @include('master-data.bidang.scripts')
</x-app-layout>
