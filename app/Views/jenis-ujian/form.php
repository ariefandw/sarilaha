<?= $this->extend('layout/app') ?>


<?= $this->section('content') ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Jenis Ujian</h3>
    <div class="card-tools"></div>
  </div>
  <div class="card-body">
    <form method="post"
      action="<?= site_url('jenisujian/' . $action . ($action == 'update' ? '/' . $row->id : '')); ?>">

      <div class="row">
        <div class="col-md-6 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-header">General</div>
            <div class="card-body row">
              <div class="mb-3">
                <label class="form-label">Prodi</label>
                <select class="form-select" name="prodi_id">
                  <?php foreach ($prodis as $prodi): ?>
                    <option value="<?= $prodi->id ?>" <?= $prodi->id == $row->prodi_id ? 'selected' : '' ?>>
                      <?= $prodi->nama_prodi ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Ujian</label>
                <input type="text" class="form-control" name="nama_ujian" value="<?= $row->nama_ujian; ?>">
              </div>
              <div class="mb-3 col-auto">
                <label class="form-label">Jumlah Pembimbing</label>
                <input type="number" class="form-control" name="jumlah_pembimbing"
                  value="<?= $row->jumlah_pembimbing; ?>">
              </div>
              <div class="mb-3 col-auto">
                <label class="form-label">Jumlah Penguji</label>
                <input type="number" class="form-control" name="jumlah_penguji" value="<?= $row->jumlah_penguji; ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Syarat</div>
            <div class="card-body row">
              <div class="mb-3 col-auto">
                <label class="form-label">Semester Ditempuh</label>
                <input type="number" class="form-control" name="semester_ditempuh"
                  value="<?= $row->semester_ditempuh; ?>">
              </div>
              <div class="mb-3 col-auto">
                <label class="form-label">SKS Ditempuh</label>
                <input type="number" class="form-control" name="sks_ditempuh" value="<?= $row->sks_ditempuh; ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Berkas Syarat</label>
                <div class="row">
                  <div class="col-md-6">
                    <div id="inputForm">
                      <?php foreach ($berkases as $index => $berkas): ?>
                        <div class="mt-1 input-group input-group-sm">
                          <input type="hidden" name="berkases[<?= $index ?>][id]" value="<?= $berkas->id ?>">
                          <input type="text" name="berkases[<?= $index ?>][nama_berkas_syarat]" class="form-control"
                            placeholder="Syarat Berkas" value="<?= $berkas->nama_berkas_syarat ?>">
                          <button type="button" class="btn btn-danger deleteBtn">
                            <i class="fa-solid fa-times"></i>
                          </button>
                        </div>
                      <?php endforeach ?>
                    </div>
                    <button type="button" id="addBtn" class="mt-1 btn btn-sm btn-success">
                      <i class="fa-solid fa-plus"></i> Tambah Berkas Syarat
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Penilaian</div>
            <div class="card-body">

              <div class="row">
                <div class="mb-3 col-auto">
                  <label class="form-label">Bobot Pembimbing</label>
                  <input type="number" class="form-control" name="bobot_pembimbing" step="0.01"
                    value="<?= $row->bobot_pembimbing; ?>">
                </div>
                <div class="mb-3 col-auto">
                  <label class="form-label">Bobot Penguji</label>
                  <input type="number" class="form-control" name="bobot_penguji" step="0.01"
                    value="<?= $row->bobot_penguji; ?>">
                </div>
              </div>

              <div class="mb-3 col-auto">
                <table id="my-table" class="table table-sm">
                  <thead>
                    <tr>
                      <th>Kriteria Penilaian</th>
                      <th>Bobot</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="table-penilaian">
                    <!-- <tr>
                      <td>Nilai pembimbing</td>
                      <td><input type="number" min="0" max="10" class="form-control form-control-sm" value=""></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Nilai penguji</td>
                      <td><input type="number" min="0" max="10" class="form-control form-control-sm" value=""></td>
                      <td></td>
                    </tr> -->
                    <?php foreach ($penilaians as $index => $penilaian): ?>
                      <tr>
                        <td>
                          <input type="hidden" name="penilaians[<?= $index ?>][id]" value="<?= $penilaian->id ?>">
                          <input type="text" name="penilaians[<?= $index ?>][nama_penilaian]"
                            class="form-control form-control-sm" value="<?= $penilaian->nama_penilaian ?>"
                            placeholder="Kriteria">
                        </td>
                        <td>
                          <input type="number" name="penilaians[<?= $index ?>][bobot]" min="0" max="25" step="0.01"
                            class="form-control form-control-sm bobot" value="<?= $penilaian->bobot ?>"
                            placeholder="Bobot">
                        </td>
                        <td>
                          <?php if ($index > 1): ?>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)">
                              <i class="fa-solid fa-times"></i>
                            </button>
                          <?php endif ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                  <tfooter>
                    <tr>
                      <td>Total Bobot</td>
                      <td id="total-bobot">0</td>
                      <td></td>
                    </tr>
                  </tfooter>
                </table>
                <button type="button" class="btn btn-sm btn-success" onclick="addRow()">
                  <i class="fa-solid fa-plus"></i> Tambah Kriteria
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="text-danger" id="pesan-bobot"></div>
      <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>

  let indexPenilaian = 0;
  let indexBerkasSyarat = 0;

  function addRow() {
    indexPenilaian--;
    let html = `
      <tr>
        <td>
          <input type="hidden" name="penilaians[${indexPenilaian}][id]" value="">
          <input type="text" name="penilaians[${indexPenilaian}][nama_penilaian]"
            class="form-control form-control-sm" value="" placeholder="Kriteria">
        </td>
        <td>
          <input type="number" name="penilaians[${indexPenilaian}][bobot]" min="0" max="25" step="0.01"
            class="form-control form-control-sm bobot" value="0" placeholder="Bobot">
        </td>
        <td>
          <button type="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)">
            <i class="fa-solid fa-times"></i>
          </button>
        </td>
      </tr>
    `;
    $('#table-penilaian').append(html);
    $('.bobot').off('keydown').on('keyup', calculateTotal);
  }

  function calculateTotal() {
    let totalBobot = 0;
    $('.bobot').each(function () {
      const bobot = parseFloat($(this).val());
      if (!isNaN(bobot)) {
        totalBobot += bobot;
      }
    });
    $('#total-bobot').text(totalBobot);
    if (totalBobot == 25) {
      $('#submit').prop('disabled', false);
      $('#pesan-bobot').text('');
    } else {
      $('#submit').prop('disabled', true);
      $('#pesan-bobot').text('Total bobot harus 25');
    }
  }

  function deleteRow(button) {
    var row = button.parentNode.parentNode;

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'Data ini akan terhapus permanen!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        row.parentNode.removeChild(row);
      }
    });
  }

  $(document).ready(function () {
    calculateTotal();
    $('.bobot').off('keydown').on('keyup', calculateTotal);

    $('#addBtn').click(function () {
      indexBerkasSyarat--;
      let html = `
      <div class="mt-1 input-group input-group-sm">
        <input type="hidden" name="berkases[${indexBerkasSyarat}][id]" value="">
        <input type="text" name="berkases[${indexBerkasSyarat}][nama_berkas_syarat]" class="form-control"
          placeholder="Syarat Berkas" value="">
        <button type="button" class="btn btn-danger deleteBtn">
          <i class="fa-solid fa-times"></i>
        </button>
      </div>
    `;
      $('#inputForm').append(html);
    });

    $(document).on('click', '.deleteBtn', function () {
      let deleteBtn = $(this);
      let inputGroup = deleteBtn.closest('.input-group');

      Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Data ini akan terhapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.isConfirmed) {
          inputGroup.remove();
        }
      });
    });
  });

  $(document).ready(function () {
    $("#add-row").click(function () {
      addRowBerkasSyarat();
    });

    $(document).on("click", ".delete-row", function () {
      $(this).closest("tr").remove();
    });
  });




</script>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<style>

</style>
<?= $this->endSection() ?>