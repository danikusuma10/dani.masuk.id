<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Tambah <?= $title; ?></h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('th_ajaran/tambah_aksi'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="id_tahun" name="id_tahun" placeholder="Masukan id_tahun" value="<?= set_value('id_tahun'); ?>">
                                <?= form_error('id_tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="tahun_ajaran" name="tahun_ajaran" placeholder="Masukan tahun_ajaran" value="<?= set_value('tahun_ajaran'); ?>">
                                <?= form_error('tahun_ajaran', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="besar_spp" name="besar_spp" placeholder="Masukan besar_spp" value="<?= set_value('besar_spp'); ?>">
                                <?= form_error('besar_spp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <hr>
                            <input type="submit" name="tambah" value="TAMBAHKAN" class="btn btn-success btn-user btn-block">

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