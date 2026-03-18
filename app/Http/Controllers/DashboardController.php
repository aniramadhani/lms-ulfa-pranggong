<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Assignment;
use App\Models\Announcement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{
    $hour = now()->hour;
    $greeting = 'Selamat Malam';
    if ($hour < 11) $greeting = 'Selamat Pagi';
    elseif ($hour < 15) $greeting = 'Selamat Siang';
    elseif ($hour < 18) $greeting = 'Selamat Sore';

    return view('dashboard', [
        'greeting' => $greeting,
        'user' => auth()->user(),
        'subjects' => \App\Models\Subject::latest()->take(6)->get(),
        'assignments' => \App\Models\Assignment::latest()->take(5)->get(),
        'announcements' => \App\Models\Announcement::latest()->take(5)->get(),
    ]);
}
}