<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subject;
use App\Models\Material;
use App\Models\Assignment;
use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Siswa (untuk Login)
        User::factory()->create([
            'name' => 'Siswa MTs Ulfa',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('password'), // passwordnya: password
        ]);

        // 2. Daftar Mata Pelajaran
        $subjects = [
            ['name' => 'Al-Qur\'an Hadits', 'teacher' => 'Ust. Ahmad Fakhruddin'],
            ['name' => 'Akidah Akhlak', 'teacher' => 'Ustz. Siti Aminah'],
            ['name' => 'Fiqih', 'teacher' => 'Ust. Mansur Jaelani'],
            ['name' => 'Sejarah Kebudayaan Islam', 'teacher' => 'Ust. Hamzah'],
            ['name' => 'Matematika', 'teacher' => 'Bu Fatimah Zahra'],
        ];

        foreach ($subjects as $s) {
            $subject = Subject::create([
                'name' => $s['name'],
                'slug' => Str::slug($s['name']),
                'teacher_name' => $s['teacher'],
                'class_level' => '7-A',
                'description' => 'Mata pelajaran ' . $s['name'] . ' untuk meningkatkan pemahaman keagamaan.',
            ]);

            // 3. Tambahkan 1 Materi per Mapel
            Material::create([
                'subject_id' => $subject->id,
                'title' => 'Bab 1: Pengenalan Dasar ' . $s['name'],
                'content' => 'Ini adalah ringkasan materi untuk bab pertama. Silakan baca buku cetak halaman 1-10.',
            ]);

            // 4. Tambahkan 1 Tugas per Mapel
            Assignment::create([
                'subject_id' => $subject->id,
                'title' => 'Latihan Soal ' . $s['name'],
                'description' => 'Kerjakan tugas di buku tulis, foto, lalu unggah dalam format PDF.',
                'deadline' => now()->addDays(7),
            ]);
        }

        // 5. Tambahkan Pengumuman Sekolah
        Announcement::create([
            'title' => 'Info Libur Ramadhan',
            'content' => 'Sesuai instruksi madrasah, kegiatan KBM diliburkan selama awal Ramadhan.',
            'user_id' => 1,
        ]);
    }
}