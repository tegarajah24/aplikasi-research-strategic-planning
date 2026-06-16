<!-- Create Modal -->
<div x-show="showCreateModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="showCreateModal" x-transition:enter="transition ease-out duration-250"
	x-transition:enter-start="opacity-0"
	x-transition:enter-end="opacity-100"
	x-transition:leave="transition ease-in duration-150"
	x-transition:leave-start="opacity-100"
	x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-slate-900/75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-show="showCreateModal" x-transition:enter="ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-250"
	x-transition:enter-start="opacity-0 scale-95 translate-y-3"
	x-transition:enter-end="opacity-100 scale-100 translate-y-0"
	x-transition:leave="transition ease-in duration-150"
	x-transition:leave-start="opacity-100 scale-100 translate-y-0"
	x-transition:leave-end="opacity-0 scale-95 translate-y-3" class="inline-block align-bottom bg-white rounded-2xl text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100">
            <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-t-2xl">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-semibold text-slate-900 mb-6 border-b pb-4">Upload Artikel Baru</h3>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Judul Artikel</label>
                                    <input type="text" name="judul" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Dosen</label>
                                        <select name="penulis" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">Pilih Dosen...</option>
                                            @foreach($dosens as $dosen)
                                                <option value="{{ $dosen->nama_dosen }}">{{ $dosen->nama_dosen }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Tahun</label>
                                        <select name="tahun" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">Pilih Tahun</option>
                                            @foreach(range(now()->year - 4, now()->year) as $y)
                                            <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Jurnal / Penerbit</label>
                                    <input type="text" name="penerbit" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">DOI (Opsional)</label>
                                    <input type="text" name="doi" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">File PDF (Opsional)</label>
                                    <input type="file" name="file_path" accept=".pdf" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    <p class="text-xs text-slate-500 mt-1">Maksimal 10MB.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100 rounded-b-2xl">
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
        <div x-show="showEditModal" x-transition:enter="transition ease-out duration-250"
	x-transition:enter-start="opacity-0"
	x-transition:enter-end="opacity-100"
	x-transition:leave="transition ease-in duration-150"
	x-transition:leave-start="opacity-100"
	x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-slate-900/75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-show="showEditModal" x-transition:enter="ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-250"
	x-transition:enter-start="opacity-0 scale-95 translate-y-3"
	x-transition:enter-end="opacity-100 scale-100 translate-y-0"
	x-transition:leave="transition ease-in duration-150"
	x-transition:leave-start="opacity-100 scale-100 translate-y-0"
	x-transition:leave-end="opacity-0 scale-95 translate-y-3" class="inline-block align-bottom bg-white rounded-2xl text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100">
            <form :action="'{{ route('artikel.index') }}/' + editData.id" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 rounded-t-2xl">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-semibold text-slate-900 mb-6 border-b pb-4">Edit Artikel</h3>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Judul Artikel</label>
                                    <input type="text" name="judul" x-model="editData.judul" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Dosen</label>
                                        <select name="penulis" x-model="editData.penulis" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">Pilih Dosen...</option>
                                            @foreach($dosens as $dosen)
                                                <option value="{{ $dosen->nama_dosen }}">{{ $dosen->nama_dosen }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Tahun</label>
                                        <select name="tahun" x-model="editData.tahun" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="">Pilih Tahun</option>
                                            @foreach(range(now()->year - 4, now()->year) as $y)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Jurnal / Penerbit</label>
                                    <input type="text" name="penerbit" x-model="editData.penerbit" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">DOI (Opsional)</label>
                                    <input type="text" name="doi" x-model="editData.doi" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">File PDF (Opsional)</label>
                                    <input type="file" name="file_path" accept=".pdf" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    <p class="text-xs text-slate-500 mt-1">Biarkan kosong jika tidak ingin mengubah file PDF. Maksimal 10MB.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100 rounded-b-2xl">
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
