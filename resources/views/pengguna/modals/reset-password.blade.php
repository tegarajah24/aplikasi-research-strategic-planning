<div id="view-modal" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50" onclick="closeViewModal()"></div>
    <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <div>
                <h3 class="text-base font-bold text-slate-800">Detail Pengguna</h3>
                <p class="text-xs text-slate-400 mt-0.5">Informasi lengkap akun pengguna</p>
            </div>
            <button type="button" onclick="closeViewModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                <x-icon name="x" class="w-5 h-5" />
            </button>
        </div>

        <div class="px-6 py-5 space-y-5">
            <div class="flex items-center gap-4">
                <img id="view-photo" src="" alt="" class="w-16 h-16 rounded-full border-2 border-white shadow-sm flex-shrink-0">
                <div>
                    <p id="view-name" class="text-base font-bold text-slate-800"></p>
                    <p id="view-username" class="text-xs text-slate-500 font-medium"></p>
                </div>
            </div>

            <div class="bg-slate-50 rounded-xl p-4 space-y-3.5">

                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">Role</span>
                    <span id="view-role" class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold"></span>
                </div>
                <div class="border-t border-slate-200/60"></div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">Status</span>
                    <span id="view-status" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold"></span>
                </div>
                <div class="border-t border-slate-200/60" id="view-prodi-divider"></div>
                <div class="flex items-center justify-between" id="view-prodi-row">
                    <span class="text-xs font-semibold text-slate-500">Program Studi</span>
                    <span id="view-prodi" class="text-sm font-medium text-slate-800 text-right max-w-[60%]"></span>
                </div>
                <div class="border-t border-slate-200/60"></div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">Terakhir Login</span>
                    <span id="view-last-login" class="text-sm font-medium text-slate-800"></span>
                </div>
                <div class="border-t border-slate-200/60"></div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">Tanggal Dibuat</span>
                    <span id="view-created" class="text-sm font-medium text-slate-800"></span>
                </div>
            </div>
        </div>

        <div class="flex justify-end px-6 py-4 border-t border-slate-100 bg-slate-50">
            <button type="button" onclick="closeViewModal()" class="px-5 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-200 transition">Tutup</button>
        </div>
    </div>
</div>
