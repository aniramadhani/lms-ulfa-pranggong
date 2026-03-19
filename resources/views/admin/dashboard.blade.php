@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-emerald-900">Ruang Kendali Admin</h2>
    <p class="text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}. Silakan kelola sistem LMS di sini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Kartu Stat Admin -->
    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-emerald-500">
        <p class="text-sm text-gray-500 uppercase font-bold">Total Siswa</p>
        <h3 class="text-2xl font-bold text-emerald-800">1</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
        <p class="text-sm text-gray-500 uppercase font-bold">Total Guru</p>
        <h3 class="text-2xl font-bold text-emerald-800">1</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
        <p class="text-sm text-gray-500 uppercase font-bold">Pengumuman Aktif</p>
        <h3 class="text-2xl font-bold text-emerald-800">1</h3>
    </div>
</div>

<div class="mt-8 bg-white p-6 rounded-xl shadow-sm">
    <h3 class="text-lg font-bold text-emerald-900 mb-4">Aksi Cepat</h3>
    <div class="flex space-x-4">
        <button class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">+ Tambah User</button>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Buat Pengumuman</button>
    </div>
</div>
@endsection