<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider w-12 text-center align-middle border-r border-slate-200/60">#</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider align-middle border-r border-slate-200/60">Kode</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider align-middle border-r border-slate-200/60">Nama Program Studi</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider align-middle border-r border-slate-200/60">Fakultas</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center align-middle">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            @forelse($prodis as $index => $item)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="py-4 px-6 text-sm text-slate-500 text-center border-r border-slate-100">{{ $prodis->firstItem() + $index }}</td>
                <td class="py-4 px-6 text-sm font-medium text-slate-900 border-r border-slate-100">{{ $item->kode_prodi }}</td>
                <td class="py-4 px-6 text-sm text-slate-700 border-r border-slate-100">{{ $item->nama_prodi }}</td>
                <td class="py-4 px-6 text-sm text-slate-700 border-r border-slate-100">{{ $item->fakultas->nama_fakultas ?? '-' }}</td>
                <td class="py-4 px-6 text-center">
                    <div class="flex justify-center gap-2">
                        <button @click="editData = {{ json_encode($item) }}; showEditModal = true" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <form action="{{ route('prodi.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data Program Studi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded transition-colors" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-12 px-6 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-slate-50 rounded-full p-3 mb-3">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-slate-900">Belum ada data prodi</h3>
                        <p class="mt-1 text-sm text-slate-500">Mulai dengan menambahkan data secara manual.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($prodis->hasPages())
<div class="p-4 border-t border-slate-100">
    {{ $prodis->links() }}
</div>
@endif
