<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">RKL/RPL</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="post" action="<?= site_url('prodi/' . $action . ($action == 'update' ? '/' . $row->id : '')); ?>">
            <div class="row mb-3">
                <label for="tahapan" class="col-sm-2 col-form-label">Tahapan</label>
                <div class="col-sm-10">
                    <select class="form-select" id="tahapan">
                        <option selected disabled>Select Tahapan</option>
                        <option value="konstruksi">Konstruksi</option>
                        <option value="operasi">Operasi</option>
                        <option value="paskaoperasi">Paska Operasi</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="kegiatan" class="col-sm-2 col-form-label">Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kegiatan" placeholder="Kegiatan">
                </div>
            </div>
            <div class="row mb-3">
                <label for="sumberDampak" class="col-sm-2 col-form-label">Sumber Dampak</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sumberDampak" placeholder="Sumber Dampak">
                </div>
            </div>
            <div class="row mb-3">
                <label for="jenisLimbah" class="col-sm-2 col-form-label">Jenis Limbah/Cemaran</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jenisLimbah" placeholder="Jenis Limbah/Cemaran">
                </div>
            </div>
            <div class="row mb-3">
                <label for="besaranDampak" class="col-sm-2 col-form-label">Besaran Dampak</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="besaranDampak" rows="3" placeholder="Besaran Dampak"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="caraPengelolaan" class="col-sm-2 col-form-label">Cara Pengelolaan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="caraPengelolaan" rows="3"
                        placeholder="Cara Pengelolaan"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tolokUkurPengelolaan" class="col-sm-2 col-form-label">Tolok Ukur Pengelolaan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="tolokUkurPengelolaan" rows="3"
                        placeholder="Tolok Ukur Pengelolaan"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="caraPemantauan" class="col-sm-2 col-form-label">Cara Pemantauan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="caraPemantauan" placeholder="Cara Pemantauan">
                </div>
            </div>
            <div class="row mb-3">
                <label for="tolokUkurPemantauan" class="col-sm-2 col-form-label">Tolok Ukur Pemantauan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tolokUkurPemantauan"
                        placeholder="Tolok Ukur Pemantauan">
                </div>
            </div>
            <div class="row mb-3">
                <label for="lampiran" class="col-sm-2 col-form-label">Lampiran</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="lampiran">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <!-- <div class="mb-3">
                <label class="form-label">Kode Prodi</label>
                <input type="text" class="form-control" name="kode_prodi" value="<?= $row->kode_prodi; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Prodi</label>
                <input type="text" class="form-control" name="nama_prodi" value="<?= $row->nama_prodi; ?>">
            </div> -->
        </form>
    </div>
</div>
<?= $this->endSection() ?>