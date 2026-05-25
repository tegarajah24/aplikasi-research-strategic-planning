<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Master Data Bidang</h1>
                <p class="text-sm text-slate-400 mt-0.5">Kategori utama dalam RENSTRA/RKT — level teratas hierarki perencanaan</p>
            </div>
            <button onclick="openModal()"
                class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-blue-600 text-white hover:bg-blue-700 transition-colors shadow-sm shadow-blue-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah Bidang
            </button>
        </div>
    </x-slot>

    <style>
        /* ── Hierarchy tree lines ── */
        .tree-item { position: relative; padding-left: 20px; }
        .tree-item::before {
            content: '';
            position: absolute;
            left: 6px; top: 0; bottom: 0;
            border-left: 1.5px dashed #cbd5e1;
        }
        .tree-item::after {
            content: '';
            position: absolute;
            left: 6px; top: 18px;
            width: 12px; height: 1.5px;
            background: #cbd5e1;
        }
        .tree-item:last-child::before { height: 18px; }

        /* ── Badge status ── */
        .badge-active   { background:#d1fae5; color:#065f46; }
        .badge-inactive { background:#f1f5f9; color:#64748b; }

        /* ── Expand accordion ── */
        .hier-body { overflow: hidden; transition: max-height .25s ease; }

        /* ── Modal ── */
        #bidang-modal { transition: opacity .2s; }
        #bidang-modal.hidden { display: none; }

        /* ── Table row hover ── */
        .trow { transition: background .12s; }
        .trow:hover { background: #f8fafc; }

        /* ── Search input ── */
        .search-wrap input {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 7px 12px 7px 36px;
            font-size: 13px;
            outline: none;
            width: 100%;
            transition: border-color .15s;
        }
        .search-wrap input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }

        /* ── Animated count ── */
        @keyframes countUp { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }
        .count-anim { animation: countUp .4s ease both; }
    </style>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- ── Hierarki Info Card ── --}}
            <div class="rounded-2xl p-5 text-white shadow-lg shadow-blue-200/40" style="background: linear-gradient(135deg, #2563eb, #4f46e5);">
                <div class="flex items-start gap-4 flex-wrap">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-widest text-blue-200 mb-1">Hierarki Perencanaan</p>
                        <div class="flex items-center gap-2 flex-wrap text-sm font-medium mt-2">
                            <span class="bg-white/20 backdrop-blur rounded-lg px-3 py-1.5 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-blue-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 003.182 0l5.178-5.178a2.25 2.25 0 000-3.182L12.41 3.659A2.25 2.25 0 0010.819 3H9.568z"/></svg>
                                Bidang
                            </span>
                            <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            <span class="bg-white/10 rounded-lg px-3 py-1.5 text-blue-100">Program</span>
                            <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            <span class="bg-white/10 rounded-lg px-3 py-1.5 text-blue-100">Kegiatan</span>
                        </div>
                        <p class="text-blue-200/80 text-xs mt-3 leading-relaxed">Bidang adalah master kategori paling atas. Setiap bidang memiliki beberapa program, dan setiap program memiliki kegiatan yang dapat dijadwalkan dalam RKT.</p>
                    </div>
                    <div class="flex gap-3 flex-wrap">
                        <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-3 text-center min-w-[70px]">
                            <p id="stat-bidang" class="text-2xl font-extrabold count-anim">—</p>
                            <p class="text-[11px] text-blue-200 mt-0.5 font-medium">Bidang</p>
                        </div>
                        <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-3 text-center min-w-[70px]">
                            <p id="stat-program" class="text-2xl font-extrabold count-anim">—</p>
                            <p class="text-[11px] text-blue-200 mt-0.5 font-medium">Program</p>
                        </div>
                        <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-3 text-center min-w-[70px]">
                            <p id="stat-kegiatan" class="text-2xl font-extrabold count-anim">—</p>
                            <p class="text-[11px] text-blue-200 mt-0.5 font-medium">Kegiatan</p>
                        </div>
                        <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-3 text-center min-w-[70px]">
                            <p id="stat-anggaran" class="text-lg font-extrabold count-anim">—</p>
                            <p class="text-[11px] text-blue-200 mt-0.5 font-medium">Anggaran</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Main Content: Table + Hierarchy ── --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

                {{-- LEFT: Table --}}
                <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    {{-- Table header + search --}}
                    <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Daftar Bidang</h2>
                            <p id="table-count" class="text-xs text-slate-400 mt-0.5"></p>
                        </div>
                        <div class="flex items-center gap-2 flex-wrap">
                            {{-- Search --}}
                            <div class="search-wrap relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z"/>
                                </svg>
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
                            <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-400">Tidak ada bidang ditemukan</p>
                            <p class="text-xs text-slate-300 mt-1">Coba ubah kata kunci pencarian</p>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Hierarchy Panel --}}
                <div class="flex flex-col gap-5">
                    {{-- Hierarchy expand --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                            <div>
                                <h3 class="text-sm font-bold text-slate-700">Hierarki Bidang</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Klik bidang untuk expand</p>
                            </div>
                            <button onclick="collapseAll()" class="text-[11px] text-blue-500 hover:text-blue-700 font-medium transition-colors">
                                Tutup Semua
                            </button>
                        </div>
                        <div id="hier-tree" class="px-4 py-3 space-y-1 max-h-[420px] overflow-y-auto">
                            {{-- JS rendered --}}
                        </div>
                    </div>

                    {{-- Quick stats per bidang --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100">
                            <h3 class="text-sm font-bold text-slate-700">Distribusi Anggaran</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Proporsi anggaran per bidang</p>
                        </div>
                        <div id="bar-chart" class="px-5 py-4 space-y-3">
                            {{-- JS rendered --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Add/Edit Modal ── --}}
    <div id="bidang-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden">
            {{-- Modal header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div>
                    <h3 id="modal-title-text" class="text-base font-bold text-slate-800">Tambah Bidang</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Isi form berikut dengan lengkap</p>
                </div>
                <button onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            {{-- Modal body --}}
            <div class="px-6 py-5 space-y-4">
                <input type="hidden" id="edit-id">
                {{-- Kode Bidang --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kode Bidang <span class="text-red-400">*</span></label>
                    <input id="f-kode" type="text" placeholder="Contoh: BD-01"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition">
                </div>
                {{-- Nama Bidang --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Bidang <span class="text-red-400">*</span></label>
                    <input id="f-nama" type="text" placeholder="Contoh: Penelitian dan Pengabdian"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition">
                </div>
                {{-- Deskripsi --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Deskripsi</label>
                    <textarea id="f-deskripsi" rows="3" placeholder="Deskripsi singkat tentang bidang ini..."
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition resize-none"></textarea>
                </div>
                {{-- Status --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Status</label>
                    <select id="f-status"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-400 transition cursor-pointer">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                {{-- Error --}}
                <div id="form-error" class="hidden text-xs text-red-500 bg-red-50 border border-red-100 rounded-lg px-3 py-2"></div>
            </div>
            {{-- Modal footer --}}
            <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                <button onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">
                    Batal
                </button>
                <button onclick="saveBidang()" class="px-5 py-2 rounded-xl text-sm font-semibold bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm shadow-blue-200">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    {{-- ── Delete Confirm Modal ── --}}
    <div id="del-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeDelModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Hapus Bidang?</h4>
                    <p id="del-name" class="text-xs text-slate-500 mt-0.5"></p>
                </div>
            </div>
            <p class="text-xs text-slate-500 mb-5">Tindakan ini tidak dapat dibatalkan. Semua data program dan kegiatan yang terkait bidang ini mungkin terpengaruh.</p>
            <div class="flex gap-2 justify-end">
                <button onclick="closeDelModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">
                    Batal
                </button>
                <button onclick="confirmDelete()" class="px-5 py-2 rounded-xl text-sm font-semibold bg-red-500 text-white hover:bg-red-600 transition">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
    // ── Dummy Data ──────────────────────────────────────────────────
    let bidangData = [
        {
            id: 1, kode: 'BD-01', nama: 'Pendidikan',
            deskripsi: 'Bidang yang mencakup seluruh kegiatan pengembangan kurikulum, pembelajaran, dan mutu akademik.',
            status: 'Aktif',
            anggaran: 185000000,
            programs: [
                { id: 101, nama: 'Pengembangan Kurikulum', kegiatan: 4 },
                { id: 102, nama: 'Pelatihan Dosen', kegiatan: 3 },
                { id: 103, nama: 'Audit Mutu Akademik', kegiatan: 2 },
            ]
        },
        {
            id: 2, kode: 'BD-02', nama: 'Penelitian dan Pengabdian',
            deskripsi: 'Mencakup kegiatan penelitian ilmiah, pengabdian masyarakat, dan publikasi karya dosen.',
            status: 'Aktif',
            anggaran: 340000000,
            programs: [
                { id: 201, nama: 'Hibah Internal', kegiatan: 5 },
                { id: 202, nama: 'Publikasi Ilmiah', kegiatan: 4 },
                { id: 203, nama: 'Pengabdian Masyarakat', kegiatan: 3 },
                { id: 204, nama: 'HKI & Paten', kegiatan: 2 },
            ]
        },
        {
            id: 3, kode: 'BD-03', nama: 'Kemahasiswaan',
            deskripsi: 'Kegiatan pembinaan, pengembangan minat-bakat, dan kesejahteraan mahasiswa.',
            status: 'Aktif',
            anggaran: 120000000,
            programs: [
                { id: 301, nama: 'Organisasi Kemahasiswaan', kegiatan: 3 },
                { id: 302, nama: 'Prestasi & Kompetisi', kegiatan: 6 },
            ]
        },
        {
            id: 4, kode: 'BD-04', nama: 'Kerjasama & Kemitraan',
            deskripsi: 'Pengelolaan MOU, kerjasama dengan industri, pemerintah, dan lembaga internasional.',
            status: 'Aktif',
            anggaran: 95000000,
            programs: [
                { id: 401, nama: 'MOU Nasional', kegiatan: 3 },
                { id: 402, nama: 'MOU Internasional', kegiatan: 2 },
            ]
        },
        {
            id: 5, kode: 'BD-05', nama: 'Tata Kelola & SDM',
            deskripsi: 'Pengembangan sumber daya manusia, penguatan kelembagaan, dan tata kelola organisasi.',
            status: 'Tidak Aktif',
            anggaran: 60000000,
            programs: [
                { id: 501, nama: 'Pengembangan SDM', kegiatan: 4 },
            ]
        },
    ];

    let deleteTargetId = null;
    const COLORS = ['#3b82f6','#6366f1','#8b5cf6','#10b981','#f59e0b'];

    // ── Helpers ──────────────────────────────────────────────────────
    function rupiah(n) {
        if (n >= 1000000000) return 'Rp ' + (n/1000000000).toFixed(1) + ' M';
        if (n >= 1000000) return 'Rp ' + (n/1000000).toFixed(0) + ' Jt';
        return 'Rp ' + n.toLocaleString('id-ID');
    }
    function totalPrograms() { return bidangData.reduce((s,b) => s + b.programs.length, 0); }
    function totalKegiatan()  { return bidangData.reduce((s,b) => s + b.programs.reduce((p,pr) => p + pr.kegiatan, 0), 0); }
    function totalAnggaran()  { return bidangData.reduce((s,b) => s + b.anggaran, 0); }

    // ── Stats ────────────────────────────────────────────────────────
    function renderStats() {
        document.getElementById('stat-bidang').textContent   = bidangData.length;
        document.getElementById('stat-program').textContent  = totalPrograms();
        document.getElementById('stat-kegiatan').textContent = totalKegiatan();
        document.getElementById('stat-anggaran').textContent = rupiah(totalAnggaran());
    }

    // ── Table ────────────────────────────────────────────────────────
    function getFiltered() {
        const q   = (document.getElementById('search-input').value || '').toLowerCase();
        const st  = document.getElementById('filter-status').value;
        return bidangData.filter(b => {
            const matchQ  = !q || b.nama.toLowerCase().includes(q) || b.kode.toLowerCase().includes(q) || b.deskripsi.toLowerCase().includes(q);
            const matchSt = !st || b.status === st;
            return matchQ && matchSt;
        });
    }

    function renderTable() {
        const filtered = getFiltered();
        const tbody = document.getElementById('tbl-body');
        const empty = document.getElementById('empty-state');
        const count = document.getElementById('table-count');

        count.textContent = `${filtered.length} dari ${bidangData.length} bidang`;

        if (!filtered.length) {
            tbody.innerHTML = '';
            empty.classList.remove('hidden');
            return;
        }
        empty.classList.add('hidden');

        const totalAng = totalAnggaran() || 1;
        tbody.innerHTML = filtered.map((b, i) => {
            const kgtCount = b.programs.reduce((s, p) => s + p.kegiatan, 0);
            const badgeCls = b.status === 'Aktif' ? 'badge-active' : 'badge-inactive';
            const colorDot = COLORS[i % COLORS.length];
            return `
            <tr class="trow border-b border-slate-100/70 cursor-pointer" onclick="highlightHier(${b.id})">
                <td class="px-5 py-3">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500">
                        <span class="w-2 h-2 rounded-full flex-shrink-0 inline-block" style="background-color: ${colorDot}"></span>
                        ${b.kode}
                    </span>
                </td>
                <td class="px-3 py-3">
                    <p class="text-sm font-semibold text-slate-800">${b.nama}</p>
                    <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">${b.deskripsi}</p>
                </td>
                <td class="px-3 py-3 text-center">
                    <span class="inline-block bg-indigo-50 text-indigo-700 text-xs font-bold px-2.5 py-0.5 rounded-lg">${b.programs.length}</span>
                </td>
                <td class="px-3 py-3 text-center">
                    <span class="inline-block bg-slate-100 text-slate-600 text-xs font-bold px-2.5 py-0.5 rounded-lg">${kgtCount}</span>
                </td>
                <td class="px-3 py-3">
                    <p class="text-xs font-semibold text-slate-700">${rupiah(b.anggaran)}</p>
                    <div class="w-full h-1 rounded-full bg-slate-100 mt-1">
                        <div class="h-1 rounded-full" style="width:${Math.round(b.anggaran/totalAng*100)}%; background-color: ${colorDot}"></div>
                    </div>
                </td>
                <td class="px-3 py-3 text-center">
                    <span class="inline-block text-[11px] font-semibold px-2.5 py-0.5 rounded-full ${badgeCls}">${b.status}</span>
                </td>
                <td class="px-3 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <button onclick="event.stopPropagation(); editBidang(${b.id})"
                            class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-50 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
                            </svg>
                        </button>
                        <button onclick="event.stopPropagation(); deleteBidang(${b.id})"
                            class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 transition" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>`;
        }).join('');
    }

    function filterTable() { renderTable(); }

    // ── Hierarchy Tree ───────────────────────────────────────────────
    function renderHierarchy() {
        const container = document.getElementById('hier-tree');
        container.innerHTML = bidangData.map((b, i) => {
            const colorDot = COLORS[i % COLORS.length];
            const kgtCount = b.programs.reduce((s, p) => s + p.kegiatan, 0);
            const programs = b.programs.map(p => `
                <div class="tree-item flex items-center gap-2 py-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5"/>
                    </svg>
                    <span class="text-xs text-slate-600">${p.nama}</span>
                    <span class="ml-auto text-[10px] bg-slate-100 text-slate-500 rounded-md px-1.5 py-0.5 font-medium flex-shrink-0">${p.kegiatan} keg</span>
                </div>`).join('');

            return `
            <div class="hier-bidang" id="hier-${b.id}">
                <button onclick="toggleHier(${b.id})"
                    class="w-full flex items-center gap-2.5 px-2 py-2 rounded-xl hover:bg-slate-50 transition group text-left">
                    <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: ${colorDot}"></span>
                    <span class="text-xs font-semibold text-slate-700 flex-1">${b.nama}</span>
                    <span class="text-[10px] text-slate-400 flex-shrink-0">${b.programs.length} program · ${kgtCount} keg</span>
                    <svg id="hier-arrow-${b.id}" class="w-3.5 h-3.5 text-slate-300 flex-shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>
                <div id="hier-body-${b.id}" class="hier-body max-h-0 pl-4">
                    <div class="pb-2">${programs}</div>
                </div>
            </div>`;
        }).join('');
    }

    function toggleHier(id) {
        const body  = document.getElementById(`hier-body-${id}`);
        const arrow = document.getElementById(`hier-arrow-${id}`);
        const isOpen = body.style.maxHeight && body.style.maxHeight !== '0px';
        body.style.maxHeight  = isOpen ? '0px' : body.scrollHeight + 'px';
        arrow.style.transform = isOpen ? '' : 'rotate(90deg)';
    }

    function highlightHier(id) {
        // expand the clicked one
        const body  = document.getElementById(`hier-body-${id}`);
        const arrow = document.getElementById(`hier-arrow-${id}`);
        if (body) {
            body.style.maxHeight  = body.scrollHeight + 'px';
            arrow.style.transform = 'rotate(90deg)';
            document.getElementById(`hier-${id}`).scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    function collapseAll() {
        bidangData.forEach(b => {
            const body  = document.getElementById(`hier-body-${b.id}`);
            const arrow = document.getElementById(`hier-arrow-${b.id}`);
            if (body)  body.style.maxHeight  = '0px';
            if (arrow) arrow.style.transform = '';
        });
    }

    // ── Bar Chart ────────────────────────────────────────────────────
    function renderBarChart() {
        const container  = document.getElementById('bar-chart');
        const total      = totalAnggaran() || 1;
        container.innerHTML = bidangData.map((b, i) => {
            const pct = Math.round(b.anggaran / total * 100);
            const colorBar = COLORS[i % COLORS.length];
            return `
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs font-medium text-slate-600 truncate">${b.nama}</span>
                    <span class="text-[11px] text-slate-400 ml-2 flex-shrink-0">${pct}%</span>
                </div>
                <div class="w-full h-2 rounded-full bg-slate-100">
                    <div class="h-2 rounded-full transition-all duration-700" style="width:${pct}%; background-color: ${colorBar}"></div>
                </div>
                <p class="text-[10px] text-slate-400 mt-0.5">${rupiah(b.anggaran)}</p>
            </div>`;
        }).join('');
    }

    // ── Modal ────────────────────────────────────────────────────────
    function openModal(id = null) {
        document.getElementById('edit-id').value       = id || '';
        document.getElementById('f-kode').value        = '';
        document.getElementById('f-nama').value        = '';
        document.getElementById('f-deskripsi').value   = '';
        document.getElementById('f-status').value      = 'Aktif';
        document.getElementById('form-error').classList.add('hidden');
        document.getElementById('modal-title-text').textContent = id ? 'Edit Bidang' : 'Tambah Bidang';

        if (id) {
            const b = bidangData.find(x => x.id === id);
            if (b) {
                document.getElementById('f-kode').value      = b.kode;
                document.getElementById('f-nama').value      = b.nama;
                document.getElementById('f-deskripsi').value = b.deskripsi;
                document.getElementById('f-status').value    = b.status;
            }
        }
        document.getElementById('bidang-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('f-kode').focus(), 100);
    }

    function closeModal() {
        document.getElementById('bidang-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function saveBidang() {
        const id    = document.getElementById('edit-id').value;
        const kode  = document.getElementById('f-kode').value.trim();
        const nama  = document.getElementById('f-nama').value.trim();
        const desk  = document.getElementById('f-deskripsi').value.trim();
        const stat  = document.getElementById('f-status').value;
        const errEl = document.getElementById('form-error');

        if (!kode || !nama) {
            errEl.textContent = 'Kode Bidang dan Nama Bidang wajib diisi.';
            errEl.classList.remove('hidden');
            return;
        }
        errEl.classList.add('hidden');

        if (id) {
            const idx = bidangData.findIndex(b => b.id === parseInt(id));
            if (idx !== -1) {
                bidangData[idx].kode      = kode;
                bidangData[idx].nama      = nama;
                bidangData[idx].deskripsi = desk;
                bidangData[idx].status    = stat;
            }
        } else {
            const newId = Math.max(...bidangData.map(b => b.id)) + 1;
            bidangData.push({ id: newId, kode, nama, deskripsi: desk, status: stat, anggaran: 0, programs: [] });
        }
        closeModal();
        renderAll();
    }

    function editBidang(id) { openModal(id); }

    // ── Delete ───────────────────────────────────────────────────────
    function deleteBidang(id) {
        const b = bidangData.find(x => x.id === id);
        if (!b) return;
        deleteTargetId = id;
        document.getElementById('del-name').textContent = `"${b.nama}" akan dihapus.`;
        document.getElementById('del-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDelModal() {
        document.getElementById('del-modal').classList.add('hidden');
        document.body.style.overflow = '';
        deleteTargetId = null;
    }

    function confirmDelete() {
        if (deleteTargetId === null) return;
        bidangData = bidangData.filter(b => b.id !== deleteTargetId);
        closeDelModal();
        renderAll();
    }

    // ── Init ─────────────────────────────────────────────────────────
    function renderAll() {
        renderStats();
        renderTable();
        renderHierarchy();
        renderBarChart();
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeModal(); closeDelModal(); }
    });

    renderAll();
    </script>

</x-app-layout>
