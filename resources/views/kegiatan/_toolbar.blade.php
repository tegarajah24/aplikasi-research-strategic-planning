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
            <select id="filter-tahun" onchange="filterTable()"
                class="simple-select border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer min-w-[180px]">
                <option value="">Semua Tahun Akademik</option>
                @foreach($tahunAkademikOptions as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun_akademik') === $tahun ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
                @endforeach
            </select>

            <select id="filter-pj" onchange="filterTable()"
                class="simple-select border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer min-w-[180px]">
                <option value="">Semua Penanggung Jawab</option>
                @foreach($penanggungJawabOptions as $pj)
                    <option value="{{ $pj }}" {{ request('penanggung_jawab') === $pj ? 'selected' : '' }}>
                        {{ $pj }}
                    </option>
                @endforeach
            </select>

            <select id="filter-status" onchange="filterTable()"
                class="simple-select border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer min-w-[180px]">
                <option value="">Semua Status</option>
                <option value="perencanaan" {{ request('status') === 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                <option value="berjalan"    {{ request('status') === 'berjalan'    ? 'selected' : '' }}>Berjalan</option>
                <option value="selesai"     {{ request('status') === 'selesai'     ? 'selected' : '' }}>Selesai</option>
                <option value="tertunda"    {{ request('status') === 'tertunda'    ? 'selected' : '' }}>Tertunda</option>
            </select>
        </div>
    </div>
</div>
