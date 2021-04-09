


<div class="container-fluid">


    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewSiswa">Tambah Siswa</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Tahun Ajaran</th>
                            <th>Status Akun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($siswa as $d) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $d->nis ?></td>
                                <td><?= $d->nama_siswa ?></td>
                                <td><?= $d->jenis_kelamin ?></td>
                                <td><?= $d->alamat ?></td>
                                <td><?= $d->no_hp_siswa ?></td>
                                <td><?= $d->tahun_ajaran ?></td>
                                <td><?= $d->is_active ?></td>
                                <td>
                                    <a href="#" class='fas fa-edit' style='font-size:15px;color:#00cc00' data-toggle="modal" data-target="#updateDonatur<?= $d->nis ?>"></a>
                                    <a href="#" class='fas fa-trash' style='font-size:15px;color:red' data-toggle="modal" data-target="#deleteDonatur<?= $d->nis ?>"></a>

                                </td>
                            </tr>
                            <!--update donatur-->
                            <div class="modal fade" id="updateDonatur<?= $d->nis ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Update Donatur </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="p-5">

                                            <form class="user" method="post" action="<?= base_url('siswa/update'); ?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label> NIS </label><br>
                                                    <input type="number" class="form-control form-control-user" name="nis" value="<?php echo $d->nis ?>" readonly="">
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label> Nama Siswa</label><br>
                                                    <input type="text" class="form-control form-control-user" id="nama_siswa" name="nama_siswa" value="<?php echo $d->nama_siswa ?>">
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label><br>
                                                    &nbsp<input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="with-gap" value="laki-laki" <?php if ($d->jenis_kelamin == 'laki-laki') {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        } ?> />
                                                    <label for="laki-laki" class="m-l-20">Laki Laki</label>

                                                    <input type="radio" name="jenis_kelamin" id="jenis_kelamin" class="with-gap" value="perempuan" <?php if ($d->jenis_kelamin == 'perempuan') {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?> />
                                                    <label for="perempuan" class="m-l-20">Perempuan</label>
                                                </div>
                                                <div class="form-group">
                                                    <label> Alamat </label><br>
                                                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" value="<?php echo $d->alamat ?>">
                                                </div>


                                                <div class="form-group">
                                                    <label> No HP Siswa </label><br>
                                                    <input type="text" class="form-control form-control-user" id="no_hp_siswa" name="no_hp_siswa" value="<?php echo $d->no_hp_siswa ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label> Tahun Ajaran </label><br>
                                                    <input type="text" class="form-control form-control-user" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $d->id_tahun ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Status akun :</label><br>
                                                    &nbsp<input type="radio" name="is_active" id="1" class="with-gap" value="1" <?php if ($d->is_active == '1') {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?> />
                                                    <label for="Aktif" class="m-l-20">Aktif</label>

                                                    <input type="radio" name="is_active" id="0" class="with-gap" value="0" <?php if ($d->is_active == '0') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?> />
                                                    <label for="Tidak aktif" class="m-l-20">Tidak aktif</label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="tambah" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--delete donatur-->
                            <div class="modal fade" id="deleteDonatur<?= $d->nis ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Donat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $d->nama_siswa ?></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('siswa/deleteSiswa?nis=') ?><?= $d->nis ?>" class="btn btn-primary">Hapus</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php $no++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="addNewSiswa" tabindex="-1" role="dialog" aria-labelledby="addNewSiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSiswaLabel">Tambah Siswa Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="p-5">
                <form class="siswa" method="post" action="<?= base_url('siswa/tambah_aksi'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nis">NIS</label><br>
                        <input type="text" class="form-control form-control-user" id="nis" name="nis" placeholder="Masukan NIS" value="<?= set_value('nis'); ?>">
                        <?= form_error('nis', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" class="form-control form-control-user" id="nama_siswa" name="nama_siswa" placeholder="Masukan Nama Siswa" value="<?= set_value('nama_siswa'); ?>">
                        <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="laki-laki">Jenis Kelamin</label><br>
                        &nbsp<input type="radio" name="jenis_kelamin" id="laki-laki" class="with-gap" value="laki-laki">
                        <label for="laki-laki" class="m-l-20">Laki-Laki</label>

                        <input type="radio" name="jenis_kelamin" id="perempuan" class="with-gap" value="perempuan">
                        <label for="perempuan" class="m-l-20">perempuan</label>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukan Alamat Siswa" value="<?= set_value('alamat'); ?>">
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="no_hp_siswa">No. HP Siswa</label>
                        <input type="text" class="form-control form-control-user" id="no_hp_siswa" name="no_hp_siswa" placeholder="Masukan Nomor Hp Siswa" value="<?= set_value('no_hp_siswa'); ?>">
                        <?= form_error('no_hp_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <select class="form-control form-control-user" id="tahun_ajaran" name="tahun_ajaran" value="<?= set_value('tahun_ajaran'); ?>">
                            <?php
                            foreach ($this->Siswa_model->tampildata_tahun()->result() as $k) {
                            ?>
                                <option value="<?php echo $k->id_tahun ?>"><?php echo $k->tahun_ajaran ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status akun :</label><br>
                        &nbsp<input type="radio" name="is_active" id="1" class="with-gap" value="1">
                        <label for="Aktif" class="m-l-20">Aktif</label>

                        <input type="radio" name="is_active" id="0" class="with-gap" value="0">
                        <label for="Tidak aktif" class="m-l-20">Tidak aktif</label>
                    </div>

                    <div class="form-group" hidden>
                        <input type="text" class="form-control form-control-user" id="role_id" name="role_id" value="2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Add</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>