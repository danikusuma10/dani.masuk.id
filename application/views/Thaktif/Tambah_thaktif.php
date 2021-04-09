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
                        <form class="user" method="post" action="<?= base_url('Th_aktif/tambah_aksi'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" hidden="" id="id" name="id" placeholder="Masukan id" value="<?= set_value('id'); ?>">
                                <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <select id="nis" name="nis" class="form-control" style="margin-left: 10px;">
                                    <?php
                                    foreach ($this->db->query('SELECT siswa.nis, siswa.nama_siswa FROM siswa')->result() as $sis) { /*$this->m_transaksi->tampil_datatahun()->result() */
                                    ?>
                                        <option value="<?php echo $sis->nis ?>"> <?php echo $sis->nis . ' | ' . $sis->nama_siswa . ''; ?> </option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="id_tahun" name="id_tahun" class="form-control" style="margin-left: 10px;">
                                    <?php
                                    foreach ($this->db->query('SELECT * FROM tahun_ajaran')->result() as $tajaran) { /*$this->m_transaksi->tampil_datatahun()->result() */
                                    ?>
                                        <option value="<?php echo $tajaran->id_tahun ?>"> <?php echo $tajaran->tahun_ajaran; ?> </option>

                                    <?php } ?>
                                </select>
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