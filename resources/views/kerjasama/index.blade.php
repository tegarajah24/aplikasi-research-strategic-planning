<x-app-layout>
    <x-slot name="header">
        <div x-data class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Kerja Sama (MoU)</h1>
                <p class="text-sm text-slate-400 mt-0.5">Halaman manajemen data Cooperations (MoU)</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="$dispatch('open-create-modal')" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-indigo-700 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Cooperation
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 min-h-full" x-data="{ 
        showCreateModal: false, 
        showEditModal: false, 
        showImportModal: false,
        editData: { id: '', nomor_surat: '', tanggal: '', mitra: '', jenis: '', tingkat: '', pic: '', program_studi: '' }
    }" @open-create-modal.window="showCreateModal = true" @open-import-modal.window="showImportModal = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-emerald-50 text-emerald-600 p-4 rounded-lg flex items-center border border-emerald-100">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-rose-50 text-rose-600 p-4 rounded-lg border border-rose-100">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                <!-- Header Card & Search -->
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Cooperations (MoU)</h2>
                        <p class="text-sm text-slate-500 mt-1">Total: {{ $kerjasamas->total() }}</p>
                    </div>
                    
                    <form method="GET" action="{{ route('kerjasama.index') }}" class="relative max-w-md w-full sm:w-auto">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors" placeholder="Search...">
                    </form>
                </div>

                <!-- Table -->
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
                        <tbody class="divide-y divide-slate-100">
                            @forelse($kerjasamas as $index => $kerjasama)
                            <tr class="hover:bg-slate-50/50 transition-colors">
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
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="py-12 px-6 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-slate-50 rounded-full p-3 mb-3">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-medium text-slate-900">No cooperations found</h3>
                                        <p class="mt-1 text-sm text-slate-500">Get started by adding a new cooperation.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($kerjasamas->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $kerjasamas->links() }}
                </div>
                @endif
            </div>
        </div>

        <!-- Create Modal -->
        <div x-show="showCreateModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showCreateModal" x-transition.opacity class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-slate-900/75 backdrop-blur-sm"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showCreateModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100">
                    <form action="{{ route('kerjasama.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-semibold text-slate-900 mb-6 border-b pb-4">Add New Cooperation (MoU)</h3>
                                    
                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Letter No.</label>
                                                <input type="text" name="nomor_surat" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Date</label>
                                                <input type="date" name="tanggal" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Partners</label>
                                            <input type="text" name="mitra" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Type</label>
                                                <select name="jenis" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Select Type...</option>
                                                    <option value="Research">Research</option>
                                                    <option value="Education">Education</option>
                                                    <option value="Community">Community</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Level</label>
                                                <select name="tingkat" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Select Level...</option>
                                                    <option value="National">National</option>
                                                    <option value="International">International</option>
                                                    <option value="Local">Local</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">PIC</label>
                                                <input type="text" name="pic" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Department</label>
                                                <select name="program_studi" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Select Department...</option>
                                                    <option value="Informatika (S1)">Informatika (S1)</option>
                                                    <option value="Sistem Informasi (S1)">Sistem Informasi (S1)</option>
                                                    <option value="Hukum (S1)">Hukum (S1)</option>
                                                    <option value="Manajemen (S1)">Manajemen (S1)</option>
                                                    <option value="Farmasi (S1)">Farmasi (S1)</option>
                                                    <option value="Keperawatan (S1)">Keperawatan (S1)</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">File PDF (Optional)</label>
                                            <input type="file" name="file_path" accept=".pdf" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            <p class="text-xs text-slate-500 mt-1">Maximum 10MB.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                            <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save
                            </button>
                            <button type="button" @click="showCreateModal = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showEditModal" x-transition.opacity class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-slate-900/75 backdrop-blur-sm"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showEditModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100">
                    <form :action="'{{ route('kerjasama.index') }}/' + editData.id" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-semibold text-slate-900 mb-6 border-b pb-4">Edit Cooperation (MoU)</h3>
                                    
                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Letter No.</label>
                                                <input type="text" name="nomor_surat" x-model="editData.nomor_surat" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Date</label>
                                                <input type="date" name="tanggal" x-model="editData.tanggal" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Partners</label>
                                            <input type="text" name="mitra" x-model="editData.mitra" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Type</label>
                                                <select name="jenis" x-model="editData.jenis" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Select Type...</option>
                                                    <option value="Research">Research</option>
                                                    <option value="Education">Education</option>
                                                    <option value="Community">Community</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Level</label>
                                                <select name="tingkat" x-model="editData.tingkat" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Select Level...</option>
                                                    <option value="National">National</option>
                                                    <option value="International">International</option>
                                                    <option value="Local">Local</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">PIC</label>
                                                <input type="text" name="pic" x-model="editData.pic" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700">Department</label>
                                                <select name="program_studi" x-model="editData.program_studi" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <option value="">Select Department...</option>
                                                    <option value="Informatika (S1)">Informatika (S1)</option>
                                                    <option value="Sistem Informasi (S1)">Sistem Informasi (S1)</option>
                                                    <option value="Hukum (S1)">Hukum (S1)</option>
                                                    <option value="Manajemen (S1)">Manajemen (S1)</option>
                                                    <option value="Farmasi (S1)">Farmasi (S1)</option>
                                                    <option value="Keperawatan (S1)">Keperawatan (S1)</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">File PDF (Optional)</label>
                                            <input type="file" name="file_path" accept=".pdf" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            <p class="text-xs text-slate-500 mt-1">Leave empty to keep the existing file. Maximum 10MB.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                            <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save Changes
                            </button>
                            <button type="button" @click="showEditModal = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
