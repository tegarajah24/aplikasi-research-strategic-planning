<div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
    <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap bg-slate-50/50">
        <div>
            <h2 class="text-sm font-bold text-slate-700">Daftar Pengguna Sistem</h2>
            <p class="text-xs text-slate-400 mt-0.5">Total {{ $users->total() }} pengguna</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="search-wrap relative w-48">
                <x-icon name="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none" />
                <form method="GET" action="{{ route('pengguna') }}" id="search-form">
                    <input name="search" type="text" placeholder="Cari nama/username..." value="{{ request('search') }}"
                        oninput="document.getElementById('search-form').submit()">
                </form>
            </div>
                <select name="role" form="search-form" onchange="document.getElementById('search-form').submit()" class="appearance-none border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-600 outline-none focus:border-sky-400 cursor-pointer">
                    <option value="">Semua Role</option>
                    <option value="Admin" {{ request('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Dekan" {{ request('role') === 'Dekan' ? 'selected' : '' }}>Dekan</option>
                    <option value="LPPM" {{ request('role') === 'LPPM' ? 'selected' : '' }}>LPPM</option>
                    <option value="Kaprodi" {{ request('role') === 'Kaprodi' ? 'selected' : '' }}>Kaprodi</option>
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
