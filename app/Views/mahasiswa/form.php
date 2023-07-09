<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Mahasiswa</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="post"
            action="<?= site_url('mahasiswa/' . $action . ($action == 'update' ? '/' . $row->id : '')); ?>">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" class="form-control" name="nip" value="<?= $row->nim; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $row->nama; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" class="form-control" name="telepon" value="<?= $row->telepon; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Prodi</label>
                <input type="text" class="form-control" name="prodi_id" value="<?= $row->prodi_id; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Angkatan</label>
                <input type="text" class="form-control" name="angkatan" value="<?= $row->angkatan; ?>">
            </div>

            <?= csrf_field() ?>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email"
                    placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?? 'admin@test.app' ?>" required />
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" inputmode="text" autocomplete="username"
                    placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?? 'admin' ?>" required />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password (Kosongkan jika tidak berubah)</label>
                <input type="password" class="form-control" name="password" inputmode="text" autocomplete="new-password"
                    placeholder="<?= lang('Auth.password') ?>" value="Labotex123" required />
            </div>

            <!-- Password (Again) -->
            <div class="mb-3">
                <label class="form-label">Password Confirm (Kosongkan jika tidak berubah)</label>
                <input type="password" class="form-control" name="password_confirm" inputmode="text"
                    autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="Labotex123"
                    required />
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>