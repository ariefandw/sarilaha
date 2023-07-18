<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TTE</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <h3 style="text-align:center;">
        <div><img src="img/logo.png" alt="logo" width="70px" height="70px"></div>
        <div>TANDA TERIMA ELEKTRONIK</div>
        <div>SISTEM INFORMASI PELAPORAN ELEKTRONIK LINGKUNGAN HIDUP</div>
        <div>DINAS LINGKUNGAN HIDUP PROVINSI MALUKU UTARA</div>
    </h3>

    <hr />

    <table>
        <tr>
            <td>ID TTE</td>
            <td>:
                <?= $id_tte ?>
            </td>
        </tr>
        <tr>
            <td>PERIODE TTE</td>
            <td>:
                <?= date("d-m-Y", strtotime($row->updated_at)) ?> s/d
                <?= date("Y-m-d", strtotime($row->updated_at . " +90 days")) ?>
            </td>
        </tr>
        <tr>
            <td>WAKTU CETAK TTE</td>
            <td>:
                <?= date("d-m-Y", strtotime($row->updated_at)) ?>
            </td>
        </tr>
    </table>

    <hr />

    <table>
        <tr>
            <td>NAMA PERUSAHAAN</td>
            <td>:
                <?= $row->nama_perusahaan ?>
            </td>
        </tr>
        <tr>
            <td>ID PERUSAHAAN</td>
            <td>:
                <?= $row->perusahaan_id ?>
            </td>
        </tr>
        <tr>
            <td>ALAMAT</td>
            <td>:
                <?= $row->alamat_perusahaan ?>
            </td>
        </tr>
    </table>

    <hr />

    <table>
        <tr>
            <td>
                <img src="<?= $qr ?>" width="150" />
            </td>
            <td style="font-size:85%; text-align:center;">
                Dokumen ini sah, diterbitkan secara elektronik melalui sistem Dinas Lingkungan Hidup Provinsi Maluku
                Utara sehingga tidak memerlukan cap dan tanda tangan bsah.
                <br /><br />
                Terima kasih telah menyampaikan laporan pengelolaan dan pemantauan lingkungan.
                <br /><br />
                <b>DINAS LINGKUNGAN HIDUP PROVINSI MALUKU UTARA</b>
            </td>
        </tr>
    </table>
</body>

</html>