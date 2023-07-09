<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UjianDosen extends Migration
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
            'peran'          => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'default'    => 'pembimbing',
            ],
            'approve_revisi' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['ujian_id', 'dosen_id']);
        $this->forge->createTable('ujian_dosen');
    }

    public function down()
    {
        $this->forge->dropTable('ujian_dosen');
    }
}