<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $Id          = $_GET['Id'];
    $SiteId      = $_POST['SiteId'];

    if ($Id != $SiteId) {
        $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_site_verify WHERE SiteId='$SiteId'"));
        if ($cek > 0){
            header("location: ./../../PM/KelolaDataSiteVerify.php?pesan=duplicate");

            return;
        }
    }

    $SiteName    = $_POST['SiteName'];
    $TocoName    = $_POST['TocoName'];
    $Sow         = $_POST['Sow'];

    $ViewAntenaRUU              = mt_rand(100000, 1000000) . date('dmYHis.') . pathinfo($_FILES['ViewAntenaRUU']['name'], PATHINFO_EXTENSION);
    $UploadFotoCabinet          = mt_rand(100000, 1000000) . date('dmYHis.') . pathinfo($_FILES['UploadFotoCabinet']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFotoCabinet']['tmp_name'], './../../assets/img/site_verify/' . $UploadFotoCabinet) &&
                move_uploaded_file($_FILES['ViewAntenaRUU']['tmp_name'], './../../assets/img/site_verify/' . $ViewAntenaRUU);

    if ($uploaded) {
        $query = "UPDATE tb_site_verify SET SiteId = '$SiteId', SiteName = '$SiteName', TocoName = '$TocoName', Sow = '$Sow',  UploadFotoCabinet = '$UploadFotoCabinet', ViewAntenaRUU = '$ViewAntenaRUU' WHERE SiteId='$Id'";
        $result = mysqli_query($db, $query);

        header("location: ./../../PM/KelolaDataSiteVerify.php?pesan=suksesedit");
    } else {

        header("location: ./../../PM/KelolaDataSiteVerify.php?pesan=gagaledit");
    }
}