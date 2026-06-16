<div class="glass-panel shadow-sm overflow-hidden">
    {{-- Table toolbar --}}
    <div class="flex items-center gap-3 px-5 py-4 border-b border-slate-100 flex-wrap">
        <div>
            <h2 class="text-sm font-bold text-slate-700">Daftar Program</h2>
            <p id="table-count" class="text-xs text-slate-400 mt-0.5"></p>
        </div>
        <div class="flex items-center gap-3 ml-auto">
            @if(auth()->user()->canWrite('program'))
            <button onclick="openModal()"
                class="flex items-center gap-2 px-4 py-3 rounded-lg text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 transition-colors shadow-sm shrink-0">
                <x-icon name="plus" class="w-3.5 h-3.5" />
                Tambah Program
            </button>
            @endif
            {{-- Search --}}
            <input id="search-input" type="text" placeholder="Cari program..."
                class="border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 w-44"
                oninput="filterTable()">
            {{-- Filter Bidang --}}
            <select id="filter-bidang" onchange="filterTable()"
                class="simple-select border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer">
                <option value="">Semua Bidang</option>
            </select>
            {{-- Filter Status --}}
            <select id="filter-status" onchange="filterTable()"
                class="simple-select border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer">
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
                    <th class="px-5 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider w-20">Kode</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Nama Program</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Bidang</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Kegiatan</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Progress</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Status</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbl-body">
                {{-- JS rendered --}}
            </tbody>
        </table>
        <div id="empty-state" class="hidden px-5 py-16 text-center">
            <x-icon name="search" class="w-12 h-12 mx-auto text-slate-200 mb-3" />
            <p class="text-sm font-medium text-slate-400">Tidak ada program ditemukan</p>
            <p class="text-xs text-slate-300 mt-1">Coba ubah kata kunci atau filter</p>
        </div>
    </div>
</div>
