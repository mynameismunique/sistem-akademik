<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create([
            'nim' => '23552011224',
            'nama' => 'Mugni Ramdani',
            'id_jurusan' => 1
        ]);
        
                Mahasiswa::create([
            'nim' => '23552011001',
            'nama' => 'Ahmad Fauzi',
            'id_jurusan' => 1
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011002',
            'nama' => 'Budi Santoso',
            'id_jurusan' => 2
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011003',
            'nama' => 'Citra Amelia',
            'id_jurusan' => 1
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011004',
            'nama' => 'Dian Purnama',
            'id_jurusan' => 3
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011005',
            'nama' => 'Eka Prasetya',
            'id_jurusan' => 2
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011006',
            'nama' => 'Fani Nurhaliza',
            'id_jurusan' => 1
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011007',
            'nama' => 'Gilang Ramadhan',
            'id_jurusan' => 3
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011008',
            'nama' => 'Hani Fitriani',
            'id_jurusan' => 2
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011009',
            'nama' => 'Iqbal Firdaus',
            'id_jurusan' => 1
        ]);
        
        Mahasiswa::create([
            'nim' => '23552011010',
            'nama' => 'Jihan Safira',
            'id_jurusan' => 3
        ]);
    }
}