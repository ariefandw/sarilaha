<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>
<?= lang('Auth.register') ?>
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-5">
                <?= lang('Auth.register') ?>
            </h5>

            <?php if (session('error') !== null): ?>
                <div class="alert alert-danger" role="alert">
                    <?= session('error') ?>
                </div>
            <?php elseif (session('errors') !== null): ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (is_array(session('errors'))): ?>
                        <?php foreach (session('errors') as $error): ?>
                            <?= $error ?>
                            <br>
                        <?php endforeach ?>
                    <?php else: ?>
                        <?= session('errors') ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <form action="<?= site_url('user/create') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="mb-2">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email"
                        placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?? 'admini@test.app' ?>"
                        required />
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" inputmode="text" autocomplete="username"
                        placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?? 'admini' ?>"
                        required />
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label class="form-label">Group</label>
                    <select class="form-select" name="group" required>
                        <option value="admin">Admin</option>
                        <option value="dosen">Dosen</option>
                        <option value="tendik">Tendik</option>
                        <option value="mahasiswa">Mahasiswa</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" inputmode="text"
                        autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" value="Labotex123"
                        required />
                </div>

                <!-- Password (Again) -->
                <div class="mb-5">
                    <label class="form-label">Password Confirm</label>
                    <input type="password" class="form-control" name="password_confirm" inputmode="text"
                        autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" value="Labotex123"
                        required />
                </div>

                <div class="d-grid col-12 col-md-8 mx-auto m-3">
                    <button type="submit" class="btn btn-primary btn-block">
                        <?= lang('Auth.register') ?>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>