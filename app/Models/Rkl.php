<?php

namespace App\Models;

use CodeIgniter\Model;

class Rkl extends Model
{
    protected $table = 'rkl';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tahapan',
        'kegiatan',
        'sumber_dampak',
        'jenis_limbah',
        'besaran_dampak',
        'cara_pengelolaan',
        'tolok_ukur_pengelolaan',
        'cara_pemantauan',
        'tolok_ukur_pemantauan',
        'lampiran',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'object';
}