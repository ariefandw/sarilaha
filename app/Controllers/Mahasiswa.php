<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new \App\Models\Mahasiswa();
    }

    public function getIndex()
    {
        $data       = $this->request->getGet();
        $q          = $data['q'] ?? '';
        $mahasiswas = $this->mahasiswaModel->where("CONCAT(nim, nama, angkatan, telepon) LIKE '%{$q}%'")->paginate(10);
        $data       = [
            'rows'  => $mahasiswas,
            'pager' => $this->mahasiswaModel->pager,
            'q'     => $q,
        ];
        return view('mahasiswa/index', $data);
    }

    public function getNew()
    {
        $data = [
            'row'    => $this->mahasiswaModel,
            'action' => 'create',
        ];
        return view('mahasiswa/form', $data);
    }

    public function postCreate()
    {
        $data = $this->request->getPost();
        $this->mahasiswaModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('mahasiswa'));
    }

    public function getEdit($id)
    {
        $data = [
            'row'    => $this->mahasiswaModel->find($id),
            'action' => 'update',
        ];
        return view('mahasiswa/form', $data);
    }

    public function postUpdate($id)
    {
        $data = $this->request->getPost();
        $this->mahasiswaModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('mahasiswa'));
    }

    public function postDelete($id)
    {
        $this->mahasiswaModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        $this->response->redirect(site_url('mahasiswa'));
    }

}