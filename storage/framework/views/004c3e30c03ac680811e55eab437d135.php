<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    
    <div class="flex items-center justify-between gap-3 px-5 py-4 border-b border-slate-100 flex-wrap">
        <div>
            <h2 class="text-sm font-bold text-slate-700">Daftar Bidang</h2>
            <p id="table-count" class="text-xs text-slate-400 mt-0.5"></p>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            
            <div class="search-wrap relative">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'search','class' => 'absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'search','class' => 'absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none']); ?>
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
                <input id="search-input" type="text" placeholder="Cari bidang..." oninput="filterTable()">
            </div>
            
            <select id="filter-status" onchange="filterTable()"
                class="border border-slate-200 rounded-xl px-3 py-[7px] text-xs text-slate-600 outline-none focus:border-blue-400 cursor-pointer">
                <option value="">Semua Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
        </div>
    </div>

    
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 text-left">
                    <th class="px-5 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider w-16">Kode</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Nama Bidang</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Program</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Kegiatan</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Anggaran</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Status</th>
                    <th class="px-3 py-3 text-[11px] font-semibold text-slate-400 uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="tbl-body">
                
            </tbody>
        </table>
        
        <div id="empty-state" class="hidden px-5 py-16 text-center">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'search','class' => 'w-12 h-12 mx-auto text-slate-200 mb-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'search','class' => 'w-12 h-12 mx-auto text-slate-200 mb-3']); ?>
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
            <p class="text-sm font-medium text-slate-400">Tidak ada bidang ditemukan</p>
            <p class="text-xs text-slate-300 mt-1">Coba ubah kata kunci pencarian</p>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views/master-data/bidang/_table.blade.php ENDPATH**/ ?>