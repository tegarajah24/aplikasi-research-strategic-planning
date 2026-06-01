<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-bold text-slate-800 leading-tight">Penelitian</h1>
                <p class="text-sm text-slate-400 mt-0.5">Daftar penelitian dosen dari database</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 min-h-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
                <h2 class="text-lg font-semibold text-slate-700 mb-2">Daftar Penelitian</h2>
                <p class="text-sm text-slate-500 mb-4">Total: {{ $penelitians->total() }} data</p>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 text-left text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                                <th class="pb-3">No</th>
                                <th class="pb-3">Judul</th>
                                <th class="pb-3">Ketua</th>
                                <th class="pb-3">Tahun</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($penelitians as $item)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-3 text-xs">{{ $loop->iteration }}</td>
                                    <td class="py-3 text-sm font-medium text-slate-800">{{ $item->judul }}</td>
                                    <td class="py-3 text-xs">{{ $item->ketua }}</td>
                                    <td class="py-3 text-xs">{{ $item->tahun }}</td>
                                    <td class="py-3 text-xs">{{ $item->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-xs text-slate-400">Belum ada data penelitian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $penelitians->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
