<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function show(Subject $subject)
    {
        // Load relasi materi dan tugas agar bisa tampil di halaman detail
        $subject->load(['materials', 'assignments']);
        return view('subjects.show', compact('subject'));
    }
}