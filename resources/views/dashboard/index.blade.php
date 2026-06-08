<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Dashboard</h1>
                <p class="text-sm text-slate-400 mt-0.5">Selamat datang kembali — ringkasan sistem RSP-UHB</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-400 hidden sm:block">{{ now()->translatedFormat('l, d F Y') }}</span>

            </div>
        </div>
    </x-slot>



    <div class="py-8 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ════════════════ ACTIVITY FEED ════════════════ --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-700">Aktivitas Terbaru</h2>
                        <p class="text-[11px] text-slate-400 mt-0.5">Log perubahan terakhir pada sistem</p>
                    </div>
                    <span class="text-[11px] font-medium px-2.5 py-1 rounded-lg bg-slate-50 text-slate-400 border border-slate-100">{{ now()->translatedFormat('F Y') }}</span>
                </div>

                <div class="p-6">
                    <div class="text-center py-12">
                        <svg class="w-14 h-14 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm font-semibold text-slate-500">Belum ada aktivitas terbaru</p>
                        <p class="text-xs text-slate-400 mt-1">Sistem berjalan normal.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
