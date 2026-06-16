<div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-lg font-semibold text-slate-800">Daftar Artikel</h2>
        <p class="text-sm text-slate-500 mt-1">Kelola data artikel penelitian dan publikasi</p>
    </div>

    <div class="flex items-center gap-3 w-full sm:w-auto">
        <input id="search-input" type="text" placeholder="Cari artikel..."
            class="border border-slate-200 rounded-xl px-3 py-3 text-xs text-slate-600 outline-none focus:border-blue-400 w-44"
            oninput="filterTable()" value="{{ request('search') }}">
        
        @if(auth()->user()->canWrite('artikel'))
        <button @click="$dispatch('open-import-modal')" class="flex items-center gap-2 px-4 py-3 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors shadow-sm shrink-0 whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            Import
        </button>
        <button @click="$dispatch('open-create-modal')" class="flex items-center gap-2 px-4 py-3 rounded-lg text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 transition-colors shadow-sm shrink-0 whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Upload Artikel
        </button>
        @endif
    </div>
</div>
