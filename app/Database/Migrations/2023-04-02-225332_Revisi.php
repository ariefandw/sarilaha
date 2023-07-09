<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Revisi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ujian_id'      => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'versi'         => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'drive_file_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'catatan'       => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['ujian_id', 'versi']);
        $this->forge->createTable('revisi');
    }

    public function down()
    {
        $this->forge->dropTable('revisi');
    }
}