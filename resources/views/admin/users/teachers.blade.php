@extends('layouts.app')

@section('content')
<div x-data="{ showAddModal: false, showEditModal: false, selectedTeacher: {} }">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-emerald-900">Data Guru / Pengajar</h2>
            <p class="text-gray-600">Kelola daftar ustadz dan ustadzah di MTs Ulfa.</p>
        </div>
        <!-- Tombol Tambah -->
        <button @click="showAddModal = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm font-medium transition-colors">
            + Tambah Guru
        </button>
    </div>

    @if(session('success'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-blue-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-blue-50 border-b border-blue-100">
                <tr>
                    <th class="px-6 py-4 text-blue-800 font-bold uppercase text-xs">Nama Guru</th>
                    <th class="px-6 py-4 text-blue-800 font-bold uppercase text-xs text-center">Mapel Spesialis</th>
                    <th class="px-6 py-4 text-blue-800 font-bold uppercase text-xs text-center">Wali Kelas</th>
                    <th class="px-6 py-4 text-blue-800 font-bold uppercase text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($teachers as $teacher)
                <tr class="hover:bg-blue-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800">{{ $teacher->name }}</div>
                        <div class="text-xs text-gray-500">{{ $teacher->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                            {{ $teacher->specialty ?: '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                        {{ $teacher->homeroom ?: '-' }}
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <!-- Tombol Edit -->
                        <button @click="selectedTeacher = {{ json_encode($teacher) }}; showEditModal = true" class="text-blue-600 hover:text-blue-800 font-medium text-sm mr-3">
                            Edit
                        </button>

                        <!-- Form Hapus -->
                        <form action="{{ route('admin.users.destroy', $teacher->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus data pengajar ini?')" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data guru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $teachers->links() }}
    </div>

    <!-- MODAL TAMBAH GURU -->
    <template x-if="showAddModal">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <h3 class="text-xl font-bold mb-4 text-blue-900">Tambah Guru Baru</h3>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="teacher">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Mapel</label>
                                <input type="text" name="specialty" placeholder="Fikih" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Wali Kelas</label>
                                <input type="text" name="homeroom" placeholder="9-B" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Password</label>
                            <input type="password" name="password" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required minlength="8">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="showAddModal = false" class="text-gray-500 hover:text-gray-700">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Guru</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- MODAL EDIT GURU -->
    <template x-if="showEditModal">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 px-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <h3 class="text-xl font-bold mb-4 text-blue-900">Edit Data Guru</h3>
                <form :action="`{{ url('admin/users') }}/${selectedTeacher.id}`" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="role" value="teacher">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                            <input type="text" name="name" x-model="selectedTeacher.name" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" x-model="selectedTeacher.email" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Mapel</label>
                                <input type="text" name="specialty" x-model="selectedTeacher.specialty" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Wali Kelas</label>
                                <input type="text" name="homeroom" x-model="selectedTeacher.homeroom" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Password Baru (Kosongkan jika tidak ganti)</label>
                            <input type="password" name="password" class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="showEditModal = false" class="text-gray-500 hover:text-gray-700">Batal</button>
                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">Update Guru</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>
@endsection