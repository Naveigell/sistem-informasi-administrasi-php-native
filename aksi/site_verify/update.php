<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $SiteId      = $_GET['Id'];
    $SiteName    = $_POST['SiteName'];
    $TocoName    = $_POST['TocoName'];
    $Sow         = $_POST['Sow'];
    $ViewAntemna = $_POST['ViewAntemna'];

    $UploadFotoCobmetTerbuka    = mt_rand(100000, 1000000) . date('dmYHis.') . pathinfo($_FILES['UploadFotoCobmetTerbuka']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFotoCobmetTerbuka']['tmp_name'], './../../assets/img/site_verify/' . $UploadFotoCobmetTerbuka);


    if ($uploaded) {
        $query = "UPDATE tb_site_verify SET SiteName = '$SiteName', TocoName = '$TocoName', Sow = '$Sow',  UploadFotoCobmetTerbuka = '$UploadFotoCobmetTerbuka', ViewAntemna = '$ViewAntemna' WHERE SiteId='$SiteId'";
        $result = mysqli_query($db, $query);

        header("location: ./../../PM/KelolaDataSiteVerify.php?pesan=suksesedit");
    } else {

        header("location: ./../../PM/KelolaDataSiteVerify.php?pesan=gagaledit");
    }
}