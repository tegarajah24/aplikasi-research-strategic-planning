<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Manajemen Pengguna</h1>
                <p class="text-sm text-slate-400 mt-0.5">Kelola data user, hak akses (role), dan log aktivitas sistem</p>
            </div>
            <button onclick="openCreateModal()"
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
        #user-modal, #del-modal { transition:opacity .2s; }
        #user-modal.hidden, #del-modal.hidden { display:none; }
        .badge-aktif { background:#d1fae5; color:#059669; border:1px solid #a7f3d0; }
        .badge-nonaktif { background:#fee2e2; color:#dc2626; border:1px solid #fecaca; }
        .role-admin { background:#eff6ff; color:#2563eb; border:1px solid #bfdbfe; }
        .role-operator { background:#f5f3ff; color:#7c3aed; border:1px solid #ddd6fe; }
        .role-viewer { background:#fffbeb; color:#d97706; border:1px solid #fde68a; }
        .search-wrap input { border:1px solid #e2e8f0; border-radius:10px; padding:7px 12px 7px 36px; font-size:13px; outline:none; width:100%; transition:border-color .15s; }
        .search-wrap input:focus { border-color:#0ea5e9; box-shadow:0 0 0 3px rgba(14,165,233,.12); }
    </style>

    @if(session('success'))
    <div class="py-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="py-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl text-sm font-medium">
            {{ session('error') }}
        </div>
    </div>
    @endif

    <div class="py-6 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- LEFT: User Table --}}
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
                    <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap bg-slate-50/50">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Daftar Pengguna Sistem</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Total {{ $users->total() }} pengguna</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="search-wrap relative w-48">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803 7.5 7.5 0 0016.803 15.803z"/></svg>
                                <form method="GET" action="{{ route('pengguna') }}" id="search-form">
                                    <input name="search" type="text" placeholder="Cari nama/username..." value="{{ request('search') }}"
                                        oninput="document.getElementById('search-form').submit()">
                                </form>
                            </div>
                            <select name="role" form="search-form" onchange="document.getElementById('search-form').submit()" class="appearance-none border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 outline-none focus:border-sky-400 cursor-pointer">
                                <option value="">Semua Role</option>
                                <option value="Admin" {{ request('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Operator" {{ request('role') === 'Operator' ? 'selected' : '' }}>Operator</option>
                                <option value="Viewer" {{ request('role') === 'Viewer' ? 'selected' : '' }}>Viewer</option>
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
                            <tbody class="text-sm">
                                @forelse($users as $user)
                                <tr class="hover:bg-slate-50/70 border-b border-slate-100 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm flex-shrink-0">
                                            <div>
                                                <p class="text-sm font-bold text-slate-800">{{ $user->name }}</p>
                                                <p class="text-[11px] text-slate-500 font-medium">{{ $user->username }} · {{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-col items-start gap-1.5">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold role-{{ strtolower($user->role) }}">{{ $user->role }}</span>
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold {{ $user->status === 'Aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $user->status === 'Aktif' ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                                {{ $user->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <p class="text-xs text-slate-700 font-medium">
                                            {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Belum pernah login' }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button onclick="openEditModal({{ $user->id }})" class="p-1.5 rounded-lg text-sky-500 hover:bg-sky-50 transition" title="Edit Data" data-user='@json($user)'>
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                                            </button>
                                            <button onclick="openResetModal({{ $user->id }})" class="p-1.5 rounded-lg text-amber-500 hover:bg-amber-50 transition" title="Reset Password">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                                            </button>
                                            <form action="{{ route('pengguna.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }} secara permanen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 transition" title="Hapus Akun">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center">
                                        <p class="text-sm font-medium text-slate-500">Tidak ada pengguna ditemukan.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($users->hasPages())
                    <div class="p-4 border-t border-slate-100">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>

                {{-- RIGHT: Audit Log --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col h-[500px] lg:h-auto">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <div>
                            <h2 class="text-sm font-bold text-slate-700">Audit Log</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Aktivitas terbaru pengguna</p>
                        </div>
                    </div>
                    <div class="flex-1 p-5 overflow-y-auto" id="audit-log-container"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Create/Edit Modal ── --}}
    <div id="user-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden">
            <form id="user-form" method="POST">
                @csrf
                <div id="form-method-edit" style="display:none">
                    @method('PUT')
                </div>
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                    <div>
                        <h3 id="modal-title" class="text-base font-bold text-slate-800">Tambah Pengguna Baru</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Data otentikasi dan hak akses sistem</p>
                    </div>
                    <button type="button" onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                    <input type="hidden" id="edit-id" name="edit_id" value="">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input id="f-nama" name="name" type="text" placeholder="Masukkan nama lengkap" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username <span class="text-red-500">*</span></label>
                            <input id="f-username" name="username" type="text" placeholder="username" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                            <select id="f-role" name="role" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition cursor-pointer">
                                <option value="Admin">Admin</option>
                                <option value="Operator">Operator</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
                        <input id="f-email" name="email" type="email" placeholder="email@institusi.ac.id" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                    </div>
                    <div id="password-group">
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                        <input id="f-password" name="password" type="password" placeholder="Minimal 8 karakter" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                        <p class="text-[10px] text-slate-400 mt-1" id="pwd-hint">Kosongkan jika tidak ingin mengubah password (saat edit).</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Akun</label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="Aktif" checked class="w-4 h-4 text-sky-500 focus:ring-sky-500">
                                <span class="text-sm text-slate-600">Aktif</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="Nonaktif" class="w-4 h-4 text-red-500 focus:ring-red-500">
                                <span class="text-sm text-slate-600">Nonaktif</span>
                            </label>
                        </div>
                    </div>
                    <div id="form-error" class="hidden text-xs text-red-600 bg-red-50 border border-red-100 rounded-lg px-3 py-2"></div>
                </div>

                <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-sm font-bold text-white shadow-sm hover:opacity-90 transition" style="background:#0ea5e9">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Reset Password Modal --}}
    <div id="reset-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeResetModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
            <form id="reset-form" method="POST">
                @csrf
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
                    <button type="button" onclick="closeResetModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-sm font-bold bg-amber-500 text-white hover:bg-amber-600 transition">Reset Password</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    let usersFromDB = @json($users->items());
    let auditLogs = [
        { id: 1, user: '{{ auth()->user()->name }}', action: 'mengakses halaman manajemen pengguna', target: '-', time: 'Baru saja', color: 'bg-sky-500' },
    ];

    // ── Modal handlers ──
    function openCreateModal() {
        document.getElementById('modal-title').textContent = 'Tambah Pengguna Baru';
        document.getElementById('edit-id').value = '';
        document.getElementById('form-method-edit').style.display = 'none';
        document.getElementById('user-form').action = '{{ route("pengguna.store") }}';
        document.getElementById('f-nama').value = '';
        document.getElementById('f-username').value = '';
        document.getElementById('f-email').value = '';
        document.getElementById('f-role').value = 'Operator';
        document.getElementById('f-password').value = '';
        document.getElementById('f-password').required = true;
        document.getElementById('pwd-hint').style.display = 'none';
        document.querySelector('input[name="status"][value="Aktif"]').checked = true;
        document.getElementById('form-error').classList.add('hidden');
        document.getElementById('user-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function openEditModal(id) {
        const btn = document.querySelector(`button[data-user][onclick*="${id}"]`);
        const user = JSON.parse(btn.dataset.user);

        document.getElementById('modal-title').textContent = 'Edit Pengguna';
        document.getElementById('edit-id').value = user.id;
        document.getElementById('form-method-edit').style.display = '';
        document.getElementById('user-form').action = '/pengguna/' + user.id;
        document.getElementById('f-nama').value = user.name;
        document.getElementById('f-username').value = user.username;
        document.getElementById('f-email').value = user.email;
        document.getElementById('f-role').value = user.role;
        document.getElementById('f-password').value = '';
        document.getElementById('f-password').required = false;
        document.getElementById('pwd-hint').style.display = '';
        document.querySelector(`input[name="status"][value="${user.status}"]`).checked = true;
        document.getElementById('form-error').classList.add('hidden');
        document.getElementById('user-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('user-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // ── Reset Password ──
    function openResetModal(id) {
        const user = usersFromDB.find(u => u.id === id);
        if (!user) return;
        document.getElementById('reset-name').textContent = `Reset password untuk: ${user.name}`;
        document.getElementById('reset-form').action = `/pengguna/${user.id}/reset-password`;
        document.getElementById('reset-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeResetModal() {
        document.getElementById('reset-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // ── Audit Log (client-side, since we don't have audit log table) ──
    function renderAuditLog() {
        const container = document.getElementById('audit-log-container');
        if (!auditLogs.length) {
            container.innerHTML = `<div class="text-center py-10"><p class="text-sm text-slate-400">Belum ada aktivitas</p></div>`;
            return;
        }
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

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeModal(); closeResetModal(); }
    });

    renderAuditLog();
    </script>
</x-app-layout>
