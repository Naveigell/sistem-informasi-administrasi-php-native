<html>
<head>
	<title>Administrasi</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/popper.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove(); 
			});
		}, 5000);
	</script>

</head>

<body style="background: #15397a;">
	<center>
		<div class="container">

			<fieldset style="max-width: 600px;height: 100%;background: #183163;">
				<fieldset class="col-md-7">
					<div class="container" style="margin: 100px auto;padding: 30px 20px;">
						<center><img src="assets/img/logo.png" width="100%" height="70"></center> <br>
						<center><?php 
						if(isset($_GET['pesan'])){
							if($_GET['pesan']=="gagallogin"){
								echo "<div class='alert alert-danger'>Nis/Username dan Password Tidak Sesuai !</div>";
							}
							else if($_GET['pesan']=="belumlogin"){
								echo "<div class='alert alert-danger'>Anda Belum Login Silahkan Login Terlebih Dahulu !</div>";
							}
							else if($_GET['pesan']=="logout"){
								echo "<div class='alert alert-danger'>Anda Berhasil Logout !</div>";
							}
						}
					?></center>
					<br>
					<form method="POST" action="koneksi/koneksilogin.php">
						<div class="form-group">
							<input type="text" name="User" placeholder="Username" class="form-control " autocomplete="off" required>
						</div>
						<div class="form-group">
							<input type="Password" name="Pass" placeholder="Password" class="form-control" required>
						</div>
						<button class="btn btn-primary btn-block" type="submit" name="LoginUser">Login</button>
					</form> <br> <br>
					<center><img src="assets/img/intisel.png" width="100%" height="70"></center>
				</div>
			</fieldset>
		</fieldset>
	</div>
</center>

</body>
</html>