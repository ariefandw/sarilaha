<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Pegawai extends Seeder
{
    public function run()
    {
        $model = new \App\Models\Pegawai();
        $faker = Factory::create('id_ID');

        $model->truncate();
        for ($i = 1; $i <= 10; $i++) {
            $this->db->table('users')->insert([
                'id'          => $i,
                'username'    => $faker->userName(),
                'active'      => 1,
                'last_active' => '2023-01-01 00:00:00',
                'created_at'  => '2023-01-01 00:00:00',
            ]);

            $email;
            $prodi_id;
            switch ($i) {
                case 1:
                    $email = 'admin@sarilaha.web.id';
                    $prodi_id = 1;
                    break;
                case 2:
                    $email = 'admin_ilkom@demo.app';
                    $prodi_id = 1;
                    break;
                case 3:
                    $email = 'admin_elins@demo.app';
                    $prodi_id = 2;
                    break;
                default:
                    $email = $faker->email();
                    $prodi_id = $faker->numberBetween(1, 10);
                    break;
            }

            $this->db->table('auth_identities')->insert([
                'user_id'      => $i,
                'type'         => 'email_password',
                'secret'       => $email,
                'secret2'      => '$2y$10$zOkXdWfd1kq2Dw7VBlgKZOsnXSL1R6V9jlloTQicwVhHMnosLJl/a',
                'last_used_at' => '2023-01-01 00:00:00',
                'created_at'   => '2023-01-01 00:00:00',
            ]);

            $this->db->table('auth_groups_users')->insert([
                'user_id'    => $i,
                'group'      => $i == 1 ? 'admin' : 'admin_prodi',
                'created_at' => '2023-01-01 00:00:00',
            ]);

            $model->save([
                'user_id'  => $i,
                'nip'      => $faker->numerify('NIP#####'),
                'prodi_id' => $prodi_id,
                'nama'     => $faker->name(),
                'telepon'  => $faker->phoneNumber()
            ]);
        }
    }
}