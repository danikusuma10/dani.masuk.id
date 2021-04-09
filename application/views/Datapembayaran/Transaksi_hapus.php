<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Terhapus</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive" style="margin-top: 30px">
                <table class="table table-bordered" id="dataTables-example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>ID Transaksi</th>
                            <th>Bulan</th>
                            <th>Tanggal Bayar</th>
                            <th>Besar SPP</th>
                            <th>Penerima</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($xtrans as $u) {
                        ?>
                            <tr>
                                <td><?php echo $id++ ?></td>
                                <td><?php echo $u->id_transaksi ?></td>
                                <?php
                                if ($u->id_bulan <= 07) {
                                    $tahun = substr($u->tahun_ajaran, 0, 4);
                                } else {
                                    $tahun = substr($u->tahun_ajaran, 5);
                                }
                                ?>
                                <td><?php echo $u->bulan . ' ' . $tahun ?></td>
                                <td><?php echo date('d-m-Y', strtotime($u->tanggal_bayar)); ?></td>
                                <td><?php echo 'Rp. ' . number_format($u->besar_spp, 0, ',', '.'); ?></td>
                                <td><?php echo $u->name ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/jquery/jquery.js' ?>"></script>