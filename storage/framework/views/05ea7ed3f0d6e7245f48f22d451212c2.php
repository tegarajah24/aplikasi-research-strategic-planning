<div id="del-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeDelModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'warning','class' => 'w-5 h-5 text-red-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'warning','class' => 'w-5 h-5 text-red-500']); ?>
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
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-800">Hapus Program?</h4>
                <p id="del-name" class="text-xs text-slate-500 mt-0.5"></p>
            </div>
        </div>
        <p class="text-xs text-slate-500 mb-5">Tindakan ini tidak dapat dibatalkan. Seluruh kegiatan dalam program ini mungkin terpengaruh.</p>
        <div class="flex gap-2 justify-end">
            <button onclick="closeDelModal()" class="px-4 py-2 rounded-xl text-sm text-slate-600 hover:bg-slate-100 transition font-medium">Batal</button>
            <button onclick="confirmDelete()" class="px-5 py-2 rounded-xl text-sm font-semibold bg-red-500 text-white hover:bg-red-600 transition">Hapus</button>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views\master-data\program\modals\delete.blade.php ENDPATH**/ ?>