<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">RKL/RPL</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="post" action="<?= site_url('rkl/' . $action . ($action == 'update' ? '/' . $row->id : '')); ?>"
            enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="tahapan" class="col-sm-2 col-form-label">Tahapan</label>
                <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" name="tahapan" placeholder="Tahapan"
                        value="<?= $row->tahapan ?>"> -->
                    <select class="form-select" name="tahapan">
                        <option value="konstruksi" <?= $row->tahapan == 'prakonstruksi' ? 'selected' : '' ?>>
                            Pra Konstruksi
                        </option>
                        <option value="konstruksi" <?= $row->tahapan == 'konstruksi' ? 'selected' : '' ?>>
                            Konstruksi
                        </option>
                        <option value="operasi" <?= $row->tahapan == 'operasi' ? 'selected' : '' ?>>
                            Operasi
                        </option>
                        <option value="paskaoperasi" <?= $row->tahapan == 'paskaoperasi' ? 'selected' : '' ?>>
                            Paska Operasi
                        </option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="kegiatan" class="col-sm-2 col-form-label">Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="kegiatan" placeholder="Kegiatan"
                        value="<?= $row->kegiatan ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="sumberDampak" class="col-sm-2 col-form-label">Sumber Dampak</label>
                <div class="col-sm-10">
                    <textarea id="sumber_dampak" class="form-control" name="sumber_dampak" rows="3"
                        placeholder="Sumber Dampak">
                        <?= $row->sumber_dampak ?>
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jenisLimbah" class="col-sm-2 col-form-label">Jenis Dampak</label>
                <div class="col-sm-10">
                    <textarea id="jenis_limbah" class="form-control" name="jenis_limbah" rows="3"
                        placeholder="Jenis Dampak">
                        <?= $row->jenis_limbah ?>
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="besaran_dampak" class="col-sm-2 col-form-label">Besaran Dampak</label>
                <div class="col-sm-10">
                    <textarea id="besaran_dampak" class="form-control" name="besaran_dampak" rows="3"
                        placeholder="Besaran Dampak">
                        <?= $row->besaran_dampak ?>
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="cara_pengelolaan" class="col-sm-2 col-form-label">Cara Pengelolaan</label>
                <div class="col-sm-10">
                    <textarea id="cara_pengelolaan" class="form-control" name="cara_pengelolaan" rows="3"
                        placeholder="Cara Pengelolaan">
                        <?= $row->cara_pengelolaan ?>
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tolok_ukur_pengelolaan" class="col-sm-2 col-form-label">Tolok Ukur Pengelolaan</label>
                <div class="col-sm-10">
                    <textarea id="tolok_ukur_pengelolaan" class="form-control" name="tolok_ukur_pengelolaan" rows="3"
                        placeholder="Tolok Ukur Pengelolaan">
                        <?= $row->tolok_ukur_pengelolaan ?>
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="caraPemantauan" class="col-sm-2 col-form-label">Cara Pemantauan</label>
                <div class="col-sm-10">
                    <textarea id="cara_pemantauan" class="form-control" name="cara_pemantauan" rows="3"
                        placeholder="Cara Pemantauan">
                        <?= $row->cara_pemantauan ?>
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="sertifikat_hasil_uji" class="col-sm-2 col-form-label">Sertifikat Hasil Uji</label>
                <div class="col-sm-10">
                    <?php if ($row->sertifikat_hasil_uji ?? false): ?>
                        <a target="__blank" href="<?= base_url('uploads/' . $row->sertifikat_hasil_uji) ?>">download</a>
                    <?php endif ?>
                    <input class="form-control" type="file" name="sertifikat_hasil_uji">
                </div>
            </div>
            <div class="row mb-3">
                <label for="tolokUkurPemantauan" class="col-sm-2 col-form-label">Tolok Ukur Pemantauan</label>
                <div class="col-sm-10">
                    <textarea id="tolok_ukur_pemantauan" class="form-control" name="tolok_ukur_pemantauan" rows="3"
                        placeholder="Tolok Ukur Pemantauan">
                        <?= $row->tolok_ukur_pemantauan ?>
                    </textarea>
                </div>
            </div>
            <!-- <div class="row mb-3">
                <label for="lampiran" class="col-sm-2 col-form-label">Lampiran</label>
                <div class="col-sm-10">
                    <?php if ($row->lampiran): ?>
                        <a target="__blank" href="<?= base_url('uploads/' . $row->lampiran) ?>">download</a>
                    <?php endif ?>
                    <input class="form-control" type="file" name="lampiran">
                </div>
            </div> -->
            <?php if (session('user')['group'] == 'admin'): ?>
                <div class="row mb-3">
                    <label for="tahapan" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="status">
                            <!-- <option selected disabled>Select Tahapan</option> -->
                            <option value="baru" <?= $row->status == 'baru' ? 'selected' : '' ?>>baru</option>
                            <option value="diterima" <?= $row->status == 'diterima' ? 'selected' : '' ?>>diterima</option>
                            <option value="ditolak" <?= $row->status == 'ditolak' ? 'selected' : '' ?>>ditolak</option>
                        </select>
                    </div>
                </div>
            <?php endif ?>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#sumber_dampak'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#jenis_limbah'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#besaran_dampak'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#cara_pengelolaan'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tolok_ukur_pengelolaan'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#cara_pemantauan'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tolok_ukur_pemantauan'))
        .catch(error => {
            console.error(error);
        });
</script>
<?= $this->endSection() ?>