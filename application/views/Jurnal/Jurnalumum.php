

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <form class="form-inline" action="<?= base_url('kas/search') ?>" method="post">

        <div class="form-group mb-2">
            <input class="form-control" type="date" id="tanggal_awal" value="<?= $this->session->flashdata('tglawal') ?>" name="tanggal_awal">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input class="form-control" type="date" id="tanggal_akhir" value="<?= $this->session->flashdata('tglakhir') ?>" name="tanggal_akhir">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Search</button>

    </form>

    <div class="row">


        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <div class="card">
                <div class="card-header">
                    Buku Kas Umum
                </div>

                <div class="card-body">
                    <!-- <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#cetakLaporan"><i class="fas fa-print"></i> Cetak Buku Kas Umum</a> -->
                    <a href="<?= base_url('kas/cetak?p=') ?>excel&tglawal=<?= $this->session->flashdata('tglawal') ?>&tglakhir=<?= $this->session->flashdata('tglakhir') ?>" class=" btn btn-success mb-4"><i class="fas fa-file-excel"></i> Download Excel</a>



                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">No.Bukti</th>
                                    <th scope="col">Uraian</th>
                                    <th scope="col">Debet</th>
                                    <th scope="col">Kredit</th>
                                    <th scope="col">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $saldo = 0;
                                foreach ($jurnal as $d) :
                                    $date = date_create($d['tgl_transaksi']);

                                    if ($d['debit'] == 0) {
                                        $nominal = $d['kredit'];

                                        $saldo = $saldo - $nominal;
                                    } else {
                                        $nominal = $d['debit'];
                                        $saldo = $saldo + $nominal;
                                    }
                                ?>

                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= date_format($date, "d F Y") ?></td>
                                        <td><?= $d['id_transaksi'] ?></td>
                                        <?php if ($user['role_id'] == 3 &&  substr($d['keterangan'], 0, 10) == 'Donasi A/n') { ?>
                                            <td><?= substr($d['keterangan'], 0, 10) ?> ****************</td>
                                        <?php } else { ?>
                                            <td><?= $d['keterangan'] ?></td>
                                        <?php } ?>
                                        <td style="text-align:right;"><?= number_format($d['debit'], 0, ',', '.') ?></td>
                                        <td style="text-align:right;"><?= number_format($d['kredit'], 0, ',', '.') ?></td>
                                        <td style="text-align:right;">Rp <?= number_format($saldo, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    
                                <?php $i++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="cetakLaporan" tabindex="-1" role="dialog" aria-labelledby="cetakLaporanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakLaporanLabel">Cetak Buku Kas Umum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline">

                    <div class="form-group mx-sm-3 mb-2">
                        <a href="<?= base_url('kas/cetak?p=') ?>excel&tglawal=<?= $this->session->flashdata('tglawal') ?>&tglakhir=<?= $this->session->flashdata('tglakhir') ?>" class=" btn btn-success mb-3"><i class="fas fa-file-excel"></i> Download Excel</a>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>