<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!-- Load file JQuery online -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Load file AdminLTE offline -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/adminlte.min.css">

<!-- Load file CSS Bootstrap offline -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css">
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Load file Midtrans online -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-XntQN7g-lIfRoI0F"></script>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->

<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/summernote/summernote-bs4.min.css">

</head>




<body  class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">




        <!--Selesai pembayaran redirect kek snap finish-->
        <div class="container mt-5">
            <form id="payment-form" method="post" action="<?= site_url() ?>Snap/finish">
                <input type="hidden" name="result_type" id="result-type" value="">
        </div>
        <input type="hidden" name="result_data" id="result-data" value="">
    </div>

    <!------------------------------------------------->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <h2 class="text-center display-4">PAYMENT SMK YPT 1 PURBALINGGA</h2>

            </div>
        </section>

        <div class="container">
            <!--uhui-->
            <div class="container">

                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama" id="nama">

                        </div>


                        <div class="form-group col-md-6">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="X KOMPUTER JARINGAN">X KOMPUTER JARINGAN</option>
                                <option value="XI KOMPUTER JARINGAN">XI KOMPUTER JARINGAN</option>
                                <option value="XII KOMPUTER JARINGAN">XII KOMPUTER JARINGAN</option>

                                <option value="X TEKNIK FABRIKASI LOGAM">X TEKNIK FABRIKASI LOGAM</option>
                                <option value="XI TEKNIK FABRIKASI LOGAM">XI TEKNIK FABRIKASI LOGAM</option>
                                <option value="XII TEKNIK FABRIKASI LOGAM">XII TEKNIK FABRIKASI LOGAM</option>

                                <option value="X TEKNIK ELEKTRONIKA INDUSTRI">X ELEKTRONIKA INDUSTRI</option>
                                <option value="XI TEKNIK ELEKTRONIKA INDUSTRI">XI ELEKTRONIKA INDUSTRI</option>
                                <option value="XII TEKNIK ELEKTRONIKA INDUSTRI">XII ELEKTRONIKA INDUSTRI</option>

                                <option value="X TEKNIK KENDARAAN RINGAN">X KOMPUTER JARINGAN</option>
                                <option value="XI TEKNIK KENDARAAN RINGAN">XI KOMPUTER JARINGAN</option>
                                <option value="XII TEKNIK KENDARAAN RINGAN">XII KOMPUTER JARINGAN</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nohp">Nomor HP</label>
                        <input type="text" class="form-control" id="nohp" placeholder="+62900000000">
                    </div>
                    <div class="form-group">
                        <label for="email">EMAIL</label>
                        <input type="email" class="form-control" id="email" placeholder="dani.kusuma@stikomyos.ac.id">
                    </div>


                    <div class="form-group col-md-4">
                        <label for="jmlbayar">Jenis Pembayaran</label>
                        <select id="jmlbayar" class="form-control">
                            <option value="150000">BAYAR SPP 1 BULAN</option>
                            <option value="300000">BAYAR SPP 2 BULAN</option>
                            <option value="450000">BAYAR SPP 3 BULAN</option>
                            <option value="600000">BAYAR SPP 4 BULAN</option>

                        </select>
                    </div>

            </div>

            <button type="submit" class="btn btn-primary" id="pay-button">Pay Now</button>
            </form>
        </div>
    </div>

    </div>
    </div>



</body>





<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        var nohp = $('#nohp').val();
        var nama = $('#nama').val();
        var kelas = $('#kelas').val();
        var email = $('#email').val();
        var jmlbayar = $('#jmlbayar').val();

        $.ajax({
            type: 'POST',
            url: '<?= site_url() ?>/Snap/token',

            data: {

                nohp: nohp,
                nama: nama,
                kelas: kelas,
                email: email,
                jmlbayar: jmlbayar
            },
            cache: false,


            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>
</body>

</html>