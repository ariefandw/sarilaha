<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perusahaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                  => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'             => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'nama'                => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email'               => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'password'            => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'phone'               => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'jabatan'             => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'nama_holding'        => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat_holding'      => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'phone_holding'       => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'faks_holding'        => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'nama_perusahaan'     => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat_perusahaan'   => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'phone_perusahaan'    => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'faks_perusahaan'     => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'kota_perusahaan'     => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'kode_kbli'           => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'jenis_industri'      => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'formulir_registrasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at'          => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'          => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('perusahaan');
    }

    public function down()
    {
        $this->forge->dropTable('perusahaan');
    }
}