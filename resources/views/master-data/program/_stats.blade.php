<div class="rounded-2xl p-5 text-white shadow-lg" style="background:linear-gradient(135deg,#7c3aed,#4f46e5)">
    <div class="flex items-start gap-4 flex-wrap">
        <div class="flex-1 min-w-0">
            <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#c4b5fd">Hierarki Perencanaan</p>
            <div class="flex items-center gap-2 flex-wrap text-sm font-medium mt-2">
                <span class="rounded-lg px-3 py-1.5 text-sm" style="background:rgba(255,255,255,.12);color:#e0e7ff">Bidang</span>
                <x-icon name="chevron-right" class="w-4 h-4" style="color:#a5b4fc" />
                <span class="rounded-lg px-3 py-1.5 text-sm font-bold" style="background:rgba(255,255,255,.25);color:#fff">Program</span>
                <x-icon name="chevron-right" class="w-4 h-4" style="color:#a5b4fc" />
                <span class="rounded-lg px-3 py-1.5 text-sm" style="background:rgba(255,255,255,.12);color:#e0e7ff">Kegiatan</span>
            </div>
            <p class="text-xs mt-3 leading-relaxed" style="color:rgba(224,231,255,.75)">Program merupakan turunan langsung dari Bidang. Setiap program memiliki beberapa kegiatan yang dijadwalkan dalam RKT. Kode program di-generate otomatis berdasarkan urutan dalam bidang.</p>
        </div>
        <div class="flex gap-3 flex-wrap">
            <div class="rounded-xl px-4 py-3 text-center min-w-[70px]" style="background:rgba(255,255,255,.15)">
                <p id="stat-program" class="text-2xl font-extrabold count-anim">—</p>
                <p class="text-[11px] font-medium mt-0.5" style="color:#c4b5fd">Program</p>
            </div>
            <div class="rounded-xl px-4 py-3 text-center min-w-[70px]" style="background:rgba(255,255,255,.15)">
                <p id="stat-kegiatan" class="text-2xl font-extrabold count-anim">—</p>
                <p class="text-[11px] font-medium mt-0.5" style="color:#c4b5fd">Kegiatan</p>
            </div>
            <div class="rounded-xl px-4 py-3 text-center min-w-[70px]" style="background:rgba(255,255,255,.15)">
                <p id="stat-anggaran" class="text-lg font-extrabold count-anim">—</p>
                <p class="text-[11px] font-medium mt-0.5" style="color:#c4b5fd">Anggaran</p>
            </div>
            <div class="rounded-xl px-4 py-3 text-center min-w-[70px]" style="background:rgba(255,255,255,.15)">
                <p id="stat-progress" class="text-2xl font-extrabold count-anim">—</p>
                <p class="text-[11px] font-medium mt-0.5" style="color:#c4b5fd">Selesai</p>
            </div>
        </div>
    </div>
</div>
