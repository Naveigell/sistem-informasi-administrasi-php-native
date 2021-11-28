<?php 
session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['NamaAdmin']==""){
	header("location:../index.php?pesan=belumlogin");
	}
if($_SESSION['id']==""){
  header("location:../index.php?pesan=belumlogin");
  }
if($_SESSION['Username']==""){
  header("location:../index.php?pesan=belumlogin");
  }
if($_SESSION['Password']==""){
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
	<title>Home Admin</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/popper.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	
  <script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 5000);
</script>
</head>
<body style="background-color: #f8f9fa">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="../assets/img/logo.png" width="50"></a>
  <a class="navbar-brand" href="">Zona Admin</a>
      
  <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        </li>
        </ul>
  <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item active">        
         <a class="navbar-brand" href="" data-target="#Profil" data-toggle="modal"><img class="btn btn-outline-success my-2 my-sm-0" src="../assets/img/admin.png" width="70"></a>
      </li>
        </ul>
  </nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="homeadmin.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="daftarekstrakurikuleradmin.php">Daftar Ekstrakurikuler</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="jadwalekstrakurikuleradmin.php">Jadwal Ekstrakurikuler</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pengumumanekstrakurikuleradmin.php">Pengumuman Ekstrakurikuler</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kelolapembina.php">Pengelolaan Pembina</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="kelolasiswa.php">Pengelolaan Siswa</a>
      </li>
    </ul>
    
  </div>
  </nav>

<div class="modal fade" id="Profil" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <a class="modal-title" href="#"><img src="../assets/img/admin.png" width="40"></a>
              &nbsp;&nbsp;&nbsp;<h4 class="modal-title">Profil Admin</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="../koneksi/koneksigantipassword.php">
              <div class="modal-body">
                <div class="form-group" hidden="true">
                  <Label class="control-label"><h5>ID</h5></Label>
                  <input type="text" name="id" value="<?php echo $_SESSION['id']; ?>" class="form-control" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                  <Label class="control-label"><h5>Nama</h5></Label>
                  <input type="text" name="NamaAdmin" value="<?php echo $_SESSION['NamaAdmin']; ?>" class="form-control" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                  <Label class="control-label"><h5>Username</h5></Label>
                  <input type="text" name="Username" value="<?php echo $_SESSION['Username']; ?>" class="form-control" autocomplete="off" readonly>
                </div>
                <div class="form-group"  hidden="true">
                  <Label class="control-label"><h5>Password</h5></Label>
                  <input type="text" name="Password" value="<?php echo $_SESSION['Password']; ?>" class="form-control" autocomplete="off" readonly>
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
                <button type="submit" class="btn btn-warning" name="GantiPasswordAdmin">Ganti Password</button>
                <a class="btn btn-danger" href="../koneksi/logout.php">Logout</a>
              </div> 
            </form>
          </div>
        </div>    
      </div>
      <center><h3>Data Siswa</h3></center>
      <center><?php 
        if(isset($_GET['pesan'])){
         if($_GET['pesan']=="sukseshapus"){
           echo "<div class='alert alert-success'>Data siswa sudah berhasil di Hapus !</div>";
        }
         }
      ?></center>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover"> 
  <tr class="bg-warning" align="center">
    <th>No</th>
    <th>Nama Siswa</th>
    <th>Nis</th>
    <th>Tanggal Lahir</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>Nomor Telpon</th>
    <th>Kelas</th>
    <th>Angkatan</th>
    <th>Ekstrakurikuler</th>
    <th>Alasan</th>
    <th>Action</th>
  </tr>

  <?php
  include '../koneksi/koneksikhususadmin.php';
  if (!$db) {echo "Connection Timeout";} 
  else 
  {
    $getData = mysqli_query($db, "SELECT * FROM tbsiswa ORDER by id ASC");
      // Fetch Data from Database to array
    $no = 1;
    while ($data = mysqli_fetch_assoc($getData)) 
    {
      $id                = $data['id'];
      $NamaSiswa         = $data['NamaSiswa'];
      $Nis               = $data['Nis'];
      $TanggalLahir      = $data['TanggalLahir'];
      $JenisKelamin      = $data['JenisKelamin'];
      $Alamat            = $data['Alamat'];
      $NomorTelpon       = $data['NomorTelpon'];
      $Kelas             = $data['Kelas'];
      $Angkatan          = $data['Angkatan'];
      $Ekstrakurikuler   = $data['Ekstrakurikuler'];
      $Alasan            = $data['Alasan'];
      ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $NamaSiswa; ?></td>
        <td><?= $Nis; ?></td>
        <td><?= $TanggalLahir; ?></td>
        <td><?= $JenisKelamin; ?></td>
        <td><?= $Alamat; ?></td>
        <td><?= $NomorTelpon; ?></td>
        <td><?= $Kelas; ?></td>
        <td><?= $Angkatan; ?></td>
        <td><?= $Ekstrakurikuler; ?></td>
        <td><?= $Alasan; ?></td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-target="#hapus<?= $id; ?>" data-toggle="modal">Hapus</button>


          <!-- Modal Tolak -->
          <div class="modal fade" id="hapus<?= $id; ?>" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="../koneksi/koneksikhususadmin.php?id=<?= $id;?>">
                  <div class="modal-body">
                    <?php
                    $user = mysqli_query($db, "SELECT * FROM tbsiswa WHERE id='$id'");
                    while ($result = mysqli_fetch_assoc($user)) {
                      ?>
                      <input type="text" name="id" value="<?= $result['id']; ?>" hidden="true">
                      <center>
                        <i class="fa fa-times fa-8x" aria-hidden="true"></i>
                        <h3>Yakin ingin menghapus data siswa <strong><?= $result['NamaSiswa']; ?></strong> ?</h3>
                      </center>
                      <?php
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" name="btnHapusSiswa">Hapus</button>
                  </div> 
                </form>
              </div>
            </div>    
          </div>
        </td>
      </tr>
      <?php
    }
  }
  ?>        
</table>
</div>
</body>        
</html>