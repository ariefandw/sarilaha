<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\GoogleApi;
use App\Models\StatusUjian;
use chillerlan\QRCode\{QRCode, QROptions};
use Dompdf\Dompdf;
use Google\Service\Drive;
use Hidehalo\Nanoid\Client;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Ujian extends BaseController
{
    protected $db;
    protected $berkasModel;
    protected $penilaianModel;
    protected $dosenModel;
    protected $ujianModel;
    protected $ujianBerkasModel;
    protected $ujianDosenModel;
    protected $nilaiModel;
    protected $revisiModel;

    public function __construct()
    {
        $db                     = \Config\Database::connect();
        $this->berkasModel      = new \App\Models\BerkasSyarat();
        $this->penilaianModel   = new \App\Models\Penilaian();
        $this->dosenModel       = new \App\Models\Dosen();
        $this->ujianModel       = new \App\Models\Ujian();
        $this->ujianBerkasModel = new \App\Models\UjianBerkasSyarat();
        $this->ujianDosenModel  = new \App\Models\UjianDosen();
        $this->nilaiModel       = new \App\Models\Nilai();
        $this->revisiModel      = new \App\Models\Revisi();
    }

    public function getIndex()
    {
        $data = $this->request->getGet();
        $q    = $data['q'] ?? '';

        $ujians = $this->ujianModel
            ->select("ujian.*, mahasiswa.nim, mahasiswa.nama, prodi.nama_prodi, 
                IF(tanggal_ujian IS NULL, '1', 
                IF(NOW() <= tanggal_ujian, '1', 
                IF(NOW() > tanggal_ujian AND jumlah_approve >= (jumlah_pembimbing + jumlah_penguji), '3', '2'))) status_ujian
            ")
            ->join('jenis_ujian', 'jenis_ujian.id = ujian.jenis_ujian_id')
            ->join('mahasiswa', 'mahasiswa.id = ujian.mahasiswa_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->join('(SELECT MAX(ujian_id) ujian_id, COUNT(1) jumlah_approve FROM ujian_dosen WHERE approve_revisi = 1) ujian_approve', 'ujian.id = ujian_approve.ujian_id', 'left');

        if (session('user')['group'] == 'dosen') {
            $dosen  = (new \App\Models\Dosen())->where('user_id', session('user')['id'])->first();
            $ujians = $ujians->join('ujian_dosen', 'ujian.id = ujian_dosen.ujian_id')
                ->where('dosen_id', $dosen->id)
                ->where('tanggal_ujian IS NOT NULL');
        }

        if (session('user')['group'] == 'mahasiswa') {
            $mahasiswa = (new \App\Models\Mahasiswa())->where('user_id', session('user')['id'])->first();
            $ujians    = $ujians->where('mahasiswa_id', $mahasiswa->id);
        }

        if (session('user')['group'] == 'admin_prodi') {
            $ujians = $ujians->where('mahasiswa.prodi_id', session('user')['prodi_id']);
        }

        $ujians = $ujians->where("CONCAT(IFNULL(judul, '')) LIKE '%{$q}%'")
            // ->orderBy('tanggal_ujian', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'rows'         => $ujians,
            'pager'        => $this->ujianModel->pager,
            'q'            => $q,
            'jenis_ujians' => (new \App\Models\JenisUjian())->orderBy('nama_ujian', 'asc')->findAll(),
        ];
        return view('ujian/index', $data);
    }

    public function getNew($jenis_ujian_id = null)
    {
        if (!in_array(session('user')['group'], ['mahasiswa']))
            return view('errors/html/error_403');

        $jenis_ujian = isset($jenis_ujian_id) ? (new \App\Models\JenisUjian())->find($jenis_ujian_id) : null;


        $berkases = $this->berkasModel
            ->select('berkas_syarat.id, nama_berkas_syarat')
            ->where('jenis_ujian_id', $jenis_ujian_id)
            ->findAll();

        $data = [
            'action'       => 'create',
            'row'          => $this->ujianModel,
            'jenis_ujian'  => $jenis_ujian,
            'dosens'       => (new \App\Models\Dosen())->orderBy('nama', 'asc')->findAll(),
            'mahasiswa'    => $mahasiswa = (new \App\Models\Mahasiswa())->where('user_id', session('user')['id'])->first(),
            'jenis_ujians' => (new \App\Models\JenisUjian())->where('prodi_id', $mahasiswa->prodi_id)->orderBy('nama_ujian', 'asc')->findAll(),
            'berkases'     => $berkases,
        ];
        return view('ujian/form', $data);
    }

    public function postCreate()
    {
        if (!in_array(session('user')['group'], ['admin', 'mahasiswa']))
            return view('errors/html/error_403');

        $data                  = $this->request->getPost();
        $mahasiswa             = (new \App\Models\Mahasiswa())->where('user_id', session('user')['id'])->first();
        $data['mahasiswa_id']  = $mahasiswa->id;
        $data['tanggal_ujian'] = empty($data['tanggal_ujian']) ? null : $data['tanggal_ujian'];
        $data['status']        = StatusUjian::BARU->value;
        $this->ujianModel->insert($data);

        // === Berkas ===
        foreach ($this->request->getFiles()['berkas'] as $key => $file) {
            $ext = $file->getExtension();
            $id  = (new Client())->formattedId('0123456789abcdefghijklmnopqrstuvwxyz', 16);
            $file->move('upload/berkas_syarat', $id . '.' . $ext);
            $this->ujianBerkasModel->insert([
                'id'               => $id,
                'ujian_id'         => $this->ujianModel->getInsertID(),
                'berkas_syarat_id' => $key,
                'ext'              => $ext,
            ]);
        }
        $folderId = GoogleApi::create_folder($this->ujianModel->getInsertID());
        $dokumen  = $this->request->getFile('laporan');
        $fileId   = GoogleApi::upload($dokumen, $folderId)->getId();
        $this->revisiModel->insert([
            'ujian_id'      => $this->ujianModel->getInsertID(),
            'versi'         => 1,
            'drive_file_id' => $fileId,
        ]);

        // === Dosen Pembimbing ===
        foreach ($data['dosen_pembimbing'] as $dosen_id) {
            $this->ujianDosenModel->insert([
                'ujian_id'       => $this->ujianModel->getInsertID(),
                'dosen_id'       => $dosen_id,
                'peran'          => 'pembimbing',
                'approve_revisi' => 0,
            ]);
            // foreach ($this->penilaianModel->where('jenis_ujian_id', $data['jenis_ujian_id'])->findAll() as $penilaian) {
            //     $this->nilaiModel->insert([
            //         'ujian_dosen_id' => $this->ujianDosenModel->getInsertID(),
            //         'penilaian_id'   => $penilaian->id,
            //         'nilai'          => 0,
            //     ]);
            // }
        }

        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('ujian'));
    }

    private function getPembimbingPenguji($id_ujian)
    {
        $dosens = $this->ujianDosenModel
            ->select('dosen_id id, nama, peran')
            ->join('dosen', 'dosen.id = ujian_dosen.dosen_id')
            ->where('ujian_id', $id_ujian)
            ->orderBy('nama')
            ->findAll();
        $dosen  = [];
        foreach ($dosens as $d) {
            $dosen[$d->peran][] = $d;
        }
        return [$dosen['pembimbing'] ?? [], $dosen['penguji'] ?? []];
    }

    public function getEdit($id)
    {
        $row = $this->ujianModel->find($id);

        $jenis_ujian = (new \App\Models\JenisUjian())->find($row->jenis_ujian_id);

        $berkases = $this->berkasModel
            ->select('berkas_syarat.id, nama_berkas_syarat, ujian_berkas_syarat.id ujian_berkas_syarat_id, ext')
            ->join('ujian_berkas_syarat', 'ujian_berkas_syarat.berkas_syarat_id = berkas_syarat.id', 'left')
            ->where('jenis_ujian_id', $row->jenis_ujian_id)
            ->where('ujian_berkas_syarat.ujian_id', $row->id)
            ->orderBy('nama_berkas_syarat')
            ->findAll();

        [$pembimbings, $pengujis] = $this->getPembimbingPenguji($id);

        for ($i = count($pembimbings); $i < $jenis_ujian->jumlah_pembimbing; $i++) {
            $pembimbings[] = new \App\Models\Dosen();
        }

        for ($i = count($pengujis); $i < $jenis_ujian->jumlah_penguji; $i++) {
            $pengujis[] = new \App\Models\Dosen();
        }

        $revisis = $this->revisiModel->where('ujian_id', $id)->findAll();

        $data = [
            'action'       => 'update',
            'row'          => $row,
            'jenis_ujian'  => $jenis_ujian,
            'dosens'       => (new \App\Models\Dosen())->orderBy('nama', 'asc')->findAll(),
            'mahasiswa'    => $mahasiswa = (new \App\Models\Mahasiswa())->where('id', $row->mahasiswa_id)->first(),
            'jenis_ujians' => (new \App\Models\JenisUjian())->where('prodi_id', $mahasiswa->prodi_id)->orderBy('nama_ujian', 'asc')->findAll(),
            'berkases'     => $berkases,
            'pembimbings'  => $pembimbings,
            'pengujis'     => $pengujis,
            'revisis'      => $revisis,

        ];
        return view('ujian/form', $data);
    }

    public function getShow($id)
    {
        [$pembimbings, $pengujis] = $this->getPembimbingPenguji($id);
        $row                      = $this->ujianModel
            ->select("ujian.*, 
                IF(tanggal_ujian IS NULL, '1', 
                IF(NOW() <= tanggal_ujian, '1', 
                IF(NOW() > tanggal_ujian AND jumlah_approve >= (jumlah_pembimbing + jumlah_penguji), '3', '2'))) status_ujian
            ")
            ->join('jenis_ujian', 'jenis_ujian.id = ujian.jenis_ujian_id')
            ->join('(SELECT MAX(ujian_id) ujian_id, COUNT(1) jumlah_approve FROM ujian_dosen WHERE approve_revisi = 1) ujian_approve', 'ujian.id = ujian_approve.ujian_id', 'left')
            ->where('ujian.id', $id)
            ->first();
        $nilai_akhir              = $this->ujianModel
            ->select("
                (SUM(IF(peran = 'pembimbing', (nilai * bobot), 0)) * MAX(bobot_pembimbing) + 
                SUM(IF(peran = 'penguji', (nilai * bobot), 0)) * MAX(bobot_penguji)) / 
                (jumlah_pembimbing * MAX(bobot_pembimbing) + jumlah_penguji * MAX(bobot_penguji))
                nilai_akhir
            ")
            ->join('jenis_ujian', 'ujian.jenis_ujian_id = jenis_ujian.id')
            ->join('ujian_dosen', 'ujian_dosen.ujian_id = ujian.id')
            ->join('nilai', 'ujian_dosen.id = nilai.ujian_dosen_id')
            ->join('penilaian', 'penilaian.id = nilai.penilaian_id')
            ->where('ujian.id', $id)
            ->first()->nilai_akhir ?? 0;

        $revisis = $this->revisiModel->where('ujian_id', $id)->findAll();

        $data = [
            'row'          => $row,
            'jenis_ujian'  => (new \App\Models\JenisUjian())->find($row->jenis_ujian_id),
            'dosens'       => (new \App\Models\Dosen())->orderBy('nama', 'asc')->findAll(),
            'mahasiswa'    => $mahasiswa = (new \App\Models\Mahasiswa())->where('id', $row->mahasiswa_id)->first(),
            'jenis_ujians' => (new \App\Models\JenisUjian())->where('prodi_id', $mahasiswa->prodi_id)->orderBy('nama_ujian', 'asc')->findAll(),
            'pembimbings'  => $pembimbings,
            'pengujis'     => $pengujis,
            'nilai_akhir'  => $nilai_akhir,
            'revisis'      => $revisis,
        ];
        return view('ujian/show', $data);
    }

    public function getNilai($id)
    {
        if (!in_array(session('user')['group'], ['dosen']))
            return view('errors/html/error_403');

        $dosen  = (new \App\Models\Dosen())
            ->select('dosen.id id, nama, peran, bobot_pembimbing, bobot_penguji')
            ->join('ujian_dosen', 'ujian_dosen.dosen_id = dosen.id')
            ->join('ujian', 'ujian.id = ujian_dosen.ujian_id')
            ->join('jenis_ujian', 'jenis_ujian.id = ujian.jenis_ujian_id')
            ->where('ujian_dosen.ujian_id', $id)
            ->where('user_id', session('user')['id'])->first();
        $nilais = $this->nilaiModel
            ->select('nilai.id id, nama_penilaian, nilai, bobot')
            ->join('ujian_dosen', 'ujian_dosen.id = nilai.ujian_dosen_id')
            ->join('ujian', 'ujian.id = ujian_dosen.ujian_id')
            ->join('jenis_ujian', 'jenis_ujian.id = ujian.jenis_ujian_id')
            ->join('penilaian', 'penilaian.id = nilai.penilaian_id')
            ->where('ujian_dosen.ujian_id', $id)
            ->where('dosen_id', $dosen->id)
            ->orderBy('nama_penilaian', 'asc')
            ->findAll();

        $revisis = $this->revisiModel->where('ujian_id', $id)->findAll();
        $data    = [
            'row'         => $row = $this->ujianModel->join('ujian_dosen', 'ujian_dosen.ujian_id = ujian.id')->where('dosen_id', $dosen->id)->find($id),
            'jenis_ujian' => (new \App\Models\JenisUjian())->find($row->jenis_ujian_id),
            'nilais'      => $nilais,
            'mahasiswa'   => (new \App\Models\Mahasiswa())->where('id', $row->mahasiswa_id)->first(),
            'dosen'       => $dosen,
            'revisis'     => $revisis,
        ];
        return view('ujian/nilai', $data);
    }

    public function postNilai()
    {
        if (!in_array(session('user')['group'], ['dosen']))
            return view('errors/html/error_403');

        $data = $this->request->getPost();
        foreach ($data['nilai'] as $id => $nilai) {
            $this->nilaiModel->update($id, ['nilai' => $nilai]);
        }

        foreach ($data['catatan'] as $id => $catatan) {
            $this->revisiModel->update($id, ['catatan' => $catatan]);
        }

        $data['approve_revisi'] = $data['approve_revisi'] ?? 0;
        $this->ujianDosenModel->update($data['id'], $data);
        $this->response->redirect(site_url('ujian'));
    }

    public function postUploadrevisi($id)
    {
        if (!in_array(session('user')['group'], ['admin', 'mahasiswa']))
            return view('errors/html/error_403');

        $versiTerakhir = $this->revisiModel->selectMax('versi')->where('ujian_id', $id)->first()->versi ?? 0;
        $folderId      = GoogleApi::findFolderByName($id);
        $dokumen       = $this->request->getFile('laporan');
        $fileId        = GoogleApi::upload($dokumen, $folderId)->getId();
        $this->revisiModel->insert([
            'ujian_id'      => $id,
            'versi'         => ((int) $versiTerakhir) + 1,
            'drive_file_id' => $fileId,
        ]);

        $this->response->redirect(site_url('ujian/show/' . $id));
    }

    public function postUpdate($id)
    {
        $ujian = $this->ujianModel->find($id);

        if (!in_array(session('user')['group'], ['admin', 'admin_prodi', 'dosen']))
            return view('errors/html/error_403');

        if (
            in_array(session('user')['group'], ['admin_prodi']) &&
            (!empty($ujian->tanggal_ujian) ? strtotime(now()) >= strtotime($ujian->tanggal_ujian) : false)
        )
            return view('errors/html/error_403');

        $data = $this->request->getPost();
        if (!empty($data['tanggal_ujian']))
            $data['tanggal_ujian'] = $data['tanggal_ujian'] . ' ' . $data['waktu_ujian'];
        $this->ujianModel->update($id, $data);

        if (!in_array(session('user')['group'], ['dosen'])) {

            foreach ($this->ujianDosenModel->where('ujian_id', $id)->findAll() as $row) {
                $this->nilaiModel->where('ujian_dosen_id', $row->id)->delete();
            }
            $this->ujianDosenModel->where('ujian_id', $id)->delete();

            // === Dosen Pembimbing ===
            foreach ($data['dosen_pembimbing'] as $dosen_id) {
                $this->ujianDosenModel->insert([
                    'ujian_id' => $id,
                    'dosen_id' => $dosen_id,
                    'peran'    => 'pembimbing',
                ]);
                foreach ($this->penilaianModel->where('jenis_ujian_id', $data['jenis_ujian_id'])->findAll() as $penilaian) {
                    $this->nilaiModel->insert([
                        'ujian_dosen_id' => $this->ujianDosenModel->getInsertID(),
                        'penilaian_id'   => $penilaian->id,
                        'nilai'          => 0,
                    ]);
                }
            }

            // === Dosen Penguji ===
            foreach ($data['dosen_penguji'] as $dosen_id) {
                $this->ujianDosenModel->insert([
                    'ujian_id' => $id,
                    'dosen_id' => $dosen_id,
                    'peran'    => 'penguji',
                ]);
                foreach ($this->penilaianModel->where('jenis_ujian_id', $data['jenis_ujian_id'])->findAll() as $penilaian) {
                    $this->nilaiModel->insert([
                        'ujian_dosen_id' => $this->ujianDosenModel->getInsertID(),
                        'penilaian_id'   => $penilaian->id,
                        'nilai'          => 0,
                    ]);
                }
            }
        } else {

            foreach ($data['ujian_pembimbing'] as $id => $ujian_pembimbing) {
                $data = [
                    'nilai'          => $ujian_pembimbing['nilai'],
                    'approve_revisi' => isset($ujian_pembimbing['approve_revisi']) ? $ujian_pembimbing['approve_revisi'] : 0,
                ];
                $this->ujianDosenModel->update($id, $data);
            }

            foreach ($data['ujian_penguji'] as $id => $ujian_penguji) {
                $this->ujianDosenModel->update($id, $ujian_penguji);
            }

        }

        session()->setFlashdata('success', 'Data berhasil disimpan');
        $this->response->redirect(site_url('ujian'));
    }

    public function postDelete($id)
    {
        if (!in_array(session('user')['group'], ['admin']))
            return view('errors/html/error_403');

        $this->ujianModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        $this->response->redirect(site_url('ujian'));
    }

    public function getPdf($id, $save = false)
    {
        $filename = date('y-m-d_H.i.s') . '-ba_ujian';

        // instantiate and use the dompdf class
        $dompdf  = new Dompdf();
        $d       = "Untuk cek validasi surat, silakah buka alamat berikut:\nhttps://mipa.ugm.ac.id/validasi-surat/\n\nKode surat: " . $id;
        $qr      = (new QRCode)->render($d);
        $qr_note = "<br><i><b>Dokumen ini telah ditandatangani secara elektronik. Verifikasi keabsahan dokumen dapat dilakukan dengan scan QR code berikut.</b></i>";

        // load HTML content
        $db = \Config\Database::connect();

        $data['row'] = $db->query("")->getResult();

        if (count($data['penandatangan']) > 0) {
            $data['penandatangan'] = $data['penandatangan'][0];
        } else {
            $data['penandatangan'] = [];
        }

        $data['row']->tanggal_kegiatan = json_decode($data['row']->tanggal_kegiatan) ?? [];

        $data['qr']       = $data['row']->status == 3 ? $qr : '';
        $data['qr_note']  = $data['row']->status == 3 ? $qr_note : '';
        $data['anggotas'] = [];

        $dompdf->getOptions()->setChroot(FCPATH);


        // return view('surat-tugas/print', $data);
        // exit;

        $dompdf->loadHtml(view('surat-tugas/print', $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // $output = $dompdf->output();
        // file_put_contents("upload/surat_tugas/" . $id . ".pdf", $output);          
        // return $this->response->redirect(site_url('surattugas'));
        if ($save) {
            file_put_contents("upload/surat_tugas/$id.pdf", $dompdf->output());
            file_put_contents("validasi/$id.pdf", $dompdf->output());
        } else {
            $dompdf->stream("$filename.pdf", ['Attachment' => 0]);
            exit;
        }
    }

}