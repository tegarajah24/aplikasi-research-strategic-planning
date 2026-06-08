const allEvents = @json($eventsData);

const statusConfig = {
    done:     { cls:'ev-done',     label:'Selesai',      badge:'bg-emerald-100 text-emerald-700' },
    running:  { cls:'ev-running',  label:'Berjalan',     badge:'bg-amber-100 text-amber-700' },
    upcoming: { cls:'ev-upcoming', label:'Akan Datang',  badge:'bg-blue-100 text-blue-700' },
    late:     { cls:'ev-late',     label:'Terlambat',    badge:'bg-red-100 text-red-700' },
};

const monthNames = ['Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'];

let currentDate = new Date();
let filteredEvents = [...allEvents];

function applyFilters() {
    const tahun  = document.getElementById('filter-tahun').value;
    const bidang = document.getElementById('filter-bidang').value;
    const program= document.getElementById('filter-program').value;
    const pj     = document.getElementById('filter-pj').value;

    filteredEvents = allEvents.filter(e => {
        const year = new Date(e.start).getFullYear().toString();
        if (tahun  && year       !== tahun)  return false;
        if (bidang && e.bidang   !== bidang)  return false;
        if (program && e.program !== program) return false;
        if (pj     && e.pj       !== pj)      return false;
        return true;
    });

    renderCalendar();
    renderUpcoming();
    renderStats();
}

function resetFilters() {
    document.getElementById('filter-tahun').value = '';
    document.getElementById('filter-bidang').value = '';
    document.getElementById('filter-program').value = '';
    document.getElementById('filter-pj').value = '';
    applyFilters();
}

function renderCalendar() {
    const year  = currentDate.getFullYear();
    const month = currentDate.getMonth();

    document.getElementById('cal-title').textContent =
        monthNames[month] + ' ' + year;

    const firstDay  = new Date(year, month, 1).getDay();
    const daysCount = new Date(year, month + 1, 0).getDate();
    const today     = new Date();

    const body = document.getElementById('cal-body');
    body.innerHTML = '';

    for (let i = 0; i < firstDay; i++) {
        body.insertAdjacentHTML('beforeend',
            `<div class="cal-day border-b border-r border-slate-100/70 bg-slate-50/40 p-1 min-h-[64px]"></div>`);
    }

    for (let d = 1; d <= daysCount; d++) {
        const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
        const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();

        const dayEvents = filteredEvents.filter(e => dateStr >= e.start && dateStr <= e.end);

        let evHtml = '';
        dayEvents.slice(0, 2).forEach(ev => {
            const cfg = statusConfig[ev.status];
            evHtml += `<span class="event-pill ${cfg.cls} mb-0.5" onclick="openModal(${ev.id})" title="${ev.title}">${ev.title}</span>`;
        });
        if (dayEvents.length > 2) {
            evHtml += `<span class="text-[10px] text-slate-400 font-medium px-1">+${dayEvents.length - 2} lagi</span>`;
        }

        body.insertAdjacentHTML('beforeend', `
            <div class="cal-day ${isToday ? 'today-cell bg-blue-50/40' : ''} border-b border-r border-slate-100/70 p-1 overflow-hidden">
                <div class="flex justify-end">
                    <span class="day-num text-[10px] font-bold ${isToday ? 'text-white' : 'text-slate-400'} w-5 h-5 flex items-center justify-center">${d}</span>
                </div>
                <div class="w-full mt-auto space-y-0.5">${evHtml}</div>
            </div>`);
    }

    const totalCells = firstDay + daysCount;
    const remaining  = (Math.ceil(totalCells / 7) * 7) - totalCells;
    for (let i = 0; i < remaining; i++) {
        body.insertAdjacentHTML('beforeend',
            `<div class="cal-day border-b border-r border-slate-100/70 bg-slate-50/40 p-1 min-h-[64px]"></div>`);
    }
}

function renderUpcoming() {
    const today = new Date().toISOString().split('T')[0];
    const upcoming = filteredEvents
        .filter(e => e.end >= today && (e.status === 'upcoming' || e.status === 'running'))
        .sort((a, b) => a.start.localeCompare(b.start))
        .slice(0, 8);

    const el = document.getElementById('upcoming-list');
    const countEl = document.getElementById('upcoming-count');
    countEl.textContent = upcoming.length;

    if (!upcoming.length) {
        el.innerHTML = `<div class="px-5 py-8 text-center text-sm text-slate-400">Tidak ada kegiatan mendatang</div>`;
        return;
    }

    el.innerHTML = upcoming.map(ev => {
        const cfg = statusConfig[ev.status];
        const startDate = new Date(ev.start);
        const dd = startDate.getDate();
        const mm = monthNames[startDate.getMonth()].slice(0,3);
        return `
        <div class="upcoming-row flex items-start gap-3 px-4 py-3 cursor-pointer" onclick="openModal(${ev.id})">
            <div class="flex-shrink-0 w-10 text-center">
                <p class="text-lg font-extrabold text-slate-700 leading-none">${dd}</p>
                <p class="text-[10px] text-slate-400 uppercase font-semibold">${mm}</p>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-700 truncate leading-snug">${ev.title}</p>
                <p class="text-xs text-slate-400 truncate mt-0.5">${ev.pj}</p>
            </div>
            <span class="flex-shrink-0 text-[10px] font-semibold px-2 py-0.5 rounded-full ${cfg.badge}">${cfg.label}</span>
        </div>`;
    }).join('');
}

function renderStats() {
    const counts = { total: filteredEvents.length, running: 0, done: 0, late: 0 };
    filteredEvents.forEach(e => {
        if (e.status === 'running')  counts.running++;
        if (e.status === 'done')     counts.done++;
        if (e.status === 'late')     counts.late++;
    });
    document.getElementById('stat-total').textContent   = counts.total;
    document.getElementById('stat-running').textContent = counts.running;
    document.getElementById('stat-done').textContent    = counts.done;
    document.getElementById('stat-late').textContent    = counts.late;
}

function openModal(id) {
    const ev = allEvents.find(e => e.id === id);
    if (!ev) return;
    const cfg = statusConfig[ev.status];

    document.getElementById('modal-title').textContent   = ev.title;
    document.getElementById('modal-program').textContent = ev.program + ' · ' + ev.bidang;
    document.getElementById('modal-pj').textContent      = ev.pj;
    document.getElementById('modal-bidang').textContent  = ev.bidang;
    document.getElementById('modal-anggaran').textContent= ev.anggaran;
    document.getElementById('modal-indikator').textContent= ev.indikator;
    document.getElementById('modal-target').textContent  = ev.target;
    document.getElementById('modal-dokumen').textContent = ev.dokumen;

    const s = new Date(ev.start), e2 = new Date(ev.end);
    const fmt = d => d.getDate() + ' ' + monthNames[d.getMonth()] + ' ' + d.getFullYear();
    document.getElementById('modal-tanggal').textContent =
        ev.start === ev.end ? fmt(s) : fmt(s) + ' – ' + fmt(e2);

    const badge = document.getElementById('modal-status-badge');
    badge.textContent = cfg.label;
    badge.className   = 'text-xs font-semibold mb-1.5 inline-block px-2.5 py-0.5 rounded-full ' + cfg.badge;

    document.getElementById('ev-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('ev-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}
function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}
function goToToday() {
    currentDate = new Date();
    renderCalendar();
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

applyFilters();
