<div class="px-6 py-3 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <div></div>
    <div class="flex items-center gap-3">
        @if(auth()->user()->canWrite('prestasi-non-akademik'))
        <button @click="$dispatch('open-create-modal')" class="inline-flex items-center justify-center px-4 bg-blue-600 border border-transparent rounded-lg py-3 text-xs font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah
        </button>
        @endif
        <a href="{{ route('prestasi-non-akademik.export') }}" class="inline-flex items-center justify-center px-4 bg-white border border-slate-200 rounded-lg py-3 text-xs font-semibold text-blue-600 hover:bg-blue-50 transition-colors shadow-sm whitespace-nowrap">
            <x-icon name="download" class="w-4 h-4 mr-1.5 text-blue-500" />
            Unduh Excel
        </a>
    </div>
</div>
