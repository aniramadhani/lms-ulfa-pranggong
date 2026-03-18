<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        // Ambil semua tugas, urutkan dari yang paling mendekati deadline
        $assignments = Assignment::with('subject')->orderBy('deadline', 'asc')->get();
        return view('assignments.index', compact('assignments'));
    }

    public function show($id)
    {
        $assignment = Assignment::with('subject')->findOrFail($id);
        
        // Cek apakah siswa ini sudah mengumpulkan tugas ini sebelumnya
        $submission = $assignment->submissions()
            ->where('user_id', Auth::id())
            ->first();

        return view('assignments.show', compact('assignment', 'submission'));
    }
}
