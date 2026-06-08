{{-- ── Detail Drawer Backdrop ── --}}
<div id="drawer-backdrop" onclick="closeDrawer()"></div>

{{-- ── Detail Drawer ── --}}
<div id="detail-drawer">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100" style="background:#fafafa">
        <div>
            <h3 id="drawer-title" class="text-sm font-bold text-slate-800">Detail Program</h3>
            <p id="drawer-kode" class="text-xs text-slate-400 mt-0.5"></p>
        </div>
        <button onclick="closeDrawer()" class="p-1.5 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition">
            <x-icon name="x" class="w-5 h-5" />
        </button>
    </div>
    <div id="drawer-body" class="px-5 py-5 space-y-5">
        {{-- JS rendered --}}
    </div>
</div>
