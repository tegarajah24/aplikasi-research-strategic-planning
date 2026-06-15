<div class="glass-panel shadow-sm px-5 py-4">
    <div class="flex flex-wrap items-center gap-3">
        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
        </svg>
        <span class="text-sm font-semibold text-slate-600">Filter:</span>

        <select id="filter-tahun" class="filter-select" onchange="applyFilters()">
            <option value="">Semua Tahun</option>
            @php
                $tahunList = $eventsData->pluck('start')->map(fn($d) => date('Y', strtotime($d)))->unique()->sort()->values();
            @endphp
            @foreach($tahunList as $t)
                <option value="{{ $t }}">{{ $t }}</option>
            @endforeach
        </select>

        <select id="filter-bidang" class="filter-select" onchange="applyFilters()">
            <option value="">Semua Bidang</option>
            @foreach($bidangList as $b)
                <option value="{{ $b->nama_bidang }}">{{ $b->nama_bidang }}</option>
            @endforeach
        </select>

        <select id="filter-program" class="filter-select" onchange="applyFilters()">
            <option value="">Semua Program</option>
            @php
                $programList = $eventsData->pluck('program')->unique()->filter()->sort()->values();
            @endphp
            @foreach($programList as $p)
                <option value="{{ $p }}">{{ $p }}</option>
            @endforeach
        </select>

        <select id="filter-pj" class="filter-select" onchange="applyFilters()">
            <option value="">Semua PJ</option>
            @php
                $pjList = $eventsData->pluck('pj')->unique()->sort()->values();
            @endphp
            @foreach($pjList as $pj)
                <option value="{{ $pj }}">{{ $pj }}</option>
            @endforeach
        </select>

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
