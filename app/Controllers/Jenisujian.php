<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Jenisujian extends BaseController
{
    protected $jenisUjianModel;
    protected $penilaianModel;
    protected $berkasSyaratModel;

    public function __construct()
    {
        $this->jenisUjianModel   = new \App\Models\JenisUjian();
        $this->penilaianModel    = new \App\Models\Penilaian();
        $this->berkasSyaratModel = new \App\Models\BerkasSyarat();
    }

    public function getIndex()
    {
        if (!in_array(session('user')['group'], ['admin', 'admin_prodi']))
            return view('errors/html/error_403');

        $data        = $this->request->getGet();
        $q           = $data['q'] ?? '';
        $jenisUjians = $this->jenisUjianModel
            ->select('jenis_ujian.*, prodi.nama_prodi')
            ->join('prodi', 'prodi.id = jenis_ujian.prodi_id')
            ->where("CONCAT(nama_ujian) LIKE '%{$q}%'");

        if (in_array(session('user')['group'], ['admin_prodi'])) {
            $jenisUjians = $jenisUjians
                ->where('prodi_id', session('user')['prodi_id']);
        }

        $jenisUjians = $jenisUjians
            ->orderBy('prodi_id')
            ->orderBy('nama_ujian')
            ->paginate(10);
        $data        = [
            'rows'  => $jenisUjians,
            'pager' => $this->jenisUjianModel->pager,
            'q'     => $q,
        ];
        return view('jenis-ujian/index', $data);
    }

    public function getNew()
    {
        // $p1 = new \App\Models\Penilaian();
        // $p2 = new \App\Models\Penilaian();
        // $p1->nama_penilaian = 'Nilai pembimbing';
        // $p1->bobot          = '1';
        // $p2->nama_penilaian = 'Nilai penguji';
        // $p2->bobot          = '1';
        // $penilaians = [$p1, $p2];

        $data = [
            'row'        => $this->jenisUjianModel,
            'action'     => 'create',
            'prodis'     => (new \App\Models\Prodi())->findAll(),
            'penilaians' => [],
            //$penilaians,
            'berkases'   => [],
        ];
        return view('jenis-ujian/form', $data);
    }

    public function postCreate()
    {
        if (!in_array(session('user')['group'], ['admin', 'admin_prodi']))
            return view('errors/html/error_403');
        $data = $this->request->getPost();
        $this->jenisUjianModel->insert($data);

        //Penilaian
        foreach ($data['penilaians'] as $penilaian) {
            $penilaian['jenis_ujian_id'] = $this->jenisUjianModel->getInsertID();
            $this->penilaianModel->save($penilaian);
        }

        //Berkas
        foreach ($data['berkases'] as $berkas) {
            $berkas['jenis_ujian_id'] = $this->jenisUjianModel->getInsertID();
            $this->berkasSyaratModel->save($berkas);
        }

        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('jenisujian'));
    }

    public function getEdit($id)
    {
        $penilaians = $this->penilaianModel->where('jenis_ujian_id', $id)->findAll();
        $berkases   = $this->berkasSyaratModel->where('jenis_ujian_id', $id)->findAll();
        $data       = [
            'row'        => $this->jenisUjianModel->find($id),
            'action'     => 'update',
            'prodis'     => (new \App\Models\Prodi())->findAll(),
            'penilaians' => $penilaians,
            'berkases'   => $berkases,
        ];
        return view('jenis-ujian/form', $data);
    }

    public function postUpdate($id)
    {
        if (!in_array(session('user')['group'], ['admin', 'admin_prodi']))
            return view('errors/html/error_403');

        $data = $this->request->getPost();
        $this->jenisUjianModel->update($id, $data);

        //Penilaian
        $penilaians = $data['penilaians'];
        $this->penilaianModel
            ->where('jenis_ujian_id', $id)
            ->whereNotIn('id', array_column($penilaians, "id"))
            ->delete();
        foreach ($penilaians as $penilaian) {
            $penilaian['jenis_ujian_id'] = $id;
            $this->penilaianModel->save($penilaian);
        }

        //Berkas
        $berkases = $data['berkases'];
        $this->berkasSyaratModel
            ->where('jenis_ujian_id', $id)
            ->whereNotIn('id', array_column($berkases, "id"))
            ->delete();
        foreach ($berkases as $berkas) {
            $berkas['jenis_ujian_id'] = $id;
            $this->berkasSyaratModel->save($berkas);
        }

        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('jenisujian'));
    }

    public function postDelete($id)
    {
        if (!in_array(session('user')['group'], ['admin', 'admin_prodi']))
            return view('errors/html/error_403');

        $this->jenisUjianModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        $this->response->redirect(site_url('jenisujian'));
    }

}