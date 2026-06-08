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
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Dashboard</h1>
                <p class="text-sm text-slate-400 mt-0.5">Selamat datang kembali — ringkasan sistem RSP-UHB</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs text-slate-400 hidden sm:block"><?php echo e(now()->translatedFormat('l, d F Y')); ?></span>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-medium border border-emerald-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Online
                </span>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <style>
        .dash-card {
            transition: transform .25s cubic-bezier(.4,0,.2,1), box-shadow .25s cubic-bezier(.4,0,.2,1);
        }
        .dash-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px -6px rgba(15,23,42,.10), 0 2px 6px -2px rgba(15,23,42,.06);
        }
        .action-link {
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .action-link:hover {
            transform: translateY(-1px);
        }
    </style>

    <div class="py-8 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            
            <section>
                <?php
                    $colorMap = [
                        'blue'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'bar' => 'bg-blue-500'],
                        'indigo'  => ['bg' => 'bg-indigo-50',  'text' => 'text-indigo-600',  'bar' => 'bg-indigo-500'],
                        'cyan'    => ['bg' => 'bg-cyan-50',    'text' => 'text-cyan-600',    'bar' => 'bg-cyan-500'],
                        'teal'    => ['bg' => 'bg-teal-50',    'text' => 'text-teal-600',    'bar' => 'bg-teal-500'],
                        'amber'   => ['bg' => 'bg-amber-50',   'text' => 'text-amber-600',   'bar' => 'bg-amber-500'],
                        'orange'  => ['bg' => 'bg-orange-50',  'text' => 'text-orange-600',  'bar' => 'bg-orange-500'],
                        'rose'    => ['bg' => 'bg-rose-50',    'text' => 'text-rose-600',    'bar' => 'bg-rose-500'],
                        'pink'    => ['bg' => 'bg-pink-50',    'text' => 'text-pink-600',    'bar' => 'bg-pink-500'],
                        'fuchsia' => ['bg' => 'bg-fuchsia-50', 'text' => 'text-fuchsia-600', 'bar' => 'bg-fuchsia-500'],
                        'red'     => ['bg' => 'bg-red-50',     'text' => 'text-red-600',     'bar' => 'bg-red-500'],
                        'violet'  => ['bg' => 'bg-violet-50',  'text' => 'text-violet-600',  'bar' => 'bg-violet-500'],
                        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'bar' => 'bg-emerald-500'],
                    ];
                    $iconMap = [
                        'building'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>',
                        'academic'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>',
                        'handshake'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>',
                        'users'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0z"/>',
                        'trophy'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0 1 16.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.023 6.023 0 0 1-2.77.853m0 0c-1.197 0-2.378-.266-3.464-.753m3.464.753a6.023 6.023 0 0 0-3.464-.753m0 0a6.023 6.023 0 0 1 2.77.853m0 0a6.023 6.023 0 0 0 3.464.753"/>',
                        'star'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>',
                        'shield'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>',
                        'book'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>',
                        'document'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>',
                        'tag'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 0 0 3.182 0l5.178-5.178a2.25 2.25 0 0 0 0-3.182l-9.581-9.581A2.25 2.25 0 0 0 9.568 3Z"/>',
                        'folder'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"/>',
                        'clipboard'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>',
                    ];
                    $routeMap = [
                        'Fakultas' => 'fakultas.index', 'Prodi' => 'prodi.index', 'Kerja Sama' => 'kerjasama.index',
                        'Dosen' => 'dosen.index', 'Prestasi Akademik' => 'prestasi-akademik.index',
                        'Prestasi Non-Akademik' => 'pengguna', 'HKI' => 'hki.index',
                        'Buku' => 'buku.index', 'Artikel' => 'artikel.index',
                        'Bidang' => 'bidang.index', 'Program' => 'program.index', 'Kegiatan RKT' => 'kegiatan.index',
                    ];
                ?>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $c = $colorMap[$stat['color']] ?? $colorMap['blue']; ?>
                        <a href="<?php echo e(route($routeMap[$stat['label']])); ?>"
                           class="dash-card group bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden block">
                            <div class="h-1 <?php echo e($c['bar']); ?>"></div>
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="w-9 h-9 rounded-xl <?php echo e($c['bg']); ?> flex items-center justify-center">
                                        <svg class="w-4.5 h-4.5 <?php echo e($c['text']); ?>" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                            <?php echo $iconMap[$stat['icon']] ?? ''; ?>

                                        </svg>
                                    </div>
                                </div>
                                <p class="text-2xl font-bold text-slate-800 tracking-tight"><?php echo e($stat['count']); ?></p>
                                <p class="text-[11px] text-slate-400 mt-1 leading-tight"><?php echo e($stat['label']); ?></p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </section>

            
            <section>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <h2 class="text-sm font-semibold text-slate-700">Aktivitas Terbaru</h2>
                                <p class="text-[11px] text-slate-400 mt-0.5">Log perubahan terakhir pada sistem</p>
                            </div>
                            <span class="text-[11px] font-medium px-2.5 py-1 rounded-lg bg-slate-50 text-slate-400 border border-slate-100">Mei 2026</span>
                        </div>

                        <div class="p-6 space-y-1">
                            <?php
                            $activities = [
                                ['module'=>'aktivitas','color'=>'amber', 'title'=>'Belum ada aktivitas terbaru',
                                 'desc'=>'Sistem berjalan normal.',
                                 'author'=>'','time'=>''],
                            ];
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $dotMap   = ['blue'=>'bg-blue-500','violet'=>'bg-violet-500','amber'=>'bg-amber-500'];
                                $badgeBg  = ['blue'=>'bg-blue-50 text-blue-600 border-blue-100','violet'=>'bg-violet-50 text-violet-600 border-violet-100','amber'=>'bg-amber-50 text-amber-600 border-amber-100'];
                            ?>
                            <div class="flex gap-4 group">
                                
                                <div class="flex flex-col items-center pt-1.5">
                                    <div class="w-2.5 h-2.5 rounded-full <?php echo e($dotMap[$act['color']]); ?> ring-4 ring-white flex-shrink-0"></div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$loop->last): ?>
                                    <div class="w-px flex-1 bg-slate-100 mt-1"></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                
                                <div class="flex-1 pb-6 last:pb-0">
                                    <div class="rounded-xl px-4 py-3 hover:bg-slate-50/80 transition-colors duration-150 -ml-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <p class="text-[13px] font-semibold text-slate-700"><?php echo e($act['title']); ?></p>
                                            <span class="text-[10px] font-medium px-1.5 py-0.5 rounded-md border <?php echo e($badgeBg[$act['color']]); ?>"><?php echo e(ucfirst($act['module'])); ?></span>
                                            <span class="text-[11px] text-slate-400 ml-auto flex-shrink-0"><?php echo e($act['time']); ?></span>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1 leading-relaxed"><?php echo e($act['desc']); ?></p>
                                        <p class="text-[11px] text-slate-400 mt-1.5"><?php echo e($act['author']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>
                    </div>

                    
                    <div class="space-y-5">

                        
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm">
                            <div class="px-5 py-4 border-b border-slate-100">
                                <h2 class="text-sm font-semibold text-slate-700">Aksi Cepat</h2>
                            </div>
                            <div class="p-4 space-y-2">
                                <a href="<?php echo e(route('kegiatan.index')); ?>" class="action-link flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium shadow-sm hover:shadow-md hover:shadow-emerald-600/20">
                                    <svg class="w-4 h-4 opacity-80" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>
                                    <span class="flex-1">Kegiatan RKT</span>
                                    <svg class="w-3.5 h-3.5 opacity-60" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                </a>
                            </div>
                        </div>

                        
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-4">
                            <h2 class="text-sm font-semibold text-slate-700">Informasi Sistem</h2>

                            <div class="space-y-3 text-xs">
                                <div class="flex justify-between"><span class="text-slate-400">Semester</span><span class="font-medium text-slate-700">Genap 2025/2026</span></div>
                                <div class="flex justify-between"><span class="text-slate-400">Tahun Akademik</span><span class="font-medium text-slate-700">2025 / 2026</span></div>
                                <div class="flex justify-between"><span class="text-slate-400">Versi</span><span class="font-medium text-slate-500 bg-slate-50 px-2 py-0.5 rounded-md border border-slate-100">v1.0.0</span></div>
                            </div>

                            <div class="pt-4 border-t border-slate-100">
                                <div class="flex justify-between mb-2">
                                    <span class="text-xs text-slate-400">Kelengkapan Data</span>
                                    <span class="text-xs font-semibold text-slate-600">78%</span>
                                </div>
                                <div class="h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-blue-500 transition-all duration-500" style="width: 78%"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

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
<?php /**PATH C:\laragon\www\aplikasi-research-strategic-planning\resources\views\dashboard\index.blade.php ENDPATH**/ ?>