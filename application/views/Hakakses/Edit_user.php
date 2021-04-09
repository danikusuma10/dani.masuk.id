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
                        <?php foreach ($user as $u) { ?>
                            <form class="user" method="post" action="<?= base_url('admin/update'); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $u->id ?>">
                                    <input type="text" class="form-control form-control-user" id="name" name="name" value="<?php echo $u->name ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" value="<?php echo $u->email ?>">
                                </div>
                                <div class="form-group">
                                    &nbsp<label>Unggah foto</label><br>
                                    &nbsp<input type="file" id="image" name="image">

                                </div>

                                <hr>
                                <div class="form-group">
                                    <label>Pilih level:</label>
                                    <select name="user_role" class="form-control" style="margin-left: 10px;">
                                        <?php
                                        foreach ($this->m_admin->tampil_datalevel()->result() as $r) {
                                        ?>
                                            <option value="<?php echo $r->role_id ?>"> <?php echo $r->role ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Status akun :</label><br>
                                    &nbsp<input type="radio" name="is_active" id="1" class="with-gap" value="1" <?php if ($u->is_active == '1') {
                                                                                                                    echo 'checked';
                                                                                                                } ?> />
                                    <label for="ON" class="m-l-20">ON</label>

                                    <input type="radio" name="is_active" id="0" class="with-gap" value="0" <?php if ($u->is_active == '0') {
                                                                                                                echo 'checked';
                                                                                                            } ?> />
                                    <label for="OFF" class="m-l-20">OFF</label>
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

</div>
<!-- End of Main Content -->