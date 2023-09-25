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

        table {
            border-collapse: collapse;
            /* Merge adjacent borders into one */
        }

        table,
        th,
        td {
            border: 1px solid black;
            /* Apply a 1px solid black border to the table, th, and td elements */
        }
    </style>
</head>

<body>
    <h3 style="text-align:center;">
        <!-- <div><img src="img/logo.png" alt="logo" width="70px" height="70px"></div> -->
        <div>LAPORAN RKL</div>
    </h3>

    <hr />

    <table>
        <tr>
            <th>Tahapan</th>
            <th>Kegiatan</th>
            <th>Sumber Dampak</th>
            <th>Jenis Limbah</th>
            <th>Besaran Dampak</th>
            <th>Cara Pengelolaan</th>
            <th>Tolok Ukur Pengelolaan</th>
            <th>Cara Pemantauan</th>
            <th>Tolok Ukur Pemantauan</th>
        </tr>
        <tr>
            <td>
                <?= $row->tahapan; ?>
            </td>
            <td>
                <?= $row->kegiatan; ?>
            </td>
            <td>
                <?= $row->sumber_dampak; ?>
            </td>
            <td>
                <?= $row->jenis_limbah; ?>
            </td>
            <td>
                <?= $row->besaran_dampak; ?>
            </td>
            <td>
                <?= $row->cara_pengelolaan; ?>
            </td>
            <td>
                <?= $row->tolok_ukur_pengelolaan; ?>
            </td>
            <td>
                <?= $row->cara_pemantauan; ?>
            </td>
            <td>
                <?= $row->tolok_ukur_pemantauan; ?>
            </td>
        </tr>
    </table>

</body>

</html>