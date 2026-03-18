@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-emerald-900">Daftar Mata Pelajaran</h2>
    <p class="text-gray-600">Pilih mata pelajaran untuk melihat materi dan tugas.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($subjects as $subject)
    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-emerald-100 hover:shadow-md transition-shadow">
        <div class="bg-emerald-600 p-4">
            <h3 class="text-white font-bold text-lg">{{ $subject->name }}</h3>
            <p class="text-emerald-100 text-sm">{{ $subject->class_level }}</p>
        </div>
        <div class="p-4">
            <p class="text-gray-600 text-sm mb-4">Guru: <span class="font-medium text-emerald-800">{{ $subject->teacher_name }}</span></p>
            <a href="{{ route('subjects.show', $subject->slug) }}" class="block text-center bg-emerald-50 text-emerald-700 font-semibold py-2 rounded-lg hover:bg-emerald-100 transition-colors">
                Buka Pelajaran
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection