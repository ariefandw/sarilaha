<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Dosen extends Seeder
{
    public function run()
    {
        $model = new \App\Models\Dosen();
        $faker = Factory::create('id_ID');

        $model->truncate();
        for ($i = 1; $i <= 10; $i++) {
            $this->db->table('users')->insert([
                'id'          => 10 + $i,
                'username'    => $faker->userName(),
                'active'      => 1,
                'last_active' => '2023-01-01 00:00:00',
                'created_at'  => '2023-01-01 00:00:00',
            ]);

            $this->db->table('auth_identities')->insert([
                'user_id'      => 10 + $i,
                'type'         => 'email_password',
                'secret'       => $i == 1 ? 'dosen@demo.app' : $faker->email(),
                'secret2'      => '$2y$10$zOkXdWfd1kq2Dw7VBlgKZOsnXSL1R6V9jlloTQicwVhHMnosLJl/a',
                'last_used_at' => '2023-01-01 00:00:00',
                'created_at'   => '2023-01-01 00:00:00',
            ]);

            $this->db->table('auth_groups_users')->insert([
                'user_id'    => 10 + $i,
                'group'      => 'dosen',
                'created_at' => '2023-01-01 00:00:00',
            ]);

            $model->save([
                'user_id' => 10 + $i,
                'nip'     => $faker->numerify('NIP#####'),
                'nama'    => $faker->name(),
                'telepon' => $faker->phoneNumber()
            ]);
        }
    }
}