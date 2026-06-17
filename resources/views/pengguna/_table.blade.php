<div class="lg:col-span-2 glass-panel shadow-sm overflow-hidden flex flex-col">
    <div class="flex items-center justify-between gap-3 px-5 py-3 border-b border-slate-100 flex-wrap bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div>
                <h2 class="text-sm font-bold text-slate-700">Daftar Pengguna Sistem</h2>
                <p class="text-xs text-slate-400 mt-0.5">Total {{ $users->total() }} pengguna</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <input type="text" id="search-input" placeholder="Cari nama/username..." class="rounded-xl py-3 text-xs w-44 border border-slate-200 bg-white placeholder-slate-400 focus:outline-none focus:border-blue-400 transition-colors">
            <select id="filter-role" class="simple-select rounded-xl py-3 text-xs border border-slate-200 bg-white text-slate-600 focus:outline-none focus:border-blue-400 cursor-pointer">
                <option value="">Semua Role</option>
                <option value="Admin">Admin</option>
                <option value="Dekan">Dekan</option>
                <option value="LPPM">LPPM</option>
                <option value="Kaprodi">Kaprodi</option>
            </select>
            <button onclick="openCreateModal()" class="inline-flex items-center justify-center px-4 bg-blue-600 border border-transparent rounded-lg py-3 text-xs font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengguna
            </button>
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
            <tbody id="table-body" class="text-sm">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50/70 border-b border-slate-100 transition-colors" data-search="{{ strtolower($user->name.' '.$user->username.' '.$user->role.' '.$user->status) }}" data-role="{{ $user->role }}">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm flex-shrink-0">
                            <div>
                                <p class="text-sm font-bold text-slate-800">{{ $user->name }}</p>
                                <p class="text-[11px] text-slate-500 font-medium">{{ $user->username }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex flex-col items-start gap-1.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold role-{{ strtolower($user->role) }}">{{ $user->role }}</span>
                            @if($user->role === 'Kaprodi' && $user->prodi)
                                <span class="text-[10px] text-slate-400">{{ $user->prodi->nama_prodi }}</span>
                            @endif
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
                                <x-icon name="pencil" class="w-4 h-4" />
                            </button>
                            <button onclick="openViewModal({{ $user->id }})" class="p-1.5 rounded-lg text-blue-500 hover:bg-blue-50 transition" title="Lihat Detail" data-user='@json($user)'>
                                <x-icon name="eye" class="w-4 h-4" />
                            </button>
                            <form action="{{ route('pengguna.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }} secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg text-red-400 hover:bg-red-50 transition" title="Hapus Akun">
                                    <x-icon name="trash" class="w-4 h-4" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="filter-empty-state-db">
                    <td colspan="4" class="py-12 text-center">
                        <p class="text-sm font-medium text-slate-500">Tidak ada pengguna ditemukan.</p>
                    </td>
                </tr>
                @endforelse
                <tr id="filter-empty-state" class="hidden">
                    <td colspan="4" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="bg-slate-50 rounded-full p-3 mb-3">
                                <x-icon name="user" class="w-8 h-8 text-slate-400" />
                            </div>
                            <h3 class="text-sm font-medium text-slate-900">Tidak ada pengguna ditemukan</h3>
                            <p class="mt-1 text-sm text-slate-500">Coba sesuaikan kata kunci pencarian.</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="p-4 border-t border-slate-100">
        {{ $users->links() }}
    </div>
    @endif
</div>
