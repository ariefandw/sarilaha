<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisUjian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'prodi_id'          => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'nama_ujian'        => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'jumlah_pembimbing' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1,
            ],
            'jumlah_penguji'    => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1,
            ],
            'semester_ditempuh' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'sks_ditempuh'      => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'bobot_pembimbing'  => [
                'type'       => 'DECIMAL',
                'constraint' => '4,2',
                'default'    => 0,
            ],
            'bobot_penguji'     => [
                'type'       => 'DECIMAL',
                'constraint' => '4,2',
                'default'    => 0,
            ],
            'created_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis_ujian');
    }

    public function down()
    {
        $this->forge->dropTable('jenis_ujian');
    }
}