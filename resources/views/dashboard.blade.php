<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="p-4 lg:p-8 max-w-7xl mx-auto space-y-8">
    
    <!-- Header -->
    <div>
        <h1 class="text-2xl lg:text-3xl font-bold text-emerald-900">
            {{ $greeting }}, {{ explode(' ', $user->name)[0] }} 👋
        </h1>
        <p class="text-gray-500 mt-1">Selamat datang di LMS MTs Ulfa Pranggong</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Pakai Blade Component atau include -->
        @include('components.stat-card', [
            'label' => 'Mata Pelajaran', 
            'value' => $subjects->count(), 
            'color' => 'bg-emerald-100 text-emerald-700'
        ])
        @include('components.stat-card', [
            'label' => 'Tugas Aktif', 
            'value' => $assignments->count(), 
            'color' => 'bg-amber-50 text-amber-600'
        ])
        <!-- ... Dan seterusnya -->
    </div>

    <!-- Content Grid -->
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Kolom Mata Pelajaran (Kiri) -->
        <div class="lg:col-span-2 space-y-4">
            <h2 class="text-lg font-bold text-emerald-900">Mata Pelajaran</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                @forelse($subjects as $subject)
                    @include('components.subject-card', ['subject' => $subject])
                @empty
                    <div class="col-span-2 bg-white rounded-2xl border p-8 text-center text-gray-400 italic">
                        Belum ada mata pelajaran.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Kolom Pengumuman (Kanan) -->
        <div class="space-y-4">
            <h2 class="text-lg font-bold text-emerald-900">Pengumuman Terbaru</h2>
            <div class="space-y-3">
                @foreach($announcements as $announcement)
                    @include('components.announcement-item', ['a' => $announcement])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection