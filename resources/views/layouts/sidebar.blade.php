<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="w-64 bg-emerald-700 text-white min-h-screen flex flex-col shadow-xl">
    <!-- Logo / Nama Sekolah -->
    <div class="p-6 border-b border-emerald-600">
        <h1 class="text-xl font-bold tracking-wider">LMS MTs Ulfa</h1>
        <p class="text-xs text-emerald-200 uppercase tracking-widest mt-1">Pranggong</p>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors {{ request()->routeIs('dashboard') ? 'bg-emerald-800 border-l-4 border-yellow-500' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('subjects.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <span>Mata Pelajaran</span>
        </a>

        <a href="{{ route('assignments.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            <span>Tugas</span>
        </a>

        <a href="{{ route('announcements.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors text-yellow-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            <span class="text-white">Pengumuman</span>
        </a>
    </nav>

    <!-- User Profile Footer -->
    <div class="p-4 border-t border-emerald-600 bg-emerald-800/50">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-emerald-900 font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-emerald-300 truncate">Siswa</p>
            </div>
        </div>
    </div>
</aside>