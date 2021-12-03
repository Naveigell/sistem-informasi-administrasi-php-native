<?php 
session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['Nama']==""){
	header("location:../index.php?pesan=belumlogin");
}
if($_SESSION['Id']==""){
  header("location:../index.php?pesan=belumlogin");
}
if($_SESSION['User']==""){
  header("location:../index.php?pesan=belumlogin");
}
if($_SESSION['Pass']==""){
  header("location:../index.php?pesan=belumlogin");
}
		$timeout = 30; // Set timeout menit
		$timeout = $timeout * 60; // Ubah menit ke detik
		if (isset($_SESSION['start_time'])) {
			$elapsed_time = time() - $_SESSION['start_time'];
      if ($elapsed_time >= $timeout) {
       session_destroy();
       echo "<script>alert('Sesi Anda Telah Abis Silahkan Login Kembali !'); 
       location.href='../index.php';</script>";
     }
   }
   $_SESSION['start_time'] = time();
   ?>

   <html>
   <head>
     <title>Home PM</title>
     <meta charset="utf-8"> 
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
     <script type="text/javascript" src="../assets/js/jquery.js"></script>
     <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
     <script type="text/javascript" src="../assets/js/popper.js"></script>
     <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
     <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
     <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="../assets/css/style.css">


     <script>
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 5000);
    </script>
  </head>
  <body style="background-color: #f8f9fa">

    <?php include_once './../layouts/header.php'; ?>

    <div class="col-md-13 d-flex align-items-stretch">

        <?php include_once './../layouts/sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4">Sidebar #06</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>





    <div class="modal fade" id="Profil" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <a class="modal-title" href="#"><img src="../assets/img/user.png" width="40"></a>
            &nbsp;&nbsp;&nbsp;<h4 class="modal-title">Profil User</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form method="POST" action="../koneksi/koneksigantipassword.php">
            <div class="modal-body">
              <div class="form-group" hidden="true">
                <Label class="control-label"><h5>ID</h5></Label>
                <input type="text" name="Id" value="<?php echo $_SESSION['Id']; ?>" class="form-control" autocomplete="off" readonly>
              </div>
              <div class="form-group">
                <Label class="control-label"><h5>Nama</h5></Label>
                <input type="text" name="Nama" value="<?php echo $_SESSION['Nama']; ?>" class="form-control" autocomplete="off" readonly>
              </div>
              <div class="form-group">
                <Label class="control-label"><h5>Username</h5></Label>
                <input type="text" name="User" value="<?php echo $_SESSION['User']; ?>" class="form-control" autocomplete="off" readonly>
              </div>
              <div class="form-group"  hidden="true">
                <Label class="control-label"><h5>Password</h5></Label>
                <input type="text" name="Pass" value="<?php echo $_SESSION['Pass']; ?>" class="form-control" autocomplete="off" readonly>
              </div>
              <div class="form-group">
                <Label class="control-label"><h5>Ganti Password</h5></Label>
                <input type="Password" name="PasswordLama" placeholder="Masukkan Password Lama" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="Password" name="PasswordBaru" placeholder="Masukkan Password Baru" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="Password" name="RetypePasswordBaru" placeholder="Masukkan Lagi Password Baru " class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-warning" name="GantiPasswordPM">Ganti Password</button>
              <a class="btn btn-danger" href="../koneksi/logout.php">Logout</a>
            </div> 
          </form>
        </div>
      </div>    
    </div>


  </body>        
  </html>