<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel <?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">


        <div class="card-body">
            <div class="container">

                <link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.css'); ?>" />
                <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script> <!-- Load file jquery -->
                <form method="get" action="" class="form">
                    <div class="form-group">
                        <label>Filter Berdasarkan</label>
                        <select class="form-control" name="filter" id="filter" style="width: 50%">
                            <option value="">Pilih</option>
                            <?php if ($_SESSION["role_id"] == "1") { ?>
                                <option value="1">Per Tanggal</option>
                            <?php } ?>
                            <option value="2">Per Siswa</option>
                            <?php if ($_SESSION["role_id"] == "1") { ?>
                                <option value="3">Per Tahun Ajaran</option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group" id="form-tanggal">
                        <label>Dari Tanggal</label>
                        <input type="date" name="tanggal" class="form-control input-tanggal" style="width: 50%" />
                    </div>

                    <div class="form-group" id="form-tanggal2">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="tanggal2" class="form-control input-tanggal2" style="width: 50%" />
                    </div>

                    <div class="form-group" id="form-nis">
                        <label>NIS/Nama Santri</label>
                        <select name="nis" class="form-control" style="width: 50%">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($nis as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                echo '<option value="' . $data->nis . '">' . $data->nis . ' | ' . $data->nama_siswa . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" id="form-tahun">
                        <label>Tahun Ajaran</label>
                        <select name="tahun" class="form-control" style="width: 50%">
                            <option value="">Pilih</option>
                            <?php
                            foreach ($tahun as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                echo '<option value="' . $data->id_tahun . '">' . $data->tahun_ajaran . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Tampilkan</button>
                    <a href="<?php echo base_url() . "Datapembayaran/laporan"; ?>">Reset Filter</a>
                </form>

            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $ket; ?></h6>
        </div>

        <div class="card-body">

            <a href="<?php echo $url_cetak; ?>">CETAK PDF</a>

            <div class="table-responsive" style="margin-top: 30px">
                <table class="table table-bordered" id="dataTable" width="130%" border="1" cellspacing="0">
                    <thead style="text-align: center">
                        <tr>
                            <th style="width: 1%;" text-align: center;"">NO</th>
                            <th style="width: 5%;">ID Transaksi</th>
                            <th style="width: 10%;">NIS</th>
                            <th style="width: 25%;">Nama</th>
                            <th style="width: 25%;">Bulan</th>
                            <th style="width: 15%;">Tanggal Bayar</th>
                            <th style="width: 27%;">Besar SPP</th>
                            <th style="width: 19%;">Penerima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($transaksi)) {
                            $no = 1;
                            foreach ($transaksi as $data) {
                        ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $no++ ?></td>
                                    <td><?php echo $data->id_transaksi ?></td>
                                    <td><?php echo $data->nis ?></td>
                                    <td><?php echo $data->nama_siswa ?></td>
                                    <?php
                                    if ($data->id_bulan <= 07) {
                                        $tahun = substr($data->tahun_ajaran, 0, 4);
                                    } else {
                                        $tahun = substr($data->tahun_ajaran, 5);
                                    }
                                    ?>
                                    <td><?php echo $data->bulan . ' ' . $tahun ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($data->tanggal_bayar)); ?></td>
                                    <td><?php echo 'Rp. ' . number_format($data->besar_spp, 0, ',', '.'); ?></td>
                                    <td><?php echo $data->name ?></td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>

                    <script src="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
                    <script>
                        $(document).ready(function() { // Ketika halaman selesai di load

                            $('#form-tanggal, #form-tanggal2, #form-nis, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

                            $('#filter').change(function() { // Ketika user memilih filter
                                if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                                    $('#form-nis, #form-bulan, #form-tahun').hide();
                                    $('#form-tanggal').show(); // Tampilkan form tanggal
                                    $('#form-tanggal2').show(); // Tampilkan form tanggal
                                } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                                    $('#form-tanggal, #form-tanggal2, #form-bulan, #form-tahun').hide();
                                    $('#form-nis').show(); // Tampilkan form bulan dan tahun
                                } else if ($(this).val() == '3') { // Jika filter nya 2 (per bulan)
                                    $('#form-tanggal, #form-tanggal2, #form-nis').hide();
                                    $('#form-tahun').show(); // Tampilkan form bulan dan tahun
                                } else { // Jika filternya 3 (per tahun)
                                    $('#form-tanggal, #form-tanggal2, #form-nis, #form-tahun').hide();
                                }

                                $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
                            })
                        })
                    </script>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->