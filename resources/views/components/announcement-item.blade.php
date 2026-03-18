<div class="p-4 bg-white rounded-xl border border-gray-100 hover:border-emerald-200 transition-colors shadow-sm">
    <div class="flex justify-between items-start mb-1">
        <h4 class="font-bold text-emerald-800 text-sm">{{ $a->title }}</h4>
        <span class="text-[10px] text-gray-400 font-medium">{{ $a->created_at->diffForHumans() }}</span>
    </div>
    <p class="text-xs text-gray-600 line-clamp-2">
        {{ $a->content }}
    </p>
</div>