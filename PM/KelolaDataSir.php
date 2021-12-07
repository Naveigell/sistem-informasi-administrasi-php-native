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
        <h2 class="mb-4">Table Sir</h2>
        <center><?php
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=="suksesedit"){
                    echo "<div class='alert alert-success'>Data Sir sudah berhasil di Edit !</div>";
                }
                else if($_GET['pesan']=="suksestambah"){
                    echo "<div class='alert alert-success'>Data Sir sudah berhasil di Tambahkan !</div>";
                }
                else if($_GET['pesan']=="gagaltambah"){
                    echo "<div class='alert alert-danger'>Data Sir sudah pernah di Tambahkan !</div>";
                }
                else if($_GET['pesan']=="sukseshapus"){
                    echo "<div class='alert alert-success'>Data Sir sudah berhasil di Hapus !</div>";
                }
            }
            ?></center>
        <div class="table-responsive" >
            <table class="table table-bordered  table-striped table-hover">
                <tr class="bg-primary" align="center">
                    <th>No</th>
                    <th>Site Id</th>
                    <th>Site Name</th>
                    <th>Band Type</th>
                    <th>Detail Sow</th>
                    <th>Site Config</th>
                    <th>BTS Type</th>
                    <th>PO Number</th>
                    <th>Site Type</th>
                    <th>Tanggal Audit</th>
                    <th>Tanggal Submit</th>
                    <th>Tanggal Approved</th>
                    <th>File Sir</th>
                    <th>Aksi</th>
                </tr>

                <?php
                include '../koneksi/KoneksiKelolaDataUser.php';
                if (!$db) {echo "Connection Timeout";}
                else
                {
                    $getData = mysqli_query($db, "SELECT * FROM tb_sir ORDER by SiteId ASC");
                    // Fetch Data from Database to array
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($getData))
                    {
                        $SiteId                = $data['SiteId'];
                        $SiteName              = $data['SiteName'];
                        $BandType              = $data['BandType'];
                        $DetailSow             = $data['DetailSow'];
                        $SiteConfig            = $data['SiteConfig'];
                        $BTSType               = $data['BTSType'];
                        $PONumber              = $data['PONumber'];
                        $SiteType              = $data['SiteType'];
                        $TanggalAudit          = $data['TanggalAudit'];
                        $TanggalSubmit         = $data['TanggalSubmit'];
                        $TanggalApproved       = $data['TanggalApproved'];
                        $UploadFileSA          = $data['UploadFileSA'];
                        ?>
                        <tr align="rights">
                            <td><?= $no++; ?></td>
                            <td><?= $SiteId; ?></td>
                            <td><?= $SiteName; ?></td>
                            <td><?= $BandType; ?></td>
                            <td><?= $DetailSow; ?></td>
                            <td><?= $SiteConfig; ?></td>
                            <td><?= $BTSType; ?></td>
                            <td><?= $PONumber; ?></td>
                            <td><?= $SiteType; ?></td>
                            <td><?= date('m - d - Y', strtotime($TanggalAudit)); ?></td>
                            <td><?= date('m - d - Y', strtotime($TanggalSubmit)); ?></td>
                            <td><?= date('m - d - Y', strtotime($TanggalApproved)); ?></td>
                            <td><a class="text-primary" style="text-decoration: underline;" href="../assets/img/sir/<?= $UploadFileSA; ?>">Download</a></td>
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
                                            <form method="POST" action="../aksi/sir/delete.php?Id=<?= $SiteId;?>">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_sir WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
                                                        <input type="text" name="Id" value="<?= $result['SiteId']; ?>" hidden="true">
                                                        <center>
                                                            <i class="fa fa-close fa-5x" aria-hidden="true"></i>
                                                            <h3>Yakin ingin menghapus Sir <strong><?= $result['SiteName']; ?></strong> ?</h3>
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
                                            <form method="POST" action="../aksi/sir/update.php?Id=<?= $SiteId;?>" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_sir WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteId">Site Id</label>
                                                            <input type="text" value="<?= $result['SiteId']; ?>" name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteName">Site Name</label>
                                                            <input type="text" value="<?= $result['SiteName']; ?>" name="SiteName" id="SiteName" placeholder="Masukkan SiteName" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="BandType">Band Type</label>
                                                            <input type="text" value="<?= $result['BandType']; ?>" name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="DetailSow">Detail Sow</label>
                                                            <input type="text" value="<?= $result['DetailSow']; ?>" name="DetailSow" id="DetailSow" placeholder="Masukkan Detail Sow" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteConfig">Site Config</label>
                                                            <input type="text" value="<?= $result['SiteConfig']; ?>" name="SiteConfig" id="SiteConfig" placeholder="Masukkan Site Config" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="BTSType">BTS Type</label>
                                                            <input type="text" value="<?= $result['BTSType']; ?>" name="BTSType" id="BTSType" placeholder="Masukkan BTS Type" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="PONumber">PO Number</label>
                                                            <input type="text" value="<?= $result['PONumber']; ?>" name="PONumber" id="PONumber" placeholder="Masukkan PO Number" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteType">Site Type</label>
                                                            <input type="text" value="<?= $result['SiteType']; ?>" name="SiteType" id="SiteType" placeholder="Masukkan Site Type" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TanggalAudit">Tanggal Audit</label>
                                                            <input type="date" value="<?= date('Y-m-d', strtotime($result['TanggalAudit'])); ?>" name="TanggalAudit" id="TanggalAudit" placeholder="Masukkan Tanggal Audit" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TanggalSubmit">Tanggal Submit</label>
                                                            <input type="date" value="<?= date('Y-m-d', strtotime($result['TanggalSubmit'])); ?>" name="TanggalSubmit" id="TanggalSubmit" placeholder="Masukkan Tanggal Submit" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TanggalApproved">Tanggal Approved</label>
                                                            <input type="date" value="<?= date('Y-m-d', strtotime($result['TanggalApproved'])); ?>" name="TanggalApproved" id="TanggalApproved" placeholder="Masukkan Tanggal Approved" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="UploadFileSA">Upload File SA</label>
                                                            <input type="file" name="UploadFileSA" id="UploadFileSA" placeholder="Masukkan No UploadFileSA" class="form-control" required>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success" name="btnEdit">Edit</button>
                                                    </div>
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
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_sir WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
<!--                                                        <input type="text" name="Id" value="--><?//= $result['SiteId']; ?><!--" hidden="true">-->
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteId">Site Id</label>
                                                            <input disabled type="text" value="<?= $result['SiteId']; ?>" name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteName">Site Name</label>
                                                            <input disabled type="text" value="<?= $result['SiteName']; ?>" name="SiteName" id="SiteName" placeholder="Masukkan SiteName" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="BandType">Band Type</label>
                                                            <input disabled type="text" value="<?= $result['BandType']; ?>" name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="DetailSow">Detail Sow</label>
                                                            <input disabled type="text" value="<?= $result['DetailSow']; ?>" name="DetailSow" id="DetailSow" placeholder="Masukkan Detail Sow" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteConfig">Site Config</label>
                                                            <input disabled type="text" value="<?= $result['SiteConfig']; ?>" name="SiteConfig" id="SiteConfig" placeholder="Masukkan Site Config" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="BTSType">BTS Type</label>
                                                            <input disabled type="text" value="<?= $result['BTSType']; ?>" name="BTSType" id="BTSType" placeholder="Masukkan BTS Type" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="PONumber">PO Number</label>
                                                            <input disabled type="text" value="<?= $result['PONumber']; ?>" name="PONumber" id="PONumber" placeholder="Masukkan PO Number" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteType">Site Type</label>
                                                            <input disabled type="text" value="<?= $result['SiteType']; ?>" name="SiteType" id="SiteType" placeholder="Masukkan Site Type" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TanggalApproved">Tanggal Approved</label>
                                                            <input disabled type="date" value="<?= date('Y-m-d', strtotime($result['TanggalApproved'])); ?>" name="TanggalApproved" id="TanggalApproved" placeholder="Masukkan Tanggal Approved" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TanggalSubmit">Tanggal Submit</label>
                                                            <input disabled type="date" value="<?= date('Y-m-d', strtotime($result['TanggalSubmit'])); ?>" name="TanggalSubmit" id="TanggalSubmit" placeholder="Masukkan Tanggal Submit" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="TanggalApproved">Tanggal Approved</label>
                                                            <input disabled type="date" value="<?= date('Y-m-d', strtotime($result['TanggalApproved'])); ?>" name="TanggalApproved" id="TanggalApproved" placeholder="Masukkan Tanggal Approved" class="form-control" required>
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
                    <div class="modal fade" id="tambahkanuser" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Form Tambah Sir</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form method="POST" action="../aksi/sir/insert.php" enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label class="control-label" for="SiteId">Site Id</label>
                                            <input type="text" name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="SiteName">Site Name</label>
                                            <input type="text" name="SiteName" id="SiteName" placeholder="Masukkan SiteName" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="BandType">Band Type</label>
                                            <input type="text" name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="DetailSow">Detail Sow</label>
                                            <input type="text" name="DetailSow" id="DetailSow" placeholder="Masukkan Detail Sow" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="SiteConfig">Site Config</label>
                                            <input type="text" name="SiteConfig" id="SiteConfig" placeholder="Masukkan Site Config" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="BTSType">BTS Type</label>
                                            <input type="text" name="BTSType" id="BTSType" placeholder="Masukkan BTS Type" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="PONumber">PO Number</label>
                                            <input type="text" name="PONumber" id="PONumber" placeholder="Masukkan PO Number" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="SiteType">Site Type</label>
                                            <input type="text" name="SiteType" id="SiteType" placeholder="Masukkan Site Type" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="TanggalAudit">Tanggal Audit</label>
                                            <input type="date" name="TanggalAudit" id="TanggalAudit" placeholder="Masukkan Tanggal Audit" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="TanggalSubmit">Tanggal Submit</label>
                                            <input type="date" name="TanggalSubmit" id="TanggalSubmit" placeholder="Masukkan Tanggal Submit" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="TanggalApproved">Tanggal Approved</label>
                                            <input type="date" name="TanggalApproved" id="TanggalApproved" placeholder="Masukkan Tanggal Approved" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="UploadFileSA">Upload File SA</label>
                                            <input type="file" name="UploadFileSA" id="UploadFileSA" placeholder="Masukkan No UploadFileSA" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="tambahsir">Tambah</button>
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
                <button type="button" class="btn btn-success fa fa-plus fa-7x" data-target="#tambahkanuser" data-toggle="modal"> Tambah Data Sir Baru </button>
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