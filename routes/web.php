<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Grouping route yang butuh login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard (Kita pakai Controller supaya bisa hitung jumlah tugas/mapel)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Mata Pelajaran
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/{subject:slug}', [SubjectController::class, 'show'])->name('subjects.show');

    // Tugas
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{id}', [AssignmentController::class, 'show'])->name('assignments.show');

    // Pengumuman
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';