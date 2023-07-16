<?php

namespace App\Controllers;

use App\Models\Perusahaan;
use Hybridauth\User\Profile;

class Home extends BaseController
{
    public function index()
    {
        return view('home/index');
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