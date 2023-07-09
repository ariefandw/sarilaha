<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UjianPembimbing extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ujian_id'       => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'dosen_id'       => [
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
            'approve_revisi' => [
                'type'    => 'TINYINT',
                'default' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['ujian_id', 'dosen_id', 'penilaian_id']);
        $this->forge->createTable('ujian_pembimbing');
    }

    public function down()
    {
        $this->forge->dropTable('ujian_pembimbing');
    }
}