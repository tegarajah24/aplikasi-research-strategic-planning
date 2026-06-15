<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    <div class="dash-card glass-panel shadow-sm overflow-hidden">
        <div class="h-1 bg-rose-500"></div>
        <div class="p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center">
                    <x-icon name="trophy" class="w-5 h-5 text-rose-600" />
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-800 tracking-tight">{{ $totalRegional }}</p>
            <p class="text-xs text-slate-400 mt-1">Total Prestasi Regional</p>
        </div>
    </div>

    <div class="dash-card glass-panel shadow-sm overflow-hidden">
        <div class="h-1 bg-emerald-500"></div>
        <div class="p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <x-icon name="trophy" class="w-5 h-5 text-emerald-600" />
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-800 tracking-tight">{{ $totalNasional }}</p>
            <p class="text-xs text-slate-400 mt-1">Total Prestasi Nasional</p>
        </div>
    </div>

    <div class="dash-card glass-panel shadow-sm overflow-hidden">
        <div class="h-1 bg-blue-500"></div>
        <div class="p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                    <x-icon name="trophy" class="w-5 h-5 text-blue-600" />
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-800 tracking-tight">{{ $totalInternasional }}</p>
            <p class="text-xs text-slate-400 mt-1">Total Prestasi Internasional</p>
        </div>
    </div>
</div>
