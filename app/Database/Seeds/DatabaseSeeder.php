<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('Auth');
        $this->call('Prodi');
        $this->call('Pegawai');
        $this->call('Dosen');
        $this->call('Mahasiswa');
        $this->call('JenisUjian');
        // $this->call('Ujian');
    }
}