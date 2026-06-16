<div class="glass-panel shadow-sm overflow-hidden">
    {{-- Table header + search --}}
    <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap">
        <div class="flex items-center gap-3">
            <div>
                <h2 class="text-sm font-bold text-slate-700">Daftar Bidang</h2>
                <p id="table-count" class="text-xs text-slate-400 mt-0.5"></p>
            </div>
            @if(auth()->user()->canWrite('bidang'))
            <button onclick="openModal()"
                class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 transition-colors shadow-sm">
                <x-icon name="plus" class="w-3.5 h-3.5" />
                Tambah
            </button>
            @endif
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            {{-- Search --}}
            <div class="search-wrap relative">
                <x-icon name="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none" />
                <input id="search-input" type="text" placeholder="Cari bidang..." oninput="filterTable()">
            </div>
            {{-- Filter status --}}
            <select id="filter-status" onchange="filterTable()"
                class="border border-slate-200 rounded-xl px-3 py-[7px] text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer">
                <option value="">Semua Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 text-left">
                    <th class="px-5 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider w-16">Kode</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Nama Bidang</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Program</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Kegiatan</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Anggaran</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Status</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbl-body">
                {{-- JS rendered --}}
            </tbody>
        </table>
        {{-- Empty state --}}
        <div id="empty-state" class="hidden px-5 py-16 text-center">
            <x-icon name="search" class="w-12 h-12 mx-auto text-slate-200 mb-3" />
            <p class="text-sm font-medium text-slate-400">Tidak ada bidang ditemukan</p>
            <p class="text-xs text-slate-300 mt-1">Coba ubah kata kunci pencarian</p>
        </div>
    </div>
</div>
