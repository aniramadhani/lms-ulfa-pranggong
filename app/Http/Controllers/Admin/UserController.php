<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // 1. Halaman Khusus Siswa
    public function students()
    {
        $students = User::where('role', 'student')->latest()->paginate(10);
        return view('admin.users.students', compact('students'));
    }

    // 2. Halaman Khusus Guru
    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->latest()->paginate(10);
        return view('admin.users.teachers', compact('teachers'));
    }

    // 3. Halaman Khusus Admin
    public function admins()
    {
        $admins = User::where('role', 'admin')->latest()->paginate(10);
        return view('admin.users.admins', compact('admins'));
    }

    // 4. Proses Simpan User Baru
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:8',
            'role'       => 'required|in:admin,teacher,student',
            'class_room' => 'nullable|string|max:50', // Tambahan untuk Siswa
            'specialty'  => 'nullable|string|max:100', // Tambahan untuk Guru
            'homeroom'   => 'nullable|string|max:50',  // Tambahan untuk Guru
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'class_room' => $request->class_room,
            'specialty'  => $request->specialty,
            'homeroom'   => $request->homeroom,
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    // 5. Update User
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role'       => 'required|in:admin,teacher,student',
            'class_room' => 'nullable|string|max:50',
            'specialty'  => 'nullable|string|max:100',
            'homeroom'   => 'nullable|string|max:50',
        ]);

        $data = $request->only(['name', 'email', 'role', 'class_room', 'specialty', 'homeroom']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data user berhasil diperbarui!');
    }

    // 6. Hapus User
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }
}