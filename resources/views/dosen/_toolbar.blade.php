<div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <form action="{{ route('dosen.index') }}" method="GET" class="relative max-w-sm w-full">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dosen..."
               class="w-full px-3 py-3 border border-slate-200 rounded-xl text-xs text-slate-600 outline-none focus:border-blue-400 transition-colors">
    </form>

    @if(auth()->user()->canWrite('dosen'))
    <div class="flex items-center gap-3">
        <button @click="$dispatch('open-create-modal')" class="inline-flex items-center justify-center px-4 py-3 bg-indigo-600 border border-transparent rounded-lg text-xs font-semibold text-white hover:bg-indigo-700 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah
        </button>
    </div>
    @endif
</div>
