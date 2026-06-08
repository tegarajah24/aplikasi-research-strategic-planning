@if(session('success'))
<div class="py-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3 rounded-xl text-sm font-medium">
        {{ session('success') }}
    </div>
</div>
@endif

@if(session('error'))
<div class="py-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl text-sm font-medium">
        {{ session('error') }}
    </div>
</div>
@endif
