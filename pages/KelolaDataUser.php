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

    <?php include "./../layouts/header.php"; ?>

    <div class="col-md-13 d-flex align-items-stretch">
      <?php include "./../layouts/sidebar.php"; ?>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Table User</h2>
        <center><?php 
        if(isset($_GET['pesan'])){
         if($_GET['pesan']=="suksesedit"){
           echo "<div class='alert alert-success'>Data User sudah berhasil di Edit !</div>";
         }
         else if($_GET['pesan']=="suksestambah"){
           echo "<div class='alert alert-success'>Data User sudah berhasil di Tambahkan !</div>";
         }
         else if($_GET['pesan']=="gagaltambah"){
           echo "<div class='alert alert-danger'>Data User sudah pernah di Tambahkan !</div>";
         }
         else if($_GET['pesan']=="sukseshapus"){
           echo "<div class='alert alert-success'>Data User sudah berhasil di Hapus !</div>";
         }
       }
     ?></center>
     <div class="table-responsive">
      <table class="table table-bordered  table-striped table-hover"> 
        <tr class="bg-primary" align="center">
          <th>No</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Email</th>
          <th>No Hp</th>
          <th>Level</th>
          <th>Action</th> 
        </tr>

        <?php
        include '../koneksi/KoneksiKelolaDataUser.php';
        if (!$db) {echo "Connection Timeout";} 
        else 
        {
          $getData = mysqli_query($db, "SELECT * FROM tb_user ORDER by Id ASC");
      // Fetch Data from Database to array
          $no = 1;
          while ($data = mysqli_fetch_assoc($getData)) 
          {
            $Id                   = $data['Id'];
            $Nama                 = $data['Nama'];
            $User                 = $data['User'];
            $Pass                 = $data['Pass'];
            $Email                = $data['Email'];
            $NoHp                 = $data['NoHp'];
            $Level                = $data['Level'];
            ?>
            <tr align="rights">
              <td><?= $no++; ?></td>
              <td><?= $Nama; ?></td>
              <td><?= $User; ?></td>
              <td><?= $Email; ?></td>
              <td><?= $NoHp; ?></td>
              <td><?= $Level; ?></td>
              <td>
                <button type="button" class="btn btn-warning btn-sm fa fa-edit" data-target="#edit<?= $Id; ?>" data-toggle="modal"></button>
                <button type="button" class="btn btn-danger btn-sm fa fa-trash" data-target="#hapus<?= $Id; ?>" data-toggle="modal"></button>

                <!-- Modal Hapus -->
                <div class="modal fade" id="hapus<?= $Id; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <form method="POST" action="../koneksi/KoneksiKelolaDataUser.php?Id=<?= $Id;?>">
                        <div class="modal-body">
                          <?php
                          $user = mysqli_query($db, "SELECT * FROM tb_user WHERE Id='$Id'");
                          while ($result = mysqli_fetch_assoc($user)) {
                            ?>
                            <input type="text" name="Id" value="<?= $result['Id']; ?>" hidden="true">
                            <center>
                              <i class="fa fa-close fa-5x" aria-hidden="true"></i>
                              <h3>Yakin ingin menghapus User <strong><?= $result['Nama']; ?></strong> ?</h3>
                            </center>
                            <?php
                          }
                          ?>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger" name="btnHapus">Hapus</button>
                        </div> 
                      </form>
                    </div>
                  </div>    
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="edit<?= $Id; ?>" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <form method="POST" action="../koneksi/KoneksiKelolaDataUser.php?Id=<?= $Id;?>">
                        <div class="modal-body">
                          <?php
                          $user = mysqli_query($db, "SELECT * FROM tb_user WHERE Id='$Id'");
                          while ($result = mysqli_fetch_assoc($user)) {
                            ?>
                            <input type="text" name="Id" value="<?= $result['Id']; ?>" hidden="true">
                            <div class="form-group">
                              <label class="control-label" for="Nama">Nama</label>
                              <input type="text" name="Nama" id="Nama" value="<?= $result['Nama']; ?>" class="form-control" required>
                            </div>   
                            <div class="form-group">
                              <label class="control-label" for="User">Username</label>
                              <input type="text" name="User" id="User" value="<?= $result['User']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="control-label" for="Email">Email</label>
                              <input type="text" name="Email" id="Email" value="<?= $result['Email']; ?>" class="form-control" required>
                              <div class="form-group">
                                <label class="control-label" for="NoHp">No Hp</label>
                                <input type="text" name="NoHp" id="NoHp" value="<?= $result['NoHp']; ?>" class="form-control" required>
                                <div class="form-group">
                                  <label class="control-label" for="Level">Level</label>
                                  <select name="Level" value="<?= $result['Level']; ?>"class="form-control" required>
                                   <option value="PM">PM</option>
                                   <option value="Admin">Admin</option>
                                   <option value="Team">Team Leader</option>
                                 </select>    
                               </div>
                               <?php
                             }
                             ?>
                           </div>
                           <div class="modal-footer">
                            <button type="submit" class="btn btn-success" name="btnEdit">Edit</button>
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
          <tr align="center">

            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahkanuser" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4>Form Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <form method="POST" action="../koneksi/KoneksiKelolaDataUser.php">
                    <div class="modal-body">

                      <div class="form-group">
                        <label class="control-label" for="Nama">Nama</label>
                        <input type="text" name="Nama" id="Nama" placeholder="Masukkan Nama" class="form-control" required>
                      </div>   
                      <div class="form-group">
                        <label class="control-label" for="User">Username</label>
                        <input type="text" name="User" id="User" placeholder="Masukkan Username" class="form-control" required>
                      </div>  
                      <div class="form-group">
                        <label class="control-label" for="Pass">Password</label>
                        <input type="password" name="Pass" id="Pass" placeholder="Masukkan Password" class="form-control" required>
                      </div>  
                      <div class="form-group">
                        <label class="control-label" for="Email">Email</label>
                        <input type="text" name="Email" id="Email" placeholder="Masukkan Email" class="form-control" required>
                        <div class="form-group">
                          <label class="control-label" for="NoHp">No Hp</label>
                          <input type="number" name="NoHp" id="NoHp" placeholder="Masukkan No Hp" class="form-control" required>
                          <div class="form-group">
                            <label class="control-label" for="Level">Level</label>
                            <select name="Level" class="form-control" required>
                             <option value="" hidden >Masukkan Level User</option>
                             <option value="PM">PM</option>
                             <option value="Admin">Admin</option>
                                <option value="Team">Team Leader</option>
                           </select>    
                         </div>
                       </div>
                       <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm" name="tambahuser">Tambah</button>
                        <button type="reset" class="btn btn-danger btn-sm" name="Reset">Reset</button>
                      </div> 
                    </form>
                  </div>
                </div>    
              </div>

            </tr>

          </table>
          <div style="float: left;">
            <button type="button" class="btn btn-success fa fa-plus fa-7x" data-target="#tambahkanuser" data-toggle="modal"> Tambah Data User Baru </button>
          </div>
        </div>
      </div>
    </div>

    <?php include_once './../layouts/footer.php'; ?>



<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/custom.js"></script>
</body> 

</html>