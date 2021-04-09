<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Tambah <?= $title; ?>/Siswa</h1>
                        </div>
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
                                <input type="text" class="form-control form-control-user" id="no_hp_Siswa" name="no_hp_siswa" placeholder="Masukan Nomor Hp Siswa" value="<?= set_value('no_hp_siswa'); ?>">
                                <?= form_error('no_hp_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <select class="form-control form-control-user" id="tahun_ajaran" name="tahun_ajaran" value="<?= set_value('tahun_ajaran'); ?>">
                                    <?php
                                    foreach ($this->m_siswa->tampildata_tahun()->result() as $k) {
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

                            <input type="submit" name="tambah" value="TAMBAHKAN SISWA" class="btn btn-success btn-user btn-block">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->