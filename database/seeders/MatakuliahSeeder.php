<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        Matakuliah::create([
            'nama_matakuliah' => 'Algoritma dan Pemrograman',
            'sks' => 3,
            'id_jurusan' => 1
        ]);
        
        Matakuliah::create([
            'nama_matakuliah' => 'Pengantar Teknologi Informasi',
            'sks' => 3,
            'id_jurusan' => 1
        ]);
        
        Matakuliah::create([
            'nama_matakuliah' => 'Matematika Dasar',
            'sks' => 2,
            'id_jurusan' => 1
        ]);

        Matakuliah::create([
            'nama_matakuliah' => 'Dasar-Dasar Pemrograman',
            'sks' => 3,
            'id_jurusan' => 1        
        ]);
        
        Matakuliah::create([
            'nama_matakuliah' => 'Matematika Diskrit',
            'sks' => 2,
            'id_jurusan' => 1
        ]);

        
        Matakuliah::create([
            'nama_matakuliah' => 'Logika Informatika',
            'sks' => 2,
            'id_jurusan' => 1
        ]);
        
        Matakuliah::create([
            'nama_matakuliah' => 'Struktur Data',
            'sks' => 2,
            'id_jurusan' => 1
        ]);
    }
}