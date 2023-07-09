<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dosen</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="post" action="<?= site_url('dosen/' . $action . ($action == 'update' ? '/' . $row->id : '')); ?>">
            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" class="form-control" name="nip" value="<?= $row->nip; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $row->nama; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" class="form-control" name="telepon" value="<?= $row->telepon; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>