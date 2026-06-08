<div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <button onclick="prevMonth()" class="p-2 rounded-xl hover:bg-slate-100 transition-colors text-slate-500 hover:text-slate-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
        </button>
        <h2 id="cal-title" class="text-base font-bold text-slate-800"></h2>
        <button onclick="nextMonth()" class="p-2 rounded-xl hover:bg-slate-100 transition-colors text-slate-500 hover:text-slate-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
            </svg>
        </button>
    </div>

    <div class="cal-grid border-b border-slate-100">
        @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $d)
        <div class="text-center text-[11px] font-semibold text-slate-400 py-2 uppercase tracking-wider
            {{ $d === 'Min' ? 'text-red-400' : '' }}">{{ $d }}</div>
        @endforeach
    </div>

    <div id="cal-body" class="cal-grid cal-body"></div>
</div>
