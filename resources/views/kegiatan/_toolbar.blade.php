<div class="p-5 border-b border-slate-100">
    <form method="GET" action="{{ route('kegiatan.index') }}" id="filter-form">
        <div class="flex flex-col lg:flex-row gap-3">

            {{-- Search --}}
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 20 20" fill-rule="evenodd">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" fill="currentColor"/>
                    </svg>
                </div>
                <input type="text" id="input-search" name="search" value="{{ request('search') }}"
                    class="block w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors"
                    placeholder="Cari kode, nama kegiatan, penanggung jawab...">
            </div>

            {{-- Filter: Tahun Akademik --}}
            <div class="w-full lg:w-48">
                <select id="filter-tahun" name="tahun_akademik"
                    class="block w-full border border-slate-200 rounded-xl py-2.5 px-3 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    onchange="document.getElementById('filter-form').submit()">
                    <option value="">Semua Tahun Akademik</option>
                    @foreach($tahunAkademikOptions as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun_akademik') === $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter: Penanggung Jawab --}}
            <div class="w-full lg:w-44">
                <select id="filter-pj" name="penanggung_jawab"
                    class="block w-full border border-slate-200 rounded-xl py-2.5 px-3 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    onchange="document.getElementById('filter-form').submit()">
                    <option value="">Semua Penanggung Jawab</option>
                    @foreach($penanggungJawabOptions as $pj)
                        <option value="{{ $pj }}" {{ request('penanggung_jawab') === $pj ? 'selected' : '' }}>
                            {{ $pj }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter: Status --}}
            <div class="w-full lg:w-40">
                <select id="filter-status" name="status"
                    class="block w-full border border-slate-200 rounded-xl py-2.5 px-3 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    onchange="document.getElementById('filter-form').submit()">
                    <option value="">Semua Status</option>
                    <option value="perencanaan" {{ request('status') === 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                    <option value="berjalan"    {{ request('status') === 'berjalan'    ? 'selected' : '' }}>Berjalan</option>
                    <option value="selesai"     {{ request('status') === 'selesai'     ? 'selected' : '' }}>Selesai</option>
                    <option value="tertunda"    {{ request('status') === 'tertunda'    ? 'selected' : '' }}>Tertunda</option>
                </select>
            </div>

            {{-- Search Button --}}
            <button type="submit" id="btn-search"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-800 text-white rounded-xl text-sm font-medium hover:bg-slate-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                </svg>
                Cari
            </button>

            @if(request()->hasAny(['search', 'tahun_akademik', 'penanggung_jawab', 'status']))
                <a href="{{ route('kegiatan.index') }}" id="btn-reset-filter"
                    class="inline-flex items-center justify-center gap-1 px-3 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>
            @endif
        </div>

        {{-- Active filters info --}}
        @if(request()->hasAny(['search', 'tahun_akademik', 'penanggung_jawab', 'status']))
            <div class="mt-3 flex flex-wrap gap-2">
                @if(request('search'))
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full border border-blue-100">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd"/></svg>
                        "{{ request('search') }}"
                    </span>
                @endif
                @if(request('tahun_akademik'))
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-full border border-slate-200">
                        Tahun: {{ request('tahun_akademik') }}
                    </span>
                @endif
                @if(request('penanggung_jawab'))
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-full border border-slate-200">
                        PJ: {{ request('penanggung_jawab') }}
                    </span>
                @endif
                @if(request('status'))
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-full border border-slate-200">
                        Status: {{ ucfirst(request('status')) }}
                    </span>
                @endif
                <span class="text-xs text-slate-400 self-center">{{ $kegiatans->total() }} data ditemukan</span>
            </div>
        @endif
    </form>
</div>
