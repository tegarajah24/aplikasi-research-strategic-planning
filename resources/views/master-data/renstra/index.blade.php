<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Master Data RENSTRA</h1>
                <p class="text-sm text-slate-400 mt-0.5">Sasaran Strategis — Periode 5 Tahun per Fakultas</p>
            </div>
        </div>
    </x-slot>

    <style>
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

        #renstra-modal, #del-modal { transition: opacity .25s ease, visibility .25s ease; }
        #renstra-modal.modal-closed, #del-modal.modal-closed {
            opacity: 0; visibility: hidden; pointer-events: none;
        }
        #renstra-modal:not(.modal-closed), #del-modal:not(.modal-closed) {
            opacity: 1; visibility: visible; pointer-events: all;
        }
        #renstra-modal > div:first-child, #del-modal > div:first-child { transition: opacity .25s ease; }
        #renstra-modal.modal-closed > div:first-child, #del-modal.modal-closed > div:first-child { opacity: 0; }
        #renstra-modal > .modal-panel, #del-modal > .modal-panel {
            transform: scale(0.92) translateY(12px);
            transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        #renstra-modal:not(.modal-closed) > .modal-panel,
        #del-modal:not(.modal-closed) > .modal-panel {
            transform: scale(1) translateY(0);
        }
    </style>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            <div class="glass-panel shadow-sm">
                <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap bg-slate-50/50">
                    <div>
                        <h2 class="text-sm font-bold text-slate-700">Hierarki RENSTRA</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Tampilan berdasarkan bidang, fakultas & periode</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <select id="filter-bidang" onchange="renderTree()"
                            class="simple-select border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer">
                            <option value="">Semua Bidang</option>
                            @foreach($bidangList as $b)
                            <option value="{{ $b->id }}">{{ $b->kode_bidang }} - {{ $b->nama_bidang }}</option>
                            @endforeach
                        </select>
                        <select id="filter-fakultas" onchange="renderTree()"
                            class="simple-select border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer">
                            <option value="">Semua Fakultas</option>
                            @foreach($fakultasList as $f)
                            <option value="{{ $f->id }}">{{ $f->kode_fakultas }} ({{ $f->nama_fakultas }})</option>
                            @endforeach
                        </select>
                        <select id="filter-periode" onchange="renderTree()"
                            class="simple-select border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer">
                        </select>
                        @if(auth()->user()->canWrite('renstra'))
                        <button onclick="openModal()"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm"
                            style="background:#0ea5e9">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>
                            Tambah Data
                        </button>
                        @endif
                    </div>
                </div>

                <div class="p-6 overflow-hidden">
                    <div id="tree-container" class="space-y-4">
                    </div>

                    <div id="empty-state" class="hidden py-16 text-center">
                        <svg class="w-16 h-16 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        <p class="text-base font-semibold text-slate-600">Belum ada data RENSTRA</p>
                        <p class="text-sm text-slate-400 mt-1">Silakan tambah data baru.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Add/Edit Modal ── --}}
    <div id="renstra-modal" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50" onclick="closeModal()"></div>
        <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-xl z-10">
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div>
                    <h3 id="modal-title-text" class="text-base font-bold text-slate-800">Tambah Data RENSTRA</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Lengkapi sasaran strategis 5 tahunan</p>
                </div>
                <button onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5 space-y-5 max-h-[75vh] overflow-y-auto bg-slate-50/30">
                <input type="hidden" id="edit-id">

                {{-- Bidang & Kode Sasaran --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Bidang <span class="text-red-500">*</span></label>
                        <select id="f-bidang"
                            class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih Bidang</option>
                            @foreach($bidangList as $b)
                            <option value="{{ $b->id }}">{{ $b->kode_bidang }} - {{ $b->nama_bidang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kode Sasaran</label>
                        <input id="f-kode" type="text" placeholder="SS1" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                    </div>
                </div>

                {{-- Fakultas --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Fakultas <span class="text-red-500">*</span></label>
                        <select id="f-fakultas"
                            class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih Fakultas</option>
                            @foreach($fakultasList as $f)
                            <option value="{{ $f->id }}">{{ $f->kode_fakultas }} ({{ $f->nama_fakultas }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                    </div>
                </div>

                {{-- Periode 5 Tahun --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Mulai <span class="text-red-500">*</span></label>
                        <select id="f-tahun-mulai"
                            class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih</option>
                            @foreach(range(now()->year - 9, now()->year + 10) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Selesai <span class="text-red-500">*</span></label>
                        <select id="f-tahun-selesai"
                            class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih</option>
                            @foreach(range(now()->year - 9, now()->year + 10) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm space-y-4">
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2 border-b border-slate-100 pb-2">Sasaran Strategis</h4>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Sasaran <span class="text-red-500">*</span></label>
                        <input id="f-sasaran" type="text" placeholder="Contoh: Meningkatkan kualitas penelitian dosen" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                    </div>
                </div>

                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm space-y-4">
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2 border-b border-slate-100 pb-2">Strategi RENSTRA</h4>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Strategi</label>
                        <input id="f-strategi" type="text" placeholder="Contoh: Mendorong penelitian nasional" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                    </div>
                </div>

                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm space-y-4">
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2 border-b border-slate-100 pb-2">Program Tahunan</h4>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Program Tahunan</label>
                        <input id="f-program" type="text" placeholder="Contoh: Program peningkatan publikasi ilmiah" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                    </div>
                </div>

                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm">
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 border-b border-slate-100 pb-2">Status Capaian</h4>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-1">Status</label>
                        <select id="f-status" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="belum_tercapai">Belum Tercapai</option>
                            <option value="dalam_proses">Dalam Proses</option>
                            <option value="tercapai">Tercapai</option>
                        </select>
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
    <div id="del-modal" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50" onclick="closeDelModal()"></div>
        <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
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
    let renstraData = @json($flatRenstra ?? []);
    let canWriteRenstra = @json(auth()->user()->canWrite('renstra'));
    let fakultasList = @json($fakultasList);
    let bidangList = @json($bidangList);
    let deleteTargetId = null;

    function getFakultasName(id) {
        const f = fakultasList.find(x => x.id === id);
        return f ? f.kode_fakultas + ' (' + f.nama_fakultas + ')' : 'Semua';
    }

    function getBidangName(id) {
        const b = bidangList.find(x => x.id === id);
        return b ? b.nama_bidang : 'Tanpa Bidang';
    }

    function getGroupedData(bidangId, fakultasId, periodeKey) {
        const filtered = renstraData.filter(d => {
            let matchBid = !bidangId || d.bidang_id == bidangId;
            let matchFak = !fakultasId || d.fakultas_id == fakultasId;
            let matchPeriode = !periodeKey || (d.tahunMulai + '-' + d.tahunSelesai) === periodeKey;
            return matchBid && matchFak && matchPeriode;
        });
        return filtered;
    }

    function renderTree() {
        const bidangId = document.getElementById('filter-bidang').value;
        const fakultasId = document.getElementById('filter-fakultas').value;
        const periodeKey = document.getElementById('filter-periode').value;
        const data = getGroupedData(bidangId, fakultasId, periodeKey);
        const container = document.getElementById('tree-container');
        const emptyState = document.getElementById('empty-state');

        if (data.length === 0) {
            container.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }
        emptyState.classList.add('hidden');

        // Group data by bidang
        const grouped = {};
        data.forEach(r => {
            const bid = r.bidang_id || 'null';
            if (!grouped[bid]) grouped[bid] = { bidang: r.bidang || 'Tanpa Bidang', items: [] };
            grouped[bid].items.push(r);
        });

        let html = '';
        Object.keys(grouped).forEach(bid => {
            const g = grouped[bid];
            html += `
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-3 px-1">
                        <div class="w-8 h-8 rounded-lg bg-violet-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-violet-500/20">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 003.182 0l5.178-5.178a2.25 2.25 0 000-3.182l-9.581-9.581A2.25 2.25 0 009.568 3z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-extrabold text-slate-800">${g.bidang}</p>
                            <p class="text-[11px] text-slate-400">${g.items.length} Sasaran Strategis</p>
                        </div>
                    </div>
                    <div class="space-y-3 pl-6 border-l-2 border-violet-100">`;

            g.items.forEach(r => {
                const programCount = r.totalProgram || 0;
                const statusBadge = r.status === 'tercapai' ? 'bg-emerald-100 text-emerald-700' :
                                    r.status === 'dalam_proses' ? 'bg-amber-100 text-amber-700' :
                                    'bg-slate-100 text-slate-500';

                html += `
                    <div class="tree-node mb-3 last:mb-0">
                        <div class="flex items-center justify-between gap-3 p-4 bg-white border-2 border-sky-100 rounded-xl shadow-sm relative z-10">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-sky-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-sky-500/20">
                                    <span class="text-[11px] font-bold text-white">${r.sasaranKode || 'RS'}</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-sky-500 uppercase tracking-wider mb-0.5">Sasaran Strategis</p>
                                    <p class="text-base font-extrabold text-slate-800">${r.sasaranNama}</p>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-[11px] text-slate-400">${getFakultasName(r.fakultas_id)}</span>
                                        <span class="text-[11px] text-slate-400">Periode ${r.tahunMulai} - ${r.tahunSelesai}</span>
                                        <span class="text-[11px] text-slate-400">${programCount} Program</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full ${statusBadge}">${r.status?.replace('_', ' ') || 'Belum Tercapai'}</span>
                                ${canWriteRenstra ? `
                                <div class="flex gap-1">
                                    <button onclick="editRenstra(${r.id})" class="p-2 bg-slate-50 text-sky-600 rounded-lg hover:bg-sky-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                                    </button>
                                    <button onclick="deleteRenstra(${r.id})" class="p-2 bg-slate-50 text-red-500 rounded-lg hover:bg-red-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    </button>
                                </div>
                                ` : ''}
                            </div>
                        </div>
                        ${r.strategiNama || r.programNama ? `
                        <div class="pl-2 mt-2">
                            ${r.strategiNama ? `
                            <div class="tree-child">
                                <div class="flex items-center gap-3 p-3 bg-indigo-50/60 border border-indigo-100/60 rounded-xl shadow-sm">
                                    <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-semibold text-indigo-400 uppercase tracking-wider mb-0.5">Strategi RENSTRA</p>
                                        <p class="text-sm font-bold text-slate-800">${r.strategiNama}</p>
                                    </div>
                                </div>
                            </div>
                            ` : ''}
                            ${r.programNama ? `
                            <div class="tree-grandchild mt-3">
                                <div class="flex items-center gap-3 p-3 bg-sky-50/60 border border-sky-100/60 rounded-xl shadow-sm">
                                    <div class="w-8 h-8 rounded-lg bg-sky-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15a2.25 2.25 0 012.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-semibold text-sky-400 uppercase tracking-wider mb-0.5">Program Tahunan</p>
                                        <p class="text-sm font-bold text-slate-800">${r.programNama}</p>
                                    </div>
                                </div>
                            </div>
                            ` : ''}
                        </div>
                        ` : ''}
                    </div>`;
            });

            html += `</div></div>`;
        });

        container.innerHTML = html;
    }

    function openModal(id = null) {
        document.getElementById('form-error').classList.add('hidden');
        document.getElementById('edit-id').value = id || '';

        if (id) {
            const row = renstraData.find(d => d.id === id);
            if (row) {
                document.getElementById('modal-title-text').textContent = 'Edit Data RENSTRA';
                document.getElementById('f-bidang').value = row.bidang_id || '';
                document.getElementById('f-fakultas').value = row.fakultas_id || '';
                document.getElementById('f-kode').value = row.sasaranKode || '';
                document.getElementById('f-sasaran').value = row.sasaranNama || '';
                document.getElementById('f-strategi').value = row.strategiNama || '';
                document.getElementById('f-program').value = row.programNama || '';
                document.getElementById('f-tahun-mulai').value = row.tahunMulai || '';
                document.getElementById('f-tahun-selesai').value = row.tahunSelesai || '';
                document.getElementById('f-status').value = row.status || 'belum_tercapai';
            }
        } else {
            document.getElementById('modal-title-text').textContent = 'Tambah Data RENSTRA';
            document.getElementById('f-bidang').value = document.getElementById('filter-bidang').value || '';
            document.getElementById('f-fakultas').value = document.getElementById('filter-fakultas').value || '';
            document.getElementById('f-kode').value = '';
            document.getElementById('f-sasaran').value = '';
            document.getElementById('f-strategi').value = '';
            document.getElementById('f-program').value = '';
            document.getElementById('f-tahun-mulai').value = '';
            document.getElementById('f-tahun-selesai').value = '';
            document.getElementById('f-status').value = 'belum_tercapai';
        }

        document.getElementById('renstra-modal').classList.remove('modal-closed');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('renstra-modal').classList.add('modal-closed');
        document.body.style.overflow = '';
    }

    function saveRenstra() {
        const id = document.getElementById('edit-id').value;
        const bidangId = document.getElementById('f-bidang').value;
        const fakultasId = document.getElementById('f-fakultas').value;
        const kode = document.getElementById('f-kode').value.trim();
        const sasaran = document.getElementById('f-sasaran').value.trim();
        const strategi = document.getElementById('f-strategi').value.trim();
        const program = document.getElementById('f-program').value.trim();
        const tahunMulai = parseInt(document.getElementById('f-tahun-mulai').value);
        const tahunSelesai = parseInt(document.getElementById('f-tahun-selesai').value);
        const status = document.getElementById('f-status').value;

        const errEl = document.getElementById('form-error');

        if (!bidangId || !fakultasId || !sasaran || !tahunMulai || !tahunSelesai) {
            errEl.textContent = 'Bidang, Fakultas, Sasaran, Tahun Mulai, dan Tahun Selesai wajib diisi.';
            errEl.classList.remove('hidden');
            return;
        }
        if (tahunSelesai < tahunMulai) {
            errEl.textContent = 'Tahun Selesai harus >= Tahun Mulai.';
            errEl.classList.remove('hidden');
            return;
        }
        errEl.classList.add('hidden');

        const payload = {
            bidang_id: bidangId || null,
            fakultas_id: fakultasId || null,
            kode: kode || null,
            sasaran: sasaran,
            strategi: strategi || null,
            program_tahunan: program || null,
            tahun_mulai: tahunMulai,
            tahun_selesai: tahunSelesai,
            status: status,
        };

        const url  = id ? '/renstra/' + id : '/renstra';
        const method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => {
            if (r.ok) { window.location.reload(); }
            else { r.json().then(d => { errEl.textContent = d.message || 'Terjadi kesalahan'; errEl.classList.remove('hidden'); }); }
        }).catch(() => {
            errEl.textContent = 'Terjadi kesalahan koneksi.';
            errEl.classList.remove('hidden');
        });
    }

    function editRenstra(id) { openModal(id); }

    function deleteRenstra(id) {
        deleteTargetId = id;
        document.getElementById('del-modal').classList.remove('modal-closed');
        document.body.style.overflow = 'hidden';
    }

    function closeDelModal() {
        document.getElementById('del-modal').classList.add('modal-closed');
        document.body.style.overflow = '';
        deleteTargetId = null;
    }

    function confirmDelete() {
        if (deleteTargetId === null) return;
        fetch('/renstra/' + deleteTargetId, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        }).then(r => {
            if (r.ok) { window.location.reload(); }
        });
        closeDelModal();
    }

    function populatePeriodeFilter() {
        const select = document.getElementById('filter-periode');
        const periods = [...new Set(renstraData.map(d => d.tahunMulai + '-' + d.tahunSelesai))].sort();
        select.innerHTML = '<option value="">Semua Periode</option>';
        periods.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p;
            opt.textContent = p;
            select.appendChild(opt);
        });
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeModal(); closeDelModal(); }
    });

    populatePeriodeFilter();
    renderTree();
    </script>
</x-app-layout>