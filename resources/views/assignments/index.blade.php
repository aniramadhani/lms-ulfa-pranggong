@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-emerald-900">Daftar Tugas</h2>
    <p class="text-gray-600">Selesaikan tugas tepat waktu untuk hasil maksimal.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-emerald-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-emerald-50 border-b border-emerald-100">
            <tr>
                <th class="px-6 py-4 text-emerald-800 font-bold uppercase text-xs">Mata Pelajaran</th>
                <th class="px-6 py-4 text-emerald-800 font-bold uppercase text-xs">Nama Tugas</th>
                <th class="px-6 py-4 text-emerald-800 font-bold uppercase text-xs">Deadline</th>
                <th class="px-6 py-4 text-emerald-800 font-bold uppercase text-xs">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($assignments as $assignment)
            <tr class="hover:bg-emerald-50/50 transition-colors">
                <td class="px-6 py-4">
                    <span class="bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded-full font-bold">
                        {{ $assignment->subject->name }}
                    </span>
                </td>
                <td class="px-6 py-4 font-medium text-gray-800">{{ $assignment->title }}</td>
                <td class="px-6 py-4 text-sm text-red-500 font-semibold">
                    {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y, H:i') }}
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('assignments.show', $assignment->id) }}" class="text-emerald-600 hover:text-emerald-800 font-bold text-sm">
                        Lihat Detail &rarr;
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection