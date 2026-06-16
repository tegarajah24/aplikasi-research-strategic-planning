<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Kalender Kegiatan</h1>
                <p class="text-sm text-slate-400 mt-0.5">Jadwal pelaksanaan kegiatan RKT dalam bentuk kalender & timeline</p>
            </div>

        </div>
    </x-slot>

    <style>
        @include('rkt.kalender.css')
    </style>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            @include('rkt.kalender._filters')

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

                @include('rkt.kalender._calendar')

                <div class="flex flex-col gap-5">
                    @include('rkt.kalender._stats')
                    @include('rkt.kalender._upcoming')
                </div>
            </div>

        </div>
    </div>

    @include('rkt.kalender.modals.event-detail')

    <script>
        @include('rkt.kalender.scripts')
    </script>
</x-app-layout>
