@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-emerald-900 mb-6">Pengumuman Madrasah</h2>
    
    <div class="space-y-4">
        @foreach($announcements as $announcement)
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-emerald-500">
            <div class="flex justify-between items-start mb-2">
                <h3 class="text-lg font-bold text-emerald-800">{{ $announcement->title }}</h3>
                <span class="text-xs text-gray-400">{{ $announcement->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-gray-600 leading-relaxed">{{ $announcement->content }}</p>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $announcements->links() }}
    </div>
</div>
@endsection