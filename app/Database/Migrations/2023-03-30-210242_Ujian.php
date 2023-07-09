<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ujian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jenis_ujian_id'    => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'mahasiswa_id'      => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'judul'             => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null'       => true,
            ],
            'tanggal_ujian'     => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'ruang_ujian'       => [
                'type' => 'VARCHAR(50)',
                'null' => true,
            ],
            'nilai_akhir_angka' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'nilai_akhir_huruf' => [
                'type' => 'VARCHAR(10)',
                'null' => true,
            ],
            'status'            => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1,
            ],
            'catatan'           => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('ujian');
    }

    public function down()
    {
        $this->forge->dropTable('ujian');
    }
}