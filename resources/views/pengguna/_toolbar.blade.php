<x-slot name="header">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-xl font-bold text-slate-800 leading-tight">Manajemen Pengguna</h1>
            <p class="text-sm text-slate-400 mt-0.5">Kelola data user, hak akses (role), dan log aktivitas sistem</p>
        </div>
        <button onclick="openCreateModal()"
            class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white hover:opacity-90 transition shadow-sm"
            style="background:#0ea5e9">
            <x-icon name="user-plus" class="w-4 h-4" />
            Tambah Pengguna
        </button>
    </div>
</x-slot>
