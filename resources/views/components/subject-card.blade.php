<div class="bg-white p-5 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition-all group">
    <div class="flex items-start justify-between">
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path></svg>
        </div>
    </div>
    <div class="mt-4">
        <h3 class="font-bold text-emerald-900 text-lg">{{ $subject->name }}</h3>
        <p class="text-sm text-gray-500">{{ $subject->teacher_name }}</p>
    </div>
    <a href="{{ route('subjects.show', $subject->slug) }}" class="mt-4 block text-center text-sm font-semibold text-emerald-700 bg-emerald-50 py-2 rounded-lg hover:bg-emerald-100">
        Buka Materi
    </a>
</div>