<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nilai Ujian</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="post" action="<?= site_url('ujian/nilai') ?>">
            <input type="hidden" name="id" value="<?= $row->id ?>" />
            <dl class="row">
                <dt class="col-sm-2">NIM</dt>
                <dd class="col-sm-10">
                    <?= $mahasiswa->nim ?>
                </dd>

                <dt class="col-sm-2">Nama</dt>
                <dd class="col-sm-10">
                    <?= $mahasiswa->nama ?>
                </dd>

                <dt class="col-sm-2">Prodi</dt>
                <dd class="col-sm-10">
                    <?= (new \App\Models\Prodi)->find($mahasiswa->prodi_id)->nama_prodi ?>
                </dd>

                <dt class="col-sm-2">Jenis Ujian</dt>
                <dd class="col-sm-10">
                    <?= $jenis_ujian->nama_ujian ?>
                </dd>

                <dt class="col-sm-2">Judul Penelitian</dt>
                <dd class="col-sm-10">
                    <?= $row->judul ?>
                </dd>

                <h3 class="text-secondary mt-4">
                    Penilaian dapat dilakukan setelah ujian pada
                    <?= format_date($row->tanggal_ujian) ?>
                </h3>

                <?php if (now() > $row->tanggal_ujian): ?>
                    <div class="row mt-3 mb-2">
                        <div class="col-sm-4">Kriteria Penilaian</div>
                        <div class="col-sm-2">Nilai (0 - 4)</div>
                        <div class="col-sm-1">Bobot</div>
                        <div class="col-sm-1">Nilai x Bobot</div>
                        <div class="col-sm-4"></div>
                    </div>

                    <?php
                    $total['bobot']       = 0;
                    $total['nilai_bobot'] = 0;
                    ?>
                    <?php foreach ($nilais as $i => $nilai): ?>
                        <div class="row mb-1">
                            <div class="col-sm-4">
                                <?= $nilai->nama_penilaian ?>
                            </div>
                            <div class="col-sm-2">
                                <input type="number" style="width:150px;" class="form-control" name="nilai[<?= $nilai->id ?>]"
                                    min="0" max="4" value="<?= $nilai->nilai; ?>">
                            </div>
                            <div class="col-sm-1">
                                <?= $nilai->bobot ?>
                                <input type="hidden" name="bobot[<?= $nilai->id ?>]" value="<?= $nilai->bobot; ?>">
                            </div>
                            <div class="col-sm-1 nilai-bobot">
                                <?= $nilai->nilai * $nilai->bobot ?>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <?php
                        $total['bobot'] += $nilai->bobot;
                        $total['nilai_bobot'] += $nilai->nilai * $nilai->bobot;
                        ?>
                    <?php endforeach ?>

                    <div class="row mt-2 mb-2">
                        <div class="col-sm-4"><b>Nilai Total</b></div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-1">
                            <b>
                                <?= $total['bobot'] ?>
                            </b>
                        </div>
                        <div class="col-sm-1">
                            <b id="nilai-akhir-angka">
                                <?= $total['nilai_bobot'] ?>
                            </b>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>

                    <dt class="col-sm-2 mt-2 mb-2">Laporan</dt>
                    <dt class="col-sm-10 mt-2 mb-2">Catatan</dt>

                    <!-- <dt class="col-sm-12">
                    <textarea class="form-control" name="catatan" rows="6">
                        <?= $row->catatan ?>
                    </textarea>
                </dt> -->

                    <?php foreach ($revisis as $revisi): ?>
                        <dd class="row">
                            <div class="col-2">
                                <a class="col-sm-6 pl-2" target="__blank"
                                    href="https://docs.google.com/document/d/<?= $revisi->drive_file_id ?>">
                                    <img style="height:40px;"
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/Google_Docs_logo_%282014-2020%29.svg/1481px-Google_Docs_logo_%282014-2020%29.svg.png" />
                                    &nbsp; Revisi
                                    <?= $revisi->versi ?>
                                </a>
                            </div>
                            <div class="col-10">
                                <textarea class="form-control border-info"
                                    name="catatan[<?= $revisi->id ?>]"><?= $revisi->catatan ?></textarea>
                            </div>
                        </dd>
                    <?php endforeach ?>

                    <dt class="col-sm-12 form-check mt-2 ms-3">
                        <input class="form-check-input border-primary" type="checkbox" id="approve_revisi"
                            name="approve_revisi" value="1" <?= $row->approve_revisi == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="approve_revisi">Approve Revisi</label>
                    </dt>

                <?php endif ?>
            </dl>
            <a href="<?= site_url('ujian') ?>" onclick="history.back();" class="btn btn-outline-primary">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <?php if (now() > $row->tanggal_ujian): ?>
                <button tyype="submit" class="btn btn-primary">Simpan</button>
            <?php endif ?>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function () {
        $('input[name^="nilai["], input[name^="bobot["]').on('input', calculateSum);

        function calculateSum() {
            console.log($('input[name^="nilai["]'));
            let sum = 0;

            // Loop through each pair of a and b inputs
            $('input[name^="nilai["]').each(function (index) {
                const nilai = parseInt($(this).val());
                const bobot = parseInt($('input[name^="bobot["]').eq(index).val());
                sum += nilai * bobot;
                $('.nilai-bobot').eq(index).text(nilai * bobot);
            });

            $('#nilai-akhir-angka').text(sum);
        }
    });
</script>
<?= $this->endSection() ?>