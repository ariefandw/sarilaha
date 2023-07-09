<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <div class="container d-flex justify-content-center p-5 align-items-center min-vh-100">
        <div class="row col-12 col-md-6 shadow-sm">
            <div class="card" style="border:solid #888 3px;">
                <div class="card-body">
                    <div class="row" style="margin-right:-36px;">
                        <div class="col-md-5" style="
                            background-color:#004366!important;
                            margin-left:-18px;
                            margin-top:-18px;
                            margin-bottom:-18px;
                            padding:20px;
                            border-top-left-radius: 0.375rem;
                            border-bottom-left-radius: 0.375rem;">
                            <div class="text-md-left text-light">
                                <img class="mx-auto d-block" src="<?= base_url('img/logo.png') ?>" alt="logo" width="70px" height="70px">
                                <div class="fs-6 mt-4 lh-1 text-center">
                                    <strong>Dinas Lingkungan Hidup</strong>
                                </div>
                                <div class="fs-6 mt-5 lh-1 text-center">
                                    Provinsi Maluku Utara<br><br><br><br><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h3 class="card-title text-center my-4">LOGIN</h3>
                            <h5 class="card-title mb-3"><?= lang('Auth.login') ?></h5>

                            <?php if (session('error') !== null) : ?>
                                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                            <?php elseif (session('errors') !== null) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php if (is_array(session('errors'))) : ?>
                                        <?php foreach (session('errors') as $error) : ?>
                                            <?= $error ?>
                                            <br>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <?= session('errors') ?>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>

                            <?php if (session('message') !== null) : ?>
                            <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                            <?php endif ?>
                            <form action="<?= url_to('login') ?>" method="post">
                                <?= csrf_field() ?>

                                <!-- Email -->
                                <div class="mb-2">
                                    <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?? ($_SERVER['CI_ENVIRONMENT'] == 'development' ? 'admin_ilkom@demo.app' : '') ?>" required />
                                </div>

                                <!-- Password -->
                                <div class="mb-2">
                                    <input type="password" class="form-control" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" value="<?= $_SERVER['CI_ENVIRONMENT'] == 'development' ? 'Labotex123' : '' ?>" required />
                                </div>

                                <!-- Remember me -->
                                <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')): ?> checked<?php endif ?>>
                                            <?= lang('Auth.rememberMe') ?>
                                        </label>
                                    </div>
                                <?php endif; ?>

                                <!-- reCAPTCHA -->
                                <input type="hidden" id="token" name="token">

                                <div class="d-grid col-12 mx-auto m-3">
                                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.login') ?></button>
                                </div>

                                <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                                    <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
                                <?php endif ?>

                                <?php if (setting('Auth.allowRegistration')) : ?>
                                    <p class="text-center"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
                                <?php endif ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3 text-white fs-6">
                <b>Copyright &copy; CV Indo Titechno <?= date('Y') ?></b>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('<?= getenv('recaptcha.sitekey') ?>', {action: 'form_submit'}).then(function(token) {
        document.getElementById('token').value = token;
    });
});
</script>
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
  background-color: rgba(0,0,0,0.2); 
  z-index: -1;
  backdrop-filter: blur(5px) brightness(70%) contrast(80%);
}
</style>
<?= $this->endSection() ?>