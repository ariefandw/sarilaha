<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h4>Profil Perusahaan</h4>
    </div>
    <div class="card-body">
        <form>
            <div class="row mb-3">
                <label for="namaPerusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaPerusahaan" placeholder="Nama Perusahaan">
                </div>
            </div>
            <div class="row mb-3">
                <label for="jenisIndustri" class="col-sm-2 col-form-label">Jenis Industri</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jenisIndustri" placeholder="Jenis Industri">
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamatKegiatan" class="col-sm-2 col-form-label">Alamat Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamatKegiatan" placeholder="Alamat Kegiatan">
                </div>
            </div>
            <div class="row mb-3">
                <label for="kabupatenKota" class="col-sm-2 col-form-label">Kabupaten/Kota Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kabupatenKota" placeholder="Kabupaten/Kota Kegiatan">
                </div>
            </div>
            <div class="row mb-3">
                <label for="telpKegiatan" class="col-sm-2 col-form-label">Telp/HP Kegiatan</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telpKegiatan" placeholder="Telp/HP Kegiatan">
                </div>
            </div>
            <div class="row mb-3">
                <label for="faxKegiatan" class="col-sm-2 col-form-label">Fax Kegiatan</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="faxKegiatan" placeholder="Fax Kegiatan">
                </div>
            </div>

            <div class="row mb-2">
                <label class="col-sm-12 col-form-label bg-dark text-white">Holding Company</label>
            </div>

            <div class="row mb-3">
                <label for="namaHolding" class="col-sm-2 col-form-label">Nama Holding Company</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaHolding" placeholder="Nama Holding Company">
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamatHolding" class="col-sm-2 col-form-label">Alamat Holding Company</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamatHolding" placeholder="Alamat Holding Company">
                </div>
            </div>
            <div class="row mb-3">
                <label for="telpHolding" class="col-sm-2 col-form-label">Telp/HP Holding Company</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telpHolding" placeholder="Telp/HP Holding Company">
                </div>
            </div>
            <div class="row mb-3">
                <label for="faxHolding" class="col-sm-2 col-form-label">Fax Holding Company</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="faxHolding" placeholder="Fax Holding Company">
                </div>
            </div>


            <div class="row mb-2">
                <label class="col-sm-12 col-form-label bg-dark text-white">Kantor Pusat</label>
            </div>

            <div class="row mb-3">
                <label for="alamatKantor" class="col-sm-2 col-form-label">Alamat Kantor Pusat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamatKantor" placeholder="Alamat Kantor Pusat">
                </div>
            </div>
            <div class="row mb-3">
                <label for="telpKantor" class="col-sm-2 col-form-label">Telp/HP Kantor Pusat</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telpKantor" placeholder="Telp/HP Kantor Pusat">
                </div>
            </div>
            <div class="row mb-3">
                <label for="faxKantor" class="col-sm-2 col-form-label">Fax Kantor Pusat</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="faxKantor" placeholder="Fax Kantor Pusat">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>