<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit <?= $title; ?>/user</h1>
                        </div>
                        <?php foreach ($siswa as $u) { ?>
                            <form class="user" method="post" action="<?= base_url('siswa/update'); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label> NIS </label><br>
                                    <input type="number" class="form-control form-control-user" name="nis" value="<?php echo $u->nis ?>" readonly="">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label> Nama Siswa</label><br>
                                    <input type="text" class="form-control form-control-user" id="nama_siswa" name="nama_siswa" value="<?php echo $u->nama_siswa ?>">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label><br>
                                    &nbsp<input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="with-gap" value="laki-laki" <?php if ($u->jenis_kelamin == 'laki-laki') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?> />
                                    <label for="laki-laki" class="m-l-20">Laki Laki</label>

                                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="with-gap" value="perempuan" <?php if ($u->jenis_kelamin == 'perempuan') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?> />
                                    <label for="perempuan" class="m-l-20">Perempuan</label>
                                </div>
                                <div class="form-group">
                                    <label> Alamat </label><br>
                                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" value="<?php echo $u->alamat ?>">
                                </div>


                                <div class="form-group">
                                    <label> No HP Siswa </label><br>
                                    <input type="text" class="form-control form-control-user" id="no_hp_siswa" name="no_hp_siswa" value="<?php echo $u->no_hp_siswa ?>">
                                </div>
                                <div class="form-group">
                                    <label> Tahun Ajaran </label><br>
                                    <input type="text" class="form-control form-control-user" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $u->id_tahun ?>">
                                </div>

                                <div class="form-group">
                                    <label>Status akun :</label><br>
                                    &nbsp<input type="radio" name="is_active" id="1" class="with-gap" value="1" <?php if ($u->is_active == '1') {
                                                                                                                    echo 'checked';
                                                                                                                } ?> />
                                    <label for="Aktif" class="m-l-20">Aktif</label>

                                    <input type="radio" name="is_active" id="0" class="with-gap" value="0" <?php if ($u->is_active == '0') {
                                                                                                                echo 'checked';
                                                                                                            } ?> />
                                    <label for="Tidak aktif" class="m-l-20">Tidak aktif</label>
                                </div>
                                <hr>
                                <input type="submit" name="update" value="EDIT AKUN" class="btn btn-success btn-user btn-block">

                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->