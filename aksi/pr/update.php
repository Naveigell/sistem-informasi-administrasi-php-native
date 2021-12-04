<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $SiteId                   = $_GET['SiteId'];
    $SiteName                = $_POST['SiteName'];
    $BandType                = $_POST['BandType'];
    $DetailSow               = $_POST['DetailSow'];
    $DetailEQP               = $_POST['DetailEQP'];
    $SiteType                = $_POST['SiteType'];
    $TanggalSubmit           = $_POST['TanggalSubmit'];
    $TanggalApproved         = $_POST['TanggalApproved'];

    $UploadFilePR       = mt_rand(100000, 1000000) . date('dmYHis.') . pathinfo($_FILES['UploadFilePR']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFilePR']['tmp_name'], './../../assets/img/pr/' . $UploadFilePR);

    if ($uploaded) {
        $query = "UPDATE tb_pr SET SiteName = '$SiteName', BandType = '$BandType', DetailSow = '$DetailSow', DetailEQP = '$DetailEQP', SiteType = '$SiteType', TanggalSubmit = '$TanggalSubmit', TanggalApproved = '$TanggalApproved', UploadFilePR = '$UploadFilePR' WHERE SiteId='$SiteId'";
        $result = mysqli_query($db, $query);

        header("location: ./../../PM/KelolaDataPR.php?pesan=suksestambah");
    } else {

        header("location: ./../../PM/KelolaDataPR.php?pesan=gagaltambah");
    }
}