<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    {{-- Card 1: Total Kegiatan --}}
    <div class="glass-panel shadow-sm p-5 hover:shadow-md hover:border-blue-400 transition-all duration-200 group">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-800">{{ $totalKegiatan }}</p>
        <p class="text-xs text-slate-400 mt-1">Total Kegiatan</p>
        <p class="text-[11px] text-slate-400/80 mt-0.5">Seluruh program kerja</p>
    </div>

    {{-- Card 2: Target Tercapai --}}
    <div class="glass-panel shadow-sm p-5 hover:shadow-md hover:border-blue-400 transition-all duration-200 group">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-800">{{ $targetTercapai }}</p>
        <p class="text-xs text-slate-400 mt-1">Target Tercapai</p>
        <p class="text-[11px] text-slate-400/80 mt-0.5">Status selesai</p>
    </div>

    {{-- Card 3: Total Anggaran --}}
    <div class="glass-panel shadow-sm p-5 hover:shadow-md hover:border-blue-400 transition-all duration-200 group">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-800">{{ $totalAnggaran }}</p>
        <p class="text-xs text-slate-400 mt-1">Total Anggaran</p>
        <p class="text-[11px] text-slate-400/80 mt-0.5">Sumber anggaran aktif</p>
    </div>

    {{-- Card 4: Kegiatan Aktif --}}
    <div class="glass-panel shadow-sm p-5 hover:shadow-md hover:border-blue-400 transition-all duration-200 group">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center group-hover:bg-violet-100 transition-colors">
                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-800">{{ $kegiatanAktif }}</p>
        <p class="text-xs text-slate-400 mt-1">Kegiatan Aktif</p>
        <p class="text-[11px] text-slate-400/80 mt-0.5">Sedang berjalan</p>
    </div>

</div>
