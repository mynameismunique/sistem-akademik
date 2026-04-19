<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        Jurusan::create([
            'nama_jurusan' => 'Teknik Informatika',
            'akreditasi' => 'A'
        ]);
        
        Jurusan::create([
            'nama_jurusan' => 'Desain Komunikasi Visual',
            'akreditasi' => 'A'
        ]);
        
        Jurusan::create([
            'nama_jurusan' => 'Teknik Industri',
            'akreditasi' => 'A'
        ]);

        Jurusan::create([
        'nama_jurusan' => 'Bisnis Digital',
        'akreditasi' => 'B'
        ]);

        Jurusan::create([
            'nama_jurusan' => 'Manajemen Retail',
            'akreditasi' => 'C'
        ]);
    }
}