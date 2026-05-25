<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Kalender Kegiatan</h1>
                <p class="text-sm text-slate-400 mt-0.5">Jadwal pelaksanaan kegiatan RKT dalam bentuk kalender & timeline</p>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="goToToday()"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors shadow-sm shadow-blue-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                    </svg>
                    Hari Ini
                </button>
            </div>
        </div>
    </x-slot>

    <style>
        /* ── Custom Calendar Styles ── */
        .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); }
        .cal-day  { min-height: 100px; }

        .event-pill {
            font-size: 11px;
            line-height: 1.2;
            padding: 2px 6px;
            border-radius: 4px;
            cursor: pointer;
            transition: opacity .15s, transform .1s;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
            display: block;
        }
        .event-pill:hover { opacity: .85; transform: scale(1.02); }

        /* status colours */
        .ev-done       { background:#d1fae5; color:#065f46; border-left:3px solid #10b981; }
        .ev-running    { background:#fef3c7; color:#92400e; border-left:3px solid #f59e0b; }
        .ev-upcoming   { background:#dbeafe; color:#1e40af; border-left:3px solid #3b82f6; }
        .ev-late       { background:#fee2e2; color:#991b1b; border-left:3px solid #ef4444; }

        /* detail modal */
        #ev-modal {
            transition: opacity .2s;
        }
        #ev-modal.hidden { display:none; }

        /* scrollbar hide on month body */
        .cal-body::-webkit-scrollbar { display:none; }
        .cal-body { -ms-overflow-style:none; scrollbar-width:none; }

        /* today ring */
        .today-cell .day-num {
            background: #2563eb;
            color: #fff;
            border-radius: 50%;
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Upcoming list hover */
        .upcoming-row { transition: background .15s; }
        .upcoming-row:hover { background: #f8fafc; }

        /* Filter select styling */
        .filter-select {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 13px;
            color: #334155;
            background: #fff;
            outline: none;
            cursor: pointer;
            transition: border-color .15s;
        }
        .filter-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.12); }

        /* Chip legend */
        .legend-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
        }
        .chip-done    { background:#d1fae5; color:#065f46; }
        .chip-running { background:#fef3c7; color:#92400e; }
        .chip-upcoming{ background:#dbeafe; color:#1e40af; }
        .chip-late    { background:#fee2e2; color:#991b1b; }
    </style>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- ── Filter Bar ── --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm px-5 py-4">
                <div class="flex flex-wrap items-center gap-3">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
                    </svg>
                    <span class="text-sm font-semibold text-slate-600">Filter:</span>

                    <select id="filter-tahun" class="filter-select" onchange="applyFilters()">
                        <option value="">Semua Tahun</option>
                        <option value="2024">2024</option>
                        <option value="2025" selected>2025</option>
                        <option value="2026">2026</option>
                    </select>

                    <select id="filter-bidang" class="filter-select" onchange="applyFilters()">
                        <option value="">Semua Bidang</option>
                        <option value="Penelitian">Penelitian</option>
                        <option value="Pengabdian">Pengabdian</option>
                        <option value="Akademik">Akademik</option>
                        <option value="Kemahasiswaan">Kemahasiswaan</option>
                    </select>

                    <select id="filter-program" class="filter-select" onchange="applyFilters()">
                        <option value="">Semua Program</option>
                        <option value="Hibah Internal">Hibah Internal</option>
                        <option value="Pengembangan SDM">Pengembangan SDM</option>
                        <option value="Publikasi">Publikasi</option>
                        <option value="Kemitraan">Kemitraan</option>
                    </select>

                    <select id="filter-pj" class="filter-select" onchange="applyFilters()">
                        <option value="">Semua PJ</option>
                        <option value="Dr. Ahmad Fauzi">Dr. Ahmad Fauzi</option>
                        <option value="Siti Rahayu, M.Pd">Siti Rahayu, M.Pd</option>
                        <option value="Budi Santoso, M.T">Budi Santoso, M.T</option>
                        <option value="Rina Agustina, M.Kom">Rina Agustina, M.Kom</option>
                    </select>

                    <button onclick="resetFilters()" class="ml-auto text-xs text-blue-500 hover:text-blue-700 font-medium transition-colors">
                        Reset Filter
                    </button>
                </div>

                {{-- Legend --}}
                <div class="flex flex-wrap items-center gap-2 mt-4 pt-4 border-t border-slate-100">
                    <span class="text-xs text-slate-400 font-medium mr-1">Status:</span>
                    <span class="legend-chip chip-done">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span> Selesai
                    </span>
                    <span class="legend-chip chip-running">
                        <span class="w-2 h-2 rounded-full bg-amber-400 inline-block"></span> Berjalan
                    </span>
                    <span class="legend-chip chip-upcoming">
                        <span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span> Akan Datang
                    </span>
                    <span class="legend-chip chip-late">
                        <span class="w-2 h-2 rounded-full bg-red-500 inline-block"></span> Terlambat
                    </span>
                </div>
            </div>

            {{-- ── Calendar + Sidebar ── --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

                {{-- Calendar Panel --}}
                <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    {{-- Month Nav --}}
                    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                        <button onclick="prevMonth()" class="p-2 rounded-xl hover:bg-slate-100 transition-colors text-slate-500 hover:text-slate-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                            </svg>
                        </button>
                        <h2 id="cal-title" class="text-base font-bold text-slate-800"></h2>
                        <button onclick="nextMonth()" class="p-2 rounded-xl hover:bg-slate-100 transition-colors text-slate-500 hover:text-slate-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Day Headers --}}
                    <div class="cal-grid border-b border-slate-100">
                        @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $d)
                        <div class="text-center text-[11px] font-semibold text-slate-400 py-2 uppercase tracking-wider
                            {{ $d === 'Min' ? 'text-red-400' : '' }}">{{ $d }}</div>
                        @endforeach
                    </div>

                    {{-- Calendar Body --}}
                    <div id="cal-body" class="cal-grid cal-body"></div>
                </div>

                {{-- Upcoming Sidebar --}}
                <div class="flex flex-col gap-5">
                    {{-- Stats --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100/60 border border-blue-200/60 rounded-2xl p-4 text-center">
                            <p id="stat-total" class="text-2xl font-extrabold text-blue-700">—</p>
                            <p class="text-xs text-blue-500 font-medium mt-0.5">Total Kegiatan</p>
                        </div>
                        <div class="bg-gradient-to-br from-amber-50 to-amber-100/60 border border-amber-200/60 rounded-2xl p-4 text-center">
                            <p id="stat-running" class="text-2xl font-extrabold text-amber-600">—</p>
                            <p class="text-xs text-amber-500 font-medium mt-0.5">Sedang Berjalan</p>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/60 border border-emerald-200/60 rounded-2xl p-4 text-center">
                            <p id="stat-done" class="text-2xl font-extrabold text-emerald-600">—</p>
                            <p class="text-xs text-emerald-500 font-medium mt-0.5">Selesai</p>
                        </div>
                        <div class="bg-gradient-to-br from-red-50 to-red-100/60 border border-red-200/60 rounded-2xl p-4 text-center">
                            <p id="stat-late" class="text-2xl font-extrabold text-red-600">—</p>
                            <p class="text-xs text-red-500 font-medium mt-0.5">Terlambat</p>
                        </div>
                    </div>

                    {{-- Upcoming List --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm flex-1 overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-sm font-bold text-slate-700">Kegiatan Mendatang</h3>
                            <span id="upcoming-count" class="text-xs bg-blue-100 text-blue-600 font-semibold px-2 py-0.5 rounded-full"></span>
                        </div>
                        <div id="upcoming-list" class="divide-y divide-slate-100 max-h-80 overflow-y-auto">
                            {{-- JS rendered --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Event Detail Modal ── --}}
    <div id="ev-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden animate-fade-in">
            {{-- Modal Header --}}
            <div id="modal-header" class="px-6 py-5 flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <p id="modal-status-badge" class="text-xs font-semibold mb-1.5 inline-block px-2.5 py-0.5 rounded-full"></p>
                    <h3 id="modal-title" class="text-lg font-bold text-slate-800 leading-snug"></h3>
                    <p id="modal-program" class="text-sm text-slate-500 mt-1"></p>
                </div>
                <button onclick="closeModal()" class="flex-shrink-0 p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="px-6 pb-6 space-y-4 border-t border-slate-100 pt-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1">Waktu Pelaksanaan</p>
                        <p id="modal-tanggal" class="text-sm font-semibold text-slate-700"></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1">Penanggung Jawab</p>
                        <p id="modal-pj" class="text-sm font-semibold text-slate-700"></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1">Bidang</p>
                        <p id="modal-bidang" class="text-sm font-semibold text-slate-700"></p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-3">
                        <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1">Anggaran</p>
                        <p id="modal-anggaran" class="text-sm font-semibold text-slate-700"></p>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-xl p-3">
                    <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1.5">Indikator Kinerja</p>
                    <p id="modal-indikator" class="text-sm text-slate-600 leading-relaxed"></p>
                </div>

                <div class="bg-slate-50 rounded-xl p-3">
                    <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1.5">Target</p>
                    <p id="modal-target" class="text-sm text-slate-600"></p>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"/>
                    </svg>
                    <p id="modal-dokumen" class="text-xs text-slate-400 italic"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    // ── Sample Data ──────────────────────────────────────────────
    const allEvents = [
        {
            id: 1,
            title: 'Seminar Nasional Riset & Inovasi',
            program: 'Hibah Internal',
            bidang: 'Penelitian',
            start: '2025-06-03',
            end:   '2025-06-05',
            pj: 'Dr. Ahmad Fauzi',
            status: 'upcoming',
            anggaran: 'Rp 25.000.000',
            indikator: 'Terlaksananya seminar dengan minimal 100 peserta dari berbagai institusi',
            target: '1 kegiatan seminar, 100 peserta, 20 paper terseleksi',
            dokumen: 'SK Pelaksanaan No. 012/UHB/2025 · Proposal Kegiatan.pdf'
        },
        {
            id: 2,
            title: 'Workshop Penulisan Artikel Ilmiah',
            program: 'Publikasi',
            bidang: 'Penelitian',
            start: '2025-06-10',
            end:   '2025-06-11',
            pj: 'Siti Rahayu, M.Pd',
            status: 'upcoming',
            anggaran: 'Rp 8.500.000',
            indikator: 'Peningkatan kemampuan penulisan artikel bereputasi internasional dosen',
            target: '30 dosen peserta, minimal 5 draft artikel siap submit',
            dokumen: 'TOR Workshop.pdf · Daftar Peserta.xlsx'
        },
        {
            id: 3,
            title: 'Rapat Koordinasi LP3M Semester Gasal',
            program: 'Pengembangan SDM',
            bidang: 'Akademik',
            start: '2025-06-02',
            end:   '2025-06-02',
            pj: 'Budi Santoso, M.T',
            status: 'running',
            anggaran: 'Rp 2.000.000',
            indikator: 'Tersusunnya program kerja LP3M semester gasal 2025/2026',
            target: '1 dokumen program kerja disepakati',
            dokumen: 'Agenda Rapat.pdf'
        },
        {
            id: 4,
            title: 'Pengabdian Masyarakat Desa Binaan',
            program: 'Kemitraan',
            bidang: 'Pengabdian',
            start: '2025-06-15',
            end:   '2025-06-20',
            pj: 'Rina Agustina, M.Kom',
            status: 'upcoming',
            anggaran: 'Rp 15.000.000',
            indikator: 'Peningkatan literasi digital masyarakat desa binaan',
            target: '50 warga terlatih, 1 laporan akhir, 1 artikel pengabmas',
            dokumen: 'Proposal Pengabmas.pdf · SK Pembimbing.pdf'
        },
        {
            id: 5,
            title: 'Pelatihan Metodologi Penelitian',
            program: 'Pengembangan SDM',
            bidang: 'Penelitian',
            start: '2025-05-10',
            end:   '2025-05-12',
            pj: 'Dr. Ahmad Fauzi',
            status: 'done',
            anggaran: 'Rp 12.000.000',
            indikator: 'Peningkatan kompetensi penelitian dosen muda',
            target: '25 dosen, sertifikat pelatihan, modul pelatihan',
            dokumen: 'Laporan Akhir Pelatihan.pdf · Daftar Hadir.xlsx'
        },
        {
            id: 6,
            title: 'Penyusunan Laporan Tahunan LP3M',
            program: 'Pengembangan SDM',
            bidang: 'Akademik',
            start: '2025-05-01',
            end:   '2025-05-31',
            pj: 'Budi Santoso, M.T',
            status: 'late',
            anggaran: 'Rp 3.500.000',
            indikator: 'Tersedianya laporan tahunan LP3M yang komprehensif dan tepat waktu',
            target: '1 dokumen laporan tahunan 2024/2025',
            dokumen: 'Draft Laporan v1.docx'
        },
        {
            id: 7,
            title: 'Seleksi Hibah Penelitian Internal',
            program: 'Hibah Internal',
            bidang: 'Penelitian',
            start: '2025-06-25',
            end:   '2025-06-27',
            pj: 'Siti Rahayu, M.Pd',
            status: 'upcoming',
            anggaran: 'Rp 5.000.000',
            indikator: 'Terseleksinya proposal penelitian terbaik untuk pendanaan internal',
            target: '10 proposal terseleksi, 5 didanai',
            dokumen: 'Panduan Hibah 2025.pdf · Form Penilaian.xlsx'
        },
        {
            id: 8,
            title: 'MOU dengan Universitas Mitra',
            program: 'Kemitraan',
            bidang: 'Kemahasiswaan',
            start: '2025-06-18',
            end:   '2025-06-18',
            pj: 'Rina Agustina, M.Kom',
            status: 'upcoming',
            anggaran: 'Rp 1.500.000',
            indikator: 'Terjalinnya kerjasama formal dengan universitas mitra',
            target: '2 MOU ditandatangani',
            dokumen: 'Draft MOU.docx'
        },
    ];

    // ── State ────────────────────────────────────────────────────
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

    // ── Filters ──────────────────────────────────────────────────
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
        document.getElementById('filter-tahun').value = '2025';
        applyFilters();
    }

    // ── Calendar Render ──────────────────────────────────────────
    function renderCalendar() {
        const year  = currentDate.getFullYear();
        const month = currentDate.getMonth();

        document.getElementById('cal-title').textContent =
            monthNames[month] + ' ' + year;

        const firstDay  = new Date(year, month, 1).getDay(); // 0=Sun
        const daysCount = new Date(year, month + 1, 0).getDate();
        const today     = new Date();

        const body = document.getElementById('cal-body');
        body.innerHTML = '';

        // empty leading cells
        for (let i = 0; i < firstDay; i++) {
            body.insertAdjacentHTML('beforeend',
                `<div class="cal-day border-b border-r border-slate-100/70 bg-slate-50/40 p-1 min-h-[100px]"></div>`);
        }

        for (let d = 1; d <= daysCount; d++) {
            const dateStr = `${year}-${String(month+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
            const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();

            const dayEvents = filteredEvents.filter(e => {
                return dateStr >= e.start && dateStr <= e.end;
            });

            let evHtml = '';
            dayEvents.slice(0, 2).forEach(ev => {
                const cfg = statusConfig[ev.status];
                evHtml += `<span class="event-pill ${cfg.cls} mb-0.5" onclick="openModal(${ev.id})" title="${ev.title}">${ev.title}</span>`;
            });
            if (dayEvents.length > 2) {
                evHtml += `<span class="text-[10px] text-slate-400 font-medium px-1">+${dayEvents.length - 2} lagi</span>`;
            }

            body.insertAdjacentHTML('beforeend', `
                <div class="cal-day ${isToday ? 'today-cell bg-blue-50/40' : ''} border-b border-r border-slate-100/70 p-1.5 overflow-hidden">
                    <div class="flex justify-end mb-1">
                        <span class="day-num text-xs font-semibold ${isToday ? 'text-white' : 'text-slate-500'} w-6 h-6 flex items-center justify-center">${d}</span>
                    </div>
                    <div class="space-y-0.5">${evHtml}</div>
                </div>`);
        }

        // fill trailing cells to complete 6 rows
        const totalCells = firstDay + daysCount;
        const remaining  = (Math.ceil(totalCells / 7) * 7) - totalCells;
        for (let i = 0; i < remaining; i++) {
            body.insertAdjacentHTML('beforeend',
                `<div class="cal-day border-b border-r border-slate-100/70 bg-slate-50/40 p-1 min-h-[100px]"></div>`);
        }
    }

    // ── Upcoming List ────────────────────────────────────────────
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

    // ── Stats ────────────────────────────────────────────────────
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

    // ── Modal ────────────────────────────────────────────────────
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

    // ── Month Nav ────────────────────────────────────────────────
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

    // Keyboard shortcut: Escape closes modal
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

    // ── Init ─────────────────────────────────────────────────────
    applyFilters();
    </script>

</x-app-layout>
