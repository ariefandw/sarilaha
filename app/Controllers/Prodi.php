<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Prodi extends BaseController
{
    protected $prodiModel;

    public function __construct()
    {
        $this->prodiModel = new \App\Models\Prodi();
    }

    public function getIndex()
    {
        $data   = $this->request->getGet();
        $q      = $data['q'] ?? '';
        $prodis = $this->prodiModel->where("CONCAT(IFNULL(kode_prodi, ''), nama_prodi) LIKE '%{$q}%'")->paginate(30);
        $data   = [
            'rows'  => $prodis,
            'pager' => $this->prodiModel->pager,
            'q'     => $q,
        ];
        return view('prodi/index', $data);
    }

    public function getNew()
    {
        $data = [
            'row'    => $this->prodiModel,
            'action' => 'create',
        ];
        return view('prodi/form', $data);
    }

    public function postCreate()
    {
        $data = $this->request->getPost();
        $this->prodiModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('prodi'));
    }

    public function getEdit($id)
    {
        $data = [
            'row'    => $this->prodiModel->find($id),
            'action' => 'update',
        ];
        return view('prodi/form', $data);
    }

    public function postUpdate($id)
    {
        $data = $this->request->getPost();
        $this->prodiModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('prodi'));
    }

    public function postDelete($id)
    {
        $this->prodiModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        $this->response->redirect(site_url('prodi'));
    }

}