<div id="ev-modal" class="modal-closed fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50" onclick="closeModal()"></div>
    <div class="modal-panel relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden">
        <div id="modal-header" class="px-6 py-5 flex items-start justify-between gap-4">
            <div class="flex-1 min-w-0">
                <p id="modal-status-badge" class="text-xs font-semibold mb-1.5 inline-block px-2.5 py-0.5 rounded-full"></p>
                <h3 id="modal-title" class="text-lg font-bold text-slate-800 leading-snug"></h3>
                <p id="modal-program" class="text-sm text-slate-500 mt-1"></p>
            </div>
            <button onclick="closeModal()" class="flex-shrink-0 p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="px-6 pb-6 space-y-4 border-t border-slate-100 pt-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-slate-50 rounded-xl p-3">
                    <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1">Waktu Pelaksanaan</p>
                    <p id="modal-tanggal" class="text-sm font-semibold text-slate-700"></p>
                </div>
                <div class="bg-slate-50 rounded-xl p-3">
                    <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1">Penanggung Jawab</p>
                    <p id="modal-pj" class="text-sm font-semibold text-slate-700"></p>
                </div>
                <div class="bg-slate-50 rounded-xl p-3 col-span-2">
                    <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1">Anggaran</p>
                    <p id="modal-anggaran" class="text-sm font-semibold text-slate-700"></p>
                </div>
            </div>

            <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1.5">Indikator Kinerja</p>
                <p id="modal-indikator" class="text-sm text-slate-600 leading-relaxed"></p>
            </div>

            <div class="bg-slate-50 rounded-xl p-3">
                <p class="text-[10px] text-slate-400 uppercase font-semibold tracking-wide mb-1.5">Target</p>
                <p id="modal-target" class="text-sm text-slate-600"></p>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"/>
                </svg>
                <p id="modal-dokumen" class="text-xs text-slate-400 italic"></p>
            </div>
        </div>
    </div>
</div>
