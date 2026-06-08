<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div x-data class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Data Kegiatan Penelitian</h1>
                <p class="text-sm text-slate-400 mt-0.5">Manajemen program kerja penelitian &amp; pengabdian masyarakat berdasarkan Renstra</p>
            </div>
            <div class="flex items-center gap-2">
                <button @click="$dispatch('open-create-modal')"
                    id="btn-tambah-kegiatan"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 active:scale-95 transition-all shadow-sm shadow-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kegiatan
                </button>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8 min-h-full" x-data="{
        showCreateModal: false,
        showEditModal: false,
        showDetailModal: false,
        editData: {
            id: '', kode_kegiatan: '', nama_kegiatan: '', indikator_kinerja: '',
            target_kegiatan: '', penanggung_jawab: '', waktu_pelaksanaan: '',
            tahun_akademik: '', kebutuhan_anggaran: '', status: '', catatan: ''
        },
        detailData: {
            kode_kegiatan: '', nama_kegiatan: '', indikator_kinerja: '',
            target_kegiatan: '', penanggung_jawab: '', waktu_pelaksanaan: '',
            tahun_akademik: '', kebutuhan_anggaran: '', status: '', catatan: ''
        }
    }"
    @open-create-modal.window="showCreateModal = true">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div id="alert-success" class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl flex items-center gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-700 p-4 rounded-xl">
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

                
                <div class="bg-gradient-to-br from-blue-50 to-blue-100/60 border border-blue-200/60 rounded-2xl p-5 relative overflow-hidden group hover:shadow-md hover:shadow-blue-100 transition-all duration-200">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200/30 rounded-full -translate-y-6 translate-x-6 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-blue-600/80 uppercase tracking-wider mb-1">Total Kegiatan</p>
                        <p class="text-3xl font-bold text-blue-700"><?php echo e($totalKegiatan); ?></p>
                        <p class="text-xs text-blue-500/70 mt-1">Seluruh program kerja</p>
                    </div>
                </div>

                
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/60 border border-emerald-200/60 rounded-2xl p-5 relative overflow-hidden group hover:shadow-md hover:shadow-emerald-100 transition-all duration-200">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-200/30 rounded-full -translate-y-6 translate-x-6 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-emerald-600/80 uppercase tracking-wider mb-1">Target Tercapai</p>
                        <p class="text-3xl font-bold text-emerald-700"><?php echo e($targetTercapai); ?></p>
                        <p class="text-xs text-emerald-500/70 mt-1">Status selesai</p>
                    </div>
                </div>

                
                <div class="bg-gradient-to-br from-amber-50 to-amber-100/60 border border-amber-200/60 rounded-2xl p-5 relative overflow-hidden group hover:shadow-md hover:shadow-amber-100 transition-all duration-200">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-amber-200/30 rounded-full -translate-y-6 translate-x-6 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-amber-500/10 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-amber-600/80 uppercase tracking-wider mb-1">Total Anggaran</p>
                        <p class="text-3xl font-bold text-amber-700"><?php echo e($totalKegiatan); ?></p>
                        <p class="text-xs text-amber-500/70 mt-1">Sumber anggaran aktif</p>
                    </div>
                </div>

                
                <div class="bg-gradient-to-br from-violet-50 to-violet-100/60 border border-violet-200/60 rounded-2xl p-5 relative overflow-hidden group hover:shadow-md hover:shadow-violet-100 transition-all duration-200">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-violet-200/30 rounded-full -translate-y-6 translate-x-6 group-hover:scale-110 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-violet-500/10 rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-violet-600/80 uppercase tracking-wider mb-1">Kegiatan Aktif</p>
                        <p class="text-3xl font-bold text-violet-700"><?php echo e($kegiatanAktif); ?></p>
                        <p class="text-xs text-violet-500/70 mt-1">Sedang berjalan</p>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">

                
                <div class="p-5 border-b border-slate-100">
                    <form method="GET" action="<?php echo e(route('kegiatan.index')); ?>" id="filter-form">
                        <div class="flex flex-col lg:flex-row gap-3">

                            
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 20 20" fill-rule="evenodd">
                                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" fill="currentColor"/>
                                    </svg>
                                </div>
                                <input type="text" id="input-search" name="search" value="<?php echo e(request('search')); ?>"
                                    class="block w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors"
                                    placeholder="Cari kode, nama kegiatan, penanggung jawab...">
                            </div>

                            
                            <div class="w-full lg:w-48">
                                <select id="filter-tahun" name="tahun_akademik"
                                    class="block w-full border border-slate-200 rounded-xl py-2.5 px-3 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    onchange="document.getElementById('filter-form').submit()">
                                    <option value="">Semua Tahun Akademik</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tahunAkademikOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tahun); ?>" <?php echo e(request('tahun_akademik') === $tahun ? 'selected' : ''); ?>>
                                            <?php echo e($tahun); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>

                            
                            <div class="w-full lg:w-44">
                                <select id="filter-pj" name="penanggung_jawab"
                                    class="block w-full border border-slate-200 rounded-xl py-2.5 px-3 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    onchange="document.getElementById('filter-form').submit()">
                                    <option value="">Semua Penanggung Jawab</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $penanggungJawabOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($pj); ?>" <?php echo e(request('penanggung_jawab') === $pj ? 'selected' : ''); ?>>
                                            <?php echo e($pj); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>

                            
                            <div class="w-full lg:w-40">
                                <select id="filter-status" name="status"
                                    class="block w-full border border-slate-200 rounded-xl py-2.5 px-3 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    onchange="document.getElementById('filter-form').submit()">
                                    <option value="">Semua Status</option>
                                    <option value="perencanaan" <?php echo e(request('status') === 'perencanaan' ? 'selected' : ''); ?>>Perencanaan</option>
                                    <option value="berjalan"    <?php echo e(request('status') === 'berjalan'    ? 'selected' : ''); ?>>Berjalan</option>
                                    <option value="selesai"     <?php echo e(request('status') === 'selesai'     ? 'selected' : ''); ?>>Selesai</option>
                                    <option value="tertunda"    <?php echo e(request('status') === 'tertunda'    ? 'selected' : ''); ?>>Tertunda</option>
                                </select>
                            </div>

                            
                            <button type="submit" id="btn-search"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-800 text-white rounded-xl text-sm font-medium hover:bg-slate-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                </svg>
                                Cari
                            </button>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->hasAny(['search', 'tahun_akademik', 'penanggung_jawab', 'status'])): ?>
                                <a href="<?php echo e(route('kegiatan.index')); ?>" id="btn-reset-filter"
                                    class="inline-flex items-center justify-center gap-1 px-3 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reset
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->hasAny(['search', 'tahun_akademik', 'penanggung_jawab', 'status'])): ?>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search')): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full border border-blue-100">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd"/></svg>
                                        "<?php echo e(request('search')); ?>"
                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('tahun_akademik')): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-full border border-slate-200">
                                        Tahun: <?php echo e(request('tahun_akademik')); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('penanggung_jawab')): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-full border border-slate-200">
                                        PJ: <?php echo e(request('penanggung_jawab')); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('status')): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-full border border-slate-200">
                                        Status: <?php echo e(ucfirst(request('status'))); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="text-xs text-slate-400 self-center"><?php echo e($kegiatans->total()); ?> data ditemukan</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </form>
                </div>

                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[900px]">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100">
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-center w-10">No</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-24">Kode</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider min-w-[200px]">Nama Kegiatan</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider min-w-[180px]">Indikator Kinerja</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-24">Target</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Penanggung Jawab</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider min-w-[160px]">Waktu Pelaksanaan</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider min-w-[140px]">Kebutuhan Anggaran</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider w-28">Status</th>
                                <th class="py-3.5 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-slate-50/50 transition-colors duration-100 group">
                                
                                <td class="py-4 px-4 text-sm text-slate-500 text-center font-medium">
                                    <?php echo e($kegiatans->firstItem() + $index); ?>

                                </td>

                                
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold border border-blue-100 font-mono">
                                        <?php echo e($kegiatan->kode_kegiatan); ?>

                                    </span>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <div class="text-sm font-semibold text-slate-800 leading-snug line-clamp-2 max-w-[220px]">
                                        <?php echo e($kegiatan->nama_kegiatan); ?>

                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatan->tahun_akademik): ?>
                                        <div class="text-xs text-slate-400 mt-1">TA: <?php echo e($kegiatan->tahun_akademik); ?></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <div class="text-sm text-slate-600 line-clamp-2 max-w-[200px]">
                                        <?php echo e($kegiatan->indikator_kinerja); ?>

                                    </div>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <span class="text-sm font-semibold text-slate-700"><?php echo e($kegiatan->target_kegiatan); ?></span>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-[10px] font-bold text-white flex-shrink-0">
                                            <?php echo e(strtoupper(substr($kegiatan->penanggung_jawab, 0, 2))); ?>

                                        </div>
                                        <span class="text-sm text-slate-700 font-medium"><?php echo e($kegiatan->penanggung_jawab); ?></span>
                                    </div>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <div class="flex items-start gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                        </svg>
                                        <span class="text-sm text-slate-600 leading-snug"><?php echo e($kegiatan->waktu_pelaksanaan); ?></span>
                                    </div>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75"/>
                                        </svg>
                                        <span class="text-sm text-slate-600"><?php echo e($kegiatan->kebutuhan_anggaran); ?></span>
                                    </div>
                                </td>

                                
                                <td class="py-4 px-4">
                                    <?php
                                        $statusConfig = match($kegiatan->status) {
                                            'perencanaan' => ['label' => 'Perencanaan', 'classes' => 'bg-blue-50 text-blue-700 border-blue-200', 'dot' => 'bg-blue-400'],
                                            'berjalan'    => ['label' => 'Berjalan',    'classes' => 'bg-amber-50 text-amber-700 border-amber-200', 'dot' => 'bg-amber-400'],
                                            'selesai'     => ['label' => 'Selesai',     'classes' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' => 'bg-emerald-400'],
                                            'tertunda'    => ['label' => 'Tertunda',    'classes' => 'bg-rose-50 text-rose-700 border-rose-200', 'dot' => 'bg-rose-400'],
                                            default       => ['label' => '-',           'classes' => 'bg-slate-50 text-slate-600 border-slate-200', 'dot' => 'bg-slate-400'],
                                        };
                                    ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border <?php echo e($statusConfig['classes']); ?>">
                                        <span class="w-1.5 h-1.5 rounded-full <?php echo e($statusConfig['dot']); ?> <?php echo e($kegiatan->status === 'berjalan' ? 'animate-pulse' : ''); ?>"></span>
                                        <?php echo e($statusConfig['label']); ?>

                                    </span>
                                </td>

                                
                                <td class="py-4 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1 opacity-70 group-hover:opacity-100 transition-opacity">
                                        
                                        <button type="button" id="btn-detail-<?php echo e($kegiatan->id); ?>"
                                            @click="detailData = <?php echo e(json_encode($kegiatan->toArray())); ?>; showDetailModal = true"
                                            class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                            title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </button>

                                        
                                        <button type="button" id="btn-edit-<?php echo e($kegiatan->id); ?>"
                                            @click="editData = <?php echo e(json_encode($kegiatan->toArray())); ?>; showEditModal = true"
                                            class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>

                                        
                                        <form action="<?php echo e(route('kegiatan.destroy', $kegiatan)); ?>" method="POST" class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?\n\n<?php echo e(addslashes($kegiatan->nama_kegiatan)); ?>')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" id="btn-hapus-<?php echo e($kegiatan->id); ?>"
                                                class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                                title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="10" class="py-16 px-6 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-semibold text-slate-800 mb-1">Tidak ada kegiatan ditemukan</h3>
                                        <p class="text-sm text-slate-500 mb-4">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->hasAny(['search', 'tahun_akademik', 'penanggung_jawab', 'status'])): ?>
                                                Coba ubah filter pencarian Anda.
                                            <?php else: ?>
                                                Mulai dengan menambahkan data kegiatan baru.
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </p>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!request()->hasAny(['search', 'tahun_akademik', 'penanggung_jawab', 'status'])): ?>
                                            <button @click="showCreateModal = true"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Tambah Kegiatan Pertama
                                            </button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($kegiatans->hasPages()): ?>
                    <div class="p-4 border-t border-slate-100 flex items-center justify-between gap-4">
                        <p class="text-xs text-slate-500">
                            Menampilkan <span class="font-semibold text-slate-700"><?php echo e($kegiatans->firstItem()); ?></span>–<span class="font-semibold text-slate-700"><?php echo e($kegiatans->lastItem()); ?></span>
                            dari <span class="font-semibold text-slate-700"><?php echo e($kegiatans->total()); ?></span> kegiatan
                        </p>
                        <?php echo e($kegiatans->links()); ?>

                    </div>
                <?php else: ?>
                    <div class="p-4 border-t border-slate-100">
                        <p class="text-xs text-slate-500">
                            Menampilkan <?php echo e($kegiatans->count()); ?> kegiatan
                        </p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        
        
        <div x-show="showCreateModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showCreateModal = false"></div>
                <div x-show="showCreateModal"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl border border-slate-100 z-10">
                    <form action="<?php echo e(route('kegiatan.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-slate-900">Tambah Kegiatan Baru</h3>
                                    <p class="text-xs text-slate-500">Isi formulir di bawah dengan lengkap</p>
                                </div>
                            </div>
                            <button type="button" @click="showCreateModal = false"
                                class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        
                        <div class="px-6 py-5 space-y-4 max-h-[65vh] overflow-y-auto">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kode Kegiatan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="kode_kegiatan" id="create-kode" placeholder="Cth: 2.1.1" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Akademik</label>
                                    <input type="text" name="tahun_akademik" id="create-tahun" placeholder="Cth: 2023/2024"
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Kegiatan <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama_kegiatan" id="create-nama" placeholder="Nama program kegiatan" required
                                    class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Indikator Kinerja Kegiatan <span class="text-rose-500">*</span></label>
                                <textarea name="indikator_kinerja" id="create-indikator" rows="2" placeholder="Deskripsi indikator pencapaian kegiatan" required
                                    class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Target Kegiatan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="target_kegiatan" id="create-target" placeholder="Cth: 30%" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Penanggung Jawab <span class="text-rose-500">*</span></label>
                                    <input type="text" name="penanggung_jawab" id="create-pj" placeholder="Cth: LPPM" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Waktu Pelaksanaan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="waktu_pelaksanaan" id="create-waktu" placeholder="Cth: September 2023 - Juni 2024" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status <span class="text-rose-500">*</span></label>
                                    <select name="status" id="create-status" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        <option value="perencanaan">Perencanaan</option>
                                        <option value="berjalan">Berjalan</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="tertunda">Tertunda</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kebutuhan Anggaran <span class="text-rose-500">*</span></label>
                                <input type="text" name="kebutuhan_anggaran" id="create-anggaran" placeholder="Cth: Anggaran LPPM" required
                                    class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan (Opsional)</label>
                                <textarea name="catatan" id="create-catatan" rows="2" placeholder="Catatan tambahan jika ada"
                                    class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                            </div>
                        </div>

                        
                        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50/50 rounded-b-2xl">
                            <button type="button" @click="showCreateModal = false"
                                class="px-4 py-2 border border-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-100 transition-colors">
                                Batal
                            </button>
                            <button type="submit" id="btn-simpan-kegiatan"
                                class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm">
                                Simpan Kegiatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        
        
        <div x-show="showEditModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showEditModal = false"></div>
                <div x-show="showEditModal"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl border border-slate-100 z-10">
                    <form :action="'<?php echo e(url('rkt/kegiatan')); ?>/' + editData.id" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-slate-900">Edit Kegiatan</h3>
                                    <p class="text-xs text-slate-500">Perbarui data kegiatan penelitian</p>
                                </div>
                            </div>
                            <button type="button" @click="showEditModal = false"
                                class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        
                        <div class="px-6 py-5 space-y-4 max-h-[65vh] overflow-y-auto">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kode Kegiatan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="kode_kegiatan" x-model="editData.kode_kegiatan" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tahun Akademik</label>
                                    <input type="text" name="tahun_akademik" x-model="editData.tahun_akademik"
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Kegiatan <span class="text-rose-500">*</span></label>
                                <input type="text" name="nama_kegiatan" x-model="editData.nama_kegiatan" required
                                    class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Indikator Kinerja Kegiatan <span class="text-rose-500">*</span></label>
                                <textarea name="indikator_kinerja" x-model="editData.indikator_kinerja" rows="2" required
                                    class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"></textarea>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Target Kegiatan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="target_kegiatan" x-model="editData.target_kegiatan" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Penanggung Jawab <span class="text-rose-500">*</span></label>
                                    <input type="text" name="penanggung_jawab" x-model="editData.penanggung_jawab" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Waktu Pelaksanaan <span class="text-rose-500">*</span></label>
                                    <input type="text" name="waktu_pelaksanaan" x-model="editData.waktu_pelaksanaan" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status <span class="text-rose-500">*</span></label>
                                    <select name="status" x-model="editData.status" required
                                        class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                        <option value="perencanaan">Perencanaan</option>
                                        <option value="berjalan">Berjalan</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="tertunda">Tertunda</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kebutuhan Anggaran <span class="text-rose-500">*</span></label>
                                <input type="text" name="kebutuhan_anggaran" x-model="editData.kebutuhan_anggaran" required
                                    class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan (Opsional)</label>
                                <textarea name="catatan" x-model="editData.catatan" rows="2"
                                    class="block w-full border border-slate-200 rounded-xl px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"></textarea>
                            </div>
                        </div>

                        
                        <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50/50 rounded-b-2xl">
                            <button type="button" @click="showEditModal = false"
                                class="px-4 py-2 border border-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-100 transition-colors">
                                Batal
                            </button>
                            <button type="submit" id="btn-simpan-edit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        
        
        <div x-show="showDetailModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto"
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showDetailModal = false"></div>
                <div x-show="showDetailModal"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg border border-slate-100 z-10">

                    
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-blue-50/50 rounded-t-2xl">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">Detail Kegiatan</h3>
                                <p class="text-xs text-slate-500" x-text="'Kode: ' + detailData.kode_kegiatan"></p>
                            </div>
                        </div>
                        <button type="button" @click="showDetailModal = false"
                            class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    
                    <div class="px-6 py-5 space-y-4 max-h-[70vh] overflow-y-auto">
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                            <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">Nama Kegiatan</p>
                            <p class="text-sm font-semibold text-slate-800" x-text="detailData.nama_kegiatan"></p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-slate-50 rounded-xl p-3">
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Kode</p>
                                <p class="text-sm font-bold text-slate-800 font-mono" x-text="detailData.kode_kegiatan"></p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-3">
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tahun Akademik</p>
                                <p class="text-sm font-medium text-slate-700" x-text="detailData.tahun_akademik || '-'"></p>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-3">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Indikator Kinerja</p>
                            <p class="text-sm text-slate-700" x-text="detailData.indikator_kinerja"></p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3">
                                <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-1">Target</p>
                                <p class="text-lg font-bold text-emerald-700" x-text="detailData.target_kegiatan"></p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-3">
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Penanggung Jawab</p>
                                <p class="text-sm font-semibold text-slate-800" x-text="detailData.penanggung_jawab"></p>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-3">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Waktu Pelaksanaan</p>
                            <p class="text-sm text-slate-700" x-text="detailData.waktu_pelaksanaan"></p>
                        </div>

                        <div class="bg-amber-50 border border-amber-100 rounded-xl p-3">
                            <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider mb-1">Kebutuhan Anggaran</p>
                            <p class="text-sm font-medium text-slate-800" x-text="detailData.kebutuhan_anggaran"></p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="flex-1 bg-slate-50 rounded-xl p-3">
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Status</p>
                                <template x-if="detailData.status === 'perencanaan'">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border bg-blue-50 text-blue-700 border-blue-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Perencanaan
                                    </span>
                                </template>
                                <template x-if="detailData.status === 'berjalan'">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border bg-amber-50 text-amber-700 border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>Berjalan
                                    </span>
                                </template>
                                <template x-if="detailData.status === 'selesai'">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border bg-emerald-50 text-emerald-700 border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Selesai
                                    </span>
                                </template>
                                <template x-if="detailData.status === 'tertunda'">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border bg-rose-50 text-rose-700 border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>Tertunda
                                    </span>
                                </template>
                            </div>
                        </div>

                        <template x-if="detailData.catatan">
                            <div class="bg-slate-50 rounded-xl p-3">
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Catatan</p>
                                <p class="text-sm text-slate-700" x-text="detailData.catatan"></p>
                            </div>
                        </template>
                    </div>

                    
                    <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 bg-slate-50/50 rounded-b-2xl">
                        <button type="button"
                            @click="editData = { ...detailData }; showDetailModal = false; showEditModal = true"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </button>
                        <button type="button" @click="showDetailModal = false"
                            class="px-4 py-2 border border-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-100 transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views\kegiatan\index.blade.php ENDPATH**/ ?>