<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider w-12 text-center">No</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul Artikel</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Penulis</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tahun</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jurnal / Penerbit</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($artikels as $index => $artikel)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="py-4 px-6 text-sm text-slate-500 text-center">{{ $artikels->firstItem() + $index }}</td>
                <td class="py-4 px-6">
                    <div class="text-sm font-medium text-slate-900 line-clamp-2">{{ $artikel->judul }}</div>
                    @if($artikel->doi)
                        <div class="text-xs text-indigo-600 mt-0.5">DOI: {{ $artikel->doi }}</div>
                    @endif
                </td>
                <td class="py-4 px-6">
                    <div class="text-sm text-slate-700">{{ $artikel->penulis }}</div>
                </td>
                <td class="py-4 px-6 text-sm text-slate-600">{{ $artikel->tahun }}</td>
                <td class="py-4 px-6 text-sm text-slate-600">{{ $artikel->penerbit }}</td>
                <td class="py-4 px-6 text-right">
                    <div class="flex justify-end gap-2">
                        @if($artikel->file_path)
                            <a href="{{ Storage::url($artikel->file_path) }}" target="_blank" class="p-1.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded transition-colors" title="Lihat PDF">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </a>
                        @endif
                        <button @click="editData = {{ json_encode($artikel) }}; showEditModal = true" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <form action="{{ route('artikel.destroy', $artikel) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
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
                <td colspan="6" class="py-12 px-6 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-slate-50 rounded-full p-3 mb-3">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-slate-900">Belum ada artikel</h3>
                        <p class="mt-1 text-sm text-slate-500">Mulai dengan mengupload atau import artikel baru.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($artikels->hasPages())
<div class="p-4 border-t border-slate-100">
    {{ $artikels->links() }}
</div>
@endif
