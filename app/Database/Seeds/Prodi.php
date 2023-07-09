<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Prodi extends Seeder
{
    public function run()
    {
        $model = new \App\Models\Prodi();

        $model->truncate();
        $model->insertBatch([
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S1 Ilmu Komputer',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S1 Elektronika dan Instrumentasi',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S1 Kimia',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S1 Matematika',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S1 Statistika',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S1 Aktuaria',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S1 Fisika',
            ],

            [
                'kode_prodi' => null,
                'nama_prodi' => 'S1 Geofisika',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S2 Ilmu Komputer',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S2 Kecerdasan Artifisial',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S2 Elektronika dan Instrumentasi',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S2 Kimia',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S2 Matematika',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S2 Fisika',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S3 Ilmu Komputer',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S3 Kimia',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S3 Matematika',
            ],
            [
                'kode_prodi' => null,
                'nama_prodi' => 'S3 Fisika',
            ],
        ]);
    }
}