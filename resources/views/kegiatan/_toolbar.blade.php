<div class="p-5 border-b border-slate-100">
    <div class="flex flex-col lg:flex-row gap-3 items-start lg:items-center">
        {{-- Search + Tambah Button --}}
        <div class="flex items-center gap-2 w-full lg:w-auto">
            <input type="text" id="search-input" placeholder="Cari kode, nama kegiatan, pj..."
                class="border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 w-full lg:w-44"
                oninput="filterTable()" value="{{ request('search') }}">
            @if(auth()->user()->canWrite('kegiatan'))
            <button @click="$dispatch('open-create-modal')"
                class="flex items-center gap-2 px-4 py-3 rounded-lg text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 transition-colors shadow-sm shrink-0 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kegiatan
            </button>
            @endif
        </div>

        {{-- Filters --}}
        <div class="flex items-center gap-2 flex-wrap lg:ml-auto">
            {{-- Tahun --}}
            <div x-data="filterSelect(() => filterTable())" @click.outside="open = false" class="filter-select-wrapper relative min-w-[180px]">
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
                <select id="filter-tahun" class="hidden simple-select" onchange="filterTable()">
                    <option value="">Semua Tahun Akademik</option>
                    @foreach($tahunAkademikOptions as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun_akademik') === $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Penanggung Jawab --}}
            <div x-data="filterSelect(() => filterTable())" @click.outside="open = false" class="filter-select-wrapper relative min-w-[180px]">
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
                <select id="filter-pj" class="hidden simple-select" onchange="filterTable()">
                    <option value="">Semua Penanggung Jawab</option>
                    @foreach($penanggungJawabOptions as $pj)
                        <option value="{{ $pj }}" {{ request('penanggung_jawab') === $pj ? 'selected' : '' }}>{{ $pj }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div x-data="filterSelect(() => filterTable())" @click.outside="open = false" class="filter-select-wrapper relative min-w-[160px]">
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
                <select id="filter-status" class="hidden simple-select" onchange="filterTable()">
                    <option value="">Semua Status</option>
                    <option value="perencanaan" {{ request('status') === 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                    <option value="berjalan"    {{ request('status') === 'berjalan'    ? 'selected' : '' }}>Berjalan</option>
                    <option value="selesai"     {{ request('status') === 'selesai'     ? 'selected' : '' }}>Selesai</option>
                    <option value="tertunda"    {{ request('status') === 'tertunda'    ? 'selected' : '' }}>Tertunda</option>
                </select>
            </div>
        </div>
    </div>
</div>
