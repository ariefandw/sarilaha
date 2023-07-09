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
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="alamatKantor">Alamat Kantor Pusat</label>
                        <input type="text" class="form-control" id="alamatKantor" placeholder="Alamat Kantor Pusat">
                    </div>
                    <div class="form-group">
                        <label for="telpKantor">Telp/HP Kantor Pusat</label>
                        <input type="tel" class="form-control" id="telpKantor" placeholder="Telp/HP Kantor Pusat">
                    </div>
                    <div class="form-group">
                        <label for="faxKantor">Fax Kantor Pusat</label>
                        <input type="tel" class="form-control" id="faxKantor" placeholder="Fax Kantor Pusat">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="namaPlb3">Nama PLB3</label>
                        <input type="text" class="form-control" id="namaPlb3" placeholder="Nama PLB3">
                    </div>
                    <div class="form-group">
                        <label for="telpPlb3">Telp/HP PLB3</label>
                        <input type="tel" class="form-control" id="telpPlb3" placeholder="Telp/HP PLB3">
                    </div>
                    <div class="form-group">
                        <label for="emailPlb3">Email PLB3</label>
                        <input type="email" class="form-control" id="emailPlb3" placeholder="Email PLB3">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="namaPpu">Nama PPU</label>
                        <input type="text" class="form-control" id="namaPpu" placeholder="Nama PPU">
                    </div>
                    <div class="form-group">
                        <label for="telpPpu">Telp/HP PPU</label>
                        <input type="tel" class="form-control" id="telpPpu" placeholder="Telp/HP PPU">
                    </div>
                    <div class="form-group">
                        <label for="emailPpu">Email PPU</label>
                        <input type="email" class="form-control" id="emailPpu" placeholder="Email PPU">
                    </div>
                    <div class="form-group">
                        <label for="namaPpa">Nama PPA</label>
                        <input type="text" class="form-control" id="namaPpa" placeholder="Nama PPA">
                    </div>
                    <div class="form-group">
                        <label for="telpPpa">Telp/HP PPA</label>
                        <input type="tel" class="form-control" id="telpPpa" placeholder="Telp/HP PPA">
                    </div>
                    <div class="form-group">
                        <label for="emailPpa">Email PPA</label>
                        <input type="email" class="form-control" id="emailPpa" placeholder="Email PPA">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>