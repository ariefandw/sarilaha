<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Perusahaan extends BaseController
{
    protected $perusahaanModel;

    public function __construct()
    {
        $this->perusahaanModel = new \App\Models\Perusahaan();
    }

    public function getIndex()
    {
        $data   = $this->request->getGet();
        $q      = $data['q'] ?? '';
        $perusahaans = $this->perusahaanModel->where("CONCAT(nama) LIKE '%{$q}%'")->paginate(10);
        $data   = [
            'rows'  => $perusahaans,
            'pager' => $this->perusahaanModel->pager,
            'q'     => $q,
        ];
        return view('perusahaan/index', $data);
    }

    public function getNew()
    {
        $data = [
            'row'    => $this->perusahaanModel,
            'action' => 'create',
        ];
        return view('perusahaan/form', $data);
    }

    public function postCreate()
    {
        $data = $this->request->getPost();
        $this->perusahaanModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('perusahaan'));
    }

    public function getEdit($id)
    {
        $data = [
            'row'    => $this->perusahaanModel->find($id),
            'action' => 'update',
        ];
        return view('perusahaan/form', $data);
    }

    public function postUpdate($id)
    {
        $data = $this->request->getPost();
        $this->perusahaanModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('perusahaan'));
    }

    public function postDelete($id)
    {
        $this->perusahaanModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        $this->response->redirect(site_url('perusahaan'));
    }

}