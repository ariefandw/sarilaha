<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Ujian extends Seeder
{
    public function run()
    {
        $db              = \Config\Database::connect();
        $model           = new \App\Models\Ujian();
        $jenisUjianmodel = new \App\Models\JenisUjian();
        $faker           = Factory::create('id_ID');

        $model->truncate();
        $this->db->table('ujian_pembimbing')->truncate();
        $this->db->table('ujian_penguji')->truncate();
        foreach ($jenisUjianmodel->findAll() as $ju) {

            $model->save([
                'jenis_ujian_id'    => $ju->id,
                'mahasiswa_id'      => $faker->numberBetween(1, 20),
                'judul'             => $faker->sentence(6),
                'nilai_akhir_angka' => $faker->numberBetween(70, 100),
                'nilai_akhir_huruf' => $faker->randomElement(['A', 'B', 'C', 'D']),
                'tanggal_ujian'     => $faker->dateTimeBetween('+1 month', '+2 month')->format('Y-m-d H:i:s'),
                'ruang_ujian'       => $faker->word,
                'status'            => $faker->numberBetween(1, 1),
                'catatan'           => $faker->text(),
            ]);

            for ($j = 0; $j < $ju->jumlah_pembimbing; $j++) {
                $db->table('ujian_pembimbing')->replace([
                    'ujian_id'       => $model->getInsertID(),
                    'dosen_id'       => $faker->numberBetween(1, 10),
                    'penilaian_id'   => $faker->numberBetween(1, 10),
                    'nilai'          => $faker->numberBetween(0, 100),
                    'approve_revisi' => $faker->randomElement([true, false]),
                ]);
            }

            for ($j = 0; $j < $ju->jumlah_penguji; $j++) {
                $db->table('ujian_penguji')->replace([
                    'ujian_id'       => $model->getInsertID(),
                    'dosen_id'       => $faker->numberBetween(1, 10),
                    'penilaian_id'   => $faker->numberBetween(1, 10),
                    'nilai'          => $faker->numberBetween(0, 100),
                    'approve_revisi' => $faker->randomElement([true, false]),
                ]);
            }
        }
    }
}