<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">RKL/RPL</h3>
        <ul class="nav nav-pills card-header-pills justify-content-end">
            <li class="nav-item">
                <form action="<?= site_url("dosen"); ?>" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari" name="q" value="<?= $q; ?>">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </li>
            <li class="nav-item px-2">
                <?php if (session('user')['group'] == 'user'): ?>
                    <a class="btn btn-success" href="<?= site_url('rkl/new') ?>" role="button">Tambah</a>
                <?php endif ?>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tahapan</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Sumber Dampak</th>
                <th scope="col">Jenis Limbah</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <th scope="row">
                        <?= empty($no) ? $no = 1 + (($pager->getCurrentPage() - 1) * $pager->GetPerPage()) : ++$no; ?>
                    </th>
                    <td>
                        <?= $row->tahapan; ?>
                    </td>
                    <td>
                        <?= $row->kegiatan; ?>
                    </td>
                    <td>
                        <?= $row->sumber_dampak; ?>
                    </td>
                    <td>
                        <?= $row->jenis_limbah; ?>
                    </td>
                    <td>
                        <?php if ($row->status == 'diterima'): ?>
                            <span class="badge bg-success">
                                <?= $row->status ?>
                            </span>
                        <?php elseif ($row->status == 'ditolak'): ?>
                            <span class="badge bg-danger">
                                <?= $row->status ?>
                            </span>
                        <?php else: ?>
                            <span class="badge bg-primary">
                                <?= $row->status ?>
                            </span>
                        <?php endif ?>
                    </td>
                    <td>
                        <form method="post" action="<?= site_url('rkl/delete/' . $row->id); ?>"
                            onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            <div class="btn-group btn-group-sm" role="group">
                                <?php if ($row->status == 'diterima'): ?>
                                    <a href="<?= site_url('rkl/tte/' . $row->lampiran); ?>" class="btn btn-primary" title="TTE">
                                        <i class="fas fa-receipt"></i>
                                    </a>
                                <?php endif ?>
                                <a href="<?= site_url('rkl/edit/' . $row->id); ?>" class="btn btn-warning">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= createPagination($pager); ?>
    </div>
</div>
<?= $this->endSection() ?>