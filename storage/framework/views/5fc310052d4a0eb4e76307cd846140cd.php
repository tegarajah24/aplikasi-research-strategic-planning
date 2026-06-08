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
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Master Data Program</h1>
                <p class="text-sm text-slate-400 mt-0.5">Program — turunan Bidang, induk Kegiatan dalam RENSTRA/RKT</p>
            </div>
            <button onclick="openModal()"
                class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm"
                style="background:#2563eb">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah Program
            </button>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        /* Tree lines */
        .tree-child { position:relative; padding-left:20px; }
        .tree-child::before { content:''; position:absolute; left:6px; top:0; bottom:0; border-left:1.5px dashed #cbd5e1; }
        .tree-child::after  { content:''; position:absolute; left:6px; top:18px; width:12px; height:1.5px; background:#cbd5e1; }
        .tree-child:last-child::before { height:18px; }

        /* badges */
        .badge-aktif    { background:#d1fae5; color:#065f46; }
        .badge-nonaktif { background:#f1f5f9; color:#64748b; }

        /* row hover */
        .trow { transition:background .12s; }
        .trow:hover { background:#f8fafc; }

        /* modals */
        #prog-modal,#del-modal,#detail-drawer { transition:opacity .2s; }
        #prog-modal.hidden,#del-modal.hidden { display:none; }

        /* search */
        .search-wrap input {
            border:1px solid #e2e8f0; border-radius:10px;
            padding:7px 12px 7px 36px; font-size:13px;
            outline:none; width:100%; transition:border-color .15s;
        }
        .search-wrap input:focus { border-color:#3b82f6; box-shadow:0 0 0 3px rgba(59,130,246,.12); }

        /* detail drawer */
        #detail-drawer {
            position:fixed; top:0; right:0; bottom:0; width:380px;
            background:#fff; box-shadow:-8px 0 32px rgba(15,23,42,.1);
            z-index:40; transform:translateX(100%);
            transition:transform .25s cubic-bezier(.4,0,.2,1);
            overflow-y:auto;
        }
        #detail-drawer.open { transform:translateX(0); }
        #drawer-backdrop {
            position:fixed; inset:0; background:rgba(15,23,42,.35);
            backdrop-filter:blur(2px); z-index:39;
            display:none;
        }
        #drawer-backdrop.open { display:block; }

        /* progress bar */
        .prog-track { background:#f1f5f9; border-radius:99px; height:6px; overflow:hidden; }
        .prog-fill  { height:6px; border-radius:99px; transition:width .6s cubic-bezier(.4,0,.2,1); }

        /* count-up */
        @keyframes countUp { from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none} }
        .count-anim { animation:countUp .4s ease both; }
    </style>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            
            <div class="rounded-2xl p-5 text-white shadow-lg" style="background:linear-gradient(135deg,#7c3aed,#4f46e5)">
                <div class="flex items-start gap-4 flex-wrap">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#c4b5fd">Hierarki Perencanaan</p>
                        <div class="flex items-center gap-2 flex-wrap text-sm font-medium mt-2">
                            <span class="rounded-lg px-3 py-1.5 text-sm" style="background:rgba(255,255,255,.12);color:#e0e7ff">Bidang</span>
                            <svg class="w-4 h-4" style="color:#a5b4fc" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            <span class="rounded-lg px-3 py-1.5 text-sm font-bold" style="background:rgba(255,255,255,.25);color:#fff">Program</span>
                            <svg class="w-4 h-4" style="color:#a5b4fc" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                            <span class="rounded-lg px-3 py-1.5 text-sm" style="background:rgba(255,255,255,.12);color:#e0e7ff">Kegiatan</span>
                        </div>
                        <p class="text-xs mt-3 leading-relaxed" style="color:rgba(224,231,255,.75)">Program merupakan turunan langsung dari Bidang. Setiap program memiliki beberapa kegiatan yang dijadwalkan dalam RKT. Kode program di-generate otomatis berdasarkan urutan dalam bidang.</p>
                    </div>
                    <div class="flex gap-3 flex-wrap">
                        <div class="rounded-xl px-4 py-3 text-center min-w-[70px]" style="background:rgba(255,255,255,.15)">
                            <p id="stat-program" class="text-2xl font-extrabold count-anim">—</p>
                            <p class="text-[11px] font-medium mt-0.5" style="color:#c4b5fd">Program</p>
                        </div>
                        <div class="rounded-xl px-4 py-3 text-center min-w-[70px]" style="background:rgba(255,255,255,.15)">
                            <p id="stat-kegiatan" class="text-2xl font-extrabold count-anim">—</p>
                            <p class="text-[11px] font-medium mt-0.5" style="color:#c4b5fd">Kegiatan</p>
                        </div>
                        <div class="rounded-xl px-4 py-3 text-center min-w-[70px]" style="background:rgba(255,255,255,.15)">
                            <p id="stat-anggaran" class="text-lg font-extrabold count-anim">—</p>
                            <p class="text-[11px] font-medium mt-0.5" style="color:#c4b5fd">Anggaran</p>
                        </div>
                        <div class="rounded-xl px-4 py-3 text-center min-w-[70px]" style="background:rgba(255,255,255,.15)">
                            <p id="stat-progress" class="text-2xl font-extrabold count-anim">—</p>
                            <p class="text-[11px] font-medium mt-0.5" style="color:#c4b5fd">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

                
                <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    
                    <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Daftar Program</h2>
                            <p id="table-count" class="text-xs text-slate-400 mt-0.5"></p>
                        </div>
                        <div class="flex items-center gap-2 flex-wrap">
                            
                            <div class="search-wrap relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z"/>
                                </svg>
                                <input id="search-input" type="text" placeholder="Cari program..." oninput="filterTable()">
                            </div>
                            
                            <select id="filter-bidang" onchange="filterTable()"
                                class="border border-slate-200 rounded-xl px-3 py-[7px] text-xs text-slate-600 outline-none focus:border-violet-400 cursor-pointer">
                                <option value="">Semua Bidang</option>
                            </select>
                            
                            <select id="filter-status" onchange="filterTable()"
                                class="border border-slate-200 rounded-xl px-3 py-[7px] text-xs text-slate-600 outline-none focus:border-violet-400 cursor-pointer">
                                <option value="">Semua Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    
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
                                
                            </tbody>
                        </table>
                        <div id="empty-state" class="hidden px-5 py-16 text-center">
                            <svg class="w-12 h-12 mx-auto text-slate-200 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-400">Tidak ada program ditemukan</p>
                            <p class="text-xs text-slate-300 mt-1">Coba ubah kata kunci atau filter</p>
                        </div>
                    </div>
                </div>

                
                <div class="flex flex-col gap-5">

                    
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                            <div>
                                <h3 class="text-sm font-bold text-slate-700">Program per Bidang</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Distribusi & hierarki</p>
                            </div>
                            <button onclick="collapseAll()" class="text-[11px] font-medium transition-colors" style="color:#7c3aed">Tutup Semua</button>
                        </div>
                        <div id="hier-tree" class="px-4 py-3 space-y-1 max-h-[300px] overflow-y-auto">
                            
                        </div>
                    </div>

                    
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100">
                            <h3 class="text-sm font-bold text-slate-700">Progress per Bidang</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Rata-rata penyelesaian kegiatan</p>
                        </div>
                        <div id="prog-chart" class="px-5 py-4 space-y-4">
                            
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    
    <div id="drawer-backdrop" onclick="closeDrawer()"></div>

    
    <div id="detail-drawer">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100" style="background:#fafafa">
            <div>
                <h3 id="drawer-title" class="text-sm font-bold text-slate-800">Detail Program</h3>
                <p id="drawer-kode" class="text-xs text-slate-400 mt-0.5"></p>
            </div>
            <button onclick="closeDrawer()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="drawer-body" class="px-5 py-5 space-y-5">
            
        </div>
    </div>

    
    <div id="prog-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div>
                    <h3 id="modal-title-text" class="text-base font-bold text-slate-800">Tambah Program</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Isi form berikut dengan lengkap</p>
                </div>
                <button onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                <input type="hidden" id="edit-id">

                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Bidang <span class="text-red-400">*</span></label>
                    <select id="f-bidang" onchange="autoKode()"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition cursor-pointer"
                        style="--tw-ring-color:rgba(124,58,237,.12)">
                        <option value="">-- Pilih Bidang --</option>
                    </select>
                </div>

                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kode Program <span class="text-red-400">*</span></label>
                    <div class="flex items-center gap-2">
                        <input id="f-kode" type="text" placeholder="Otomatis — bisa diedit"
                            class="flex-1 border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
                        <span id="kode-preview" class="text-[11px] bg-violet-50 text-violet-600 border border-violet-100 rounded-lg px-2 py-1 font-mono whitespace-nowrap hidden"></span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Format: {nomor bidang}.{urutan} — Contoh: 2.1, 2.2</p>
                </div>

                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Program <span class="text-red-400">*</span></label>
                    <input id="f-nama" type="text" placeholder="Contoh: Peningkatan Kualitas Penelitian Dosen"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
                </div>

                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Sasaran Program</label>
                    <textarea id="f-sasaran" rows="2" placeholder="Deskripsi sasaran yang ingin dicapai..."
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition resize-none"></textarea>
                </div>

                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Strategi RENSTRA</label>
                    <input id="f-strategi" type="text" placeholder="Contoh: Meningkatkan kompetensi riset dosen"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
                </div>

                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Program Tahunan (RKT)</label>
                    <input id="f-rkt" type="text" placeholder="Contoh: RKT 2026 — Prioritas Utama"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
                </div>

                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Total Anggaran (Rp)</label>
                    <input id="f-anggaran" type="number" min="0" placeholder="0"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
                </div>

                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Status</label>
                    <select id="f-status"
                        class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 transition cursor-pointer">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>

                <div id="form-error" class="hidden text-xs text-red-500 bg-red-50 border border-red-100 rounded-lg px-3 py-2"></div>
            </div>
            <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                <button onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">Batal</button>
                <button onclick="saveProgram()" class="px-5 py-2 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm" style="background:#7c3aed">Simpan</button>
            </div>
        </div>
    </div>

    
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
                    <h4 class="text-sm font-bold text-slate-800">Hapus Program?</h4>
                    <p id="del-name" class="text-xs text-slate-500 mt-0.5"></p>
                </div>
            </div>
            <p class="text-xs text-slate-500 mb-5">Tindakan ini tidak dapat dibatalkan. Seluruh kegiatan dalam program ini mungkin terpengaruh.</p>
            <div class="flex gap-2 justify-end">
                <button onclick="closeDelModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">Batal</button>
                <button onclick="confirmDelete()" class="px-5 py-2 rounded-xl text-sm font-semibold bg-red-500 text-white hover:bg-red-600 transition">Hapus</button>
            </div>
        </div>
    </div>

    <script>
    // ── Data from Database ──────────────────────────────────────────
    const bidangMaster = <?php echo json_encode($bidangMaster, 15, 512) ?>;
    let programData = <?php echo json_encode($programList, 15, 512) ?>;

    let deleteTargetId = null;
    let detailOpenId   = null;

    // ── Helpers ──────────────────────────────────────────────────────
    function rupiah(n) {
        if (n >= 1000000000) return 'Rp '+(n/1000000000).toFixed(1)+' M';
        if (n >= 1000000)    return 'Rp '+(n/1000000).toFixed(0)+' Jt';
        return 'Rp '+n.toLocaleString('id-ID');
    }
    function getBidang(id) { return bidangMaster.find(b => b.id === id); }
    function programsForBidang(bid) { return programData.filter(p => p.bidangId === bid); }
    function totalKegiatan()  { return programData.reduce((s,p) => s + p.kegiatan.length, 0); }
    function totalAnggaran()  { return programData.reduce((s,p) => s + p.anggaran, 0); }
    function totalSelesai()   { return programData.reduce((s,p) => s + p.kegiatan.filter(k=>k.selesai).length, 0); }
    function progressPct(p)   {
        if (!p.kegiatan.length) return 0;
        return Math.round(p.kegiatan.filter(k=>k.selesai).length / p.kegiatan.length * 100);
    }

    // ── Stats ────────────────────────────────────────────────────────
    function renderStats() {
        document.getElementById('stat-program').textContent  = programData.length;
        document.getElementById('stat-kegiatan').textContent = totalKegiatan();
        document.getElementById('stat-anggaran').textContent = rupiah(totalAnggaran());
        const pct = totalKegiatan() ? Math.round(totalSelesai()/totalKegiatan()*100) : 0;
        document.getElementById('stat-progress').textContent = pct+'%';
    }

    // ── Populate selects ─────────────────────────────────────────────
    function populateSelects() {
        const filterSel = document.getElementById('filter-bidang');
        const formSel   = document.getElementById('f-bidang');
        bidangMaster.forEach(b => {
            [filterSel, formSel].forEach(sel => {
                const opt = document.createElement('option');
                opt.value = b.id;
                opt.textContent = b.nama;
                sel.appendChild(opt);
            });
        });
    }

    // ── Auto Kode ────────────────────────────────────────────────────
    function autoKode() {
        const bidId = parseInt(document.getElementById('f-bidang').value);
        const editId = document.getElementById('edit-id').value;
        if (!bidId) { document.getElementById('f-kode').value=''; document.getElementById('kode-preview').classList.add('hidden'); return; }
        const b = getBidang(bidId);
        const existing = programData.filter(p => p.bidangId === bidId && (!editId || p.id !== parseInt(editId)));
        const nextNum = existing.length + 1;
        const kode = `${b.no}.${nextNum}`;
        document.getElementById('f-kode').value = kode;
        const prev = document.getElementById('kode-preview');
        prev.textContent = kode;
        prev.classList.remove('hidden');
    }

    // ── Filter ───────────────────────────────────────────────────────
    function getFiltered() {
        const q   = (document.getElementById('search-input').value || '').toLowerCase();
        const bid = document.getElementById('filter-bidang').value;
        const st  = document.getElementById('filter-status').value;
        return programData.filter(p => {
            const matchQ   = !q || p.nama.toLowerCase().includes(q) || p.kode.toLowerCase().includes(q) || (p.sasaran||'').toLowerCase().includes(q);
            const matchBid = !bid || p.bidangId === parseInt(bid);
            const matchSt  = !st  || p.status === st;
            return matchQ && matchBid && matchSt;
        });
    }
    function filterTable() { renderTable(); }

    // ── Table ────────────────────────────────────────────────────────
    function renderTable() {
        const filtered = getFiltered();
        const tbody = document.getElementById('tbl-body');
        const empty = document.getElementById('empty-state');
        const count = document.getElementById('table-count');
        count.textContent = `${filtered.length} dari ${programData.length} program`;

        if (!filtered.length) { tbody.innerHTML=''; empty.classList.remove('hidden'); return; }
        empty.classList.add('hidden');

        tbody.innerHTML = filtered.map(p => {
            const b   = getBidang(p.bidangId);
            const pct = progressPct(p);
            const badge = p.status === 'Aktif' ? 'badge-aktif' : 'badge-nonaktif';
            const statusDot = p.status === 'Aktif' ? '#10b981' : '#94a3b8';
            return `
            <tr class="trow border-b border-slate-100/70 cursor-pointer" onclick="openDrawer(${p.id})">
                <td class="px-5 py-3">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500">
                        <span class="w-2 h-2 rounded-full flex-shrink-0 inline-block" style="background-color:${b ? b.color : '#94a3b8'}"></span>
                        ${p.kode}
                    </span>
                </td>
                <td class="px-3 py-3 max-w-[220px]">
                    <p class="text-sm font-semibold text-slate-800 line-clamp-1">${p.nama}</p>
                    <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">${p.sasaran || '—'}</p>
                </td>
                <td class="px-3 py-3">
                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-600">
                        <span class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background-color:${b ? b.color : '#94a3b8'}"></span>
                        ${b ? b.nama : '—'}
                    </span>
                </td>
                <td class="px-3 py-3 text-center">
                    <span class="inline-block bg-violet-50 text-violet-700 text-xs font-bold px-2.5 py-0.5 rounded-lg">${p.kegiatan.length}</span>
                </td>
                <td class="px-3 py-3 min-w-[100px]">
                    <div class="flex items-center gap-2">
                        <div class="flex-1 prog-track">
                            <div class="prog-fill" style="width:${pct}%;background-color:${pct>=80?'#10b981':pct>=40?'#6366f1':'#f59e0b'}"></div>
                        </div>
                        <span class="text-[11px] font-semibold text-slate-500 w-8 text-right flex-shrink-0">${pct}%</span>
                    </div>
                </td>
                <td class="px-3 py-3 text-center">
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2.5 py-0.5 rounded-full ${badge}">
                        <span class="w-1.5 h-1.5 rounded-full" style="background:${statusDot}"></span>
                        ${p.status}
                    </span>
                </td>
                <td class="px-3 py-3 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <button onclick="event.stopPropagation();editProgram(${p.id})"
                            class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-50 transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/>
                            </svg>
                        </button>
                        <button onclick="event.stopPropagation();deleteProgram(${p.id})"
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

    // ── Hierarchy Panel ──────────────────────────────────────────────
    function renderHierarchy() {
        const container = document.getElementById('hier-tree');
        container.innerHTML = bidangMaster.map(b => {
            const progs = programsForBidang(b.id);
            if (!progs.length) return '';
            const items = progs.map(p => `
                <div class="tree-child flex items-center gap-2 py-1 cursor-pointer hover:bg-slate-50 rounded-lg px-2 -ml-2 transition" onclick="openDrawer(${p.id})">
                    <span class="text-[11px] font-mono text-slate-400 w-8 flex-shrink-0">${p.kode}</span>
                    <span class="text-xs text-slate-600 flex-1 truncate">${p.nama}</span>
                    <span class="text-[10px] bg-slate-100 text-slate-500 rounded-md px-1.5 py-0.5 flex-shrink-0">${p.kegiatan.length} keg</span>
                </div>`).join('');
            return `
            <div id="hier-b-${b.id}">
                <button onclick="toggleHier(${b.id})" class="w-full flex items-center gap-2.5 px-2 py-2 rounded-xl hover:bg-slate-50 transition text-left">
                    <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color:${b.color}"></span>
                    <span class="text-xs font-semibold text-slate-700 flex-1">${b.nama}</span>
                    <span class="text-[10px] text-slate-400 flex-shrink-0">${progs.length} prog</span>
                    <svg id="hier-arrow-${b.id}" class="w-3.5 h-3.5 text-slate-300 flex-shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>
                <div id="hier-body-${b.id}" class="overflow-hidden transition-all duration-200" style="max-height:0">
                    <div class="pl-4 pb-2">${items}</div>
                </div>
            </div>`;
        }).join('');
    }

    function toggleHier(id) {
        const body  = document.getElementById(`hier-body-${id}`);
        const arrow = document.getElementById(`hier-arrow-${id}`);
        const isOpen = body.style.maxHeight && body.style.maxHeight !== '0px';
        body.style.maxHeight  = isOpen ? '0px' : body.scrollHeight + 300 + 'px';
        arrow.style.transform = isOpen ? '' : 'rotate(90deg)';
    }

    function collapseAll() {
        bidangMaster.forEach(b => {
            const body  = document.getElementById(`hier-body-${b.id}`);
            const arrow = document.getElementById(`hier-arrow-${b.id}`);
            if (body)  body.style.maxHeight  = '0px';
            if (arrow) arrow.style.transform = '';
        });
    }

    // ── Progress Chart ───────────────────────────────────────────────
    function renderProgChart() {
        const container = document.getElementById('prog-chart');
        container.innerHTML = bidangMaster.map(b => {
            const progs = programsForBidang(b.id);
            if (!progs.length) return '';
            const totalKeg = progs.reduce((s,p)=>s+p.kegiatan.length,0);
            const doneKeg  = progs.reduce((s,p)=>s+p.kegiatan.filter(k=>k.selesai).length,0);
            const pct = totalKeg ? Math.round(doneKeg/totalKeg*100) : 0;
            const barColor = pct>=80?'#10b981':pct>=40?'#6366f1':'#f59e0b';
            return `
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full" style="background-color:${b.color}"></span>
                        <span class="text-xs font-medium text-slate-600 truncate max-w-[140px]">${b.nama}</span>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <span class="text-[11px] text-slate-400">${progs.length} program</span>
                        <span class="text-[11px] font-semibold text-slate-600">${pct}%</span>
                    </div>
                </div>
                <div class="prog-track">
                    <div class="prog-fill" style="width:${pct}%;background-color:${barColor}"></div>
                </div>
                <p class="text-[10px] text-slate-400 mt-1">${doneKeg}/${totalKeg} kegiatan selesai · ${rupiah(progs.reduce((s,p)=>s+p.anggaran,0))}</p>
            </div>`;
        }).join('');
    }

    // ── Detail Drawer ────────────────────────────────────────────────
    function openDrawer(id) {
        const p = programData.find(x => x.id === id);
        if (!p) return;
        detailOpenId = id;
        const b   = getBidang(p.bidangId);
        const pct = progressPct(p);
        const barColor = pct>=80?'#10b981':pct>=40?'#6366f1':'#f59e0b';

        document.getElementById('drawer-title').textContent = p.nama;
        document.getElementById('drawer-kode').textContent  = `Kode: ${p.kode}  ·  ${b ? b.nama : ''}`;

        const kegItems = p.kegiatan.map((k,i) => `
            <div class="flex items-start gap-3 py-2 ${i < p.kegiatan.length-1 ? 'border-b border-slate-100' : ''}">
                <div class="flex-shrink-0 mt-0.5 w-5 h-5 rounded-full flex items-center justify-center ${k.selesai ? '' : 'border border-slate-200'}"
                     style="${k.selesai ? 'background:#d1fae5' : ''}">
                    ${k.selesai
                        ? `<svg class="w-3 h-3" style="color:#059669" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>`
                        : `<span class="w-1.5 h-1.5 rounded-full bg-slate-300 block"></span>`}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium ${k.selesai ? 'text-slate-500 line-through' : 'text-slate-700'}">${k.nama}</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">${rupiah(k.anggaran)}</p>
                </div>
            </div>`).join('');

        document.getElementById('drawer-body').innerHTML = `
            <!-- Info chips -->
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full border" style="background:${b?b.color+'18':'#f1f5f9'};color:${b?b.color:'#64748b'};border-color:${b?b.color+'40':'#e2e8f0'}">
                    <span class="w-1.5 h-1.5 rounded-full" style="background-color:${b?b.color:'#94a3b8'}"></span>
                    ${b ? b.nama : '—'}
                </span>
                <span class="inline-flex items-center text-xs font-medium px-2.5 py-1 rounded-full ${p.status==='Aktif'?'badge-aktif':'badge-nonaktif'}">${p.status}</span>
            </div>

            <!-- Progress -->
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-semibold text-slate-600">Progress Kegiatan</span>
                    <span class="text-sm font-bold" style="color:${barColor}">${pct}%</span>
                </div>
                <div class="prog-track">
                    <div class="prog-fill" style="width:${pct}%;background-color:${barColor}"></div>
                </div>
                <div class="flex justify-between mt-2 text-[11px] text-slate-400">
                    <span>${p.kegiatan.filter(k=>k.selesai).length} selesai</span>
                    <span>${p.kegiatan.filter(k=>!k.selesai).length} tersisa</span>
                </div>
            </div>

            <!-- Stats row -->
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-slate-50 rounded-xl p-3 text-center">
                    <p class="text-lg font-extrabold text-slate-800">${p.kegiatan.length}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">Total Kegiatan</p>
                </div>
                <div class="bg-slate-50 rounded-xl p-3 text-center">
                    <p class="text-base font-extrabold text-slate-800">${rupiah(p.anggaran)}</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">Total Anggaran</p>
                </div>
            </div>

            <!-- Meta -->
            <div class="space-y-2 text-xs">
                ${p.sasaran ? `<div class="flex gap-2"><span class="text-slate-400 flex-shrink-0 w-20">Sasaran</span><span class="text-slate-600">${p.sasaran}</span></div>` : ''}
                ${p.strategi ? `<div class="flex gap-2"><span class="text-slate-400 flex-shrink-0 w-20">Strategi</span><span class="text-slate-600">${p.strategi}</span></div>` : ''}
                ${p.rkt ? `<div class="flex gap-2"><span class="text-slate-400 flex-shrink-0 w-20">RKT</span><span class="text-slate-600">${p.rkt}</span></div>` : ''}
            </div>

            <!-- Kegiatan list -->
            <div>
                <h4 class="text-xs font-bold text-slate-700 mb-2">Daftar Kegiatan</h4>
                <div class="border border-slate-100 rounded-xl overflow-hidden">
                    ${kegItems || '<p class="text-xs text-slate-400 px-4 py-3">Belum ada kegiatan</p>'}
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-2 pt-2">
                <button onclick="editProgram(${p.id})"
                    class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold border border-violet-200 text-violet-700 hover:bg-violet-50 transition">Edit Program</button>
                <button onclick="deleteProgram(${p.id})"
                    class="px-4 py-2.5 rounded-xl text-sm font-semibold border border-red-100 text-red-500 hover:bg-red-50 transition">Hapus</button>
            </div>
        `;

        document.getElementById('detail-drawer').classList.add('open');
        document.getElementById('drawer-backdrop').classList.add('open');
    }

    function closeDrawer() {
        document.getElementById('detail-drawer').classList.remove('open');
        document.getElementById('drawer-backdrop').classList.remove('open');
        detailOpenId = null;
    }

    // ── Modal ────────────────────────────────────────────────────────
    function openModal(id = null) {
        document.getElementById('edit-id').value     = id || '';
        document.getElementById('f-bidang').value    = '';
        document.getElementById('f-kode').value      = '';
        document.getElementById('f-nama').value      = '';
        document.getElementById('f-sasaran').value   = '';
        document.getElementById('f-strategi').value  = '';
        document.getElementById('f-rkt').value       = '';
        document.getElementById('f-anggaran').value  = '';
        document.getElementById('f-status').value    = 'Aktif';
        document.getElementById('kode-preview').classList.add('hidden');
        document.getElementById('form-error').classList.add('hidden');
        document.getElementById('modal-title-text').textContent = id ? 'Edit Program' : 'Tambah Program';

        if (id) {
            const p = programData.find(x => x.id === id);
            if (p) {
                document.getElementById('f-bidang').value   = p.bidangId;
                document.getElementById('f-kode').value     = p.kode;
                document.getElementById('f-nama').value     = p.nama;
                document.getElementById('f-sasaran').value  = p.sasaran || '';
                document.getElementById('f-strategi').value = p.strategi || '';
                document.getElementById('f-rkt').value      = p.rkt || '';
                document.getElementById('f-anggaran').value = p.anggaran;
                document.getElementById('f-status').value   = p.status;
                const prev = document.getElementById('kode-preview');
                prev.textContent = p.kode;
                prev.classList.remove('hidden');
            }
        }
        document.getElementById('prog-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => document.getElementById('f-nama').focus(), 100);
    }

    function closeModal() {
        document.getElementById('prog-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function saveProgram() {
        const id       = document.getElementById('edit-id').value;
        const bidangId = parseInt(document.getElementById('f-bidang').value);
        const kode     = document.getElementById('f-kode').value.trim();
        const nama     = document.getElementById('f-nama').value.trim();
        const sasaran  = document.getElementById('f-sasaran').value.trim();
        const strategi = document.getElementById('f-strategi').value.trim();
        const rkt      = document.getElementById('f-rkt').value.trim();
        const anggaran = parseInt(document.getElementById('f-anggaran').value) || 0;
        const status   = document.getElementById('f-status').value;
        const errEl    = document.getElementById('form-error');

        if (!bidangId || !kode || !nama) {
            errEl.textContent = 'Bidang, Kode Program, dan Nama Program wajib diisi.';
            errEl.classList.remove('hidden');
            return;
        }
        errEl.classList.add('hidden');

        const url  = id ? '/program/' + id : '/program';
        const method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' },
            body: JSON.stringify({
                bidang_id: bidangId, kode_program: kode, nama_program: nama,
                deskripsi: '', sasaran: sasaran, strategi_renstra: strategi,
                program_tahunan: rkt, anggaran: anggaran, status: status
            })
        }).then(r => {
            if (r.ok) { window.location.reload(); }
            else { r.json().then(d => { errEl.textContent = d.message || 'Terjadi kesalahan'; errEl.classList.remove('hidden'); }); }
        }).catch(() => {
            errEl.textContent = 'Terjadi kesalahan koneksi.';
            errEl.classList.remove('hidden');
        });
    }

    function editProgram(id) { closeDrawer(); setTimeout(()=>openModal(id),100); }

    // ── Delete ───────────────────────────────────────────────────────
    function deleteProgram(id) {
        const p = programData.find(x => x.id === id);
        if (!p) return;
        deleteTargetId = id;
        document.getElementById('del-name').textContent = `"${p.nama}" akan dihapus.`;
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
        fetch('/program/' + deleteTargetId, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>', 'Accept': 'application/json' }
        }).then(r => {
            if (r.ok) { window.location.reload(); }
        });
        closeDelModal();
        closeDrawer();
    }

    // ── Init ─────────────────────────────────────────────────────────
    function renderAll() {
        renderStats();
        renderTable();
        renderHierarchy();
        renderProgChart();
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeModal(); closeDelModal(); closeDrawer(); }
    });

    populateSelects();
    renderAll();
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
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views/master-data/program/index.blade.php ENDPATH**/ ?>