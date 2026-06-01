<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Prestasi Akademik</h1>
                <p class="text-sm text-slate-400 mt-0.5">Rekapitulasi capaian prestasi akademik per tahun</p>
            </div>
        </div>
    </x-slot>

    <style>
        .dash-card {
            transition: transform .25s cubic-bezier(.4,0,.2,1), box-shadow .25s cubic-bezier(.4,0,.2,1);
        }
        .dash-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px -6px rgba(15,23,42,.10), 0 2px 6px -2px rgba(15,23,42,.06);
        }
    </style>

    <div class="py-8 min-h-full" x-data="{ 
        showCreateModal: false, 
        showEditModal: false, 
        showImportModal: false,
        editData: { id: '', tahun: '', regional: 0, nasional: 0, internasional: 0 }
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

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <!-- Regional Card (Red) -->
                <div class="dash-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="h-1 bg-rose-500"></div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-slate-800 tracking-tight">{{ $totalRegional }}</p>
                        <p class="text-xs text-slate-400 mt-1">Total Prestasi Regional</p>
                    </div>
                </div>

                <!-- Nasional Card (Green) -->
                <div class="dash-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="h-1 bg-emerald-500"></div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-slate-800 tracking-tight">{{ $totalNasional }}</p>
                        <p class="text-xs text-slate-400 mt-1">Total Prestasi Nasional</p>
                    </div>
                </div>

                <!-- Internasional Card (Teal/Blue) -->
                <div class="dash-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="h-1 bg-blue-500"></div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-slate-800 tracking-tight">{{ $totalInternasional }}</p>
                        <p class="text-xs text-slate-400 mt-1">Total Prestasi Internasional</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                <!-- Header Card -->
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-800">Prestasi Akademik</h2>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <button @click="$dispatch('open-create-modal')" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-indigo-700 transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah
                        </button>
                        <a href="{{ route('prestasi-akademik.export') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-blue-600 hover:bg-blue-50 transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Unduh Excel
                        </a>
                    </div>
                </div>

                <!-- Table -->
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
                                    <div class="flex justify-center gap-2">
                                        <button @click="editData = {{ json_encode($prestasi) }}; showEditModal = true" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <form action="{{ route('prestasi-akademik.destroy', $prestasi) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus rekapitulasi prestasi tahun ini?');">
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
                                <td colspan="10" class="py-12 px-6 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-slate-50 rounded-full p-3 mb-3">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                                            </svg>
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
                
                <!-- Pagination -->
                @if($prestasis->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $prestasis->links() }}
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
                <div x-show="showCreateModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-100">
                    <form action="{{ route('prestasi-akademik.store') }}" method="POST">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-semibold text-slate-900 mb-6 border-b pb-4">Tambah Data Prestasi per Tahun</h3>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Tahun</label>
                                            <input type="number" name="tahun" value="{{ date('Y') }}" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Nama Mahasiswa</label>
                                            <input type="text" name="nama_mahasiswa" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama Mahasiswa">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Prodi</label>
                                            <input type="text" name="prodi" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Program Studi">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Fakultas</label>
                                            <input type="text" name="fakultas" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Fakultas">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Jumlah Regional</label>
                                            <input type="number" name="regional" value="0" min="0" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Jumlah Nasional</label>
                                            <input type="number" name="nasional" value="0" min="0" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Jumlah Internasional</label>
                                            <input type="number" name="internasional" value="0" min="0" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                            <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Simpan
                            </button>
                            <button type="button" @click="showCreateModal = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
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
                <div x-show="showEditModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-100">
                    <form :action="'{{ route('prestasi-akademik.index') }}/' + editData.id" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-semibold text-slate-900 mb-6 border-b pb-4">Edit Data Prestasi</h3>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Tahun</label>
                                            <input type="number" name="tahun" x-model="editData.tahun" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Nama Mahasiswa</label>
                                            <input type="text" name="nama_mahasiswa" x-model="editData.nama_mahasiswa" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama Mahasiswa">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Prodi</label>
                                            <input type="text" name="prodi" x-model="editData.prodi" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Program Studi">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Fakultas</label>
                                            <input type="text" name="fakultas" x-model="editData.fakultas" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Fakultas">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Jumlah Regional</label>
                                            <input type="number" name="regional" x-model="editData.regional" min="0" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Jumlah Nasional</label>
                                            <input type="number" name="nasional" x-model="editData.nasional" min="0" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700">Jumlah Internasional</label>
                                            <input type="number" name="internasional" x-model="editData.internasional" min="0" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                            <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Simpan Perubahan
                            </button>
                            <button type="button" @click="showEditModal = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
