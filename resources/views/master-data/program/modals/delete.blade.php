<div id="del-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeDelModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                <x-icon name="warning" class="w-5 h-5 text-red-500" />
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-800">Hapus Program?</h4>
                <p id="del-name" class="text-xs text-slate-500 mt-0.5"></p>
            </div>
        </div>
        <p class="text-xs text-slate-500 mb-5">Tindakan ini tidak dapat dibatalkan. Seluruh kegiatan dalam program ini mungkin terpengaruh.</p>
        <div class="flex gap-2 justify-end">
            <button onclick="closeDelModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">Batal</button>
            <button onclick="confirmDelete()" class="px-5 py-2 rounded-xl text-sm font-semibold bg-red-500 text-white hover:bg-red-600 transition">Hapus</button>
        </div>
    </div>
</div>
