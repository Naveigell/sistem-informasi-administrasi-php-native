<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $Id                    = $_GET['Id'];
    $SiteId                = $_POST['SiteId'];
    $SiteName              = $_POST['SiteName'];
    $BandType              = $_POST['BandType'];
    $DetailSow             = $_POST['DetailSow'];
    $SiteConfig            = $_POST['SiteConfig'];
    $BTSType               = $_POST['BTSType'];
    $PONumber              = $_POST['PONumber'];
    $SiteType              = $_POST['SiteType'];
    $TanggalSubmit         = $_POST['TanggalSubmit'];
    $TanggalApproved       = $_POST['TanggalApproved'];

    if ($Id != $SiteId) {
        $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_sa WHERE SiteId='$SiteId'"));
        if ($cek > 0){
            header("location: ./../../PM/KelolaDataSA.php?pesan=duplicate");

            return;
        }
    }

    $UploadFileSA       = mt_rand(100000, 1000000) . date('dmYHis.') . pathinfo($_FILES['UploadFileSA']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFileSA']['tmp_name'], './../../assets/img/sa/' . $UploadFileSA);

    if ($uploaded) {
        $query = "UPDATE tb_sa SET SiteId='$SiteId', SiteName = '$SiteName', BandType = '$BandType', DetailSow = '$DetailSow', SiteConfig = '$SiteConfig', BTSType = '$BTSType', PONumber = '$PONumber', SiteType = '$SiteType', TanggalSubmit = '$TanggalSubmit', TanggalApproved = '$TanggalApproved', UploadFileSA = '$UploadFileSA' WHERE SiteId='$Id'";
        $result = mysqli_query($db, $query);

        header("location: ./../../PM/KelolaDataSA.php?pesan=suksesedit");
    } else {

        header("location: ./../../PM/KelolaDataSA.php?pesan=gagaledit");
    }
}