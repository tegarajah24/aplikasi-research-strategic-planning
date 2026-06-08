<div class="rounded-2xl p-5 text-white shadow-lg shadow-blue-200/40" style="background: linear-gradient(135deg, #2563eb, #4f46e5);">
    <div class="flex items-start gap-4 flex-wrap">
        <div class="flex-1 min-w-0">
            <p class="text-xs font-semibold uppercase tracking-widest text-blue-200 mb-1">Hierarki Perencanaan</p>
            <div class="flex items-center gap-2 flex-wrap text-sm font-medium mt-2">
                <span class="bg-white/20 backdrop-blur rounded-lg px-3 py-1.5 flex items-center gap-1.5">
                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'tag','class' => 'w-3.5 h-3.5 text-blue-200']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'tag','class' => 'w-3.5 h-3.5 text-blue-200']); ?>
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
                    Bidang
                </span>
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-right','class' => 'w-4 h-4 text-blue-300']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-right','class' => 'w-4 h-4 text-blue-300']); ?>
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
                <span class="bg-white/10 rounded-lg px-3 py-1.5 text-blue-100">Program</span>
                <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'chevron-right','class' => 'w-4 h-4 text-blue-300']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-right','class' => 'w-4 h-4 text-blue-300']); ?>
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
                <span class="bg-white/10 rounded-lg px-3 py-1.5 text-blue-100">Kegiatan</span>
            </div>
            <p class="text-blue-200/80 text-xs mt-3 leading-relaxed">Bidang adalah master kategori paling atas. Setiap bidang memiliki beberapa program, dan setiap program memiliki kegiatan yang dapat dijadwalkan dalam RKT.</p>
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
            <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-3 text-center min-w-[70px]">
                <p id="stat-anggaran" class="text-lg font-extrabold count-anim">—</p>
                <p class="text-[11px] text-blue-200 mt-0.5 font-medium">Anggaran</p>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views\master-data\bidang\_stats.blade.php ENDPATH**/ ?>