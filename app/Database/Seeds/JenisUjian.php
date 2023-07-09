<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class JenisUjian extends Seeder
{
    public function run()
    {
        $model          = new \App\Models\JenisUjian();
        $prodiModel     = new \App\Models\Prodi();
        $penilaianModel = new \App\Models\Penilaian();
        $berkasModel    = new \App\Models\BerkasSyarat();
        $faker          = Factory::create('id_ID');

        $semesters = [1, 2, 3, 4, 5, 6, 7, 8];
        $sks       = [2, 3, 4, 5];

        $model->truncate();
        $penilaianModel->truncate();
        $berkasModel->truncate();
        $nama_berkas = ['Draft Laporan Penelitian', 'Kartu Mahasiswa', 'Surat Keaktifan Mahasiswa'];
        $nama_ujian  = ['Proposal', 'Skripsi', 'Tesis', 'Disertasi'];
        for ($i = 1; $i <= 20; $i++) {
            $prodi = $prodiModel->find($faker->numberBetween(1, 5));
            $model->save([
                'prodi_id'          => $prodi->id,
                'nama_ujian'        => $nama_ujian[$faker->numberBetween(0, 3)] . ' ' . $i,
                'jumlah_penguji'    => $faker->numberBetween(2, 3),
                'jumlah_pembimbing' => $faker->numberBetween(1, 2),
                'semester_ditempuh' => $faker->randomElement($semesters),
                'sks_ditempuh'      => $faker->randomElement($sks),
            ]);

            // $penilaianModel->save([
            //     'jenis_ujian_id' => $i,
            //     'nama_penilaian' => 'Nilai Pembimbing',
            //     'bobot'          => $faker->numberBetween(1, 2),
            // ]);
            // $penilaianModel->save([
            //     'jenis_ujian_id' => $i,
            //     'nama_penilaian' => 'Nilai Penguji',
            //     'bobot'          => $faker->numberBetween(1, 2),
            // ]);
            for ($j = 1; $j <= $faker->numberBetween(2, 5); $j++) {
                $penilaianModel->save([
                    'jenis_ujian_id' => $i,
                    'nama_penilaian' => $faker->sentence(3),
                    'bobot'          => $faker->numberBetween(1, 5),
                ]);
            }
            for ($j = 1; $j <= $faker->numberBetween(2, 3); $j++) {
                $berkasModel->save([
                    'jenis_ujian_id'     => $i,
                    'nama_berkas_syarat' => $nama_berkas[$j - 1], //$faker->sentence(2),
                ]);
            }
        }
    }
}