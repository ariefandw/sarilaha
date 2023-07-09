<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ujian</h3>
        <ul class="nav nav-pills card-header-pills justify-content-end">
            <li class="nav-item">
                <form action="<?= site_url("ujian"); ?>" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari" name="q" value="<?= $q; ?>">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
            </li>
            <li class="nav-item px-2">
                <a class="btn btn-success" href="<?= site_url('ujian/new') ?>" role="button">Tambah</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover">
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIM/Nama</th>
                <th scope="col">Judul</th>
                <th scope="col">Prodi</th>
                <th scope="col">Tanggal Ujian</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Daftar</th>
                <th scope="col">Aksi</th>
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <th scope="row">
                        <?= empty($no) ? $no = 1 + (($pager->getCurrentPage() - 1) * $pager->GetPerPage()) : ++$no; ?>
                    </th>
                    <td>
                        <?= $row->nim; ?><br />
                        <?= $row->nama; ?>
                    </td>
                    <td>
                        <?= $row->judul; ?>
                    </td>
                    <td>
                        <?= $row->nama_prodi ?>
                    </td>
                    <td>
                        <?= $row->tanggal_ujian ?>
                    </td>
                    <td>
                        <?= App\Models\StatusUjian::from($row->status_ujian)->name ?>
                    </td>
                    <td>
                        <?= $row->created_at ?>
                    </td>
                    <td>
                        <form method="post" action="<?= site_url('ujian/delete/' . $row->id); ?>"
                            onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?= site_url('ujian/show/' . $row->id); ?>" class="btn btn-primary" title="Lihat">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <?php if (in_array(session('user')['group'], ['admin', 'admin_prodi'])): ?>
                                    <?php
                                    if (
                                        (
                                            in_array(session('user')['group'], ['admin_prodi']) &&
                                            (!(strtotime(now()) >= (strtotime($row->tanggal_ujian))) || empty($row->tanggal_ujian))
                                        ) ||
                                        (in_array(session('user')['group'], ['dosen']) && $row->status != App\Models\StatusUjian::LULUS->value)
                                    ): ?>
                                        <a href="<?= site_url('ujian/edit/' . $row->id); ?>" class="btn btn-warning" title="Edit">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if (in_array(session('user')['group'], ['admin'])): ?>
                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                        <i class="fa-solid fa-times"></i>
                                    </button>
                                <?php endif ?>
                                <?php if (
                                    in_array(session('user')['group'], ['dosen'])
                                    // && App\Models\StatusUjian::from($row->status_ujian)->value == App\Models\StatusUjian::REVISI
                                ):
                                    ?>
                                    <a href="<?= site_url('ujian/nilai/' . $row->id); ?>" class="btn btn-info" title="Nilai">
                                        <i class="fa-solid fa-calculator"></i>
                                    </a>
                                <?php endif ?>
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