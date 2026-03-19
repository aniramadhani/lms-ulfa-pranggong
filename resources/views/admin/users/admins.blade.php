@extends('layouts.app')

@section('content')
<!-- Container Utama dengan Alpine.js untuk Modal -->
<div x-data="{ showAddModal: false, showEditModal: false, selectedAdmin: {} }">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-emerald-900">Data Administrator</h2>
            <p class="text-gray-600">Personel dengan akses penuh ke kendali sistem.</p>
        </div>
        <!-- Tombol Tambah -->
        <button @click="showAddModal = true" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-sm font-medium transition-colors">
            + Tambah Admin
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-red-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-red-50 border-b border-red-100">
                <tr>
                    <th class="px-6 py-4 text-red-800 font-bold uppercase text-xs w-1/3">Nama Admin</th>
                    <th class="px-6 py-4 text-red-800 font-bold uppercase text-xs w-1/3 text-center">Status Akun</th>
                    <th class="px-6 py-4 text-red-800 font-bold uppercase text-xs text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($admins as $admin)
                <tr class="hover:bg-red-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800">{{ $admin->name }}</div>
                        <div class="text-xs text-gray-500">{{ $admin->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-black uppercase">Aktif</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <!-- Tombol Edit -->
                        <button @click="selectedAdmin = {{ json_encode($admin) }}; showEditModal = true" class="text-blue-600 hover:text-blue-800 font-medium text-sm mr-3">
                            Edit
                        </button>

                        @if(Auth::id() !== $admin->id)
                            <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus admin ini?')" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                    Hapus
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs italic">Ini Anda</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- MODAL TAMBAH -->
    <template x-if="showAddModal">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <h3 class="text-xl font-bold mb-4">Tambah Administrator</h3>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="admin">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium">Nama</label>
                            <input type="text" name="name" class="w-full border rounded-lg p-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input type="email" name="email" class="w-full border rounded-lg p-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Password</label>
                            <input type="password" name="password" class="w-full border rounded-lg p-2" required minlength="8">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="showAddModal = false" class="text-gray-500">Batal</button>
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- MODAL EDIT -->
    <template x-if="showEditModal">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <h3 class="text-xl font-bold mb-4 text-emerald-900">Edit Administrator</h3>
                <form :action="`{{ url('admin/users') }}/${selectedAdmin.id}`" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="role" value="admin">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium">Nama</label>
                            <input type="text" name="name" x-model="selectedAdmin.name" class="w-full border rounded-lg p-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input type="email" name="email" x-model="selectedAdmin.email" class="w-full border rounded-lg p-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-red-500 text-xs text-right italic font-normal">*Isi jika ingin ganti password</label>
                            <input type="password" name="password" placeholder="Password Baru" class="w-full border rounded-lg p-2">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="showEditModal = false" class="text-gray-500 hover:text-gray-700">Batal</button>
                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>
@endsection