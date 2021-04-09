<!-- Begin Page Content -->
<div class="container-fluid">

<h1 class="h3 mb-2 text-primary"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
           
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center thead-light">
                        <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Status transaksi</th>
                                    <th scope="col">Gross_amount</th>
                                    <th scope="col">Tipe Pembayaran</th>
                                    <th scope="col">Bank</th>
                                    <th scope="col">VA_Number</th>
                                    <th scope="col">Waktu Transaksi</th>
                                    <th scope="col">Waktu Settlement</th>
                                    <th scope="col">Bill Key</th>
                                    <th scope="col">Biller Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tranksaksi as $t) : ?>
                            <tr>
                                <td><?= $t['order_id']; ?></td>
                                <td><?= $t['nama']; ?></td>
                                <td><?= $t['kelas']; ?></td>
                                <td><?= $t['transaction_status']; ?></td>
                                <td><?= $t['gross_amount']; ?></td>
                                <td><?= $t['payment_type']; ?></td>
                                <td><?= $t['bank']; ?></td>
                                <td><?= $t['va_number']; ?></td>
                                <td><?= $t['transaction_time']; ?></td>
                                <td><?= $t['settlement_time']; ?></td>
                                <td><?= $t['bill_key']; ?></td>
                                <td><?= $t['biller_code']; ?></td>
                              
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


