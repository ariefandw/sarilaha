<?php

namespace App\Models;

use CodeIgniter\Model;

class Perusahaan extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'perusahaan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id', 
        'nama', 
        'email', 
        'password', 
        'phone', 
        'jabatan', 
        'nama_perusahaan', 
        'faks_perusahaan', 
        'kode_kbli', 
        'jenis_industri', 
        'formulir_registrasi'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}