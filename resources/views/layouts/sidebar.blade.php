<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="w-64 bg-emerald-700 text-white min-h-screen flex flex-col shadow-xl">
    <!-- Logo / Nama Sekolah -->
    <div class="p-6 border-b border-emerald-600">
        <h1 class="text-xl font-bold tracking-wider">LMS MTs Ulfa</h1>
        <p class="text-xs text-emerald-200 uppercase tracking-widest mt-1">Pranggong</p>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        
<!-- ============================== -->
        <!-- MENU KHUSUS ADMIN -->
        <!-- ============================== -->
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Dashboard Admin</span>
            </a>

            <!-- DROPDOWN DATA USER (Pakai Alpine.js bawaan Laravel) -->
            <!-- x-data memastikan menu ini otomatis terbuka kalau kita lagi di halaman Data User -->
            <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-emerald-800 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-emerald-800' : '' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span>Data User</span>
                    </div>
                    <!-- Ikon Panah yang akan muter kalau di-klik -->
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Isi Dropdown (Siswa, Guru, Admin) -->
                <div x-show="open" x-transition class="mt-1 space-y-1 pl-11 pr-3">
                    <a href="{{ route('admin.users.students') }}" class="block py-2 text-sm text-emerald-200 hover:text-white transition-colors {{ request()->routeIs('admin.users.students') ? 'text-white font-bold border-l-2 border-yellow-500 pl-2' : '' }}">
                        Data Siswa
                    </a>
                    <a href="{{ route('admin.users.teachers') }}" class="block py-2 text-sm text-emerald-200 hover:text-white transition-colors {{ request()->routeIs('admin.users.teachers') ? 'text-white font-bold border-l-2 border-yellow-500 pl-2' : '' }}">
                        Data Guru
                    </a>
                    <a href="{{ route('admin.users.admins') }}" class="block py-2 text-sm text-emerald-200 hover:text-white transition-colors {{ request()->routeIs('admin.users.admins') ? 'text-white font-bold border-l-2 border-yellow-500 pl-2' : '' }}">
                        Data Admin
                    </a>
                </div>
            </div>

            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"></path></svg>
                <span>Kelola Mapel</span>
            </a>

        <!-- ============================== -->
        <!-- MENU KHUSUS GURU -->
        <!-- ============================== -->
        @elseif(Auth::user()->role === 'teacher')
            <a href="{{ route('teacher.dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors {{ request()->routeIs('teacher.dashboard') ? 'bg-emerald-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Dashboard Guru</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                <span>Kelola Tugas</span>
            </a>

        <!-- ============================== -->
        <!-- MENU KHUSUS SISWA -->
        <!-- ============================== -->
        @else
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors {{ request()->routeIs('dashboard') ? 'bg-emerald-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Dashboard Belajar</span>
            </a>
            <a href="{{ route('subjects.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors {{ request()->routeIs('subjects.*') ? 'bg-emerald-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span>Mata Pelajaran</span>
            </a>
            <a href="{{ route('assignments.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors {{ request()->routeIs('assignments.*') ? 'bg-emerald-800 border-l-4 border-yellow-500' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                <span>Tugas Saya</span>
            </a>
        @endif

        <!-- ============================== -->
        <!-- MENU UMUM (Semua Bisa Lihat) -->
        <!-- ============================== -->
        <a href="{{ route('announcements.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-800 transition-colors text-yellow-500 mt-4 {{ request()->routeIs('announcements.*') ? 'bg-emerald-800 border-l-4 border-yellow-500' : '' }}">
            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            <span class="text-white">Pengumuman</span>
        </a>
    </nav>

    <!-- User Profile Footer -->
    <div class="p-4 border-t border-emerald-600 bg-emerald-800/50">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-emerald-900 font-bold uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden flex-1">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <!-- Menampilkan Role yang Sedang Login -->
                <p class="text-xs text-emerald-300 truncate uppercase tracking-wider">
                    {{ Auth::user()->role }}
                </p>
            </div>
            
            <!-- Tombol Logout Bawaan Breeze yang Dipercantik -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-emerald-300 hover:text-white transition-colors" title="Keluar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </div>
</aside>