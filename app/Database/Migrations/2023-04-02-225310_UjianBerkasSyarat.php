<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UjianBerkasSyarat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'ujian_id'         => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'berkas_syarat_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'ext'              => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['ujian_id', 'berkas_syarat_id']);
        $this->forge->createTable('ujian_berkas_syarat');
    }

    public function down()
    {
        $this->forge->dropTable('ujian_berkas_syarat');
    }
}