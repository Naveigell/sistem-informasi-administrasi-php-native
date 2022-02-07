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
        <h2 class="mb-4">Table Site Integrasi</h2>
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
                else if($_GET['pesan']=="duplicate"){
                    echo "<div class='alert alert-danger'>Id site data Sir tidak boleh sama !</div>";
                }
            }
            ?></center>
        <div class="table-responsive" >
            <table class="table table-bordered  table-striped table-hover">
                <tr class="bg-primary" align="center">
                    <th>No</th>
                    <th>Site Id</th>
                    <th>Site Name</th>
                    <th>Sow</th>
                    <th>Band Type</th>
                    <th>BTS Type</th>
                    <th>Site Config</th>
                    <th>Enginer Id</th>
                    <th>Enginer Name</th>
                    <th>Integrator Name</th>
                    <th>No Hp Integrator</th>
                    <th>Action</th>
                </tr>

                <?php
                include '../koneksi/KoneksiKelolaDataUser.php';
                if (!$db) {echo "Connection Timeout";}
                else
                {
                    $getData = mysqli_query($db, "SELECT * FROM tb_site_integrasi ORDER by SiteId ASC");
                    // Fetch Data from Database to array
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($getData))
                    {
                        $SiteId          = $data['SiteId'];
                        $SiteName        = $data['SiteName'];
                        $Sow             = $data['Sow'];
                        $BandType        = $data['BandType'];
                        $BTSType         = $data['BTSType'];
                        $SiteConfig      = $data['SiteConfig'];
                        $EnginerId       = $data['EnginerId'];
                        $EnginerName     = $data['EnginerName'];
                        $IntegratorName  = $data['IntegratorName'];
                        $NoHpIntegrator  = $data['NoHpIntegrator'];
                        ?>
                        <tr align="rights">
                            <td><?= $no++; ?></td>
                            <td><?= $SiteId; ?></td>
                            <td><?= $SiteName; ?></td>
                            <td><?= $Sow; ?></td>
                            <td><?= $BandType; ?></td>
                            <td><?= $BTSType; ?></td>
                            <td><?= $SiteConfig; ?></td>
                            <td><?= $EnginerId; ?></td>
                            <td><?= $EnginerName; ?></td>
                            <td><?= $IntegratorName; ?></td>
                            <td><?= $NoHpIntegrator; ?></td>
                            <td>
                                <?php if (!in_array($_SESSION['Level'], ['Team', 'Admin'])) : ?>
                                    <button type="button" class="btn btn-warning btn-sm fa fa-edit" data-target="#edit<?= $SiteId; ?>" data-toggle="modal"></button>
                                    <button type="button" class="btn btn-danger btn-sm fa fa-trash" data-target="#hapus<?= $SiteId; ?>" data-toggle="modal"></button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-primary btn-sm fa fa-eye" data-target="#detail<?= $SiteId; ?>" data-toggle="modal"></button>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapus<?= $SiteId; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="POST" action="../aksi/site_integrasi/delete.php?Id=<?= $SiteId;?>">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_site_integrasi WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
                                                        <input type="text" name="Id" value="<?= $result['SiteId']; ?>" hidden="true">
                                                        <center>
                                                            <i class="fa fa-close fa-5x" aria-hidden="true"></i>
                                                            <h3>Yakin ingin menghapus User <strong><?= $result['SiteName']; ?></strong> ?</h3>
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
                                            <form method="POST" action="../aksi/site_integrasi/update.php?Id=<?= $SiteId;?>">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_site_integrasi WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                    ?>
                                                    <input id="site-id-hidden-update-<?= $SiteId;?>" type="text" name="Id" value="<?= $result['SiteId']; ?>" hidden="true">
                                                    <div class="form-group">
                                                        <label class="control-label" for="SiteId">Site Id</label>
                                                        <input type="text" data-site-id="<?= $SiteId;?>" value="<?= $result['SiteId']; ?>" name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control site-id-update" required>
                                                        <div class="invalid-feedback">
                                                            Site Id tidak bisa digunakan
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="SiteName">Site Name</label>
                                                        <input type="text" value="<?= $result['SiteName']; ?>" name="SiteName" id="SiteName" placeholder="Masukkan Site Name" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="Sow">Sow</label>
                                                        <input type="text" value="<?= $result['Sow']; ?>" name="Sow" id="Sow" placeholder="Masukkan Sow" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="BandType">Band Type</label>
                                                        <input type="text" value="<?= $result['BandType']; ?>" name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="BTSType">BTS Type</label>
                                                        <input type="text" value="<?= $result['BTSType']; ?>" name="BTSType" id="BandType" placeholder="Masukkan BTS Type" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="SiteConfig">Site Config</label>
                                                        <input type="text" value="<?= $result['SiteConfig']; ?>" name="SiteConfig" id="SiteConfig" placeholder="Masukkan Site Config" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="EnginerId">Enginer Id</label>
                                                        <input type="text" value="<?= $result['EnginerId']; ?>" name="EnginerId" id="EnginerId" placeholder="Masukkan Enginer Id" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="EnginerName">Enginer Name</label>
                                                        <input type="text" value="<?= $result['EnginerName']; ?>" name="EnginerName" id="EnginerName" placeholder="Masukkan Enginer Name" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="IntegratorName">Integrator Name</label>
                                                        <input type="text" value="<?= $result['IntegratorName']; ?>" name="IntegratorName" id="IntegratorName" placeholder="Masukkan Integrator Name" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="NoHpIntegrator">No Hp Integrator</label>
                                                        <input type="text" value="<?= $result['NoHpIntegrator']; ?>" name="NoHpIntegrator" id="NoHpIntegrator" placeholder="Masukkan No Hp Integrator" class="form-control" required>
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
                                            <form method="POST" action="../aksi/site_integrasi/update.php?Id=<?= $SiteId;?>">
                                                <div class="modal-body">
                                                    <?php
                                                    $user = mysqli_query($db, "SELECT * FROM tb_site_integrasi WHERE SiteId='$SiteId'");
                                                    while ($result = mysqli_fetch_assoc($user)) {
                                                        ?>
<!--                                                        <input type="text" name="Id" value="--><?//= $result['Id']; ?><!--" hidden="true">-->
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteId">Site Id</label>
                                                            <input type="text" disabled value="<?= $result['SiteId']; ?>" name="SiteId" id="SiteId" placeholder="Masukkan Site Name" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteName">Site Name</label>
                                                            <input type="text" disabled value="<?= $result['SiteName']; ?>" name="SiteName" id="SiteName" placeholder="Masukkan Site Name" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="Sow">Sow</label>
                                                            <input type="text" disabled value="<?= $result['Sow']; ?>" name="Sow" id="Sow" placeholder="Masukkan Sow" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="BandType">Band Type</label>
                                                            <input type="text" disabled value="<?= $result['BandType']; ?>" name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="BTSType">BTS Type</label>
                                                            <input type="text" disabled value="<?= $result['BTSType']; ?>" name="BTSType" id="BandType" placeholder="Masukkan BTS Type" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="SiteConfig">Site Config</label>
                                                            <input type="text" disabled value="<?= $result['SiteConfig']; ?>" name="SiteConfig" id="SiteConfig" placeholder="Masukkan Site Config" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="EnginerId">Enginer Id</label>
                                                            <input type="text" disabled value="<?= $result['EnginerId']; ?>" name="EnginerId" id="EnginerId" placeholder="Masukkan Enginer Id" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="EnginerName">Enginer Name</label>
                                                            <input type="text" disabled value="<?= $result['EnginerName']; ?>" name="EnginerName" id="EnginerName" placeholder="Masukkan Enginer Name" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="IntegratorName">Integrator Name</label>
                                                            <input type="text" disabled value="<?= $result['IntegratorName']; ?>" name="IntegratorName" id="IntegratorName" placeholder="Masukkan Integrator Name" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" for="NoHpIntegrator">No Hp Integrator</label>
                                                            <input type="text" disabled value="<?= $result['NoHpIntegrator']; ?>" name="NoHpIntegrator" id="NoHpIntegrator" placeholder="Masukkan No Hp Integrator" class="form-control" required>
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
                                    <h4>Form Tambah Site Integrasi</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form method="POST" action="../aksi/site_integrasi/insert.php">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label" for="SiteId">Site Id</label>
                                            <input type="text" name="SiteId" id="SiteId" placeholder="Masukkan Site Id" class="form-control site-id-insert" required>
                                            <div class="invalid-feedback">
                                                Site Id tidak bisa digunakan
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="SiteName">Site Name</label>
                                            <input type="text" name="SiteName" id="SiteName" placeholder="Masukkan Site Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="Sow">Sow</label>
                                            <input type="text" name="Sow" id="Sow" placeholder="Masukkan Sow" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="BandType">Band Type</label>
                                            <input type="text" name="BandType" id="BandType" placeholder="Masukkan Band Type" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="BTSType">BTS Type</label>
                                            <input type="text" name="BTSType" id="BandType" placeholder="Masukkan BTS Type" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="SiteConfig">Site Config</label>
                                            <input type="text" name="SiteConfig" id="SiteConfig" placeholder="Masukkan Site Config" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="EnginerId">Enginer Id</label>
                                            <input type="text" name="EnginerId" id="EnginerId" placeholder="Masukkan Enginer Id" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="EnginerName">Enginer Name</label>
                                            <input type="text" name="EnginerName" id="EnginerName" placeholder="Masukkan Enginer Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="IntegratorName">Integrator Name</label>
                                            <input type="text" name="IntegratorName" id="IntegratorName" placeholder="Masukkan Integrator Name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="NoHpIntegrator">No Hp Integrator</label>
                                            <input type="text" name="NoHpIntegrator" id="NoHpIntegrator" placeholder="Masukkan No Hp Integrator" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success btn-sm" name="tambahsiteintegrasi">Tambah</button>
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
                <button type="button" class="btn btn-success fa fa-plus fa-7x" data-target="#tambahkanuser" data-toggle="modal"> Tambah Data Site Integrasi Baru </button>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/custom.js"></script>
<script>
    $(document).ready(function () {
        $('.site-id-insert').on('keyup change', function (e) {
            const siteId = e.target.value;
            const self   = this;

            $.ajax({
                url: './../aksi/site_integrasi/check_site_id.php',
                method: 'POST',
                data: {
                    SiteId: siteId,
                }
            }).done(function (e) {
                $(self).removeClass('is-invalid');
            }).fail(function (e) {
                $(self).addClass('is-invalid');
            })
        });

        $('.site-id-update').on('keyup change', function (e) {
            const siteId = e.target.value;
            const Id     = $('#site-id-hidden-update-' + $(this).data('site-id')).val();
            const self   = this;

            $.ajax({
                url: './../aksi/site_integrasi/check_site_id.php?Id=' + Id,
                method: 'POST',
                data: {
                    SiteId: siteId,
                }
            }).done(function (e) {
                $(self).removeClass('is-invalid');
            }).fail(function (e) {
                $(self).addClass('is-invalid');
            })
        })
    })
</script>
</body>

</html>