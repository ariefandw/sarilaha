<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Auth extends Seeder
{
    public function run()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->table('auth_logins')->truncate();
        $this->db->table('auth_remember_tokens')->truncate();
        $this->db->table('auth_token_logins')->truncate();
        $this->db->table('auth_permissions_users')->truncate();
        $this->db->table('auth_groups_users')->truncate();
        $this->db->table('auth_identities')->truncate();
        $this->db->table('users')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        // $this->db->table('users')->insert([
        //     'username'    => 'admin',
        //     'active'      => 1,
        //     'last_active' => '2023-01-01 00:00:00',
        //     'created_at'  => '2023-01-01 00:00:00',
        // ]);

        // $this->db->table('auth_identities')->insert([
        //     'user_id'      => 1,
        //     'type'         => 'email_password',
        //     'secret'       => 'admin@test.app',
        //     'secret2'      => '$2y$10$zOkXdWfd1kq2Dw7VBlgKZOsnXSL1R6V9jlloTQicwVhHMnosLJl/a',
        //     'last_used_at' => '2023-01-01 00:00:00',
        //     'created_at'   => '2023-01-01 00:00:00',
        // ]);

        // $this->db->table('auth_groups_users')->insert([
        //     'user_id'    => 1,
        //     'group'      => 'admin',
        //     'created_at' => '2023-01-01 00:00:00',
        // ]);
    }
}