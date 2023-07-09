<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>
<?= lang('Auth.register') ?>
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-8 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">
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

            <form action="<?= url_to('register') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row mb-2">
                    <label class="col-sm-12 col-form-label bg-dark text-white">Isian Kontak Pendaftar *</label>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Nama Pendaftar *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama" inputmode="text" autocomplete="name"
                            placeholder="<?= lang('Auth.name') ?>" value="<?= old('nama') ?? 'admin' ?>" required />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Email Pendaftar *</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email"
                            placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?? 'admin@test.app' ?>"
                            required />
                    </div>
                </div>

                <!-- <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Email Pendaftar</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email_confirm" inputmode="email"
                            autocomplete="email" placeholder="Konfirmasi Email" value="<?= old('email_confirm') ?>"
                            required />
                    </div>
                </div> -->

                <!-- <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="username" inputmode="text" autocomplete="username"
                            placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?? 'admin' ?>"
                            required />
                    </div>
                </div> -->

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Password *</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" inputmode="text"
                            autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" value="Labotex123"
                            required />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Konfirmasi Password *</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_confirm" inputmode="text"
                            autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>"
                            value="Labotex123" required />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">No Handphone *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="phone" placeholder="No Handphone"
                            value="<?= old('phone') ?>" required />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Jabatan Pendaftar *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="jabatan" placeholder="Jabatan"
                            value="<?= old('jabatan') ?>" required />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-12 col-form-label bg-dark text-white">Isian Data Perusahaan/Instansi</label>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Perusahaan/Instansi *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama_perusahaan" placeholder="Perusahaan/Instansi"
                            value="<?= old('nama_perusahaan') ?>" required />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">No Telp Perusahaan/Instansi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama_perusahaan"
                            placeholder="No Telp Perusahaan/Instansi" value="<?= old('telp_perusahaan') ?>" />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">No Faks Perusahaan/Instansi</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="faks_perusahaan"
                            placeholder="No Faks Perusahaan/Instansi" value="<?= old('faks_perusahaan') ?>" />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-12 col-form-label bg-dark text-white">Jika Registrasi Sebagai
                        Perusahaan</label>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Kode KBLI</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="kode_kbli" placeholder="Kode KBLI"
                            value="<?= old('kode_kbli') ?>" />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Jenis Industri</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="jenis_industri" placeholder="Jenis Industri"
                            value="<?= old('jenis_industri') ?>" />
                    </div>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-12 col-form-label bg-dark text-white">Formulir Registrasi</label>
                </div>

                <div class="row mb-2">
                    <label class="col-sm-4 col-form-label">Lapiran Formulir Registrasi *</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="formulir_registrasi"
                            value="<?= old('formulir_registrasi') ?>" required />
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="d-grid co4-12 mx-auto m-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            <?= lang('Auth.register') ?>
                        </button>
                    </div>
                </div>

                <p class="text-center">
                    <?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a>
                </p>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<style>
    html {
        background: url(<?= base_url('img/bg.jpg') ?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    html::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2);
        z-index: -1;
        backdrop-filter: blur(5px) brightness(70%) contrast(80%);
    }
</style>
<?= $this->endSection() ?>