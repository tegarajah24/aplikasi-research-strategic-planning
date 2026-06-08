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
                                    <select name="tahun" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih Tahun</option>
                                        @foreach(range(now()->year - 4, now()->year) as $y)
                                        <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Nama Mahasiswa</label>
                                    <input type="text" name="nama_mahasiswa" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama Mahasiswa">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Prodi</label>
                                    <select name="prodi" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih Prodi</option>
                                        @foreach($prodiList as $p)
                                        <option value="{{ $p->nama_prodi }}">{{ $p->kode_prodi }} — {{ $p->nama_prodi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Fakultas</label>
                                    <select name="fakultas" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih Fakultas</option>
                                        @foreach($fakultasList as $f)
                                        <option value="{{ $f->nama_fakultas }}">{{ $f->kode_fakultas }} — {{ $f->nama_fakultas }}</option>
                                        @endforeach
                                    </select>
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
                                    <select name="tahun" x-model="editData.tahun" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih Tahun</option>
                                        @foreach(range(now()->year - 4, now()->year) as $y)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Nama Mahasiswa</label>
                                    <input type="text" name="nama_mahasiswa" x-model="editData.nama_mahasiswa" class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama Mahasiswa">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Prodi</label>
                                    <select name="prodi" x-model="editData.prodi" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih Prodi</option>
                                        @foreach($prodiList as $p)
                                        <option value="{{ $p->nama_prodi }}">{{ $p->kode_prodi }} — {{ $p->nama_prodi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Fakultas</label>
                                    <select name="fakultas" x-model="editData.fakultas" required class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Pilih Fakultas</option>
                                        @foreach($fakultasList as $f)
                                        <option value="{{ $f->nama_fakultas }}">{{ $f->kode_fakultas }} — {{ $f->nama_fakultas }}</option>
                                        @endforeach
                                    </select>
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
