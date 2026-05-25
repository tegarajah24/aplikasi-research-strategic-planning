<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Master Data RENSTRA</h1>
                <p class="text-sm text-slate-400 mt-0.5">Bank Data Sasaran, Strategi, dan Program Tahunan</p>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="copyPreviousYear()"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition shadow-sm">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"/>
                    </svg>
                    Copy Tahun Sebelumnya
                </button>
                <button onclick="openModal()"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm"
                    style="background:#0ea5e9">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Tambah Data
                </button>
            </div>
        </div>
    </x-slot>

    <style>
        /* Tree View Lines */
        .tree-node { position:relative; }
        .tree-node::before {
            content:''; position:absolute;
            left:15px; top:36px; bottom:0;
            border-left:2px solid #e2e8f0;
        }
        .tree-node:last-child::before { display:none; }
        
        .tree-child { position:relative; padding-left:36px; }
        .tree-child::before {
            content:''; position:absolute;
            left:15px; top:0; bottom:0;
            border-left:2px solid #e2e8f0;
        }
        .tree-child::after {
            content:''; position:absolute;
            left:15px; top:20px; width:16px; height:2px;
            background:#e2e8f0;
        }
        .tree-child:last-child::before { height:22px; }

        .tree-grandchild { position:relative; padding-left:36px; margin-top:4px; }
        .tree-grandchild::before {
            content:''; position:absolute;
            left:15px; top:0; bottom:0;
            border-left:2px solid #e2e8f0;
        }
        .tree-grandchild::after {
            content:''; position:absolute;
            left:15px; top:16px; width:16px; height:2px;
            background:#e2e8f0;
        }
        .tree-grandchild:last-child::before { height:18px; }

        /* Modals */
        #renstra-modal, #del-modal { transition:opacity .2s; }
        #renstra-modal.hidden, #del-modal.hidden { display:none; }
    </style>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- ── Info Banner ── --}}
            <div class="rounded-2xl p-6 text-white shadow-lg" style="background:linear-gradient(135deg,#0284c7,#0369a1)">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div class="flex-1 min-w-0 max-w-3xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3" style="background:rgba(255,255,255,.15);color:#e0f2fe">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                            Bank Data RENSTRA
                        </div>
                        <p class="text-sm leading-relaxed" style="color:rgba(224,242,255,.85)">
                            Halaman ini berfungsi sebagai referensi strategis utama. Rencana Kerja Tahunan (RKT) dan Program akan mengambil data <strong>Sasaran Strategis</strong>, <strong>Strategi RENSTRA</strong>, dan <strong>Program Tahunan</strong> dari sini agar input lebih terstruktur, rapi, dan konsisten.
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <div class="rounded-xl px-5 py-4 text-center min-w-[90px]" style="background:rgba(255,255,255,.1)">
                            <p id="stat-sasaran" class="text-3xl font-extrabold">0</p>
                            <p class="text-xs font-medium mt-1" style="color:#bae6fd">Sasaran</p>
                        </div>
                        <div class="rounded-xl px-5 py-4 text-center min-w-[90px]" style="background:rgba(255,255,255,.1)">
                            <p id="stat-strategi" class="text-3xl font-extrabold">0</p>
                            <p class="text-xs font-medium mt-1" style="color:#bae6fd">Strategi</p>
                        </div>
                        <div class="rounded-xl px-5 py-4 text-center min-w-[90px]" style="background:rgba(255,255,255,.1)">
                            <p id="stat-program" class="text-3xl font-extrabold">0</p>
                            <p class="text-xs font-medium mt-1" style="color:#bae6fd">Program Thn</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Main Content ── --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                {{-- Toolbar --}}
                <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap bg-slate-50/50">
                    <div>
                        <h2 class="text-sm font-bold text-slate-700">Hierarki RENSTRA</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Tampilan berdasarkan relasi hierarkis</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <select id="filter-tahun" onchange="renderTree()"
                                class="appearance-none border border-slate-200 rounded-xl pl-9 pr-8 py-2 text-sm font-semibold text-slate-700 outline-none focus:border-sky-400 cursor-pointer bg-white">
                                <option value="2026">Tahun 2026</option>
                                <option value="2025">Tahun 2025</option>
                            </select>
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Tree View Container --}}
                <div class="p-6">
                    <div id="tree-container" class="space-y-4">
                        {{-- JS Rendered Tree --}}
                    </div>
                    
                    <div id="empty-state" class="hidden py-16 text-center">
                        <svg class="w-16 h-16 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        <p class="text-base font-semibold text-slate-600">Belum ada data RENSTRA</p>
                        <p class="text-sm text-slate-400 mt-1">Silakan tambah data baru atau copy dari tahun sebelumnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Add/Edit Modal ── --}}
    <div id="renstra-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-xl z-10 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div>
                    <h3 id="modal-title-text" class="text-base font-bold text-slate-800">Tambah Data RENSTRA</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Lengkapi hierarki sasaran strategis</p>
                </div>
                <button onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5 space-y-5 max-h-[75vh] overflow-y-auto bg-slate-50/30">
                <input type="hidden" id="edit-id">

                {{-- Tahun --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Periode <span class="text-red-500">*</span></label>
                    <input id="f-tahun" type="number" min="2000" max="2100" placeholder="2026"
                        class="w-32 border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                </div>

                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm space-y-4">
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2 border-b border-slate-100 pb-2">1. Sasaran Strategis</h4>
                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-1">
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1">Kode Sasaran</label>
                            <input id="f-sasaran-kode" type="text" placeholder="SS1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                        </div>
                        <div class="col-span-3">
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Sasaran</label>
                            <input id="f-sasaran-nama" type="text" placeholder="Contoh: Meningkatkan kualitas penelitian dosen" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm space-y-4">
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2 border-b border-slate-100 pb-2">2. Strategi RENSTRA</h4>
                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-1">
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1">Kode Strategi</label>
                            <input id="f-strategi-kode" type="text" placeholder="STR1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                        </div>
                        <div class="col-span-3">
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Strategi</label>
                            <input id="f-strategi-nama" type="text" placeholder="Contoh: Mendorong penelitian nasional" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm space-y-4">
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2 border-b border-slate-100 pb-2">3. Program Tahunan</h4>
                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-1">
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1">Kode Program</label>
                            <input id="f-program-kode" type="text" placeholder="PT1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                        </div>
                        <div class="col-span-3">
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Program Tahunan</label>
                            <input id="f-program-nama" type="text" placeholder="Contoh: Program peningkatan publikasi ilmiah" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                        </div>
                    </div>
                </div>

                <div id="form-error" class="hidden text-xs text-red-600 bg-red-50 border border-red-100 rounded-lg px-4 py-3 font-medium"></div>
            </div>
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50">
                <button onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-200 transition">Batal</button>
                <button onclick="saveRenstra()" class="px-5 py-2 rounded-xl text-sm font-bold text-white shadow-sm hover:opacity-90 transition" style="background:#0ea5e9">Simpan Data</button>
            </div>
        </div>
    </div>

    {{-- ── Delete Modal ── --}}
    <div id="del-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeDelModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800">Hapus Item?</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Item akan dihapus dari hierarki</p>
                </div>
            </div>
            <p class="text-sm text-slate-600 mb-6 leading-relaxed">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-2 justify-end">
                <button onclick="closeDelModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</button>
                <button onclick="confirmDelete()" class="px-5 py-2 rounded-xl text-sm font-bold bg-red-500 text-white hover:bg-red-600 transition">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <script>
    // ── Dummy Data ──────────────────────────────────────────────────
    // Format flat, nanti digroup saat render
    let renstraData = [
        {
            id: 1, tahun: 2026,
            sasaranKode: 'SS1', sasaranNama: 'Meningkatkan kualitas penelitian dosen',
            strategiKode: 'STR1', strategiNama: 'Mendorong penelitian kolaboratif nasional & internasional',
            programKode: 'PT1', programNama: 'Program peningkatan publikasi ilmiah bereputasi'
        },
        {
            id: 2, tahun: 2026,
            sasaranKode: 'SS1', sasaranNama: 'Meningkatkan kualitas penelitian dosen',
            strategiKode: 'STR1', strategiNama: 'Mendorong penelitian kolaboratif nasional & internasional',
            programKode: 'PT2', programNama: 'Program hibah penelitian internal bersaing'
        },
        {
            id: 3, tahun: 2026,
            sasaranKode: 'SS1', sasaranNama: 'Meningkatkan kualitas penelitian dosen',
            strategiKode: 'STR2', strategiNama: 'Peningkatan perolehan HKI dan Paten',
            programKode: 'PT3', programNama: 'Program pendampingan drafting paten'
        },
        {
            id: 4, tahun: 2026,
            sasaranKode: 'SS2', sasaranNama: 'Peningkatan Mutu Tata Kelola dan SDM',
            strategiKode: 'STR3', strategiNama: 'Meningkatkan kualifikasi pendidikan dosen',
            programKode: 'PT4', programNama: 'Program beasiswa studi lanjut S3'
        },
        // Data 2025 (untuk fitur copy)
        {
            id: 5, tahun: 2025,
            sasaranKode: 'SS1', sasaranNama: 'Meningkatkan kualitas penelitian dosen',
            strategiKode: 'STR1', strategiNama: 'Mendorong penelitian kolaboratif nasional & internasional',
            programKode: 'PT1', programNama: 'Program peningkatan publikasi ilmiah'
        }
    ];

    let deleteTargetId = null;

    // ── Data Processing (Grouping for Tree View) ────────────────────
    function getGroupedData(tahun) {
        const filtered = renstraData.filter(d => d.tahun == tahun);
        const grouped = {};
        
        filtered.forEach(row => {
            // Group Sasaran
            if (!grouped[row.sasaranKode]) {
                grouped[row.sasaranKode] = {
                    kode: row.sasaranKode, nama: row.sasaranNama,
                    strategi: {}
                };
            }
            // Group Strategi
            if (!grouped[row.sasaranKode].strategi[row.strategiKode]) {
                grouped[row.sasaranKode].strategi[row.strategiKode] = {
                    kode: row.strategiKode, nama: row.strategiNama,
                    program: []
                };
            }
            // Push Program Tahunan
            grouped[row.sasaranKode].strategi[row.strategiKode].program.push({
                id: row.id,
                kode: row.programKode,
                nama: row.programNama
            });
        });
        
        return grouped;
    }

    // ── UI Rendering ─────────────────────────────────────────────────
    function renderTree() {
        const tahun = document.getElementById('filter-tahun').value;
        const data = getGroupedData(tahun);
        const container = document.getElementById('tree-container');
        const emptyState = document.getElementById('empty-state');
        
        const sasaranKeys = Object.keys(data);
        
        // Update Stats
        let countSasaran = sasaranKeys.length;
        let countStrategi = 0;
        let countProgram = 0;
        
        if (countSasaran === 0) {
            container.innerHTML = '';
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
            let html = '';
            
            sasaranKeys.forEach(sKey => {
                const sasaran = data[sKey];
                const stratKeys = Object.keys(sasaran.strategi);
                countStrategi += stratKeys.length;
                
                let stratHtml = '';
                stratKeys.forEach(strKey => {
                    const strategi = sasaran.strategi[strKey];
                    countProgram += strategi.program.length;
                    
                    let progHtml = '';
                    strategi.program.forEach(prog => {
                        progHtml += `
                            <div class="tree-grandchild group">
                                <div class="flex items-center justify-between p-3 bg-white border border-slate-100 rounded-xl shadow-sm hover:border-sky-200 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center flex-shrink-0">
                                            <span class="text-[10px] font-bold text-sky-600">${prog.kode}</span>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-0.5">Program Tahunan</p>
                                            <p class="text-sm font-semibold text-slate-700">${prog.nama}</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
                                        <button onclick="editRenstra(${prog.id})" class="p-2 bg-slate-50 text-sky-600 rounded-lg hover:bg-sky-100 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg></button>
                                        <button onclick="deleteRenstra(${prog.id})" class="p-2 bg-slate-50 text-red-500 rounded-lg hover:bg-red-100 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg></button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    
                    stratHtml += `
                        <div class="tree-child mt-4">
                            <div class="flex items-center gap-3 p-3 bg-slate-50 border border-slate-200/60 rounded-xl shadow-sm mb-2">
                                <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                    <span class="text-[10px] font-bold text-indigo-700">${strategi.kode}</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-0.5">Strategi RENSTRA</p>
                                    <p class="text-sm font-bold text-slate-800">${strategi.nama}</p>
                                </div>
                            </div>
                            <div class="ml-2 border-l-2 border-slate-100">
                                ${progHtml}
                            </div>
                        </div>
                    `;
                });
                
                html += `
                    <div class="tree-node mb-6 last:mb-0">
                        <div class="flex items-center gap-3 p-4 bg-white border-2 border-sky-100 rounded-xl shadow-sm relative z-10">
                            <div class="w-10 h-10 rounded-xl bg-sky-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-sky-500/20">
                                <span class="text-[11px] font-bold text-white">${sasaran.kode}</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-sky-500 uppercase tracking-wider mb-0.5">Sasaran Strategis</p>
                                <p class="text-base font-extrabold text-slate-800">${sasaran.nama}</p>
                            </div>
                        </div>
                        <div class="pl-2">
                            ${stratHtml}
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }
        
        document.getElementById('stat-sasaran').textContent = countSasaran;
        document.getElementById('stat-strategi').textContent = countStrategi;
        document.getElementById('stat-program').textContent = countProgram;
    }

    // ── Form Modal ───────────────────────────────────────────────────
    function openModal(id = null) {
        document.getElementById('form-error').classList.add('hidden');
        document.getElementById('edit-id').value = id || '';
        
        if (id) {
            const row = renstraData.find(d => d.id === id);
            if (row) {
                document.getElementById('modal-title-text').textContent = 'Edit Data RENSTRA';
                document.getElementById('f-tahun').value = row.tahun;
                document.getElementById('f-sasaran-kode').value = row.sasaranKode;
                document.getElementById('f-sasaran-nama').value = row.sasaranNama;
                document.getElementById('f-strategi-kode').value = row.strategiKode;
                document.getElementById('f-strategi-nama').value = row.strategiNama;
                document.getElementById('f-program-kode').value = row.programKode;
                document.getElementById('f-program-nama').value = row.programNama;
            }
        } else {
            document.getElementById('modal-title-text').textContent = 'Tambah Data RENSTRA';
            document.getElementById('f-tahun').value = document.getElementById('filter-tahun').value || new Date().getFullYear();
            
            // Clear inputs except year
            ['sasaran-kode','sasaran-nama','strategi-kode','strategi-nama','program-kode','program-nama'].forEach(f => {
                document.getElementById('f-' + f).value = '';
            });
        }
        
        document.getElementById('renstra-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('renstra-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function saveRenstra() {
        const id = document.getElementById('edit-id').value;
        const row = {
            tahun: parseInt(document.getElementById('f-tahun').value),
            sasaranKode: document.getElementById('f-sasaran-kode').value.trim(),
            sasaranNama: document.getElementById('f-sasaran-nama').value.trim(),
            strategiKode: document.getElementById('f-strategi-kode').value.trim(),
            strategiNama: document.getElementById('f-strategi-nama').value.trim(),
            programKode: document.getElementById('f-program-kode').value.trim(),
            programNama: document.getElementById('f-program-nama').value.trim(),
        };
        
        const errEl = document.getElementById('form-error');
        
        // Basic Validation
        if (!row.tahun || !row.sasaranKode || !row.sasaranNama || !row.strategiKode || !row.strategiNama || !row.programKode || !row.programNama) {
            errEl.textContent = 'Semua field wajib diisi lengkap untuk menjaga struktur hierarki.';
            errEl.classList.remove('hidden');
            return;
        }
        
        if (id) {
            const idx = renstraData.findIndex(d => d.id === parseInt(id));
            if (idx !== -1) {
                renstraData[idx] = { ...renstraData[idx], ...row };
            }
        } else {
            row.id = Math.max(0, ...renstraData.map(d=>d.id)) + 1;
            renstraData.push(row);
        }
        
        closeModal();
        
        // Update filter dropdown to show the year if not exists
        const select = document.getElementById('filter-tahun');
        let exists = Array.from(select.options).some(opt => opt.value == row.tahun);
        if (!exists) {
            const opt = document.createElement('option');
            opt.value = row.tahun;
            opt.textContent = `Tahun ${row.tahun}`;
            select.appendChild(opt);
        }
        select.value = row.tahun;
        
        renderTree();
    }

    function editRenstra(id) {
        openModal(id);
    }

    // ── Delete Action ────────────────────────────────────────────────
    function deleteRenstra(id) {
        deleteTargetId = id;
        document.getElementById('del-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDelModal() {
        document.getElementById('del-modal').classList.add('hidden');
        document.body.style.overflow = '';
        deleteTargetId = null;
    }

    function confirmDelete() {
        if (deleteTargetId !== null) {
            renstraData = renstraData.filter(d => d.id !== deleteTargetId);
            closeDelModal();
            renderTree();
        }
    }

    // ── Copy Previous Year ───────────────────────────────────────────
    function copyPreviousYear() {
        const currYear = parseInt(document.getElementById('filter-tahun').value);
        const prevYear = currYear - 1;
        
        const prevData = renstraData.filter(d => d.tahun === prevYear);
        if (prevData.length === 0) {
            alert(`Tidak ada data RENSTRA pada tahun ${prevYear} untuk dicopy.`);
            return;
        }
        
        if (confirm(`Copy ${prevData.length} data RENSTRA dari tahun ${prevYear} ke ${currYear}?`)) {
            let maxId = Math.max(0, ...renstraData.map(d=>d.id));
            
            // Avoid duplicate copy if already copied (simple check)
            const existingCurr = renstraData.filter(d => d.tahun === currYear);
            
            prevData.forEach(row => {
                // Check if program already exists in current year
                const exists = existingCurr.some(c => c.programKode === row.programKode && c.strategiKode === row.strategiKode);
                if (!exists) {
                    maxId++;
                    const newRow = { ...row, id: maxId, tahun: currYear };
                    renstraData.push(newRow);
                }
            });
            
            renderTree();
        }
    }

    // ── Init ─────────────────────────────────────────────────────────
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeModal(); closeDelModal(); }
    });

    renderTree();
    </script>
</x-app-layout>
