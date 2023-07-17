<?php

namespace App\Controllers;

use App\Models\Perusahaan;
use Hybridauth\User\Profile;

class Home extends BaseController
{
    public function index()
    {
        $db   = \Config\Database::connect();
        $row  = $db->query("SELECT COUNT(1) total, SUM(IF(status='baru', 1, 0)) baru, SUM(IF(status='diterima', 1, 0)) diterima, SUM(IF(status='ditolak', 1, 0)) ditolak FROM rkl")->getResult()[0];
        $data = [
            'total'      => $row->total,
            'baru'       => $row->baru,
            'diterima'   => $row->diterima,
            'ditolak'    => $row->ditolak,
            'perusahaan' => $db->query("SELECT COUNT(1) perusahaan FROM perusahaan")->getResult()[0]->perusahaan,
        ];
        return view('home/index', $data);
    }

    public function profil()
    {
        $perusahaan         = (new Perusahaan())->find(session('user')['profile']->id);
        $data['perusahaan'] = $perusahaan;
        return view('home/profil', $data);
    }

    public function updateprofil()
    {
        $data = $this->request->getPost();
        (new Perusahaan())->update(session('user')['profile']->id, $data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('/'));
    }
}