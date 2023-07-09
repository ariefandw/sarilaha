<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BerkasSyarat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                 => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jenis_ujian_id'     => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'nama_berkas_syarat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('berkas_syarat');
    }

    public function down()
    {
        $this->forge->dropTable('berkas_syarat');
    }
}