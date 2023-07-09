<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rkl extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                     => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tahapan'                => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'kegiatan'               => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sumber_dampak'          => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_limbah'           => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'besaran_dampak'         => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cara_pengelolaan'       => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tolok_ukur_pengelolaan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cara_pemantauan'        => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tolok_ukur_pemantauan'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'lampiran'               => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at'             => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'             => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('rkl');
    }

    public function down()
    {
        $this->forge->dropTable('rkl');
    }
}