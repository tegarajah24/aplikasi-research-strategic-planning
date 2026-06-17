<div class="glass-panel shadow-sm overflow-hidden flex flex-col h-[500px] lg:h-auto">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
        <div>
            <h2 class="text-sm font-bold text-slate-700">Audit Log</h2>
            <p class="text-xs text-slate-400 mt-0.5">Aktivitas terbaru pengguna</p>
        </div>
    </div>
    <div class="flex-1 p-5 overflow-y-auto" id="audit-log-container">
        @forelse($logs as $log)
        <div class="flex items-start gap-3 py-2.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
            <div class="size-7 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                <span class="text-xs font-bold text-slate-500">{{ substr($log->user?->name ?? '?', 0, 1) }}</span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-slate-700">
                    <span class="font-semibold">{{ $log->user?->name ?? 'System' }}</span>
                    <span class="text-slate-500">{{ $log->description }}</span>
                </p>
                <div class="flex items-center gap-2 mt-0.5">
                    <span class="text-[10px] font-medium text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded">{{ $log->module }}</span>
                    <span class="text-[10px] text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-10">
            <p class="text-sm text-slate-400">Belum ada aktivitas</p>
        </div>
        @endforelse
    </div>
</div>
