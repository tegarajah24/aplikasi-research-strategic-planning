<script>
// ── Data from Database ──────────────────────────────────────────
let bidangData = @json($bidangList);
let canWriteBidang = @json(auth()->user()->canWrite('bidang'));

let deleteTargetId = null;
const COLORS = ['#3b82f6','#6366f1','#8b5cf6','#10b981','#f59e0b'];

// ── SVG Icons used in JS-rendered HTML ──────────────────────────
const SVG = {
    pencil: '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>',
    trash: '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>',
    grid: '<svg class="w-3.5 h-3.5 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5"/></svg>',
};

function iconChevronRight(id) {
    return '<svg id="' + id + '" class="w-3.5 h-3.5 text-slate-300 flex-shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>';
}

// ── Helpers ──────────────────────────────────────────────────────
function totalPrograms() { return bidangData.reduce((s,b) => s + b.renstras.reduce((p,r) => p + r.sasarans.reduce((ss, sa) => ss + sa.strategis.reduce((st, str) => st + str.programs.length, 0), 0), 0), 0); }
function totalKegiatan()  { return bidangData.reduce((s,b) => s + b.renstras.reduce((p,r) => p + r.sasarans.reduce((ss, sa) => ss + sa.strategis.reduce((st, str) => st + str.programs.reduce((pr, prog) => pr + (prog.kegiatan || 0), 0), 0), 0), 0), 0); }

