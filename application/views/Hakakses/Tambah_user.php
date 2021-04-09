<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Tambah <?= $title; ?>/user</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('admin/tambah_aksi'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" autofocus placeholder="Nama lengkap" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukan email" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                &nbsp<label>Unggah foto</label><br>
                                &nbsp<input type="file" id="image" name="image">

                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukan password">

                            </div>
                            <hr>

                            <div class="form-group">
                                <label>Pilih level:</label>
                                <select name="user_role" class="form-control" style="margin-left: 10px;">
                                    <?php
                                    foreach ($this->Admin_model->tampil_datalevel()->result() as $r) {
                                    ?>
                                        <option value="<?php echo $r->role_id ?>"> <?php echo $r->role ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label>Status akun :</label><br>
                                &nbsp<input type="radio" name="is_active" id="1" class="with-gap" value="1">
                                <label for="ON" class="m-l-20">ON</label>

                                <input type="radio" name="is_active" id="0" class="with-gap" value="0">
                                <label for="OFF" class="m-l-20">OFF</label>
                            </div>

                            <hr>
                            <input type="submit" name="tambah" value="TAMBAHKAN AKUN" class="btn btn-success btn-user btn-block">

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