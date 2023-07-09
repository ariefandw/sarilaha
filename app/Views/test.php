<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Test</h3>
    </div>
    <div class="card-body">
        <form action="<?= site_url('test/upload') ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="dokumen">
            <br><br>
            <input type="submit" value="Upload">
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>