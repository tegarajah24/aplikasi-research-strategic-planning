<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider w-12 text-center">#</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Letter No.</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Partners</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Type</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Level</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">PIC</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Department</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">File</th>
                <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>
        <tbody id="table-body" class="divide-y divide-slate-100">
            @forelse($kerjasamas as $index => $kerjasama)
            <tr class="hover:bg-slate-50/50 transition-colors" data-search="{{ strtolower($kerjasama->nomor_surat.' '.$kerjasama->mitra.' '.$kerjasama->pic.' '.$kerjasama->program_studi.' '.$kerjasama->jenis.' '.$kerjasama->tingkat) }}">
                <td class="py-4 px-6 text-sm text-slate-500 text-center">{{ $kerjasamas->firstItem() + $index }}</td>
                <td class="py-4 px-6">
                    <div class="text-sm font-medium text-slate-900">{{ $kerjasama->nomor_surat }}</div>
                </td>
                <td class="py-4 px-6 text-sm text-slate-600">{{ \Carbon\Carbon::parse($kerjasama->tanggal)->format('d-m-Y') }}</td>
                <td class="py-4 px-6 text-sm text-slate-700">{{ $kerjasama->mitra }}</td>
                <td class="py-4 px-6 text-sm text-slate-600">{{ $kerjasama->jenis }}</td>
                <td class="py-4 px-6 text-sm text-slate-600">{{ $kerjasama->tingkat }}</td>
                <td class="py-4 px-6 text-sm text-slate-600">{{ $kerjasama->pic }}</td>
                <td class="py-4 px-6 text-sm text-slate-600">{{ $kerjasama->program_studi }}</td>
                <td class="py-4 px-6">
                    @if($kerjasama->file_path)
                        <a href="{{ Storage::url($kerjasama->file_path) }}" target="_blank" class="inline-flex items-center px-2.5 py-1.5 border border-slate-200 text-xs font-medium rounded text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-sm">
                            View PDF
                        </a>
                    @else
                        <span class="text-xs text-slate-400 italic">No File</span>
                    @endif
                </td>
                <td class="py-4 px-6 text-right">
                    @if(auth()->user()->canWrite('kerjasama'))
                    <div class="flex justify-end gap-2">
                        <button @click="editData = {{ json_encode($kerjasama) }}; showEditModal = true" class="p-1.5 text-white bg-amber-500 hover:bg-amber-600 rounded transition-colors shadow-sm" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <form action="{{ route('kerjasama.destroy', $kerjasama) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this cooperation data?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-white bg-rose-600 hover:bg-rose-700 rounded transition-colors shadow-sm" title="Delete">
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
            <tr id="filter-empty-state-db" class="hidden">
                <td colspan="10" class="py-12 px-6 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-slate-50 rounded-full p-3 mb-3">
                            <x-icon name="document" class="w-8 h-8 text-slate-400" />
                        </div>
                        <h3 class="text-sm font-medium text-slate-900">No cooperations found</h3>
                        <p class="mt-1 text-sm text-slate-500">Get started by adding a new cooperation.</p>
                    </div>
                </td>
            </tr>
            @endforelse
            <tr id="filter-empty-state" class="hidden">
                <td colspan="10" class="py-12 px-6 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-slate-50 rounded-full p-3 mb-3">
                            <x-icon name="document" class="w-8 h-8 text-slate-400" />
                        </div>
                        <h3 class="text-sm font-medium text-slate-900">No matching cooperations</h3>
                        <p class="mt-1 text-sm text-slate-500">Try adjusting your search criteria.</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@if($kerjasamas->hasPages())
<div class="p-4 border-t border-slate-100">
    {{ $kerjasamas->links() }}
</div>
@endif
