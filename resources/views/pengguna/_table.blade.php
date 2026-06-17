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
            <div x-data="filterSelect(() => filterTable())" @click.outside="open = false" class="filter-select-wrapper relative min-w-[160px]">
                <button @click="toggle" type="button"
                    class="flex items-center justify-between gap-2 w-full border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none cursor-pointer bg-white transition-colors duration-200"
                    :class="open ? 'border-blue-400' : 'hover:border-slate-300'">
                    <span x-text="selected ? (options.find(o => o.value === selected)?.label || selected) : placeholder" class="truncate"></span>
                    <svg class="w-3.5 h-3.5 text-slate-400 flex-shrink-0 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                    class="absolute z-50 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg py-1 max-h-48 overflow-y-auto">
                    <template x-for="(opt, i) in options" :key="i">
                        <button @click="select(opt.value)" type="button"
                            class="w-full text-left px-3 py-2 text-xs transition-colors duration-100"
                            :class="selected === opt.value ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-600 hover:bg-slate-50'"
                            x-text="opt.label">
                        </button>
                    </template>
                </div>
                <select id="filter-role" class="hidden">
                    <option value="">Semua Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Dekan">Dekan</option>
                    <option value="LPPM">LPPM</option>
                    <option value="Kaprodi">Kaprodi</option>
                </select>
            </div>
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
                            <form action="{{ route('pengguna.toggle-status', $user) }}" method="POST" class="inline" onsubmit="return confirm('{{ $user->status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan' }} pengguna {{ $user->name }}?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="p-1.5 rounded-lg {{ $user->status === 'Aktif' ? 'text-red-400 hover:bg-red-50' : 'text-emerald-500 hover:bg-emerald-50' }} transition" title="{{ $user->status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan' }} Akun">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        @if($user->status === 'Aktif')
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        @else
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                                        @endif
                                    </svg>
                                </button>
                            </form>
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
