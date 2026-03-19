<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// RUTE UMUM (Bisa diakses Siswa, Guru, & Admin)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// RUTE KHUSUS SISWA
// ==========================================
Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/{subject:slug}', [SubjectController::class, 'show'])->name('subjects.show');
    
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{id}', [AssignmentController::class, 'show'])->name('assignments.show');
    
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
});

// ==========================================
// RUTE KHUSUS GURU
// ==========================================
Route::middleware(['auth', 'verified', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard'); 
    })->name('teacher.dashboard');
});

// RUTE KHUSUS ADMIN

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // --- Rute List User (Sudah ada di kode kamu) ---
    Route::get('/admin/siswa', [UserController::class, 'students'])->name('admin.users.students');
    Route::get('/admin/guru', [UserController::class, 'teachers'])->name('admin.users.teachers');
    Route::get('/admin/admins', [UserController::class, 'admins'])->name('admin.users.admins');

    // --- TAMBAHKAN Rute Action Berikut (Baru) ---
    // Simpan User Baru
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    
    // Update User (menggunakan PUT/PATCH)
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    
    // Hapus User
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

require __DIR__.'/auth.php';