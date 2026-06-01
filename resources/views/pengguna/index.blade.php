<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Manajemen Pengguna</h1>
                <p class="text-sm text-slate-400 mt-0.5">Kelola data user, hak akses (role), dan log aktivitas sistem</p>
            </div>
            <button onclick="openModal()"
                class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm"
                style="background:#0ea5e9">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.66-1.546"/>
                </svg>
                Tambah Pengguna
            </button>
        </div>
    </x-slot>

    <style>
        /* Modals */
        #user-modal, #del-modal, #reset-modal { transition:opacity .2s; }
        #user-modal.hidden, #del-modal.hidden, #reset-modal.hidden { display:none; }

        /* Status Badges */
        .badge-aktif { background:#d1fae5; color:#059669; border:1px solid #a7f3d0; }
        .badge-nonaktif { background:#fee2e2; color:#dc2626; border:1px solid #fecaca; }

        /* Role Badges */
        .role-admin { background:#eff6ff; color:#2563eb; border:1px solid #bfdbfe; }
        .role-operator { background:#f5f3ff; color:#7c3aed; border:1px solid #ddd6fe; }
        .role-viewer { background:#fffbeb; color:#d97706; border:1px solid #fde68a; }

        /* Search input */
        .search-wrap input {
            border:1px solid #e2e8f0; border-radius:10px;
            padding:7px 12px 7px 36px; font-size:13px;
            outline:none; width:100%; transition:border-color .15s;
        }
        .search-wrap input:focus { border-color:#0ea5e9; box-shadow:0 0 0 3px rgba(14,165,233,.12); }
    </style>

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- ── Role Information Cards ── --}}


            {{-- ── Main Layout (Table + Audit Log) ── --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- LEFT: User Table --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
                    <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap bg-slate-50/50">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Daftar Pengguna Sistem</h2>
                            <p id="user-count" class="text-xs text-slate-400 mt-0.5">Memuat...</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="search-wrap relative w-48">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z"/></svg>
                                <input id="search-input" type="text" placeholder="Cari nama/username..." oninput="renderTable()">
                            </div>
                            <select id="filter-role" onchange="renderTable()" class="appearance-none border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 outline-none focus:border-sky-400 cursor-pointer">
                                <option value="">Semua Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Operator">Operator</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white border-b border-slate-100">
                                    <th class="px-5 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Pengguna</th>
                                    <th class="px-4 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Role & Status</th>
                                    <th class="px-4 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Aktivitas Terakhir</th>
                                    <th class="px-4 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbl-body" class="text-sm">
                                {{-- JS Rendered --}}
                            </tbody>
                        </table>
                        <div id="empty-state" class="hidden py-12 text-center">
                            <p class="text-sm font-medium text-slate-500">Tidak ada pengguna ditemukan.</p>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Audit Log --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col h-[500px] lg:h-auto">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Audit Log</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Aktivitas terbaru pengguna</p>
                        </div>
                        <button class="text-[10px] font-semibold text-sky-600 hover:text-sky-700">Lihat Semua</button>
                    </div>
                    
                    <div class="flex-1 p-5 overflow-y-auto" id="audit-log-container">
                        {{-- JS Rendered --}}
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- ── Modals ── --}}

    {{-- Form Tambah/Edit User --}}
    <div id="user-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div>
                    <h3 id="modal-title" class="text-base font-bold text-slate-800">Tambah Pengguna Baru</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Data otentikasi dan hak akses sistem</p>
                </div>
                <button onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                <input type="hidden" id="edit-id">
                
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input id="f-nama" type="text" placeholder="Masukkan nama lengkap" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username <span class="text-red-500">*</span></label>
                        <input id="f-username" type="text" placeholder="username" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                        <select id="f-role" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition cursor-pointer">
                            <option value="Admin">Admin</option>
                            <option value="Operator">Operator</option>
                            <option value="Viewer">Viewer</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
                    <input id="f-email" type="email" placeholder="email@institusi.ac.id" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                </div>

                <div id="password-group">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                    <input id="f-password" type="password" placeholder="Minimal 8 karakter" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                    <p class="text-[10px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah password (saat edit).</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Akun</label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="f_status" value="Aktif" checked class="w-4 h-4 text-sky-500 focus:ring-sky-500">
                            <span class="text-sm text-slate-600">Aktif</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="f_status" value="Nonaktif" class="w-4 h-4 text-red-500 focus:ring-red-500">
                            <span class="text-sm text-slate-600">Nonaktif</span>
                        </label>
                    </div>
                </div>
                
                <div id="form-error" class="hidden text-xs text-red-600 bg-red-50 border border-red-100 rounded-lg px-3 py-2"></div>
            </div>
            
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50">
                <button onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-200 transition">Batal</button>
                <button onclick="saveUser()" class="px-5 py-2 rounded-xl text-sm font-bold text-white shadow-sm hover:opacity-90 transition" style="background:#0ea5e9">Simpan</button>
            </div>
        </div>
    </div>

    {{-- Reset Password Modal --}}
    <div id="reset-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeResetModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800">Reset Password</h4>
                    <p id="reset-name" class="text-xs text-slate-500 mt-0.5"></p>
                </div>
            </div>
            <p class="text-sm text-slate-600 mb-4 leading-relaxed">Password akan direset menjadi default: <strong class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-slate-800">uhb12345</strong></p>
            <div class="flex gap-2 justify-end">
                <button onclick="closeResetModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</button>
                <button onclick="confirmReset()" class="px-5 py-2 rounded-xl text-sm font-bold bg-amber-500 text-white hover:bg-amber-600 transition">Reset Password</button>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div id="del-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeDelModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800">Hapus Akun?</h4>
                    <p id="del-name" class="text-xs text-slate-500 mt-0.5"></p>
                </div>
            </div>
            <p class="text-sm text-slate-600 mb-6 leading-relaxed">Apakah Anda yakin ingin menghapus pengguna ini secara permanen?</p>
            <div class="flex gap-2 justify-end">
                <button onclick="closeDelModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</button>
                <button onclick="confirmDelete()" class="px-5 py-2 rounded-xl text-sm font-bold bg-red-500 text-white hover:bg-red-600 transition">Ya, Hapus</button>
            </div>
        </div>
    </div>

    <script>
    // ── Dummy Data ──────────────────────────────────────────────────
    let usersData = [
        { id: 1, nama: 'Admin LPPM', username: 'admin', email: 'admin@uhb.ac.id', role: 'Admin', status: 'Aktif', lastLogin: '25 Mei 2026, 08:30', avatar: 'https://ui-avatars.com/api/?name=Admin+LPPM&background=0284c7&color=fff&bold=true' },
        { id: 2, nama: 'Dr. Andi Saputra, M.Kom', username: 'andis', email: 'andi@uhb.ac.id', role: 'Operator', status: 'Aktif', lastLogin: '24 Mei 2026, 14:15', avatar: 'https://ui-avatars.com/api/?name=Andi+Saputra&background=7c3aed&color=fff&bold=true' },
        { id: 3, nama: 'Prof. Budi Santoso, Ph.D', username: 'budis', email: 'budi@uhb.ac.id', role: 'Viewer', status: 'Aktif', lastLogin: '10 Mei 2026, 09:00', avatar: 'https://ui-avatars.com/api/?name=Budi+Santoso&background=d97706&color=fff&bold=true' },
        { id: 4, nama: 'Siti Rahayu, M.Pd', username: 'siti_r', email: 'siti@uhb.ac.id', role: 'Operator', status: 'Nonaktif', lastLogin: 'Belum pernah login', avatar: 'https://ui-avatars.com/api/?name=Siti+Rahayu&background=94a3b8&color=fff&bold=true' }
    ];

    let auditLogs = [
        { id: 1, user: 'Admin LPPM', action: 'mereset password', target: 'Dr. Andi Saputra', time: '10 menit lalu', color: 'bg-amber-500' },
        { id: 2, user: 'Dr. Andi Saputra', action: 'mengedit kegiatan', target: 'Workshop Kurikulum 2026', time: '1 jam lalu', color: 'bg-emerald-500' },
        { id: 3, user: 'Admin LPPM', action: 'menambah user baru', target: 'Siti Rahayu, M.Pd', time: '1 hari lalu', color: 'bg-sky-500' },
        { id: 4, user: 'Prof. Budi Santoso', action: 'mengunduh laporan', target: 'Laporan RKT 2025', time: '3 hari lalu', color: 'bg-slate-500' },
        { id: 5, user: 'Admin LPPM', action: 'mengubah status', target: 'Prof. Budi Santoso menjadi Aktif', time: '5 hari lalu', color: 'bg-purple-500' }
    ];

    let targetId = null;

    // ── Table Rendering ──────────────────────────────────────────────
    function renderTable() {
        const query = document.getElementById('search-input').value.toLowerCase();
        const roleFilter = document.getElementById('filter-role').value;
        const tbody = document.getElementById('tbl-body');
        
        let filtered = usersData.filter(u => {
            const matchQuery = !query || u.nama.toLowerCase().includes(query) || u.username.toLowerCase().includes(query);
            const matchRole = !roleFilter || u.role === roleFilter;
            return matchQuery && matchRole;
        });
        
        document.getElementById('user-count').textContent = `Total ${filtered.length} pengguna`;
        
        if(filtered.length === 0) {
            tbody.innerHTML = '';
            document.getElementById('empty-state').classList.remove('hidden');
            return;
        }
        
        document.getElementById('empty-state').classList.add('hidden');
        
        tbody.innerHTML = filtered.map(u => {
            const badgeStatus = u.status === 'Aktif' ? 'badge-aktif' : 'badge-nonaktif';
            const badgeRole = u.role === 'Admin' ? 'role-admin' : (u.role === 'Operator' ? 'role-operator' : 'role-viewer');
            
            return `
            <tr class="hover:bg-slate-50/70 border-b border-slate-100 transition-colors">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <img src="${u.avatar}" alt="${u.nama}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm flex-shrink-0">
                        <div>
                            <p class="text-sm font-bold text-slate-800">${u.nama}</p>
                            <p class="text-[11px] text-slate-500 font-medium">@${u.username} · ${u.email}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-4">
                    <div class="flex flex-col items-start gap-1.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold ${badgeRole}">${u.role}</span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold ${badgeStatus}">
                            <span class="w-1.5 h-1.5 rounded-full ${u.status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-500'}"></span>
                            ${u.status}
                        </span>
                    </div>
                </td>
                <td class="px-4 py-4">
                    <p class="text-xs text-slate-700 font-medium">${u.lastLogin}</p>
                </td>
                <td class="px-4 py-4 text-center">
                    <div class="flex items-center justify-center gap-1.5">
                        <button onclick="editUser(${u.id})" class="p-1.5 rounded-lg text-sky-500 hover:bg-sky-50 transition" title="Edit Data">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                        </button>
                        <button onclick="resetPassword(${u.id})" class="p-1.5 rounded-lg text-amber-500 hover:bg-amber-50 transition" title="Reset Password">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                        </button>
                        <button onclick="deleteUser(${u.id})" class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 transition" title="Hapus Akun">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                        </button>
                    </div>
                </td>
            </tr>`;
        }).join('');
    }

    // ── Audit Log Rendering ──────────────────────────────────────────
    function renderAuditLog() {
        const container = document.getElementById('audit-log-container');
        container.innerHTML = auditLogs.map((log, index) => `
            <div class="flex gap-4 group">
                <div class="flex flex-col items-center pt-1.5">
                    <div class="w-2.5 h-2.5 rounded-full ${log.color} ring-4 ring-white shadow-sm flex-shrink-0 z-10"></div>
                    ${index !== auditLogs.length - 1 ? '<div class="w-px h-full bg-slate-100 mt-1"></div>' : ''}
                </div>
                <div class="pb-6">
                    <p class="text-xs text-slate-600 leading-relaxed">
                        <span class="font-bold text-slate-800">${log.user}</span> 
                        ${log.action} 
                        <span class="font-medium text-slate-700">${log.target}</span>
                    </p>
                    <p class="text-[10px] text-slate-400 mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        ${log.time}
                    </p>
                </div>
            </div>
        `).join('');
    }

    // ── Modals & Actions ─────────────────────────────────────────────
    function openModal(id = null) {
        document.getElementById('form-error').classList.add('hidden');
        document.getElementById('edit-id').value = id || '';
        
        const pwdGroup = document.getElementById('password-group');
        
        if (id) {
            const user = usersData.find(u => u.id === id);
            if (user) {
                document.getElementById('modal-title').textContent = 'Edit Pengguna';
                document.getElementById('f-nama').value = user.nama;
                document.getElementById('f-username').value = user.username;
                document.getElementById('f-email').value = user.email;
                document.getElementById('f-role').value = user.role;
                document.getElementById('f-password').value = ''; // Empty on edit
                
                document.querySelector(`input[name="f_status"][value="${user.status}"]`).checked = true;
            }
        } else {
            document.getElementById('modal-title').textContent = 'Tambah Pengguna Baru';
            document.getElementById('f-nama').value = '';
            document.getElementById('f-username').value = '';
            document.getElementById('f-email').value = '';
            document.getElementById('f-role').value = 'Operator';
            document.getElementById('f-password').value = '';
            document.querySelector(`input[name="f_status"][value="Aktif"]`).checked = true;
        }
        
        document.getElementById('user-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('user-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function saveUser() {
        const id = document.getElementById('edit-id').value;
        const nama = document.getElementById('f-nama').value.trim();
        const username = document.getElementById('f-username').value.trim();
        const email = document.getElementById('f-email').value.trim();
        const role = document.getElementById('f-role').value;
        const status = document.querySelector('input[name="f_status"]:checked').value;
        const password = document.getElementById('f-password').value;
        
        const errEl = document.getElementById('form-error');
        
        if (!nama || !username || !email) {
            errEl.textContent = 'Nama, Username, dan Email wajib diisi.';
            errEl.classList.remove('hidden');
            return;
        }
        
        if (!id && !password) {
            errEl.textContent = 'Password wajib diisi untuk pengguna baru.';
            errEl.classList.remove('hidden');
            return;
        }

        const colorMap = { 'Admin': '0284c7', 'Operator': '7c3aed', 'Viewer': 'd97706' };
        const color = colorMap[role] || '94a3b8';
        const avatar = `https://ui-avatars.com/api/?name=${encodeURIComponent(nama)}&background=${color}&color=fff&bold=true`;
        
        if (id) {
            const idx = usersData.findIndex(u => u.id === parseInt(id));
            if (idx !== -1) {
                usersData[idx] = { ...usersData[idx], nama, username, email, role, status, avatar };
            }
        } else {
            const newId = Math.max(0, ...usersData.map(u=>u.id)) + 1;
            usersData.push({ id: newId, nama, username, email, role, status, avatar, lastLogin: 'Belum pernah login' });
        }
        
        closeModal();
        renderTable();
    }

    function editUser(id) {
        openModal(id);
    }

    // Reset Password
    function resetPassword(id) {
        const user = usersData.find(u => u.id === id);
        if(!user) return;
        targetId = id;
        document.getElementById('reset-name').textContent = `Reset password untuk: ${user.nama}`;
        document.getElementById('reset-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeResetModal() {
        document.getElementById('reset-modal').classList.add('hidden');
        document.body.style.overflow = '';
        targetId = null;
    }
    function confirmReset() {
        if(targetId) {
            // Simulasi sukses
            alert('Password berhasil direset menjadi: uhb12345');
            
            // Tambah audit log
            const user = usersData.find(u => u.id === targetId);
            auditLogs.unshift({ id: Date.now(), user: 'Admin LPPM', action: 'mereset password', target: user.nama, time: 'Baru saja', color: 'bg-amber-500' });
            renderAuditLog();
            
            closeResetModal();
        }
    }

    // Delete
    function deleteUser(id) {
        const user = usersData.find(u => u.id === id);
        if(!user) return;
        targetId = id;
        document.getElementById('del-name').textContent = user.nama;
        document.getElementById('del-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeDelModal() {
        document.getElementById('del-modal').classList.add('hidden');
        document.body.style.overflow = '';
        targetId = null;
    }
    function confirmDelete() {
        if (targetId) {
            const user = usersData.find(u => u.id === targetId);
            usersData = usersData.filter(u => u.id !== targetId);
            
            // Tambah audit log
            auditLogs.unshift({ id: Date.now(), user: 'Admin LPPM', action: 'menghapus pengguna', target: user.nama, time: 'Baru saja', color: 'bg-red-500' });
            
            renderAuditLog();
            renderTable();
            closeDelModal();
        }
    }

    // Init
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeModal(); closeDelModal(); closeResetModal(); }
    });

    renderTable();
    renderAuditLog();
    </script>
</x-app-layout>
