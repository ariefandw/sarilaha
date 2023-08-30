<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use chillerlan\QRCode\QRCode;
use Dompdf\Dompdf;

class Rkl extends BaseController
{
    protected $prodiModel;
    protected $rklModel;

    public function __construct()
    {
        $this->prodiModel = new \App\Models\Prodi();
        $this->rklModel   = new \App\Models\Rkl();
    }

    public function getIndex()
    {
        $data = $this->request->getGet();
        $q    = $data['q'] ?? '';
        $rkls = $this->rklModel->join('perusahaan', 'perusahaan.id = rkl.perusahaan_id')->where("CONCAT(IFNULL(kegiatan, '')) LIKE '%{$q}%'");
        if(session('user')['group'] == 'user') $rkls = $rkls->where('perusahaan_id', session('user')['profile']->id);
        $rkls = $rkls->paginate(15);
        $data = [
            'rows'  => $rkls,
            'pager' => $this->rklModel->pager,
            'q'     => $q,
        ];
        return view('rkl/index', $data);
    }

    public function getNew()
    {
        $data = [
            'row'    => $this->prodiModel,
            'action' => 'create',
        ];
        return view('rkl/form', $data);
    }

    public function postCreate()
    {
        $data = $this->request->getPost();

        $file    = $this->request->getFile('lampiran');
        $newName = (new \Hidehalo\Nanoid\Client())->generateId() . '.' . $file->getExtension();
        $file->move(ROOTPATH . 'public/uploads', $newName);

        $data['lampiran']      = $newName;
        $data['status']        = 'baru';
        $data['perusahaan_id'] = session('user')['group'] == 'admin' ? 0 : session('user')['profile']->id;
        $this->rklModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('rkl'));
    }

    public function getEdit($id)
    {
        $data = [
            'row'    => $this->rklModel->find($id),
            'action' => 'update',
        ];
        return view('rkl/form', $data);
    }

    public function postUpdate($id)
    {
        $data = $this->request->getPost();

        $file = $this->request->getFile('lampiran');
        if ($file->isValid() && !$file->getError()) {
            $newName = (new \Hidehalo\Nanoid\Client())->generateId() . '.' . $file->getExtension();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $data['lampiran'] = $newName;
        }

        $this->rklModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('rkl'));
    }

    public function postDelete($id)
    {
        $this->prodiModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        $this->response->redirect(site_url('prodi'));
    }

    public function getTte($id, $save = false)
    {
        $row = $this->rklModel
            ->join('perusahaan', 'perusahaan.id = rkl.perusahaan_id')
            ->where('lampiran', $id)
            ->first();

        if (($row->status ?? '') != 'diterima') {
            return '<h1>Anda belum memiliki ijin yang diterima dari surat ini</h1>';
        }

        $filename = date('y-m-d_H.i.s') . '-tte';

        $dompdf = new Dompdf();
        $qr     = (new QRCode)->render("https://sarilaha.web.id/index.php/rkl/tte/" . $row->lampiran);

        $data = [
            'row'    => $row,
            'id_tte' => explode('.', $row->lampiran)[0],
            'qr'     => $qr,
        ];

        $dompdf->getOptions()->setChroot(FCPATH);


        $dompdf->loadHtml(view('rkl/tte', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if ($save) {
            file_put_contents("upload/surat_tugas/$id.pdf", $dompdf->output());
            file_put_contents("validasi/$id.pdf", $dompdf->output());
        } else {
            $dompdf->stream("$filename.pdf", ['Attachment' => 0]);
            exit;
        }
    }

}
