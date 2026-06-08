<script>
// ── Data from Database ──────────────────────────────────────────
const bidangMaster = <?php echo json_encode($bidangMaster, 15, 512) ?>;
let programData = <?php echo json_encode($programList, 15, 512) ?>;

let deleteTargetId = null;
let detailOpenId   = null;

// ── SVG Icons used in JS-rendered HTML ──────────────────────────
const SVG = {
    pencil: '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>',
    trash: '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>',
    check: '<svg class="w-3 h-3" style="color:#059669" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>',
};

function iconChevronRight(id) {
    return '<svg id="' + id + '" class="w-3.5 h-3.5 text-slate-300 flex-shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>';
}

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
                        ${SVG.pencil}
                    </button>
                    <button onclick="event.stopPropagation();deleteProgram(${p.id})"
                        class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 transition" title="Hapus">
                        ${SVG.trash}
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
                ${iconChevronRight('hier-arrow-'+b.id)}
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
                    ? SVG.check
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
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views/master-data/program/scripts.blade.php ENDPATH**/ ?>