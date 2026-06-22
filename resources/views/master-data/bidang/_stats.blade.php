<div class="rounded-2xl p-5 text-white shadow-lg shadow-blue-200/40" style="background: linear-gradient(135deg, #2563eb, #4f46e5);">
    <div class="flex items-start gap-4 flex-wrap">
        <div class="flex-1 min-w-0">
            <p class="text-xs font-semibold uppercase tracking-widest text-blue-200 mb-1">Hierarki Perencanaan</p>
            <div class="flex items-center gap-2 flex-wrap text-sm font-medium mt-2">
                <span class="bg-white/20 backdrop-blur rounded-lg px-3 py-1.5 flex items-center gap-1.5">
                    <x-icon name="tag" class="w-3.5 h-3.5 text-blue-200" />
                    Bidang
                </span>
                <x-icon name="chevron-right" class="w-4 h-4 text-blue-300" />
                <span class="bg-white/10 rounded-lg px-3 py-1.5 text-blue-100">RENSTRA</span>
                <x-icon name="chevron-right" class="w-4 h-4 text-blue-300" />
                <span class="bg-white/10 rounded-lg px-3 py-1.5 text-blue-100">Program</span>
                <x-icon name="chevron-right" class="w-4 h-4 text-blue-300" />
                <span class="bg-white/10 rounded-lg px-3 py-1.5 text-blue-100">Kegiatan</span>
            </div>
            <p class="text-blue-200/80 text-xs mt-3 leading-relaxed">Bidang adalah payung kategori tertinggi dalam perencanaan RENOP. Setiap bidang membawahi beberapa RENSTRA (sasaran strategis), yang kemudian memiliki program dan kegiatan operasional.</p>
        </div>
        <div class="flex gap-3 flex-wrap">
            <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-3 text-center min-w-[70px]">
                <p id="stat-bidang" class="text-2xl font-extrabold count-anim">—</p>
                <p class="text-[11px] text-blue-200 mt-0.5 font-medium">Bidang</p>
            </div>
            <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-3 text-center min-w-[70px]">
                <p id="stat-program" class="text-2xl font-extrabold count-anim">—</p>
                <p class="text-[11px] text-blue-200 mt-0.5 font-medium">Program</p>
            </div>
            <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-3 text-center min-w-[70px]">
                <p id="stat-kegiatan" class="text-2xl font-extrabold count-anim">—</p>
                <p class="text-[11px] text-blue-200 mt-0.5 font-medium">Kegiatan</p>
            </div>
        </div>
    </div>
</div>
