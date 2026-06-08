<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th rowspan="2" class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider w-12 text-center align-middle border-r border-slate-200/60">No</th>
                <th rowspan="2" class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center align-middle border-r border-slate-200/60">Tahun</th>
                <th rowspan="2" class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center align-middle border-r border-slate-200/60">Mahasiswa</th>
                <th rowspan="2" class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center align-middle border-r border-slate-200/60">Prodi</th>
                <th rowspan="2" class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center align-middle border-r border-slate-200/60">Fakultas</th>
                <th colspan="3" class="py-2 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center border-b border-r border-slate-200/60">Tingkat</th>
                <th rowspan="2" class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center align-middle border-r border-slate-200/60">Total</th>
                <th rowspan="2" class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center align-middle">Aksi</th>
            </tr>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="py-2 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center border-r border-slate-200/60">Regional</th>
                <th class="py-2 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center border-r border-slate-200/60">Nasional</th>
                <th class="py-2 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center border-r border-slate-200/60">Internasional</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            @forelse($prestasis as $index => $prestasi)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="py-4 px-6 text-sm text-slate-500 text-center border-r border-slate-100">{{ $prestasis->firstItem() + $index }}</td>
                <td class="py-4 px-6 text-center font-medium text-slate-900 border-r border-slate-100">{{ $prestasi->tahun }}</td>
                <td class="py-4 px-6 text-center text-slate-700 border-r border-slate-100">{{ $prestasi->nama_mahasiswa ?? '-' }}</td>
                <td class="py-4 px-6 text-center text-slate-700 border-r border-slate-100">{{ $prestasi->prodi ?? '-' }}</td>
                <td class="py-4 px-6 text-center text-slate-700 border-r border-slate-100">{{ $prestasi->fakultas ?? '-' }}</td>
                <td class="py-4 px-6 text-center text-slate-700 border-r border-slate-100">{{ $prestasi->regional }}</td>
                <td class="py-4 px-6 text-center text-slate-700 border-r border-slate-100">{{ $prestasi->nasional }}</td>
                <td class="py-4 px-6 text-center text-slate-700 border-r border-slate-100">{{ $prestasi->internasional }}</td>
                <td class="py-4 px-6 text-center font-semibold text-slate-900 border-r border-slate-100">{{ $prestasi->regional + $prestasi->nasional + $prestasi->internasional }}</td>
                <td class="py-4 px-6 text-center">
                    @if(auth()->user()->canWrite('prestasi-non-akademik'))
                    <div class="flex justify-center gap-2">
                        <button @click="editData = {{ json_encode($prestasi) }}; showEditModal = true" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <form action="{{ route('prestasi-non-akademik.destroy', $prestasi) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus rekapitulasi prestasi tahun ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded transition-colors" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="py-12 px-6 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-slate-50 rounded-full p-3 mb-3">
                            <x-icon name="document" class="w-8 h-8 text-slate-400" />
                        </div>
                        <h3 class="text-sm font-medium text-slate-900">Belum ada data prestasi</h3>
                        <p class="mt-1 text-sm text-slate-500">Mulai dengan menambahkan data secara manual.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($prestasis->hasPages())
<div class="p-4 border-t border-slate-100">
    {{ $prestasis->links() }}
</div>
@endif
