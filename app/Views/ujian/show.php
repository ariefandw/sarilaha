<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ujian</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <dl class="row">
                    <dt class="col-sm-4">NIM</dt>
                    <dd class="col-sm-8">
                        <?= $mahasiswa->nim ?>
                    </dd>

                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8">
                        <?= $mahasiswa->nama ?>
                    </dd>

                    <dt class="col-sm-4">Prodi</dt>
                    <dd class="col-sm-8">
                        <?= (new \App\Models\Prodi)->find($mahasiswa->prodi_id)->nama_prodi ?>
                    </dd>

                    <dt class="col-sm-4">Jenis Ujian</dt>
                    <dd class="col-sm-8">
                        <?= $jenis_ujian->nama_ujian ?>
                    </dd>

                    <dt class="col-sm-4">Judul Penelitian</dt>
                    <dd class="col-sm-8">
                        <?= $row->judul ?>
                    </dd>

                    <dt class="col-sm-4">Berkas Syarat</dt>
                    <dd class="col-sm-8">
                        <?php
                        $berkases = (new \App\Models\UjianBerkasSyarat)
                            ->select('nama_berkas_syarat, ext, ujian_berkas_syarat.id')
                            ->join('berkas_syarat', 'berkas_syarat.id = ujian_berkas_syarat.berkas_syarat_id')
                            ->where('ujian_id', $row->id)->findAll();
                        ?>
                        <?php foreach ($berkases as $berkas): ?>
                            <div>
                                <?= $berkas->nama_berkas_syarat ?>
                                (<a href="<?= base_url('upload/berkas_syarat/' . $berkas->id . '.' . $berkas->ext) ?>"
                                    target="__blank">download</a>)
                            </div>
                        <?php endforeach ?>
                    </dd>

                    <dt class="col-sm-4 mt-2">Dosen Pembimbing</dt>
                    <dd class="col-sm-8 mt-2">
                        <?php foreach ($pembimbings as $pembimbings): ?>
                            <div>
                                <?= $pembimbings->nama ?>
                            </div>
                        <?php endforeach ?>
                    </dd>

                    <dt class="col-sm-4">Dosen Penguji</dt>
                    <dd class="col-sm-8">
                        <?php foreach ($pengujis as $pengujis): ?>
                            <div>
                                <?= $pengujis->nama ?>
                            </div>
                        <?php endforeach ?>
                    </dd>

                    <dt class="col-sm-4">Tanggal Ujian</dt>
                    <dd class="col-sm-8">
                        <?= format_date($row->tanggal_ujian) ?>&nbsp;
                    </dd>

                    <dt class="col-sm-4">Ruang Ujian</dt>
                    <dd class="col-sm-8">
                        <?= $row->ruang_ujian ?>&nbsp;
                    </dd>

                    <!-- <dt class="col-sm-4">Nilai Akhir Angka</dt>
                    <dd class="col-sm-8">
                        <?= $row->nilai_akhir_angka ?>&nbsp;
                    </dd> -->

                    <?php if ($row->nilai_akhir_angka): ?>
                        <dt class="col-sm-4">Nilai Akhir Huruf</dt>
                        <dd class="col-sm-8">
                            <?= $row->nilai_akhir_huruf ?>&nbsp;
                        </dd>
                    <?php endif ?>

                    <dt class="col-sm-4">Catatan</dt>
                    <dd class="col-sm-8">
                        <?= $row->catatan ?>&nbsp;
                    </dd>

                    <?php if ($row->status_ujian == App\Models\StatusUjian::LULUS): ?>
                        <dt class="col-sm-4">Nilai Akhir Angka</dt>
                        <dd class="col-sm-8">
                            <?= round($nilai_akhir) ?>&nbsp;
                        </dd>

                        <dt class="col-sm-4">Nilai Akhir Huruf</dt>
                        <dd class="col-sm-8">
                            <?= calculateGrade(round($nilai_akhir)) ?>&nbsp;
                        </dd>
                    <?php endif ?>

                    <dt class="col-sm-4">Status Ujian</dt>
                    <dd class="col-sm-8">
                        <?= \App\Models\StatusUjian::from($row->status)->name ?>&nbsp;
                    </dd>
                </dl>
            </div>
            <div class="col-6">
                <form method="post" enctype="multipart/form-data"
                    action="<?= site_url('ujian/uploadrevisi/' . $row->id); ?>">
                    <h3>Laporan</h3>
                    <table class="table table-sm">
                        <tr>
                            <th>Laporan</th>
                            <th>Catatan</th>
                        </tr>
                        <?php foreach ($revisis as $revisi): ?>
                            <tr>
                                <td>
                                    <a class="col-sm-6 pl-2" target="__blank"
                                        href="https://docs.google.com/document/d/<?= $revisi->drive_file_id ?>">
                                        Revisi
                                        <?= $revisi->versi ?>
                                    </a>
                                </td>
                                <td>
                                    <?= $revisi->catatan ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>


                    <?php if (in_array(session('user')['group'], ['admin', 'mahasiswa'])): ?>
                        <div><b>Upload Revisi</b></div>
                        <input type="file" name="laporan" class="form-control mt-2" accept=".doc, .docx" required>
                        <button type="submit" class="btn btn-primary mt-2">Unggah</button>
                    <?php endif ?>
                </form>
            </div>
        </div>

        <a href="<?= site_url('ujian') ?>" onclick="history.back();" class="btn btn-outline-primary">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>