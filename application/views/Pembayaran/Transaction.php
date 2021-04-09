  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cek Tranksaksi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container">
	<html>

	<head>
		<title>Checkout</title>
	</head>

	<body>

	
		<form action="<?php echo site_url() ?>transaction/process" method="POST">
			<p>
				<label>Order id</label>
				<input value="" size="20" type="text" name="order_id" autocomplete="off" />
			</p>
			<p>
				<label>Action</label><br />
				<input type="radio" name="action" value="status">Get Status<br>
				<input type="radio" name="action" value="approve">Approve<br>
				<input type="radio" name="action" value="cancel">Cancel<br>
				<input type="radio" name="action" value="expire">Expire<br>
			</p>
			<button class="submit-button" type="submit">Submit Payment</button>
		</form>
	</body>

	</html>
</div>

