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
        <h2 class="mb-4">Table Mos</h2>
        <center><?php
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=="suksesedit"){
                    echo "<div class='alert alert-success'>Data Mos sudah berhasil di Edit !</div>";
                }
                else if($_GET['pesan']=="suksestambah"){
                    echo "<div class='alert alert-success'>Data Mos sudah berhasil di Tambahkan !</div>";
                }
                else if($_GET['pesan']=="gagaltambah"){
                    echo "<div class='alert alert-danger'>Data Mos sudah pernah di Tambahkan !</div>";
                }
                else if($_GET['pesan']=="sukseshapus"){
                    echo "<div class='alert alert-success'>Data Mos sudah berhasil di Hapus !</div>";
                }
                else if($_GET['pesan']=="duplicate"){
                    echo "<div class='alert alert-danger'>Id site data Mos tidak boleh sama !</div>";
                }
            }
            ?></center>
        <div class="table-responsive">
            <table class="table table-bordered  table-striped table-hover">
                <tr class="bg-primary" align="center">
                    <th>No</th>
                    <th>Site Id</th>
                    <th>Site Name</th>
                    <th>Site Type</th>
                    <th>Pic On Site</th>
                    <th>No Telp Pic</th>
                    <th>Penanggung Jawab Vendor</th>
                    <th>Toco Name</th>
                    <th>Sow</th>
                    <th>Action</th>
                </tr>

                <?php
                include '../koneksi/KoneksiKelolaDataUser.php';
                if (!$db) {echo "Connection Timeout";}
                else
                {
                    $getData = mysqli_query($db, "SELECT * FROM tb_mos ORDER by SiteId ASC");
                    // Fetch Data from Database to array
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($getData))
                    {
                        $SiteId                   = $data['SiteId'];
                        $SiteName                 = $data['SiteName'];
                        $SiteType                 = $data['SiteType'];
                        $PicOnSite                = $data['PicOnSite'];
                        $NoTelpPic                = $data['NoTelpPic'];
                        $PenanggungJawabVendor    = $data['PenanggungJawabVendor'];
                        $TocoName                 = $data['TocoName'];
                        $Sow                      = $data['Sow'];
                        $UploadFotoMaterial       = $data['UploadFotoMaterial'];
                        $UploadFotoPicOnSite      = $data['UploadFotoPicOnSite'];
                        ?>
                        <tr align="rights">
                            <td><?= $no++; ?></td>
                            <td><?= $SiteId; ?></td>
                            <td><?= $SiteName; ?></td>
                            <td><?= $SiteType; ?></td>
                            <td><?= $PicOnSite; ?></td>
                            <td><?= $NoTelpPic; ?></td>
                            <td><?= $PenanggungJawabVendor; ?></td>
                            <td><?= $TocoName; ?></td>
                            <td><?= $Sow; ?></td>
                            <td>
                                <?php if (!in_array($_SESSION['Level'], ['Team', 'Admin'])) : ?>
                                    <button type="button" class="btn btn-warning btn-sm fa fa-edit" data-target="#edit<?= $SiteId; ?>" data-toggle="modal"></button>
                                    <button type="button" class="btn btn-danger btn-sm fa fa-trash" data-target="#hapus<?= $SiteId; ?>" data-toggle="modal"></button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-success btn-sm fa fa-eye" data-target="#detail<?= $SiteId; ?>" data-toggle="modal"></button>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapus<?= $SiteId; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="POST" action="../aksi/mos/delete.php?SiteId=<?= $SiteId;?>">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_mos WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
                                                        <input type="text" name="SiteId" value="<?= $result['SiteId']; ?>" hidden="true">
                                                        <center>
                                                            <i class="fa fa-close fa-5x" aria-hidden="true"></i>
                                                            <h3>Yakin ingin menghapus Mos <strong><?= $result['SiteName']; ?></strong> ?</h3>
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
                                            <form method="POST" action="../aksi/mos/update.php?Id=<?= $SiteId;?>" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_mos WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                    ?>
<!--                                                        <input type="text" name="Id" value="--><?//= $result['SiteId']; ?><!--" hidden="true">-->
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteId">Site Id</label>
                                                            <input type="text" name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control" required value="<?= $result['SiteId']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteName">Site Name</label>
                                                            <input type="text" name="SiteName" id="SiteName" placeholder="Masukkan Site Name" class="form-control" required value="<?= $result['SiteName']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteType">Site Type</label>
                                                            <input type="text" name="SiteType" id="SiteType" placeholder="Masukkan Username" class="form-control" required value="<?= $result['SiteType']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="PicOnSite">Pic On Site</label>
                                                            <input type="text" name="PicOnSite" id="PicOnSite" placeholder="Masukkan Pic On Site" class="form-control" required value="<?= $result['PicOnSite']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="NoTelpPic">No Telp Pic</label>
                                                            <input type="text" name="NoTelpPic" id="NoTelpPic" placeholder="Masukkan No Telp Pic" class="form-control" required value="<?= $result['NoTelpPic']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="PenanggungJawabVendor">Penanggung Jawab Vendor</label>
                                                            <input type="text" name="PenanggungJawabVendor" id="PenanggungJawabVendor" placeholder="Masukkan Penanggung Jawab Vendor" class="form-control" required value="<?= $result['PenanggungJawabVendor']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TocoName">Toco Name</label>
                                                            <input type="text" name="TocoName" id="TocoName" placeholder="Masukkan Toco Name" class="form-control" required value="<?= $result['TocoName']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="Sow">Sow</label>
                                                            <input type="text" name="Sow" id="Sow" placeholder="Masukkan Sow" class="form-control" required value="<?= $result['Sow']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="UploadFotoMaterial">Upload Foto Material</label>
                                                            <input type="file" name="UploadFotoMaterial" id="UploadFotoMaterial" placeholder="Upload Foto Material" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="UploadFotoPicOnSite">Upload Foto Pic On Site</label>
                                                            <input type="file" name="UploadFotoPicOnSite" id="UploadFotoPicOnSite" placeholder="Upload Foto Pic On Site" class="form-control" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="btnEdit">Edit</button>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
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
                                            <form enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_mos WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
<!--                                                        <input type="text" name="Id" value="--><?//= $result['SiteId']; ?><!--" hidden="true">-->
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteId">Site Id</label>
                                                            <input type="text" disabled name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control" required value="<?= $result['SiteId']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteName">Site Name</label>
                                                            <input type="text" disabled name="SiteName" id="SiteName" placeholder="Masukkan Site Name" class="form-control" required value="<?= $result['SiteName']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteType">Site Type</label>
                                                            <input type="text" disabled name="SiteType" id="SiteType" placeholder="Masukkan Username" class="form-control" required value="<?= $result['SiteType']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="PicOnSite">Pic On Site</label>
                                                            <input type="text" disabled name="PicOnSite" id="PicOnSite" placeholder="Masukkan Pic On Site" class="form-control" required value="<?= $result['PicOnSite']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="NoTelpPic">No Telp Pic</label>
                                                            <input type="text" disabled name="NoTelpPic" id="NoTelpPic" placeholder="Masukkan No Telp Pic" class="form-control" required value="<?= $result['NoTelpPic']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="PenanggungJawabVendor">Penanggung Jawab Vendor</label>
                                                            <input type="text" disabled name="PenanggungJawabVendor" id="PenanggungJawabVendor" placeholder="Masukkan Penanggung Jawab Vendor" class="form-control" required value="<?= $result['PenanggungJawabVendor']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TocoName">Toco Name</label>
                                                            <input type="text" disabled name="TocoName" id="TocoName" placeholder="Masukkan Toco Name" class="form-control" required value="<?= $result['TocoName']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="Sow">Sow</label>
                                                            <input type="text" disabled name="Sow" id="Sow" placeholder="Masukkan Sow" class="form-control" required value="<?= $result['Sow']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="UploadFotoMaterial">Upload Foto Material</label>
                                                            <img src="./../assets/img/mos/<?= $result['UploadFotoMaterial']; ?>" alt="" width="300px" height="300px">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="UploadFotoPicOnSite">Upload Foto Pic On Site</label>
                                                            <img src="./../assets/img/mos/<?= $result['UploadFotoPicOnSite']; ?>" alt="" width="300px" height="300px">
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
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
                    <div class="modal fade" id="tambahkanmos" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Form Tambah Mos</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form method="POST" action="./../aksi/mos/insert.php" enctype="multipart/form-data">
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
                                            <label class="control-label" for="SiteType">Site Type</label>
                                            <input type="text" name="SiteType" id="SiteType" placeholder="Masukkan Username" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="PicOnSite">Pic On Site</label>
                                            <input type="text" name="PicOnSite" id="PicOnSite" placeholder="Masukkan Pic On Site" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="NoTelpPic">No Telp Pic</label>
                                            <input type="text" name="NoTelpPic" id="NoTelpPic" placeholder="Masukkan No Telp Pic" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="PenanggungJawabVendor">Penanggung Jawab Vendor</label>
                                            <input type="text" name="PenanggungJawabVendor" id="PenanggungJawabVendor" placeholder="Masukkan Penanggung Jawab Vendor" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="TocoName">Toco Name</label>
                                            <input type="text" name="TocoName" id="TocoName" placeholder="Masukkan Toco Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="Sow">Sow</label>
                                            <input type="text" name="Sow" id="Sow" placeholder="Masukkan Sow" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="UploadFotoMaterial">Upload Foto Material</label>
                                            <input type="file" name="UploadFotoMaterial" id="UploadFotoMaterial" placeholder="Upload Foto Material" accept="image/jpeg,image/jpg,image/png" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="UploadFotoPicOnSite">Upload Foto Pic On Site</label>
                                            <input type="file" name="UploadFotoPicOnSite" id="UploadFotoPicOnSite" placeholder="Upload Foto Pic On Site" accept="image/jpeg,image/jpg,image/png" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="tambahmos">Tambah</button>
                                            <button type="reset" class="btn btn-danger btn-sm" name="Reset">Reset</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>

            </table>
            <div style="float: left;">
                <button type="button" class="btn btn-success fa fa-plus fa-7x" data-target="#tambahkanmos" data-toggle="modal"> Tambah Data Mos Baru </button>
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