<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $Id                    = $_GET['Id'];
    $SiteId                = $_POST['SiteId'];
    $SiteName                = $_POST['SiteName'];
    $BandType                = $_POST['BandType'];
    $DetailSow               = $_POST['DetailSow'];
    $DetailEQP               = $_POST['DetailEQP'];
    $SiteType                = $_POST['SiteType'];
    $TanggalSubmit           = $_POST['TanggalSubmit'];
    $TanggalApproved         = $_POST['TanggalApproved'];

    if ($Id != $SiteId) {
        $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_pr WHERE SiteId='$SiteId'"));
        if ($cek > 0){
            header("location: ./../../PM/KelolaDataPR.php?pesan=duplicate");

            return;
        }
    }

    $UploadFilePR       = 'Site ' . $SiteId . ' ' . $SiteName . ' ' . date('d - M - Y') . pathinfo($_FILES['UploadFilePR']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFilePR']['tmp_name'], './../../assets/img/pr/' . $UploadFilePR);

    if ($uploaded) {
        $query = "UPDATE tb_pr SET SiteId='$SiteId', SiteName = '$SiteName', BandType = '$BandType', DetailSow = '$DetailSow', DetailEQP = '$DetailEQP', SiteType = '$SiteType', TanggalSubmit = '$TanggalSubmit', TanggalApproved = '$TanggalApproved', UploadFilePR = '$UploadFilePR' WHERE SiteId='$Id'";
        $result = mysqli_query($db, $query);

        header("location: ./../../PM/KelolaDataPR.php?pesan=suksesedit");
    } else {

        header("location: ./../../PM/KelolaDataPR.php?pesan=gagaledit");
    }
}