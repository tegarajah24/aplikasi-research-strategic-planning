<div x-show="showImportModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="showImportModal" x-transition:enter="transition ease-out duration-250"
	x-transition:enter-start="opacity-0"
	x-transition:enter-end="opacity-100"
	x-transition:leave="transition ease-in duration-150"
	x-transition:leave-start="opacity-100"
	x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-slate-900/75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-show="showImportModal" x-transition:enter="ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-250"
	x-transition:enter-start="opacity-0 scale-95 translate-y-3"
	x-transition:enter-end="opacity-100 scale-100 translate-y-0"
	x-transition:leave="transition ease-in duration-150"
	x-transition:leave-start="opacity-100 scale-100 translate-y-0"
	x-transition:leave-end="opacity-0 scale-95 translate-y-3" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-100">
            <form action="{{ route('buku.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-semibold text-slate-900 mb-4 border-b pb-4">Import Data Buku</h3>

                            <div class="space-y-4">
                                <div class="bg-blue-50 text-blue-700 p-3 rounded-lg text-sm mb-4">
                                    Format CSV harus memiliki urutan kolom: <br>
                                    <strong>Judul, Penulis, Penerbit, Tahun Terbit, ISBN</strong><br>
                                    *Baris pertama (header) akan diabaikan.
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Pilih File CSV/TXT</label>
                                    <input type="file" name="file_import" accept=".csv, .txt" required class="mt-2 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                    <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Proses Import
                    </button>
                    <button type="button" @click="showImportModal = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
