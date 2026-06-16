<div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-lg font-semibold text-slate-800">Daftar Artikel</h2>
        <p class="text-sm text-slate-500 mt-1">Kelola data artikel penelitian dan publikasi</p>
    </div>

    <div class="flex items-center gap-3 w-full sm:w-auto">
        <form method="GET" action="{{ route('artikel.index') }}" class="relative max-w-md w-full sm:w-auto">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-lg leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors" placeholder="Cari artikel...">
        </form>
        
        @if(auth()->user()->canWrite('artikel'))
        <button @click="$dispatch('open-import-modal')" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
            Import
        </button>
        <button @click="$dispatch('open-create-modal')" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-indigo-700 transition-colors shadow-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Upload Artikel
        </button>
        @endif
    </div>
</div>
