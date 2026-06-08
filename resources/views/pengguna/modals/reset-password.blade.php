<div id="reset-modal" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeResetModal()"></div>
    <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
        <form id="reset-form" method="POST">
            @csrf
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                    <x-icon name="key" class="w-6 h-6 text-amber-600" />
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800">Reset Password</h4>
                    <p id="reset-name" class="text-xs text-slate-500 mt-0.5"></p>
                </div>
            </div>
            <p class="text-sm text-slate-600 mb-4 leading-relaxed">Password akan direset menjadi default: <strong class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-slate-800">uhb12345</strong></p>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeResetModal()" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl text-sm font-bold bg-amber-500 text-white hover:bg-amber-600 transition">Reset Password</button>
            </div>
        </form>
    </div>
</div>
