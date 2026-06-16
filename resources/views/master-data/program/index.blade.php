<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Master Data Program</h1>
                <p class="text-sm text-slate-400 mt-0.5">Program — turunan Bidang, induk Kegiatan dalam RENSTRA/RKT</p>
            </div>
        </div>
    </x-slot>

    @include('master-data.program.css')

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            @include('master-data.program._stats')

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                <div class="xl:col-span-2">
                    @include('master-data.program._table')
                </div>
                <div class="flex flex-col gap-5">
                    @include('master-data.program._hierarchy')
                    @include('master-data.program._progchart')
                </div>
            </div>

        </div>
    </div>

    @include('master-data.program._drawer')
    @include('master-data.program.modals.create-edit')
    @include('master-data.program.modals.delete')

    @include('master-data.program.scripts')
</x-app-layout>
