<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    {{-- Total Kegiatan --}}
    <div class="bg-gradient-to-br from-blue-50 to-blue-100/60 border border-blue-200/60 rounded-2xl p-5 relative overflow-hidden group hover:shadow-md hover:shadow-blue-100 transition-all duration-200">
        <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200/30 rounded-full -translate-y-6 translate-x-6 group-hover:scale-110 transition-transform duration-300"></div>
        <div class="relative">
            <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-blue-600/80 uppercase tracking-wider mb-1">Total Kegiatan</p>
            <p class="text-3xl font-bold text-blue-700">{{ $totalKegiatan }}</p>
            <p class="text-xs text-blue-500/70 mt-1">Seluruh program kerja</p>
        </div>
    </div>

    {{-- Target Tercapai --}}
    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/60 border border-emerald-200/60 rounded-2xl p-5 relative overflow-hidden group hover:shadow-md hover:shadow-emerald-100 transition-all duration-200">
        <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-200/30 rounded-full -translate-y-6 translate-x-6 group-hover:scale-110 transition-transform duration-300"></div>
        <div class="relative">
            <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-emerald-600/80 uppercase tracking-wider mb-1">Target Tercapai</p>
            <p class="text-3xl font-bold text-emerald-700">{{ $targetTercapai }}</p>
            <p class="text-xs text-emerald-500/70 mt-1">Status selesai</p>
        </div>
    </div>

    {{-- Total Anggaran --}}
    <div class="bg-gradient-to-br from-amber-50 to-amber-100/60 border border-amber-200/60 rounded-2xl p-5 relative overflow-hidden group hover:shadow-md hover:shadow-amber-100 transition-all duration-200">
        <div class="absolute top-0 right-0 w-20 h-20 bg-amber-200/30 rounded-full -translate-y-6 translate-x-6 group-hover:scale-110 transition-transform duration-300"></div>
        <div class="relative">
            <div class="w-10 h-10 bg-amber-500/10 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-amber-600/80 uppercase tracking-wider mb-1">Total Anggaran</p>
            <p class="text-3xl font-bold text-amber-700">{{ $totalKegiatan }}</p>
            <p class="text-xs text-amber-500/70 mt-1">Sumber anggaran aktif</p>
        </div>
    </div>

    {{-- Kegiatan Aktif --}}
    <div class="bg-gradient-to-br from-violet-50 to-violet-100/60 border border-violet-200/60 rounded-2xl p-5 relative overflow-hidden group hover:shadow-md hover:shadow-violet-100 transition-all duration-200">
        <div class="absolute top-0 right-0 w-20 h-20 bg-violet-200/30 rounded-full -translate-y-6 translate-x-6 group-hover:scale-110 transition-transform duration-300"></div>
        <div class="relative">
            <div class="w-10 h-10 bg-violet-500/10 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                </svg>
            </div>
            <p class="text-xs font-semibold text-violet-600/80 uppercase tracking-wider mb-1">Kegiatan Aktif</p>
            <p class="text-3xl font-bold text-violet-700">{{ $kegiatanAktif }}</p>
            <p class="text-xs text-violet-500/70 mt-1">Sedang berjalan</p>
        </div>
    </div>
</div>
