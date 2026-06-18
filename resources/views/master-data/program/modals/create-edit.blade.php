<div id="prog-modal" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50" onclick="closeModal()"></div>
    <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <div>
                <h3 id="modal-title-text" class="text-base font-bold text-slate-800">Tambah Program</h3>
                <p class="text-xs text-slate-400 mt-0.5">Isi form berikut dengan lengkap</p>
            </div>
            <button onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                <x-icon name="x" class="w-5 h-5" />
            </button>
        </div>
        <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
            <input type="hidden" id="edit-id">

            {{-- Renstra --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">RENSTRA <span class="text-red-400">*</span></label>
                <select id="f-renstra"
                    class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">-- Pilih RENSTRA --</option>
                    @foreach($renstraList as $r)
                    <option value="{{ $r->id }}">
                        [{{ $r->kode }}] {{ $r->sasaran }} ({{ $r->tahun_mulai }}-{{ $r->tahun_selesai }})
                        {{ $r->fakultas ? '- ' . $r->fakultas->kode_fakultas : '' }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Bidang (select) --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Bidang <span class="text-red-400">*</span></label>
                <select id="f-bidang" onchange="autoKode()"
                    class="mt-1 block w-full border-slate-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">-- Pilih Bidang --</option>
                </select>
            </div>

            {{-- Kode (auto-generated tapi bisa diedit) --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kode Program <span class="text-red-400">*</span></label>
                <div class="flex items-center gap-2">
                    <input id="f-kode" type="text" placeholder="Otomatis — bisa diedit"
                        class="flex-1 border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
                    <span id="kode-preview" class="text-[11px] bg-violet-50 text-violet-600 border border-violet-100 rounded-lg px-2 py-1 font-mono whitespace-nowrap hidden"></span>
                </div>
                <p class="text-[11px] text-slate-400 mt-1">Format: {nomor bidang}.{urutan} — Contoh: 2.1, 2.2</p>
            </div>

            {{-- Nama Program --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Program <span class="text-red-400">*</span></label>
                <input id="f-nama" type="text" placeholder="Contoh: Peningkatan Kualitas Penelitian Dosen"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
            </div>

            {{-- Anggaran --}}
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Total Anggaran (Rp)</label>
                <input id="f-anggaran" type="number" min="0" placeholder="0"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
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

            <div id="form-error" class="hidden text-xs text-red-500 bg-red-50 border border-red-100 rounded-lg px-3 py-2"></div>
        </div>
        <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            <button onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">Batal</button>
            <button onclick="saveProgram()" class="px-5 py-2 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm" style="background:#7c3aed">Simpan</button>
        </div>
    </div>
</div>