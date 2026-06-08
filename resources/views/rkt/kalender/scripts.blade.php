const allEvents = [
    { id: 1, title: 'Seminar Nasional Riset & Inovasi', program: 'Hibah Internal', bidang: 'Penelitian', start: '2025-06-03', end: '2025-06-05', pj: 'Dr. Ahmad Fauzi', status: 'upcoming', anggaran: 'Rp 25.000.000', indikator: 'Terlaksananya seminar dengan minimal 100 peserta dari berbagai institusi', target: '1 kegiatan seminar, 100 peserta, 20 paper terseleksi', dokumen: 'SK Pelaksanaan No. 012/UHB/2025 · Proposal Kegiatan.pdf' },
    { id: 2, title: 'Workshop Penulisan Artikel Ilmiah', program: 'Publikasi', bidang: 'Penelitian', start: '2025-06-10', end: '2025-06-11', pj: 'Siti Rahayu, M.Pd', status: 'upcoming', anggaran: 'Rp 8.500.000', indikator: 'Peningkatan kemampuan penulisan artikel bereputasi internasional dosen', target: '30 dosen peserta, minimal 5 draft artikel siap submit', dokumen: 'TOR Workshop.pdf · Daftar Peserta.xlsx' },
    { id: 3, title: 'Rapat Koordinasi LP3M Semester Gasal', program: 'Pengembangan SDM', bidang: 'Akademik', start: '2025-06-02', end: '2025-06-02', pj: 'Budi Santoso, M.T', status: 'running', anggaran: 'Rp 2.000.000', indikator: 'Tersusunnya program kerja LP3M semester gasal 2025/2026', target: '1 dokumen program kerja disepakati', dokumen: 'Agenda Rapat.pdf' },
    { id: 4, title: 'Pengabdian Masyarakat Desa Binaan', program: 'Kemitraan', bidang: 'Pengabdian', start: '2025-06-15', end: '2025-06-20', pj: 'Rina Agustina, M.Kom', status: 'upcoming', anggaran: 'Rp 15.000.000', indikator: 'Peningkatan literasi digital masyarakat desa binaan', target: '50 warga terlatih, 1 laporan akhir, 1 artikel pengabmas', dokumen: 'Proposal Pengabmas.pdf · SK Pembimbing.pdf' },
    { id: 5, title: 'Pelatihan Metodologi Penelitian', program: 'Pengembangan SDM', bidang: 'Penelitian', start: '2025-05-10', end: '2025-05-12', pj: 'Dr. Ahmad Fauzi', status: 'done', anggaran: 'Rp 12.000.000', indikator: 'Peningkatan kompetensi penelitian dosen muda', target: '25 dosen, sertifikat pelatihan, modul pelatihan', dokumen: 'Laporan Akhir Pelatihan.pdf · Daftar Hadir.xlsx' },
    { id: 6, title: 'Penyusunan Laporan Tahunan LP3M', program: 'Pengembangan SDM', bidang: 'Akademik', start: '2025-05-01', end: '2025-05-31', pj: 'Budi Santoso, M.T', status: 'late', anggaran: 'Rp 3.500.000', indikator: 'Tersedianya laporan tahunan LP3M yang komprehensif dan tepat waktu', target: '1 dokumen laporan tahunan 2024/2025', dokumen: 'Draft Laporan v1.docx' },
    { id: 7, title: 'Seleksi Hibah Penelitian Internal', program: 'Hibah Internal', bidang: 'Penelitian', start: '2025-06-25', end: '2025-06-27', pj: 'Siti Rahayu, M.Pd', status: 'upcoming', anggaran: 'Rp 5.000.000', indikator: 'Terseleksinya proposal penelitian terbaik untuk pendanaan internal', target: '10 proposal terseleksi, 5 didanai', dokumen: 'Panduan Hibah 2025.pdf · Form Penilaian.xlsx' },
    { id: 8, title: 'MOU dengan Universitas Mitra', program: 'Kemitraan', bidang: 'Kemahasiswaan', start: '2025-06-18', end: '2025-06-18', pj: 'Rina Agustina, M.Kom', status: 'upcoming', anggaran: 'Rp 1.500.000', indikator: 'Terjalinnya kerjasama formal dengan universitas mitra', target: '2 MOU ditandatangani', dokumen: 'Draft MOU.docx' },
    { id: 9, title: 'Penyusunan Proposal Hibah DIKTI', program: 'Hibah Internal', bidang: 'Penelitian', start: '2026-05-12', end: '2026-05-15', pj: 'Dr. Ahmad Fauzi', status: 'done', anggaran: 'Rp 30.000.000', indikator: 'Tersusunnya proposal hibah berskala nasional DIKTI', target: '3 proposal disubmit ke portal BIMA', dokumen: 'Panduan BIMA 2026.pdf · Draft Proposal.docx' },
    { id: 10, title: 'Monitoring dan Evaluasi Penelitian Internal', program: 'Hibah Internal', bidang: 'Penelitian', start: '2026-05-24', end: '2026-05-26', pj: 'Siti Rahayu, M.Pd', status: 'running', anggaran: 'Rp 4.000.000', indikator: 'Terlaksananya monev tengah tahun untuk 15 judul penelitian', target: '15 laporan kemajuan dievaluasi, laporan monev selesai', dokumen: 'Instrumen Monev.pdf · Jadwal Monev.xlsx' },
    { id: 11, title: 'Workshop Penulisan Jurnal Scopus', program: 'Publikasi', bidang: 'Penelitian', start: '2026-05-28', end: '2026-05-29', pj: 'Rina Agustina, M.Kom', status: 'upcoming', anggaran: 'Rp 10.000.000', indikator: 'Peningkatan publikasi ilmiah di jurnal internasional terindeks Scopus', target: '20 dosen peserta, minimal 3 paper submit', dokumen: 'Materi Workshop.zip · Template Jurnal.docx' },
    { id: 12, title: 'Audit Mutu Internal Akademik', program: 'Pengembangan SDM', bidang: 'Akademik', start: '2026-05-05', end: '2026-05-08', pj: 'Budi Santoso, M.T', status: 'done', anggaran: 'Rp 5.500.000', indikator: 'Terlaksananya audit mutu akademik di tingkat program studi', target: '5 program studi diaudit, laporan AMI 2026 selesai', dokumen: 'Instrumen Audit.xlsx · SK Auditor.pdf' },
    { id: 13, title: 'Kunjungan Kerjasama Luar Negeri', program: 'Kemitraan', bidang: 'Kemahasiswaan', start: '2026-05-20', end: '2026-05-22', pj: 'Dr. Ahmad Fauzi', status: 'late', anggaran: 'Rp 45.000.000', indikator: 'MoA implementasi student exchange dengan universitas mitra', target: '1 naskah MoA disepakati dan ditandatangani', dokumen: 'Draft MoA.docx · Rencana Kunjungan.pdf' },
    { id: 14, title: 'Sosialisasi KKN Tematik 2026', program: 'Kemitraan', bidang: 'Pengabdian', start: '2026-06-05', end: '2026-06-05', pj: 'Rina Agustina, M.Kom', status: 'upcoming', anggaran: 'Rp 3.000.000', indikator: 'Pembekalan mahasiswa sebelum terjun ke lokasi KKN', target: '150 mahasiswa terdaftar pembekalan KKN', dokumen: 'Materi KKN 2026.pdf · Buku Panduan.pdf' },
    { id: 15, title: 'FGD Penyusunan Visi Misi Fakultas', program: 'Pengembangan SDM', bidang: 'Akademik', start: '2026-06-12', end: '2026-06-14', pj: 'Budi Santoso, M.T', status: 'upcoming', anggaran: 'Rp 7.500.000', indikator: 'Terumuskannya draf visi keilmuan dan misi fakultas yang baru', target: '1 dokumen draf visi misi, dihadiri 40 peserta stakeholder', dokumen: 'Undangan Stakeholder.pdf · Draf Kuesioner.docx' },
    { id: 16, title: 'Submit Laporan Kinerja Dosen (LKD)', program: 'Pengembangan SDM', bidang: 'Akademik', start: '2026-05-25', end: '2026-05-27', pj: 'Siti Rahayu, M.Pd', status: 'running', anggaran: 'Rp 0', indikator: 'Seluruh dosen tetap melaporkan kinerja di SISTER', target: '100% dosen tetap selesai submit LKD', dokumen: 'Panduan SISTER LKD.pdf' },
];

let currentDate = new Date();
let filteredEvents = [...allEvents];

const statusConfig = {
    done:     { cls:'ev-done',     label:'Selesai',      badge:'bg-emerald-100 text-emerald-700' },
    running:  { cls:'ev-running',  label:'Berjalan',     badge:'bg-amber-100 text-amber-700' },
    upcoming: { cls:'ev-upcoming', label:'Akan Datang',  badge:'bg-blue-100 text-blue-700' },
    late:     { cls:'ev-late',     label:'Terlambat',    badge:'bg-red-100 text-red-700' },
};

const monthNames = ['Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'];

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
    ['filter-tahun','filter-bidang','filter-program','filter-pj'].forEach(id => {
        document.getElementById(id).value = '';
    });
    document.getElementById('filter-tahun').value = '2026';
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
