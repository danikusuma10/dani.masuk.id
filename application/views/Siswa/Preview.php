<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak PDF</title>

    <style>
        .tabel {
            border-collapse: collapse;
            margin: auto;
        }

        .tabel th {
            padding: 6px 10px;
            background-color: #17A673;
            color: #000;
            font-size: 25px;
        }
    </style>

</head>

<body>
    <div style="padding: 4mm; border: 2px solid;" align="center">
        <h1>PONDOK PESANTREN AL MUNAWWIR KRAPYAK KOMPLEK L</h1>
        <h2>DAFTAR SANTRI</h2>
    </div>
    <br>
    <?php echo anchor('siswa/cetak1/', '<input type=button  value=\'Cetak Data\'>'); ?>
    <?php echo anchor('siswa', '<input type=button value=\'Kembali\'>'); ?>
    <br>
    <br>
    <table border="1px" class="tabel">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No Hp Siswa</th>
            <th>Tahun</th>
        </tr>

        <?php
        if (!empty($siswa)) {
            $no = 1;
            foreach ($siswa as $u) {
        ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $u->nis ?></td>
                    <td><?php echo $u->nama_siswa ?></td>
                    <td><?php echo $u->jenis_kelamin ?></td>
                    <td><?php echo $u->alamat ?></td>
                    <td><?php echo $u->no_hp_siswa ?></td>
                    <td><?php echo $u->tahun_ajaran ?></td>
                </tr>
            <?php } ?>
        <?php } ?>

    </table>
</body>

</html>