<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel <?= $title; ?></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Siswa</h6>
        </div>

        <div class="card-body">
            <div class="container">
                <?php foreach ($siswa as $u) { ?>

                    <div class="row" style="height: 35px">
                        <div class="col-4"><b>NIS</b></div>
                        <div class="col-8"> <?php echo $u->nis ?></div>
                    </div>
                    <div class="row" style="height: 35px">
                        <div class="col-4"><b>Nama</b></div>
                        <div class="col-8"> <?php echo $u->nama_siswa ?></div>
                    </div>
                    <div class="row" style="height: 35px">
                        <div class="col-4"><b>Jenis Kelamin</b></div>
                        <div class="col-8"> <?php echo $u->jenis_kelamin ?></div>
                    </div>
                    <div class="row" style="height: 35px">
                        <div class="col-4"><b>Alamat</b></div>
                        <div class="col-8"> <?php echo $u->alamat ?></div>
                    </div>
                    <div class="row" style="height: 35px">
                        <div class="col-4"><b>No HP</b></div>
                        <div class="col-8"> <?php echo $u->no_hp_siswa ?></div>
                    </div>
                    <!--<div class="row" style="height: 35px">
                    <div class="col-4"><b>Kelas | Tahun Ajaran</b></div>
                    <div class="col-8"> <?php echo $u->kelas . ' | ' . $u->tahun_ajaran ?></div>
                  </div>-->

                <?php } ?>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->