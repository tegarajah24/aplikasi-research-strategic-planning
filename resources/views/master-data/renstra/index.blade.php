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
        .tree-child:only-child::after { top:18px; }

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
        .tree-grandchild:only-child::after { top:14px; }

        #renstra-modal, #del-modal, [id^="table-modal-"] { transition: opacity .25s ease, visibility .25s ease; }
        #renstra-modal.modal-closed, #del-modal.modal-closed, [id^="table-modal-"].modal-closed {
            opacity: 0; visibility: hidden; pointer-events: none;
        }
        #renstra-modal:not(.modal-closed), #del-modal:not(.modal-closed), [id^="table-modal-"]:not(.modal-closed) {
            opacity: 1; visibility: visible; pointer-events: all;
        }
        #renstra-modal > div:first-child, #del-modal > div:first-child, [id^="table-modal-"] > div:first-child { transition: opacity .25s ease; }
        #renstra-modal.modal-closed > div:first-child, #del-modal.modal-closed > div:first-child, [id^="table-modal-"].modal-closed > div:first-child { opacity: 0; }
        #renstra-modal > .modal-panel, #del-modal > .modal-panel, [id^="table-modal-"] > .modal-panel {
            transform: scale(0.92) translateY(12px);
            transition: transform .25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        #renstra-modal:not(.modal-closed) > .modal-panel,
        #del-modal:not(.modal-closed) > .modal-panel,
        [id^="table-modal-"]:not(.modal-closed) > .modal-panel {
            transform: scale(1) translateY(0);
        }
        .btn-add { transition: all .15s; }
        .btn-add:hover { transform: translateY(-1px); }
        .btn-remove { transition: all .15s; }
        .btn-remove:hover { background: #fef2f2; color: #dc2626; }
        .repeater-item { animation: slideIn .2s ease; }
        @keyframes slideIn {
            from { opacity:0; transform:translateY(-6px); }
            to { opacity:1; transform:translateY(0); }
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
                        <a href="{{ route('renstra.export.excel') }}"
                           data-no-loader
                           class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white hover:opacity-90 transition shadow-sm"
                           style="background:#0ea5e9">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            Excel
                        </a>
                        <a href="{{ route('renstra.export.word') }}"
                           data-no-loader
                           class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white hover:opacity-90 transition shadow-sm"
                           style="background:#2563eb">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            Word
                        </a>
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
        <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl z-10">
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

                {{-- Kode & Fakultas --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kode RENSTRA</label>
                        <input id="f-kode" type="text" placeholder="RS-01" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition">
                    </div>
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

                {{-- Nested Repeater: Sasaran → Strategi → Program Tahunan --}}
                <div class="p-4 bg-white border border-slate-200 rounded-xl shadow-sm space-y-3">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2 mb-2">
                        <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Sasaran Strategis</h4>
                        <button onclick="addSasaran()" type="button" class="btn-add text-[11px] font-semibold text-sky-600 hover:text-sky-800 bg-sky-50 hover:bg-sky-100 px-3 py-1.5 rounded-lg flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Tambah Sasaran
                        </button>
                    </div>
                    <div id="sasaran-container" class="space-y-3">
                    </div>
                    <p id="sasaran-empty" class="text-xs text-slate-400 text-center py-2">Belum ada sasaran. Klik "Tambah Sasaran" untuk mulai.</p>
                </div>

                {{-- Status --}}
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

    {{-- ── Per-Renstra Table Modals ── --}}
    @foreach($renstras as $renstraItem)
        @php
            $grouped = $renstraItem->sasarans->groupBy(fn($s) => $s->bidang?->nama_bidang ?? 'Tanpa Bidang');
        @endphp
    <div id="table-modal-{{ $renstraItem->id }}" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50" onclick="closeTableModal({{ $renstraItem->id }})"></div>
        <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-5xl z-10">
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Program RENSTRA</h3>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $renstraItem->kode }} — Periode {{ $renstraItem->tahun_mulai }}/{{ $renstraItem->tahun_selesai }}</p>
                </div>
                <button onclick="closeTableModal({{ $renstraItem->id }})" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="px-6 py-5 max-h-[70vh] overflow-auto">
                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-bordered align-middle bg-white">
                        <thead class="table-dark text-center">
                            <tr>
                                <th style="width: 35%;">Sasaran Strategis</th>
                                <th style="width: 35%;">Strategi</th>
                                <th style="width: 30%;">Program Tahunan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grouped as $bidangName => $sasarans)
                                <tr class="fw-bold text-primary" style="background-color: #e2e8f0;">
                                    <td colspan="3" class="p-3" style="font-size: 1.05rem; background-color: #e2e8f0;">
                                        {{ $bidangName }}
                                    </td>
                                </tr>

                                @foreach($sasarans as $sasaranIdx => $sasaran)
                                    @php
                                        $strategis = $sasaran->strategis ?? collect();
                                        $strategiRowspans = [];
                                        $totalSasaranRows = 0;
                                        foreach ($strategis as $st) {
                                            $count = max(1, $st->programs->count());
                                            $strategiRowspans[] = $count;
                                            $totalSasaranRows += $count;
                                        }
                                        $totalSasaranRows = max(1, $totalSasaranRows);
                                    @endphp

                                    @foreach($strategis as $stIdx => $strategi)
                                        @php $programRows = max(1, $strategi->programs->count()); @endphp

                                        @foreach($strategi->programs as $prIdx => $program)
                                            <tr>
                                                @if($stIdx === 0 && $prIdx === 0)
                                                    <td rowspan="{{ $totalSasaranRows }}" class="align-top p-3 fw-medium" style="vertical-align:top;padding:16px;">
                                                        {{ $sasaran->nama_sasaran }}
                                                    </td>
                                                @endif
                                                @if($prIdx === 0)
                                                    <td rowspan="{{ $programRows }}" class="align-top p-3 text-muted" style="vertical-align:top;padding:16px;">
                                                        {{ $strategi->nama_strategi }}
                                                    </td>
                                                @endif
                                                <td class="align-top p-3" style="padding:12px 16px;">
                                                    {{ $program->nama_program }}
                                                    @if($program->tahun_akademik)
                                                        <span class="text-muted" style="font-size:11px;color:#6c757d;"> ({{ $program->tahun_akademik }})</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if($strategi->programs->isEmpty())
                                            <tr>
                                                @if($stIdx === 0)
                                                    <td rowspan="{{ $totalSasaranRows }}" class="align-top p-3 fw-medium" style="vertical-align:top;padding:16px;">
                                                        {{ $sasaran->nama_sasaran }}
                                                    </td>
                                                @endif
                                                <td class="align-top p-3 text-muted" style="vertical-align:top;padding:16px;">
                                                    {{ $strategi->nama_strategi }}
                                                </td>
                                                <td class="text-muted fst-italic p-3 text-center" style="padding:12px;color:#6c757d;text-align:center;">- Belum ada program -</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @if($strategis->isEmpty())
                                        <tr>
                                            <td class="p-3 fw-medium" style="padding:16px;">{{ $sasaran->nama_sasaran }}</td>
                                            <td class="text-muted fst-italic p-3 text-center" style="padding:12px;color:#6c757d;text-align:center;">- Belum ada strategi -</td>
                                            <td class="text-muted fst-italic p-3 text-center" style="padding:12px;color:#6c757d;text-align:center;">- Belum ada program -</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach

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

    // ── Repeater state ──
    let sasaranCounter = 0;
    let strategiCounters = {};
    let programCounters = {};

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
            let matchBid = !bidangId || (d.sasarans || []).some(s => s.bidang_id == bidangId);
            let matchFak = !fakultasId || d.fakultas_id == fakultasId;
            let matchPeriode = !periodeKey || (d.tahunMulai + '-' + d.tahunSelesai) === periodeKey;
            return matchFak && matchPeriode && matchBid;
        });
        return filtered;
    }

    // ── Repeater helpers ──
    function getBidangSelect(value) {
        let opts = '<option value="">Pilih Bidang</option>';
        bidangList.forEach(b => {
            opts += `<option value="${b.id}" ${b.id == value ? 'selected' : ''}>${b.kode_bidang} - ${b.nama_bidang}</option>`;
        });
        return opts;
    }

    function sasaranTemplate(sasaranVal, strategisHtml, bidangId) {
        sasaranCounter++;
        const idx = sasaranCounter;
        return `
            <div class="repeater-item sasaran-group p-3 bg-sky-50/40 border border-sky-100 rounded-xl" data-sasaran-idx="${idx}">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[11px] font-bold text-sky-600 uppercase tracking-wider">Sasaran #${idx}</span>
                    <button onclick="removeSasaran(this)" type="button" class="btn-remove text-[11px] text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 px-2 py-1 rounded-lg flex items-center gap-1 border border-slate-200">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Hapus
                    </button>
                </div>
                <select class="bidang-input w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition mb-2">${getBidangSelect(bidangId)}</select>
                <input type="text" class="sasaran-input w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-sky-500 transition" placeholder="Contoh: Meningkatkan kualitas penelitian dosen" value="${sasaranVal || ''}">
                <div class="mt-3 pl-4 border-l-2 border-sky-100 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-semibold text-indigo-500 uppercase tracking-wider">Strategi</span>
                        <button onclick="addStrategi(this)" type="button" class="btn-add text-[11px] font-semibold text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-2 py-1 rounded-lg flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Tambah Strategi
                        </button>
                    </div>
                    <div class="strategi-container space-y-2">
                        ${strategisHtml || ''}
                    </div>
                </div>
            </div>
        `;
    }

    function strategiTemplate(strategiVal, programsHtml) {
        const sIdx = sasaranCounter;
        if (!strategiCounters[sIdx]) strategiCounters[sIdx] = 0;
        strategiCounters[sIdx]++;
        const stIdx = strategiCounters[sIdx];
        return `
            <div class="repeater-item strategi-group p-2.5 bg-indigo-50/30 border border-indigo-100/60 rounded-lg" data-strategi-idx="${stIdx}">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider">Strategi #${stIdx}</span>
                    <button onclick="removeStrategi(this)" type="button" class="btn-remove text-[10px] text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 px-2 py-0.5 rounded-lg border border-slate-200">
                        <svg class="w-2.5 h-2.5 inline" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Hapus
                    </button>
                </div>
                <input type="text" class="strategi-input w-full border border-slate-200 rounded-lg px-3 py-1.5 text-sm outline-none focus:border-indigo-400 transition" placeholder="Contoh: Mendorong penelitian nasional" value="${strategiVal || ''}">
                <div class="mt-2 pl-3 border-l-2 border-indigo-100 space-y-1.5">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-semibold text-sky-500 uppercase tracking-wider">Program Tahunan</span>
                        <button onclick="addProgram(this)" type="button" class="btn-add text-[10px] font-semibold text-sky-600 hover:text-sky-800 bg-sky-50 hover:bg-sky-100 px-2 py-0.5 rounded-lg flex items-center gap-1">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Tambah Program
                        </button>
                    </div>
                    <div class="program-container space-y-1.5">
                        ${programsHtml || ''}
                    </div>
                </div>
            </div>
        `;
    }

    function programTemplate(programVal, tahunAkademik) {
        const taOptions = ['', '2023/2024', '2024/2025', '2025/2026', '2026/2027', '2027/2028'];
        let taHtml = '';
        taOptions.forEach(opt => {
            taHtml += `<option value="${opt}" ${opt === (tahunAkademik || '') ? 'selected' : ''}>${opt || 'Pilih Tahun'}</option>`;
        });
        return `
            <div class="repeater-item program-group p-2 bg-sky-50/40 border border-sky-100/60 rounded-lg">
                <div class="flex items-center gap-2">
                    <input type="text" class="program-input flex-1 border border-slate-200 rounded-lg px-2.5 py-1.5 text-sm outline-none focus:border-sky-400 transition" placeholder="Contoh: Program peningkatan publikasi" value="${programVal || ''}">
                    <button onclick="removeProgram(this)" type="button" class="btn-remove text-slate-400 hover:text-red-600 bg-white hover:bg-red-50 p-1 rounded-lg border border-slate-200 flex-shrink-0">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <select class="program-tahun-select mt-1.5 w-full border border-slate-200 rounded-lg px-2.5 py-1.5 text-sm outline-none focus:border-sky-400 transition">${taHtml}</select>
            </div>
        `;
    }

    function addSasaran(sasaranVal, strategisData, bidangId) {
        const container = document.getElementById('sasaran-container');
        const empty = document.getElementById('sasaran-empty');
        if (empty) empty.style.display = 'none';

        let strategisHtml = '';
        if (strategisData && strategisData.length) {
            strategisData.forEach(sd => {
                let programsHtml = '';
                if (sd.programs && sd.programs.length) {
                    sd.programs.forEach(pd => {
                        programsHtml += programTemplate(pd.nama_program || '', pd.tahun_akademik || '');
                    });
                }
                strategisHtml += strategiTemplate(sd.nama_strategi || '', programsHtml);
            });
        }

        container.insertAdjacentHTML('beforeend', sasaranTemplate(sasaranVal || '', strategisHtml, bidangId));
    }

    function addStrategi(btn, strategiVal, programsData) {
        const container = btn.closest('.sasaran-group').querySelector('.strategi-container');
        let programsHtml = '';
        if (programsData && programsData.length) {
            programsData.forEach(pd => {
                programsHtml += programTemplate(pd.nama_program || '', pd.tahun_akademik || '');
            });
        }
        container.insertAdjacentHTML('beforeend', strategiTemplate(strategiVal || '', programsHtml));
    }

    function addProgram(btn, programVal) {
        const container = btn.closest('.strategi-group').querySelector('.program-container');
        container.insertAdjacentHTML('beforeend', programTemplate(programVal || ''));
    }

    function removeSasaran(btn) {
        btn.closest('.sasaran-group').remove();
        const container = document.getElementById('sasaran-container');
        if (container.children.length === 0) {
            document.getElementById('sasaran-empty').style.display = 'block';
        }
    }

    function removeStrategi(btn) {
        btn.closest('.strategi-group').remove();
    }

    function removeProgram(btn) {
        btn.closest('.program-group').remove();
    }

    // ── Collect form data ──
    function collectSasarans() {
        const groups = document.querySelectorAll('#sasaran-container > .sasaran-group');
        const result = [];
        groups.forEach(g => {
            const bidangInput = g.querySelector('.bidang-input');
            const bidangId = bidangInput ? bidangInput.value : '';
            const sasaranInput = g.querySelector('.sasaran-input');
            const sasaranVal = sasaranInput ? sasaranInput.value.trim() : '';
            if (!sasaranVal) return;

            const strategiGroups = g.querySelectorAll('.strategi-container > .strategi-group');
            const strategis = [];
            strategiGroups.forEach(sg => {
                const strategiInput = sg.querySelector('.strategi-input');
                const strategiVal = strategiInput ? strategiInput.value.trim() : '';
                if (!strategiVal) return;

                const programGroups = sg.querySelectorAll('.program-container > .program-group');
                const programs = [];
                programGroups.forEach(pg => {
                    const progInput = pg.querySelector('.program-input');
                    const progVal = progInput ? progInput.value.trim() : '';
                    if (!progVal) return;
                    const taSelect = pg.querySelector('.program-tahun-select');
                    const taVal = taSelect ? taSelect.value : '';
                    programs.push({ nama_program: progVal, tahun_akademik: taVal });
                });

                strategis.push({ nama_strategi: strategiVal, programs });
            });

            result.push({ bidang_id: bidangId || null, nama_sasaran: sasaranVal, strategis });
        });
        return result;
    }

    // ── Tree rendering ──
    function getBidangForRenstra(r) {
        const sasarans = r.sasarans || [];
        if (sasarans.length === 0) return { id: 'null', name: 'Tanpa Bidang' };
        // Group by bidang_id — use the first one found
        for (const s of sasarans) {
            if (s.bidang_id) {
                const b = bidangList.find(x => x.id === s.bidang_id);
                return { id: s.bidang_id, name: b ? b.nama_bidang : 'Tanpa Bidang' };
            }
        }
        return { id: 'null', name: 'Tanpa Bidang' };
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

        const grouped = {};
        data.forEach(r => {
            const bInfo = getBidangForRenstra(r);
            if (!grouped[bInfo.id]) grouped[bInfo.id] = { bidang: bInfo.name, items: [] };
            grouped[bInfo.id].items.push(r);
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
                            <p class="text-[11px] text-slate-400">${g.items.length} Entri RENSTRA</p>
                        </div>
                    </div>
                    <div class="space-y-3 pl-6 border-l-2 border-violet-100">`;

            g.items.forEach(r => {
                const sasarans = r.sasarans || [];
                const totalProgram = sasarans.reduce((sum, s) => sum + (s.strategis || []).reduce((ss, st) => ss + (st.programs || []).length, 0), 0);
                const totalStrategi = sasarans.reduce((sum, s) => sum + (s.strategis || []).length, 0);
                const statusBadge = r.status === 'tercapai' ? 'bg-emerald-100 text-emerald-700' :
                                    r.status === 'dalam_proses' ? 'bg-amber-100 text-amber-700' :
                                    'bg-slate-100 text-slate-500';

                html += `
                    <div class="tree-node mb-3 last:mb-0">
                        <div class="flex items-center justify-between gap-3 p-4 bg-white border-2 border-sky-100 rounded-xl shadow-sm relative z-10">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-sky-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-sky-500/20">
                                    <span class="text-[11px] font-bold text-white">${r.kode || 'RS'}</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-sky-500 uppercase tracking-wider mb-0.5">RENSTRA</p>
                                    <p class="text-xs font-semibold text-slate-600">${getFakultasName(r.fakultas_id)} — Periode ${r.tahunMulai} - ${r.tahunSelesai}</p>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-[11px] text-slate-400">${sasarans.length} Sasaran</span>
                                        <span class="text-[11px] text-slate-400">${totalStrategi} Strategi</span>
                                        <span class="text-[11px] text-slate-400">${totalProgram} Program Tahunan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full ${statusBadge}">${r.status?.replace(/_/g, ' ') || 'Belum Tercapai'}</span>
                                <button onclick="openTableModal(${r.id})" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition" title="Tampilkan Tabel">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c.621 0 1.125-.504 1.125-1.125m-1.125 1.125v1.5m-7.5 0A1.125 1.125 0 013.375 12m9.75 0a1.125 1.125 0 011.125-1.125"/></svg>
                                </button>
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
                        </div>`;

                if (sasarans.length > 0) {
                    html += `<div class="pl-2 mt-2">`;
                    sasarans.forEach((s, si) => {
                        const isLastSasaran = si === sasarans.length - 1;
                        html += `
                            <div class="tree-child ${isLastSasaran ? 'last-sasaran' : ''}">
                                <div class="flex items-center gap-3 p-3 bg-sky-50/60 border border-sky-100/60 rounded-xl shadow-sm mb-2">
                                    <div class="w-9 h-9 rounded-lg bg-sky-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75 2.25 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-semibold text-sky-400 uppercase tracking-wider mb-0.5">Sasaran Strategis #${si + 1}</p>
                                        <p class="text-sm font-bold text-slate-800">${s.nama_sasaran}</p>
                                    </div>
                                </div>`;

                        const strategis = s.strategis || [];
                        if (strategis.length > 0) {
                            strategis.forEach((st, sti) => {
                                html += `
                                    <div class="tree-grandchild">
                                        <div class="flex items-center gap-3 p-3 bg-indigo-50/60 border border-indigo-100/60 rounded-xl shadow-sm mb-1">
                                            <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-semibold text-indigo-400 uppercase tracking-wider mb-0.5">Strategi #${sti + 1}</p>
                                                <p class="text-sm font-bold text-slate-800">${st.nama_strategi}</p>
                                            </div>
                                        </div>`;

                                const programs = st.programs || [];
                                programs.forEach((pr, pri) => {
                                    html += `
                                        <div class="tree-grandchild" style="margin-top:2px;padding-left:36px;">
                                            <div class="flex items-center gap-3 p-2.5 bg-emerald-50/60 border border-emerald-100/60 rounded-xl shadow-sm">
                                                <div class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75 2.25 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-semibold text-emerald-500 uppercase tracking-wider mb-0.5">Program Tahunan #${pri + 1}</p>
                                                    <p class="text-sm font-bold text-slate-800">${pr.nama_program}</p>
                                                    ${pr.tahun_akademik ? `<p class="text-[10px] text-emerald-600 font-medium mt-0.5">${pr.tahun_akademik}</p>` : ''}
                                                </div>
                                            </div>
                                        </div>`;
                                });

                                html += `</div>`;
                            });
                        }

                        html += `</div>`;
                    });
                    html += `</div>`;
                }

                html += `</div>`;
            });

            html += `</div></div>`;
        });

        container.innerHTML = html;
    }

    // ── Modal ──
    function setSelectValue(selectId, value) {
        const el = document.getElementById(selectId);
        if (!el) return;
        for (let i = 0; i < el.options.length; i++) {
            if (String(el.options[i].value) === String(value)) {
                el.selectedIndex = i;
                break;
            }
        }
    }

    function openModal(id = null) {
        document.getElementById('form-error').classList.add('hidden');
        document.getElementById('edit-id').value = id || '';

        // Reset repeater state
        sasaranCounter = 0;
        strategiCounters = {};
        programCounters = {};
        const container = document.getElementById('sasaran-container');
        container.innerHTML = '';
        document.getElementById('sasaran-empty').style.display = 'block';

        if (id) {
            const row = renstraData.find(d => d.id === id);
            if (row) {
                document.getElementById('modal-title-text').textContent = 'Edit Data RENSTRA';
                setSelectValue('f-fakultas', row.fakultas_id);
                document.getElementById('f-kode').value = row.kode || '';
                setSelectValue('f-tahun-mulai', row.tahunMulai);
                setSelectValue('f-tahun-selesai', row.tahunSelesai);
                document.getElementById('f-status').value = row.status || 'belum_tercapai';

                const sasarans = row.sasarans || [];
                if (sasarans.length > 0) {
                    sasarans.forEach(s => {
                        addSasaran(s.nama_sasaran, s.strategis || [], s.bidang_id);
                    });
                } else {
                    addSasaran('', [], '');
                }
            }
        } else {
            document.getElementById('modal-title-text').textContent = 'Tambah Data RENSTRA';
            document.getElementById('f-fakultas').value = document.getElementById('filter-fakultas').value || '';
            document.getElementById('f-kode').value = '';
            document.getElementById('f-tahun-mulai').value = '';
            document.getElementById('f-tahun-selesai').value = '';
            document.getElementById('f-status').value = 'belum_tercapai';
            addSasaran('', [], '');
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
        const fakultasId = document.getElementById('f-fakultas').value;
        const kode = document.getElementById('f-kode').value.trim();
        const tahunMulai = parseInt(document.getElementById('f-tahun-mulai').value);
        const tahunSelesai = parseInt(document.getElementById('f-tahun-selesai').value);
        const status = document.getElementById('f-status').value;
        const sasarans = collectSasarans();

        const errEl = document.getElementById('form-error');

        if (!fakultasId || !tahunMulai || !tahunSelesai) {
            errEl.textContent = 'Fakultas, Tahun Mulai, dan Tahun Selesai wajib diisi.';
            errEl.classList.remove('hidden');
            return;
        }
        if (tahunSelesai < tahunMulai) {
            errEl.textContent = 'Tahun Selesai harus >= Tahun Mulai.';
            errEl.classList.remove('hidden');
            return;
        }
        if (sasarans.length === 0) {
            errEl.textContent = 'Minimal satu sasaran strategis harus diisi.';
            errEl.classList.remove('hidden');
            return;
        }

        errEl.classList.add('hidden');

        const payload = {
            fakultas_id: fakultasId || null,
            kode: kode || null,
            tahun_mulai: tahunMulai,
            tahun_selesai: tahunSelesai,
            status: status,
            sasarans: sasarans,
        };

        const url  = id ? '/renstra/' + id : '/renstra';

        fetch(url, {
            method: 'POST',
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

    function openTableModal(id) {
        const el = document.getElementById('table-modal-' + id);
        if (!el) return;
        el.classList.remove('modal-closed');
        document.body.style.overflow = 'hidden';
    }

    function closeTableModal(id) {
        const el = document.getElementById('table-modal-' + id);
        if (!el) return;
        el.classList.add('modal-closed');
        document.body.style.overflow = '';
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
        if (e.key === 'Escape') {
            closeModal();
            closeDelModal();
            document.querySelectorAll('[id^="table-modal-"]').forEach(el => {
                if (!el.classList.contains('modal-closed')) {
                    const id = el.id.replace('table-modal-', '');
                    closeTableModal(id);
                }
            });
        }
    });

    populatePeriodeFilter();
    renderTree();
    </script>
</x-app-layout>