// ── Stats ────────────────────────────────────────────────────────
function renderStats() {
    const elBidang = document.getElementById('stat-bidang');
    const elProgram = document.getElementById('stat-program');
    const elKegiatan = document.getElementById('stat-kegiatan');
    if (elBidang) elBidang.textContent = bidangData.length;
    if (elProgram) elProgram.textContent = totalPrograms();
    if (elKegiatan) elKegiatan.textContent = totalKegiatan();
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

    tbody.innerHTML = filtered.map((b, i) => {
        const progCount = b.renstras.reduce((s, r) => s + r.sasarans.reduce((ss, sa) => ss + sa.strategis.reduce((st, str) => st + str.programs.length, 0), 0), 0);
        const kgtCount = b.renstras.reduce((s, r) => s + r.sasarans.reduce((ss, sa) => ss + sa.strategis.reduce((st, str) => st + str.programs.reduce((pr, prog) => pr + (prog.kegiatan || 0), 0), 0), 0), 0);
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
                <span class="inline-block bg-indigo-50 text-indigo-700 text-xs font-bold px-2.5 py-0.5 rounded-lg">${progCount}</span>
            </td>
            <td class="px-3 py-3 text-center">
                <span class="inline-block bg-slate-100 text-slate-600 text-xs font-bold px-2.5 py-0.5 rounded-lg">${kgtCount}</span>
            </td>
            <td class="px-3 py-3 text-center">
                <span class="inline-block text-[11px] font-semibold px-2.5 py-0.5 rounded-full ${badgeCls}">${b.status}</span>
            </td>
            <td class="px-3 py-3 text-center">
                ${canWriteBidang ? `
                <div class="flex items-center justify-center gap-1">
                    <button onclick="event.stopPropagation(); editBidang(${b.id})"
                        class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-50 transition" title="Edit">
                        ${SVG.pencil}
                    </button>
                    <button onclick="event.stopPropagation(); deleteBidang(${b.id})"
                        class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 transition" title="Hapus">
                        ${SVG.trash}
                    </button>
                </div>
                ` : ''}
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
        const progCount = b.renstras.reduce((s, r) => s + r.sasarans.reduce((ss, sa) => ss + sa.strategis.reduce((st, str) => st + str.programs.length, 0), 0), 0);
        const kgtCount = b.renstras.reduce((s, r) => s + r.sasarans.reduce((ss, sa) => ss + sa.strategis.reduce((st, str) => st + str.programs.reduce((pr, prog) => pr + (prog.kegiatan || 0), 0), 0), 0), 0);
        const renstras = b.renstras.map(r => {
            const sasaranHtml = r.sasarans.map(sa => {
                const strategiHtml = sa.strategis.map(st => {
                    const programHtml = st.programs.map(pr => `
                        <div class="tree-item flex items-center gap-2 py-1 pl-8">
                            <span class="text-[11px] font-mono text-slate-400 w-8">PRG</span>
                            <span class="text-xs text-slate-600">${pr.nama_program}</span>
                            <span class="ml-auto text-[10px] bg-slate-100 text-slate-500 rounded-md px-1.5 py-0.5 font-medium flex-shrink-0">${pr.kegiatan} keg</span>
                        </div>`).join('');
                    return `
                        <div class="tree-item flex items-center gap-2 py-1 pl-6">
                            <span class="text-[10px] font-mono text-indigo-400 w-10">STG</span>
                            <span class="text-xs text-slate-600">${st.nama_strategi}</span>
                        </div>
                        ${programHtml}
                    `;
                }).join('');
                return `
                    <div class="tree-item flex items-center gap-2 py-1 pl-4">
                        <span class="text-[10px] font-mono text-sky-500 w-10">SSR</span>
                        <span class="text-xs font-medium text-slate-700">${sa.nama_sasaran}</span>
                    </div>
                    ${strategiHtml}
                `;
            }).join('');
            return `
                <div class="tree-item flex items-center gap-2 py-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-300 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    <span class="text-xs font-semibold text-indigo-600">${r.fakultas}</span>
                    <span class="text-[10px] text-slate-400">${r.tahunMulai}-${r.tahunSelesai}</span>
                </div>
                ${sasaranHtml}
            `;
        }).join('');

        return `
        <div class="hier-bidang" id="hier-${b.id}">
            <button onclick="toggleHier(${b.id})"
                class="w-full flex items-center gap-2.5 px-2 py-2 rounded-xl hover:bg-slate-50 transition group text-left">
                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: ${colorDot}"></span>
                <span class="text-xs font-semibold text-slate-700 flex-1">${b.nama}</span>
                <span class="text-[10px] text-slate-400 flex-shrink-0">${progCount} program · ${kgtCount} keg</span>
                ${iconChevronRight('hier-arrow-'+b.id)}
            </button>
            <div id="hier-body-${b.id}" class="hier-body max-h-0 pl-4">
                <div class="pb-2">${renstras}</div>
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
    const totalProg  = totalPrograms() || 1;
    container.innerHTML = bidangData.map((b, i) => {
        const progCount = b.renstras.reduce((s, r) => s + r.sasarans.reduce((ss, sa) => ss + sa.strategis.reduce((st, str) => st + str.programs.length, 0), 0), 0);
        const pct = Math.round(progCount / totalProg * 100);
        const colorBar = COLORS[i % COLORS.length];
        return `
        <div>
            <div class="flex items-center justify-between mb-1">
                <span class="text-xs font-medium text-slate-600 truncate">${b.nama}</span>
                <span class="text-[11px] text-slate-400 ml-2 flex-shrink-0">${progCount} prog</span>
            </div>
            <div class="w-full h-2 rounded-full bg-slate-100">
                <div class="h-2 rounded-full transition-all duration-700" style="width:${pct}%; background-color: ${colorBar}"></div>
            </div>
            <p class="text-[10px] text-slate-400 mt-0.5">${pct}% dari total program</p>
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
    document.getElementById('bidang-modal').classList.remove('modal-closed');
    document.body.style.overflow = 'hidden';
    setTimeout(() => document.getElementById('f-kode').focus(), 100);
}

function closeModal() {
    document.getElementById('bidang-modal').classList.add('modal-closed');
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

    const url  = id ? '/bidang/' + id : '/bidang';
    const method = id ? 'PUT' : 'POST';

    fetch(url, {
        method: method,
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify({ kode_bidang: kode, nama_bidang: nama, deskripsi: desk, status: stat })
    }).then(r => {
        if (r.ok) { window.location.reload(); }
        else { r.json().then(d => { errEl.textContent = d.message || 'Terjadi kesalahan'; errEl.classList.remove('hidden'); }); }
    }).catch(() => {
        errEl.textContent = 'Terjadi kesalahan koneksi.';
        errEl.classList.remove('hidden');
    });
}

function editBidang(id) { openModal(id); }

// ── Delete ───────────────────────────────────────────────────────
function deleteBidang(id) {
    const b = bidangData.find(x => x.id === id);
    if (!b) return;
    deleteTargetId = id;
    document.getElementById('del-name').textContent = `"${b.nama}" akan dihapus.`;
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
    fetch('/bidang/' + deleteTargetId, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
    }).then(r => {
        if (r.ok) { window.location.reload(); }
    });
    closeDelModal();
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
