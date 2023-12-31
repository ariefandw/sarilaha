<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">User</h3>
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
                <a class="btn btn-success" href="<?= site_url('user/new') ?>" role="button">Tambah</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
                <th scope="col">Aksi</th>
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <th scope="row">
                        <?= empty($no) ? $no = 1 + (($pager->getCurrentPage() - 1) * $pager->GetPerPage()) : ++$no; ?>
                    </th>
                    <td>
                        <?= $row->getIdentity('email_password')->secret; ?>
                    </td>
                    <td>
                        <?= $row->username; ?>
                    </td>
                    <td>
                        <form method="post" action="<?= site_url('dosen/delete/' . $row->id); ?>"
                            onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?= site_url('dosen/edit/' . $row->id); ?>" class="btn btn-warning">
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