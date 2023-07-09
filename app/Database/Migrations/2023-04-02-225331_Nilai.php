<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UjianNilai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ujian_dosen_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'penilaian_id'   => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'nilai'          => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['ujian_dosen_id', 'penilaian_id']);
        $this->forge->createTable('nilai');
    }

    public function down()
    {
        $this->forge->dropTable('nilai');
    }
}