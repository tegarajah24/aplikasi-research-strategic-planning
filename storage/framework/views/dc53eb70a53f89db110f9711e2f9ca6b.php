<div id="prog-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
            <div>
                <h3 id="modal-title-text" class="text-base font-bold text-slate-800">Tambah Program</h3>
                <p class="text-xs text-slate-400 mt-0.5">Isi form berikut dengan lengkap</p>
            </div>
            <button onclick="closeModal()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'x','class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x','class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
            </button>
        </div>
        <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
            <input type="hidden" id="edit-id">

            
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Bidang <span class="text-red-400">*</span></label>
                <select id="f-bidang" onchange="autoKode()"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition cursor-pointer"
                    style="--tw-ring-color:rgba(124,58,237,.12)">
                    <option value="">-- Pilih Bidang --</option>
                </select>
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kode Program <span class="text-red-400">*</span></label>
                <div class="flex items-center gap-2">
                    <input id="f-kode" type="text" placeholder="Otomatis — bisa diedit"
                        class="flex-1 border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
                    <span id="kode-preview" class="text-[11px] bg-violet-50 text-violet-600 border border-violet-100 rounded-lg px-2 py-1 font-mono whitespace-nowrap hidden"></span>
                </div>
                <p class="text-[11px] text-slate-400 mt-1">Format: {nomor bidang}.{urutan} — Contoh: 2.1, 2.2</p>
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Program <span class="text-red-400">*</span></label>
                <input id="f-nama" type="text" placeholder="Contoh: Peningkatan Kualitas Penelitian Dosen"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Sasaran Program</label>
                <textarea id="f-sasaran" rows="2" placeholder="Deskripsi sasaran yang ingin dicapai..."
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition resize-none"></textarea>
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Strategi RENSTRA</label>
                <input id="f-strategi" type="text" placeholder="Contoh: Meningkatkan kompetensi riset dosen"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Program Tahunan (RKT)</label>
                <input id="f-rkt" type="text" placeholder="Contoh: RKT 2026 — Prioritas Utama"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Total Anggaran (Rp)</label>
                <input id="f-anggaran" type="number" min="0" placeholder="0"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 focus:ring-2 transition">
            </div>

            
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Status</label>
                <select id="f-status"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:border-violet-400 transition cursor-pointer">
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>

            <div id="form-error" class="hidden text-xs text-red-500 bg-red-50 border border-red-100 rounded-lg px-3 py-2"></div>
        </div>
        <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            <button onclick="closeModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">Batal</button>
            <button onclick="saveProgram()" class="px-5 py-2 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm" style="background:#7c3aed">Simpan</button>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views/master-data/program/modals/create-edit.blade.php ENDPATH**/ ?>