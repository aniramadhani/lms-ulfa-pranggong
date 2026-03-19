@extends('layouts.app')

@section('content')
<div x-data="{ showAddModal: false, showEditModal: false, selectedStudent: {} }">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-emerald-900">Data Siswa</h2>
            <p class="text-gray-600">Kelola daftar siswa aktif di LMS MTs Ulfa.</p>
        </div>
        <!-- Tombol Tambah -->
        <button @click="showAddModal = true" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg shadow-sm font-medium transition-colors">
            + Tambah Siswa
        </button>
    </div>

    <!-- Fitur Search -->
    <form action="{{ route('admin.users.students') }}" method="GET" class="mb-4 flex space-x-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa..." class="border-emerald-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 w-64 text-sm px-3 py-2 border">
        <button type="submit" class="bg-white border border-emerald-200 text-emerald-700 px-3 py-2 rounded-lg text-sm hover:bg-emerald-50">Cari</button>
    </form>

    @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-emerald-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-emerald-50 border-b border-emerald-100">
                <tr>
                    <th class="px-6 py-4 text-emerald-800 font-bold uppercase text-xs w-1/4">Nama Siswa</th>
                    <th class="px-6 py-4 text-emerald-800 font-bold uppercase text-xs w-1/4">Email</th>
                    <th class="px-6 py-4 text-emerald-800 font-bold uppercase text-xs w-1/4 text-center">Kelas</th>
                    <th class="px-6 py-4 text-emerald-800 font-bold uppercase text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($students as $student)
                <tr class="hover:bg-emerald-50/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $student->name }}</td>
                    <td class="px-6 py-4 text-gray-600 text-sm">{{ $student->email }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded font-bold border border-gray-200">
                            {{ $student->class_room ?: 'Tanpa Kelas' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <!-- Tombol Edit -->
                        <button @click="selectedStudent = {{ json_encode($student) }}; showEditModal = true" class="text-blue-600 hover:text-blue-800 font-medium text-sm mr-3">
                            Edit
                        </button>
                        
                        <!-- Form Hapus -->
                        <form action="{{ route('admin.users.destroy', $student->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus data siswa ini?')" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $students->links() }}
    </div>

    <!-- MODAL TAMBAH SISWA -->
    <template x-if="showAddModal">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <h3 class="text-xl font-bold mb-4 text-emerald-900">Tambah Siswa Baru</h3>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="student">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full border rounded-lg p-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full border rounded-lg p-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Kelas (Opsional)</label>
                            <input type="text" name="class_room" placeholder="Contoh: 7-A" class="w-full border rounded-lg p-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Password</label>
                            <input type="password" name="password" class="w-full border rounded-lg p-2 focus:ring-emerald-500 focus:border-emerald-500" required minlength="8">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="showAddModal = false" class="text-gray-500 hover:text-gray-700">Batal</button>
                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">Simpan Siswa</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- MODAL EDIT SISWA -->
    <template x-if="showEditModal">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <h3 class="text-xl font-bold mb-4 text-emerald-900">Edit Data Siswa</h3>
                <form :action="`{{ url('admin/users') }}/${selectedStudent.id}`" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="role" value="student">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="name" x-model="selectedStudent.name" class="w-full border rounded-lg p-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" x-model="selectedStudent.email" class="w-full border rounded-lg p-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Kelas</label>
                            <input type="text" name="class_room" x-model="selectedStudent.class_room" class="w-full border rounded-lg p-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Password Baru (Kosongkan jika tidak ganti)</label>
                            <input type="password" name="password" class="w-full border rounded-lg p-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="showEditModal = false" class="text-gray-500 hover:text-gray-700">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update Siswa</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>
@endsection