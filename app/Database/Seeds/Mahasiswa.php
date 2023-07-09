<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Mahasiswa extends Seeder
{
    public function run()
    {
        $model = new \App\Models\Mahasiswa();
        $faker = Factory::create('id_ID');

        $model->truncate();
        for ($i = 1; $i <= 10; $i++) {
            $this->db->table('users')->insert([
                'id'          => 20 + $i,
                'username'    => $faker->userName(),
                'active'      => 1,
                'last_active' => '2023-01-01 00:00:00',
                'created_at'  => '2023-01-01 00:00:00',
            ]);

            $this->db->table('auth_identities')->insert([
                'user_id'      => 20 + $i,
                'type'         => 'email_password',
                'secret'       => $i == 1 ? 'mahasiswa@demo.app' : $faker->email(),
                'secret2'      => '$2y$10$zOkXdWfd1kq2Dw7VBlgKZOsnXSL1R6V9jlloTQicwVhHMnosLJl/a',
                'last_used_at' => '2023-01-01 00:00:00',
                'created_at'   => '2023-01-01 00:00:00',
            ]);

            $this->db->table('auth_groups_users')->insert([
                'user_id'    => 20 + $i,
                'group'      => 'mahasiswa',
                'created_at' => '2023-01-01 00:00:00',
            ]);

            $model->save([
                'user_id'  => 20 + $i,
                'nim'      => $faker->numerify('NIM#####'),
                'nama'     => $faker->name(),
                'prodi_id' => $i == 1 ? 1 : $faker->numberBetween(1, 5),
                'angkatan' => $faker->numberBetween(2018, 2023),
                'telepon'  => $faker->phoneNumber(),
            ]);
        }
    }
}