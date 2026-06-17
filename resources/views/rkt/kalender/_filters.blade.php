<div class="glass-panel shadow-sm px-5 py-4 relative z-20">
    <div class="flex flex-wrap items-center gap-3">
        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
        </svg>
        <span class="text-sm font-semibold text-slate-600">Filter:</span>

        {{-- Tahun --}}
        <div x-data="filterSelect(() => applyFilters())" @click.outside="open = false" class="filter-select-wrapper relative min-w-[160px]">
            <button @click="toggle" type="button"
                class="flex items-center justify-between gap-2 w-full border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none cursor-pointer bg-white transition-colors duration-200"
                :class="open ? 'border-blue-400' : 'hover:border-slate-300'">
                <span x-text="selected ? (options.find(o => o.value === selected)?.label || selected) : placeholder" class="truncate"></span>
                <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                class="absolute z-50 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg py-1 max-h-48 overflow-y-auto">
                <template x-for="(opt, i) in options" :key="i">
                    <button @click="select(opt.value)" type="button"
                        class="w-full text-left px-3 py-2 text-xs transition-colors duration-100"
                        :class="selected === opt.value ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                        x-text="opt.label">
                    </button>
                </template>
            </div>
            <select id="filter-tahun" class="hidden simple-select" onchange="applyFilters()">
                <option value="">Semua Tahun</option>
                @php
                    $tahunList = $eventsData->pluck('start')->map(fn($d) => date('Y', strtotime($d)))->unique()->sort()->values();
                @endphp
                @foreach($tahunList as $t)
                    <option value="{{ $t }}">{{ $t }}</option>
                @endforeach
            </select>
        </div>



        {{-- PJ --}}
        <div x-data="filterSelect(() => applyFilters())" @click.outside="open = false" class="filter-select-wrapper relative min-w-[160px]">
            <button @click="toggle" type="button"
                class="flex items-center justify-between gap-2 w-full border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none cursor-pointer bg-white transition-colors duration-200"
                :class="open ? 'border-blue-400' : 'hover:border-slate-300'">
                <span x-text="selected ? (options.find(o => o.value === selected)?.label || selected) : placeholder" class="truncate"></span>
                <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                class="absolute z-50 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg py-1 max-h-48 overflow-y-auto">
                <template x-for="(opt, i) in options" :key="i">
                    <button @click="select(opt.value)" type="button"
                        class="w-full text-left px-3 py-2 text-xs transition-colors duration-100"
                        :class="selected === opt.value ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                        x-text="opt.label">
                    </button>
                </template>
            </div>
            <select id="filter-pj" class="hidden simple-select" onchange="applyFilters()">
                <option value="">Semua PJ</option>
                @php
                    $pjList = $eventsData->pluck('pj')->unique()->sort()->values();
                @endphp
                @foreach($pjList as $pj)
                    <option value="{{ $pj }}">{{ $pj }}</option>
                @endforeach
            </select>
        </div>

        <button onclick="goToToday()"
            class="flex items-center gap-2 px-4 py-3 rounded-lg text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 transition-colors shadow-sm shrink-0 whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
            </svg>
            Hari Ini
        </button>

        <button onclick="resetFilters()" class="ml-auto text-xs text-blue-500 hover:text-blue-700 font-medium transition-colors">
            Reset Filter
        </button>
    </div>

    <div class="flex flex-wrap items-center gap-2 mt-4 pt-4 border-t border-slate-100">
        <span class="text-xs text-slate-400 font-medium mr-1">Status:</span>
        <span class="legend-chip chip-done">
            <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span> Selesai
        </span>
        <span class="legend-chip chip-running">
            <span class="w-2 h-2 rounded-full bg-amber-400 inline-block"></span> Berjalan
        </span>
        <span class="legend-chip chip-upcoming">
            <span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span> Akan Datang
        </span>
        <span class="legend-chip chip-late">
            <span class="w-2 h-2 rounded-full bg-red-500 inline-block"></span> Terlambat
        </span>
    </div>
</div>
