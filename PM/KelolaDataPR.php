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

<?php include_once './../layouts/header.php'?>

<div class="col-md-13 d-flex align-items-stretch">
    <?php include "./../layouts/sidebar.php"; ?>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5 table-responsive">
        <h2 class="mb-4">Table PR</h2>
        <center><?php
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=="suksesedit"){
                    echo "<div class='alert alert-success'>Data PR sudah berhasil di Edit !</div>";
                }
                else if($_GET['pesan']=="suksestambah"){
                    echo "<div class='alert alert-success'>Data PR sudah berhasil di Tambahkan !</div>";
                }
                else if($_GET['pesan']=="gagaltambah"){
                    echo "<div class='alert alert-danger'>Data PR sudah pernah di Tambahkan !</div>";
                }
                else if($_GET['pesan']=="sukseshapus"){
                    echo "<div class='alert alert-success'>Data PR sudah berhasil di Hapus !</div>";
                }
            }
            ?></center>
        <div class="table-responsive" >
            <table class="table table-bordered  table-striped table-hover">
                <tr class="bg-primary" align="center">
                    <th>Site Id</th>
                    <th>Site Name</th>
                    <th>Band Type</th>
                    <th>Detail Sow</th>
                    <th>Detail EQP</th>
                    <th>Site Type</th>
                    <th>Tanggal Submit</th>
                    <th>Tanggal Approved</th>
                    <th>File PR</th>
                    <th>Aksi</th>
                </tr>

                <?php
                include '../koneksi/KoneksiKelolaDataUser.php';
                if (!$db) {echo "Connection Timeout";}
                else
                {
                    $getData = mysqli_query($db, "SELECT * FROM tb_pr ORDER by SiteId ASC");
                    // Fetch Data from Database to array
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($getData))
                    {
                        $SiteId                  = $data['SiteId'];
                        $SiteName                = $data['SiteName'];
                        $BandType                = $data['BandType'];
                        $DetailSow               = $data['DetailSow'];
                        $DetailEQP               = $data['DetailEQP'];
                        $SiteType                = $data['SiteType'];
                        $TanggalSubmit           = $data['TanggalSubmit'];
                        $TanggalApproved         = $data['TanggalApproved'];
                        $UploadFilePR            = $data['UploadFilePR'];
                        ?>
                        <tr align="rights">
                            <td><?= $SiteId; ?></td>
                            <td><?= $SiteName; ?></td>
                            <td><?= $BandType; ?></td>
                            <td><?= $DetailSow; ?></td>
                            <td><?= $DetailEQP; ?></td>
                            <td><?= $SiteType; ?></td>
                            <td><?= date('m - d - Y', strtotime($TanggalSubmit)); ?></td>
                            <td><?= date('m - d - Y', strtotime($TanggalApproved)); ?></td>
                            <td><a class="text-primary" style="text-decoration: underline;" href="../assets/img/pr/<?= $UploadFilePR; ?>">Download</a></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm fa fa-edit" data-target="#edit<?= $SiteId; ?>" data-toggle="modal"></button>
                                <button type="button" class="btn btn-danger btn-sm fa fa-trash" data-target="#hapus<?= $SiteId; ?>" data-toggle="modal"></button>
                                <button type="button" class="btn btn-primary btn-sm fa fa-eye" data-target="#detail<?= $SiteId; ?>" data-toggle="modal"></button>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapus<?= $SiteId; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="POST" action="../aksi/pr/delete.php?SiteId=<?= $SiteId;?>">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_pr WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
                                                        <input type="text" name="SiteId" value="<?= $result['SiteId']; ?>" hidden="true">
                                                        <center>
                                                            <i class="fa fa-close fa-5x" aria-hidden="true"></i>
                                                            <h3>Yakin ingin menghapus PR <strong><?= $result['SiteName']; ?></strong> ?</h3>
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
                                <div class="modal fade" id="edit<?= $SiteId; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="POST" action="../aksi/pr/update.php?Id=<?= $SiteId;?>" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_pr WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                    ?>
                                                    <input type="text" name="Id" value="<?= $result['Id']; ?>" hidden="true">
                                                    <div class="form-group">
                                                        <label class="control-label" for="SiteId">Site Id</label>
                                                        <input type="text" name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control" value="<?= $result['SiteId']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="SiteName">Site Name</label>
                                                        <input type="text" name="SiteName" id="SiteName" placeholder="Masukkan Site Name" class="form-control" value="<?= $result['SiteName']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="BandType">Band Type</label>
                                                        <input type="text" name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" value="<?= $result['BandType']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="DetailSow">Detail Sow</label>
                                                        <input type="text" name="DetailSow" id="DetailSow" placeholder="Masukkan Sow" class="form-control" value="<?= $result['DetailSow']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="DetailEQP">Detail EQP</label>
                                                        <input type="text" name="DetailEQP" id="DetailEQP" placeholder="Masukkan Sow" class="form-control" value="<?= $result['DetailEQP']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="SiteType">Site Type</label>
                                                        <input type="text" name="SiteType" id="SiteType" placeholder="Masukkan Site Type" class="form-control" value="<?= $result['SiteType']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="TanggalSubmit">Tanggal Submit</label>
                                                        <input type="date" name="TanggalSubmit" id="TanggalSubmit" placeholder="Tanggal Submit" class="form-control" value="<?= date('Y-m-d', strtotime($result['TanggalSubmit'])); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="TanggalApproved">Tanggal Approved</label>
                                                        <input type="date" name="TanggalApproved" id="TanggalApproved" placeholder="Tanggal Approved" accept="image/jpeg,image/jpg,image/png" class="form-control" value="<?= date('Y-m-d', strtotime($result['TanggalApproved'])); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="UploadFilePR">Upload File PR</label>
                                                        <input type="file" name="UploadFilePR" id="UploadFilePR" placeholder="Upload File PR" class="form-control" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" name="btnEdit">Edit</button>
                                                    </div>
                                                        <?php } ?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="detail<?= $SiteId; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="POST">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_pr WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
                                                        <input type="text" name="Id" value="<?= $result['Id']; ?>" hidden="true">
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteId">Site Id</label>
                                                            <input type="text" disabled name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control" value="<?= $result['SiteId']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteName">Site Name</label>
                                                            <input type="text" disabled name="SiteName" id="SiteName" placeholder="Masukkan Site Name" class="form-control" value="<?= $result['SiteName']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="BandType">Band Type</label>
                                                            <input type="text" disabled name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" value="<?= $result['BandType']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="DetailSow">Detail Sow</label>
                                                            <input type="text" disabled name="DetailSow" id="DetailSow" placeholder="Masukkan Sow" class="form-control" value="<?= $result['DetailSow']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="DetailEQP">Detail EQP</label>
                                                            <input type="text" disabled name="DetailEQP" id="DetailEQP" placeholder="Masukkan Sow" class="form-control" value="<?= $result['DetailEQP']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteType">Site Type</label>
                                                            <input type="text" disabled name="SiteType" id="SiteType" placeholder="Masukkan Site Type" class="form-control" value="<?= $result['SiteType']; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TanggalSubmit">Tanggal Submit</label>
                                                            <input type="date" disabled name="TanggalSubmit" id="TanggalSubmit" placeholder="Tanggal Submit" class="form-control" value="<?= date('Y-m-d', strtotime($result['TanggalSubmit'])); ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TanggalApproved">Tanggal Approved</label>
                                                            <input type="date" disabled name="TanggalApproved" id="TanggalApproved" placeholder="Tanggal Approved" accept="image/jpeg,image/jpg,image/png" class="form-control" value="<?= date('Y-m-d', strtotime($result['TanggalApproved'])); ?>" required>
                                                        </div>
                                                    <?php } ?>
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
                    <div class="modal fade" id="tambahkanpr" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Form Tambah PR</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form method="POST" action="./../aksi/pr/insert.php" ENCTYPE="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label" for="SiteId">Site Id</label>
                                            <input type="text" name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="SiteName">Site Name</label>
                                            <input type="text" name="SiteName" id="SiteName" placeholder="Masukkan Site Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="BandType">Band Type</label>
                                            <input type="text" name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="DetailSow">Detail Sow</label>
                                            <input type="text" name="DetailSow" id="DetailSow" placeholder="Masukkan Sow" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="DetailEQP">Detail EQP</label>
                                            <input type="text" name="DetailEQP" id="DetailEQP" placeholder="Masukkan Sow" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="SiteType">Site Type</label>
                                            <input type="text" name="SiteType" id="SiteType" placeholder="Masukkan Site Type" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="TanggalSubmit">Tanggal Submit</label>
                                            <input type="date" name="TanggalSubmit" id="TanggalSubmit" placeholder="Upload Foto Pic On Site" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="TanggalApproved">Tanggal Approved</label>
                                            <input type="date" name="TanggalApproved" id="TanggalApproved" placeholder="Upload Foto Pic On Site" accept="image/jpeg,image/jpg,image/png" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="UploadFilePR">Upload File PR</label>
                                            <input type="file" name="UploadFilePR" id="UploadFilePR" placeholder="Upload File PR" class="form-control" required>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="tambahpr">Tambah</button>
                                            <button type="reset" class="btn btn-danger btn-sm" name="Reset">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>

            </table>
            <div style="float: left;">
                <button type="button" class="btn btn-success fa fa-plus fa-7x" data-target="#tambahkanpr" data-toggle="modal"> Tambah Data PR Baru </button>
            </div>
        </div>
    </div>
</div>

<!-- <script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>-->
</body>

</html>