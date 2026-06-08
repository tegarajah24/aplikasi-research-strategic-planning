<div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-lg font-semibold text-slate-800">Prestasi Akademik</h2>
    </div>

    <div class="flex items-center gap-3">
        @if(auth()->user()->canWrite('prestasi-akademik'))
        <button @click="$dispatch('open-create-modal')" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-indigo-700 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah
        </button>
        @endif
        <a href="{{ route('prestasi-akademik.export') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-blue-600 hover:bg-blue-50 transition-colors shadow-sm">
            <x-icon name="download" class="w-4 h-4 mr-2 text-blue-500" />
            Unduh Excel
        </a>
    </div>
</div>
