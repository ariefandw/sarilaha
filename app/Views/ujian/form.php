<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ujian</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-2">NIM</dt>
            <dd class="col-sm-10">
                <?= $mahasiswa->nim ?>
            </dd>

            <dt class="col-sm-2">Nama</dt>
            <dd class="col-sm-10">
                <?= $mahasiswa->nama ?>
            </dd>

            <dt class="col-sm-2">Prodi</dt>
            <dd class="col-sm-10">
                <?= (new \App\Models\Prodi)->find($mahasiswa->prodi_id)->nama_prodi ?>
            </dd>

            <?php if (session('user')['group'] == 'mahasiswa'): ?>
                <dt class="col-sm-2">Pilih Ujian</dt>
                <dd class="col-sm-10">
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <?= isset($jenis_ujian) ? $jenis_ujian->nama_ujian : 'Pilih Ujian' ?>
                        </button>
                        <ul class="dropdown-menu">
                            <?php foreach ($jenis_ujians as $ju): ?>
                                <li><a class="dropdown-item" href="<?= site_url('ujian/new/' . $ju->id) ?>"><?= $ju->nama_ujian ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </dd>
            <?php endif; ?>

            <?php if ($action == 'update'): ?>
                <dt class="col-sm-2">Jenis Ujian</dt>
                <dd class="col-sm-10">
                    <?= $jenis_ujian->nama_ujian ?>
                </dd>
            <?php endif; ?>
        </dl>

        <?php if (isset($jenis_ujian)): ?>
            <form method="post" enctype="multipart/form-data"
                action="<?= site_url('ujian/' . $action . ($action == 'update' ? '/' . $row->id : '')); ?>">
                <?php if (in_array(session('user')['group'], ['admin', 'admin_prodi', 'mahasiswa'])): ?>
                    <div class="mb-3">
                        <label class="form-label">Judul Penelitian</label>
                        <input type="hidden" required class="form-control" name="jenis_ujian_id"
                            value="<?= $jenis_ujian->id; ?>">
                        <input type="text" required class="form-control" name="judul" value="<?= $row->judul; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Berkas Syarat</b> (.pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx)</label>
                    </div>
                    <?php foreach ($berkases as $berkas): ?>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">
                                <?= $berkas->nama_berkas_syarat ?>
                            </label>
                            <?php if (in_array(session('user')['group'], ['admin', 'mahasiswa'])): ?>
                                <div class="col-sm-4">
                                    <input type="file" required name="berkas[<?= $berkas->id ?>]" class="form-control"
                                        accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx">
                                </div>
                            <?php endif ?>
                            <?php if (!empty($berkas->ujian_berkas_syarat_id)): ?>
                                <a class="col-sm-6" target="__blank"
                                    href="<?= base_url('upload/berkas_syarat/' . $berkas->ujian_berkas_syarat_id . '.' . $berkas->ext) ?>">
                                    (download)
                                </a>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Laporan</label>
                        <?php if (in_array(session('user')['group'], ['admin', 'mahasiswa'])): ?>
                                <div class="col-sm-4">
                                    <input type="file" name="laporan" class="form-control" accept=".doc, .docx" required>
                                </div>
                        <?php endif ?>
                        <?php if (!empty($revisis)): ?>
                            <a class="col-sm-6" target="__blank"
                                href="https://docs.google.com/document/d/<?= $revisis[count($revisis) - 1]->drive_file_id ?>">
                                (download)
                            </a>
                        <?php endif ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><b>Dosen Pembimbing</b></label>
                    </div>
                    <?php if ($action == 'update'): ?>
                        <?php foreach ($pembimbings as $i => $pembimbing): ?>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">
                                    <?= 'Pembimbing ' . ($i + 1) ?>
                                </label>
                                <div class="col-sm-10">
                                    <select name="dosen_pembimbing[]">
                                        <option value="">-- Pilih Dosen --</option>
                                        <?php foreach ($dosens as $dosen): ?>
                                            <option <?= $dosen->id == $pembimbing->id ? 'selected' : '' ?> value="<?= $dosen->id ?>"><?= $dosen->nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php for ($i = 0; $i < $jenis_ujian->jumlah_pembimbing; $i++): ?>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">
                                    <?= 'Pembimbing ' . ($i + 1) ?>
                                </label>
                                <div class="col-sm-10">
                                    <select name="dosen_pembimbing[]">
                                        <option value="">-- Pilih Dosen --</option>
                                        <?php foreach ($dosens as $dosen): ?>
                                            <option value="<?= $dosen->id ?>"><?= $dosen->nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        <?php endfor ?>
                    <?php endif ?>

                <?php endif ?>
                <?php if (in_array(session('user')['group'], ['admin', 'admin_prodi'])): ?>

                    <div class="mb-3">
                        <label class="form-label"><b>Dosen Penguji</b></label>
                    </div>
                    <?php if ($action == 'update'): ?>
                        <?php foreach ($pengujis as $i => $penguji): ?>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">
                                    <?= 'Penguji ' . ($i + 1) ?>
                                </label>
                                <div class="col-sm-10">
                                    <select name="dosen_penguji[]">
                                        <option value="">-- Pilih Dosen --</option>
                                        <?php foreach ($dosens as $dosen): ?>
                                            <option <?= $dosen->id == $penguji->id ? 'selected' : '' ?> value="<?= $dosen->id ?>"><?= $dosen->nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?php for ($i = 0; $i < $jenis_ujian->jumlah_pembimbing; $i++): ?>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">
                                    <?= 'Pembimbing ' . ($i + 1) ?>
                                </label>
                                <div class="col-sm-10">
                                    <select name="dosen_pembimbing[]">
                                        <option value="">-- Pilih Dosen --</option>
                                        <?php foreach ($dosens as $dosen): ?>
                                            <option value="<?= $dosen->id ?>"><?= $dosen->nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        <?php endfor ?>
                    <?php endif ?>

                <?php endif ?>


                <div class="row mt-4">

                    <?php if (in_array(session('user')['group'], ['admin', 'dosen'])): ?>
                        <div class="col-6 mb-3">
                            <label class="form-label">Nilai Akhir Angka</label>
                            <input type="number" class="form-control" disabled name="nilai_akhir_angka" readonly
                                value="<?= $row->nilai_akhir_angka; ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Nilai Akhir Huruf</label>
                            <input type="text" class="form-control" disabled name="nilai_akhir_huruf" readonly
                                value="<?= $row->nilai_akhir_huruf; ?>">
                        </div>
                    <?php endif ?>

                    <?php if (in_array(session('user')['group'], ['admin', 'admin_prodi'])): ?>
                        <?php
                        $date = null;
                        $time = null;
                        if(!empty($row->tanggal_ujian)){
                            $datetime = new DateTime($row->tanggal_ujian);
                            $date = $datetime->format('Y-m-d');
                            $time = $datetime->format('h:i');
                        }
                        ?>
                        <div class="col-3 mb-3">
                            <label class="form-label">Tanggal Ujian</label>
                            <input type="date" class="form-control" name="tanggal_ujian" required
                                value="<?= $date ?>" min="<?= now('Y-m-d') ?>">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">Waktu Ujian</label>
                            <input type="time" class="form-control time" name="waktu_ujian" required
                                value="<?= $time; ?>" min="<?= now('H:i') ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Ruang Ujian</label>
                            <input type="text" class="form-control" name="ruang_ujian" required
                                value="<?= $row->ruang_ujian; ?>">
                        </div>
                    <?php endif ?>

                </div>
                <?php if (in_array(session('user')['group'], ['admin', 'dosen'])): ?>
                    <div class="mb-3">
                        <label class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="6"><?= $row->catatan; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Ujian</label>
                        <select name="status">
                            <?php foreach (App\Models\StatusUjian::cases() as $statusUjian): ?>
                                <option value="<?= $statusUjian->value ?>" <?= $row->status == $statusUjian->value ? 'selected' : '' ?>>
                                    <?= $statusUjian->name ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                <?php endif ?>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="" id="agreementCheck">
                    <label class="form-check-label" for="agreementCheck">
                        Saya telah memasukkan data dengan benar. Jika terdapat kesalahan maka saya bertanggungjawab atas
                        resikonya
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg mt-2" id="submitButton" disabled>SIMPAN</button>
            </form>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    const agreementCheck = document.getElementById('agreementCheck');
    const submitButton = document.getElementById('submitButton');

    agreementCheck.addEventListener('change', function () {
        submitButton.disabled = !agreementCheck.checked;
    });
</script>
<?= $this->endSection() ?>