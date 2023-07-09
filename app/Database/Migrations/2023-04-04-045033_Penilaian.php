<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penilaian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jenis_ujian_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'nama_penilaian' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'bobot'          => [
                'type'       => 'DECIMAL',
                'constraint' => '4,2',
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('penilaian');
    }

    public function down()
    {
        $this->forge->dropTable('penilaian');
    }
}