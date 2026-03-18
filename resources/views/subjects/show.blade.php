@extends('layouts.app')

@section('content')
<div class="mb-6">
    <nav class="flex text-sm text-gray-500 mb-2">
        <a href="{{ route('subjects.index') }}" class="hover:text-emerald-700">Mata Pelajaran</a>
        <span class="mx-2">/</span>
        <span class="text-emerald-900 font-medium">{{ $subject->name }}</span>
    </nav>
    <h2 class="text-3xl font-bold text-emerald-900">{{ $subject->name }}</h2>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- List Materi -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-emerald-100">
            <h3 class="text-xl font-bold text-emerald-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path></svg>
                Materi Pembelajaran
            </h3>
            <div class="space-y-4">
                @forelse($subject->materials as $material)
                <div class="p-4 border border-gray-100 rounded-lg hover:bg-emerald-50 transition-colors">
                    <h4 class="font-semibold text-emerald-900">{{ $material->title }}</h4>
                    <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($material->content, 100) }}</p>
                </div>
                @empty
                <p class="text-gray-400 italic">Belum ada materi yang diunggah.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sidebar Tugas Aktif -->
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-yellow-100">
            <h3 class="text-xl font-bold text-yellow-700 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"></path></svg>
                Tugas
            </h3>
            <div class="space-y-3">
                @foreach($subject->assignments as $assignment)
                <a href="#" class="block p-3 rounded-lg border border-yellow-50 hover:bg-yellow-50">
                    <p class="font-medium text-gray-800">{{ $assignment->title }}</p>
                    <p class="text-xs text-red-500 mt-1">Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M, H:i') }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection