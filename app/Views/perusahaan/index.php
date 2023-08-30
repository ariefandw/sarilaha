<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Perusahaan</h3>
        <ul class="nav nav-pills card-header-pills justify-content-end">
            <li class="nav-item">
                <form action="<?= site_url("perusahaan"); ?>" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari" name="q" value="<?= $q; ?>">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </li>
            <li class="nav-item px-2">
                <a class="btn btn-success" href="<?= site_url('perusahaan/new') ?>" role="button">Tambah</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Email</th>
                <th scope="col">Nama Perusahaan</th>
                <th scope="col">Alamat Perusahaan</th>
                <th scope="col">Faks Perusahaan</th>
                <th scope="col">Kota Perusahaan</th>
                <!-- <th scope="col">Aksi</th> -->
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <th scope="row">
                        <?= empty($no) ? $no = 1 + (($pager->getCurrentPage() - 1) * $pager->GetPerPage()) : ++$no; ?>
                    </th>
                    <td>
                        <?= $row->email; ?>
                    </td>
                    <td>
                        <?= $row->nama_perusahaan; ?>
                    </td>
                    <td>
                        <?= $row->alamat_perusahaan; ?>
                    </td>
                    <td>
                        <?= $row->phone_perusahaan; ?>
                    </td>
                    <td>
                        <?= $row->faks_perusahaan; ?>
                    </td>
                    <td>
                        <?= $row->kota_perusahaan; ?>
                    </td>
                    <!-- <td>
                        <form method="post" action="<?= site_url('perusahaan/delete/' . $row->id); ?>"
                            onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?= site_url('perusahaan/edit/' . $row->id); ?>" class="btn btn-warning">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        </form>
                    </td> -->
                </tr>
            <?php endforeach; ?>
        </table>
        <?= createPagination($pager); ?>
    </div>
</div>
<?= $this->endSection() ?>