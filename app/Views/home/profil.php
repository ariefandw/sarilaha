<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h4>Profil Perusahaan</h4>
    </div>
    <div class="card-body">
        <form method="post" action="<?= site_url('updateprofil') ?>" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="namaPerusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaPerusahaan" placeholder="Nama Perusahaan"
                        name="nama_perusahaan" value="<?= $perusahaan->nama_perusahaan ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="jenisIndustri" class="col-sm-2 col-form-label">Jenis Industri</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jenisIndustri" placeholder="Jenis Industri"
                        name="jenis_industri" value="<?= $perusahaan->jenis_industri ?>">
                </div>
            </div>
            <!-- <div class="row mb-3">
                <label for="alamatKegiatan" class="col-sm-2 col-form-label">Alamat Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamatKegiatan" placeholder="Alamat Kegiatan">
                </div>
            </div> -->
            <div class="row mb-3">
                <label for="kabupatenKota" class="col-sm-2 col-form-label">Kabupaten/Kota Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kabupatenKota" placeholder="Kabupaten/Kota Kegiatan"
                        name="kota_perusahaan" value="<?= $perusahaan->kota_perusahaan ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="telpKegiatan" class="col-sm-2 col-form-label">Telp/HP Pendaftar</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telpKegiatan" placeholder="Telp/HP Pendaftar"
                        name="phone" value="<?= $perusahaan->phone ?>">
                </div>
            </div>
            <!-- <div class="row mb-3">
                <label for="faxKegiatan" class="col-sm-2 col-form-label">Fax Kegiatan</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="faxKegiatan" placeholder="Fax Kegiatan">
                </div>
            </div> -->

            <div class="row mb-2">
                <label class="col-sm-12 col-form-label bg-dark text-white">Holding Company</label>
            </div>

            <div class="row mb-3">
                <label for="namaHolding" class="col-sm-2 col-form-label">Nama Holding Company</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaHolding" placeholder="Nama Holding Company"
                        name="nama_holding" value="<?= $perusahaan->nama_holding ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="alamatHolding" class="col-sm-2 col-form-label">Alamat Holding Company</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamatHolding" placeholder="Alamat Holding Company"
                        name="alamat_holding" value="<?= $perusahaan->alamat_holding ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="telpHolding" class="col-sm-2 col-form-label">Telp/HP Holding Company</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telpHolding" placeholder="Telp/HP Holding Company"
                        name="phone_holding" value="<?= $perusahaan->phone_holding ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="faxHolding" class="col-sm-2 col-form-label">Fax Holding Company</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="faxHolding" placeholder="Fax Holding Company"
                        name="faks_holding" value="<?= $perusahaan->faks_holding ?>">
                </div>
            </div>


            <div class="row mb-2">
                <label class="col-sm-12 col-form-label bg-dark text-white">Kantor Pusat</label>
            </div>

            <div class="row mb-3">
                <label for="alamatKantor" class="col-sm-2 col-form-label">Alamat Kantor Pusat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamatKantor" placeholder="Alamat Kantor Pusat"
                        name="alamat_perusahaan" value="<?= $perusahaan->alamat_perusahaan ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="telpKantor" class="col-sm-2 col-form-label">Telp/HP Kantor Pusat</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telpKantor" placeholder="Telp/HP Kantor Pusat"
                        name="phone_perusahaan" value="<?= $perusahaan->phone_perusahaan ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="faxKantor" class="col-sm-2 col-form-label">Fax Kantor Pusat</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="faxKantor" placeholder="Fax Kantor Pusat"
                        name="faks_perusahaan" value="<?= $perusahaan->faks_perusahaan ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>