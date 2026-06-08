<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Master Data RENSTRA</h1>
                <p class="text-sm text-slate-400 mt-0.5">Bank Data Sasaran, Strategi, dan Program Tahunan</p>
            </div>
            <div class="flex items-center gap-2">
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
     <?php $__env->endSlot(); ?>

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

            
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                
                <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap bg-slate-50/50">
                    <div>
                        <h2 class="text-sm font-bold text-slate-700">Hierarki RENSTRA</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Tampilan berdasarkan relasi hierarkis</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <select id="filter-fakultas" onchange="renderTree()"
                                class="appearance-none border border-slate-200 rounded-xl pl-9 pr-8 py-2 text-sm font-semibold text-slate-700 outline-none focus:border-sky-400 cursor-pointer bg-white">
                                <option value="Semua">Semua Fakultas/Prodi</option>
                                <option value="FIS">FIS (Fakultas Ilmu Sosial)</option>
                                <option value="FST">FST (Fakultas Sains dan Teknologi)</option>
                                <option value="FKES">FKES (Fakultas Kesehatan)</option>
                            </select>
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                        </div>
                        <div class="relative">
                            <select id="filter-tahun" onchange="renderTree()"
                                class="appearance-none border border-slate-200 rounded-xl pl-9 pr-8 py-2 text-sm font-semibold text-slate-700 outline-none focus:border-sky-400 cursor-pointer bg-white">
                            </select>
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        </div>
                    </div>
                </div>

                
                <div class="p-6">
                    <div id="tree-container" class="space-y-4">
                        
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

                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Periode <span class="text-red-500">*</span></label>
                        <input id="f-tahun" type="number" min="2000" max="2100" placeholder="2026"
                            class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Fakultas / Prodi <span class="text-red-500">*</span></label>
                        <select id="f-fakultas" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                            <option value="FIS">FIS (Fakultas Ilmu Sosial)</option>
                            <option value="FST">FST (Fakultas Sains dan Teknologi)</option>
                            <option value="FKES">FKES (Fakultas Kesehatan)</option>
                        </select>
                    </div>
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
    // ── Data ────────────────────────────────────────────────────────
    let renstraData = <?php echo json_encode($flatRenstra ?? [], 15, 512) ?>;

    let deleteTargetId = null;

    // ── Data Processing (Grouping for Tree View) ────────────────────
    function getGroupedData(tahun, fakultas) {
        const filtered = renstraData.filter(d => {
            let matchTahun = d.tahun == tahun;
            let matchFakultas = (fakultas === 'Semua') ? true : d.fakultas === fakultas;
            return matchTahun && matchFakultas;
        });
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
        const fakultas = document.getElementById('filter-fakultas').value;
        const data = getGroupedData(tahun, fakultas);
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
                document.getElementById('f-fakultas').value = row.fakultas || 'FST';
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
            
            let currentFilterFakultas = document.getElementById('filter-fakultas').value;
            document.getElementById('f-fakultas').value = (currentFilterFakultas === 'Semua') ? 'FST' : currentFilterFakultas;
            
            // Clear inputs except year and fakultas
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
        const tahun = parseInt(document.getElementById('f-tahun').value);
        const sasaranKode = document.getElementById('f-sasaran-kode').value.trim();
        const sasaranNama = document.getElementById('f-sasaran-nama').value.trim();
        const strategiKode = document.getElementById('f-strategi-kode').value.trim();
        const strategiNama = document.getElementById('f-strategi-nama').value.trim();
        const programKode = document.getElementById('f-program-kode').value.trim();
        const programNama = document.getElementById('f-program-nama').value.trim();

        const errEl = document.getElementById('form-error');

        if (!tahun || !sasaranKode || !sasaranNama || !strategiNama || !programNama) {
            errEl.textContent = 'Tahun, Sasaran, Strategi, dan Program Tahunan wajib diisi.';
            errEl.classList.remove('hidden');
            return;
        }
        errEl.classList.add('hidden');

        const payload = {
            kode: sasaranKode,
            sasaran: sasaranNama,
            strategi: strategiNama,
            program_tahunan: programNama,
            periode: tahun.toString(),
        };

        const url  = id ? '/renstra/' + id : '/renstra';
        const method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => {
            if (r.ok) { window.location.reload(); }
            else { r.json().then(d => { errEl.textContent = d.message || 'Terjadi kesalahan'; errEl.classList.remove('hidden'); }); }
        }).catch(() => {
            errEl.textContent = 'Terjadi kesalahan koneksi.';
            errEl.classList.remove('hidden');
        });
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
        if (deleteTargetId === null) return;
        fetch('/renstra/' + deleteTargetId, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' }
        }).then(r => {
            if (r.ok) { window.location.reload(); }
        });
        closeDelModal();
    }

    // ── Populate Dynamic Year Filter ────────────────────────────────
    function populateTahunFilter() {
        const select = document.getElementById('filter-tahun');
        const currentSelected = select.value;
        const years = [...new Set(renstraData.map(d => d.tahun))].sort((a, b) => b - a);
        
        select.innerHTML = '';
        if (years.length === 0) {
            const currentYear = new Date().getFullYear();
            select.innerHTML = `<option value="${currentYear}">Tahun ${currentYear}</option>`;
        } else {
            years.forEach(yr => {
                const opt = document.createElement('option');
                opt.value = yr;
                opt.textContent = `Tahun ${yr}`;
                select.appendChild(opt);
            });
        }
        
        if (currentSelected && Array.from(select.options).some(opt => opt.value == currentSelected)) {
            select.value = currentSelected;
        }
    }

    // ── Init ─────────────────────────────────────────────────────────
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeModal(); closeDelModal(); }
    });

    populateTahunFilter();
    renderTree();
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views/master-data/renstra/index.blade.php ENDPATH**/ ?>