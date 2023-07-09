<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dosen extends BaseController
{
    protected $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new \App\Models\Dosen();
    }

    public function getIndex()
    {
        $data   = $this->request->getGet();
        $q      = $data['q'] ?? '';
        $dosens = $this->dosenModel->where("CONCAT(nip, nama, telepon) LIKE '%{$q}%'")->paginate(10);
        $data   = [
            'rows'  => $dosens,
            'pager' => $this->dosenModel->pager,
            'q'     => $q,
        ];
        return view('dosen/index', $data);
    }

    public function getNew()
    {
        $data = [
            'row'    => $this->dosenModel,
            'action' => 'create',
        ];
        return view('dosen/form', $data);
    }

    public function postCreate()
    {
        $data = $this->request->getPost();
        $this->dosenModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('dosen'));
    }

    public function getEdit($id)
    {
        $data = [
            'row'    => $this->dosenModel->find($id),
            'action' => 'update',
        ];
        return view('dosen/form', $data);
    }

    public function postUpdate($id)
    {
        $data = $this->request->getPost();
        $this->dosenModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('dosen'));
    }

    public function postDelete($id)
    {
        $this->dosenModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        $this->response->redirect(site_url('dosen'));
    }

}