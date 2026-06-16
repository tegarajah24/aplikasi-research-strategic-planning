<div id="bidang-modal" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50" onclick="closeModal()"></div>
    <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">
        {{-- Modal header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <div>
                <h3 id="modal-title-text" class="text-base font-bold text-slate-800">Tambah Bidang</h3>
                <p class="text-xs text-slate-400 mt-0.5">Isi form berikut dengan lengkap</p>
            </div>
            <button onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                <x-icon name="x" class="w-5 h-5" />
            </button>
        </div>
        {{-- Modal body --}}
        <div class="px-6 py-5 space-y-4">
            <input type="hidden" id="edit-id">
            {{-- Kode Bidang --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kode Bidang <span class="text-red-400">*</span></label>
                <input id="f-kode" type="text" placeholder="Contoh: BD-01"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition">
            </div>
            {{-- Nama Bidang --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Bidang <span class="text-red-400">*</span></label>
                <input id="f-nama" type="text" placeholder="Contoh: Penelitian dan Pengabdian"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition">
            </div>
            {{-- Deskripsi --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Deskripsi</label>
                <textarea id="f-deskripsi" rows="3" placeholder="Deskripsi singkat tentang bidang ini..."
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition resize-none"></textarea>
            </div>
            {{-- Status --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Status</label>
                <select id="f-status"
                    class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            {{-- Error --}}
            <div id="form-error" class="hidden text-xs text-red-500 bg-red-50 border border-red-100 rounded-lg px-3 py-2"></div>
        </div>
        {{-- Modal footer --}}
        <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            <button onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">
                Batal
            </button>
            <button onclick="saveBidang()" class="px-5 py-2 rounded-xl text-sm font-semibold bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm shadow-blue-200">
                Simpan
            </button>
        </div>
    </div>
</div>
