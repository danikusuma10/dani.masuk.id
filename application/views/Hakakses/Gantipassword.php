<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                        </div>

                        <form class="user" method="post" action="<?= base_url('admin/updatepassword'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" maxlength="30" name="id" value="<?php echo $this->session->userdata('email'); ?>" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="lama" name="lama" placeholder="Masukan password lama">
                            </div>
                            <hr>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="baru" name="baru" placeholder="Password baru">
                            </div>
                            <hr>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="konfirmasi" name="konfirmasi" placeholder="Konfirmasi password baru">
                            </div>
                            <hr>
                            <input type="submit" name="submit" value="EDIT AKUN" class="btn btn-success btn-user btn-block">

                        </form>
                    </div>
                </div>
            </div>
        </div>

    

 </body>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->