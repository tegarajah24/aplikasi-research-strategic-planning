<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Kalender Kegiatan</h1>
                <p class="text-sm text-slate-400 mt-0.5">Jadwal pelaksanaan kegiatan RKT dalam bentuk kalender & timeline</p>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="goToToday()"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors shadow-sm shadow-blue-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    Hari Ini
                </button>
            </div>
        </div>
    </x-slot>

    @include('rkt.kalender.css')

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
