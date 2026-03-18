@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('assignments.index') }}" class="text-emerald-600 text-sm font-medium mb-4 inline-block">&larr; Kembali ke Daftar Tugas</a>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Detail Tugas -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-xl shadow-sm border border-emerald-100">
                <h1 class="text-2xl font-bold text-emerald-900 mb-2">{{ $assignment->title }}</h1>
                <p class="text-sm text-gray-500 mb-6 italic">Diposting oleh Guru {{ $assignment->subject->teacher_name }}</p>
                
                <div class="prose prose-emerald max-w-none text-gray-700">
                    <p>{{ $assignment->description }}</p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Status & Form Upload -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border {{ $submission ? 'border-emerald-500' : 'border-yellow-400' }}">
                <h3 class="font-bold text-gray-800 mb-4">Status Pengumpulan</h3>
                
                @if($submission)
                    <div class="bg-emerald-50 p-4 rounded-lg mb-4 text-center text-emerald-700">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <p class="font-bold">Sudah Dikumpulkan</p>
                        <p class="text-xs">Pada: {{ $submission->created_at->format('d M, H:i') }}</p>
                    </div>
                    @if($submission->score)
                        <div class="mt-4 border-t pt-4">
                            <p class="text-sm text-gray-500 text-center">Nilai Kamu:</p>
                            <p class="text-3xl font-bold text-emerald-800 text-center">{{ $submission->score }}/100</p>
                        </div>
                    @endif
                @else
                    <div class="text-center py-4 bg-yellow-50 rounded-lg mb-4 text-yellow-700">
                        <p class="font-bold">Belum Dikumpulkan</p>
                    </div>
                    
                    <!-- Form Upload (Contoh route store) -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Pilih File Tugas (PDF/DOC)</label>
                            <input type="file" name="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer"/>
                            <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-2 rounded-lg hover:bg-emerald-700 transition-colors">
                                Kumpulkan Sekarang
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection