<div id="user-modal" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden">
        <form id="user-form" method="POST">
            @csrf
            <div id="form-method-edit" style="display:none">
                <input type="hidden" name="_method" id="form-method-input" value="PUT" disabled>
            </div>
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <div>
                    <h3 id="modal-title" class="text-base font-bold text-slate-800">Tambah Pengguna Baru</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Data otentikasi dan hak akses sistem</p>
                </div>
                <button type="button" onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                    <x-icon name="x" class="w-5 h-5" />
                </button>
            </div>

            <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                <input type="hidden" id="edit-id" name="edit_id" value="">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input id="f-nama" name="name" type="text" placeholder="Masukkan nama lengkap" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username <span class="text-red-500">*</span></label>
                        <input id="f-username" name="username" type="text" placeholder="username" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                        <select id="f-role" name="role" onchange="toggleProdiField()" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition cursor-pointer">
                            <option value="Admin">Admin</option>
                            <option value="Dekan">Dekan</option>
                            <option value="LPPM">LPPM</option>
                            <option value="Kaprodi">Kaprodi</option>
                        </select>
                    </div>
                    <div id="prodi-field" class="hidden">
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Program Studi <span class="text-red-500">*</span></label>
                        <select id="f-prodi" name="prodi_id" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition cursor-pointer">
                            <option value="">Pilih Prodi</option>
                            @foreach($prodiList as $p)
                            <option value="{{ $p->id }}">{{ $p->kode_prodi }} — {{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
                    <input id="f-email" name="email" type="email" placeholder="email@institusi.ac.id" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                </div>
                <div id="password-group">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                    <input id="f-password" name="password" type="password" placeholder="Minimal 8 karakter" class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100 transition">
                    <p class="text-[10px] text-slate-400 mt-1" id="pwd-hint">Kosongkan jika tidak ingin mengubah password (saat edit).</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status Akun</label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="Aktif" checked class="w-4 h-4 text-sky-500 focus:ring-sky-500">
                            <span class="text-sm text-slate-600">Aktif</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="Nonaktif" class="w-4 h-4 text-red-500 focus:ring-red-500">
                            <span class="text-sm text-slate-600">Nonaktif</span>
                        </label>
                    </div>
                </div>
                <div id="form-error" class="hidden text-xs text-red-600 bg-red-50 border border-red-100 rounded-lg px-3 py-2"></div>
            </div>

            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50">
                <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl text-sm font-bold text-white shadow-sm hover:opacity-90 transition" style="background:#0ea5e9">Simpan</button>
            </div>
        </form>
    </div>
</div>
