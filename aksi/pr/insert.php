<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['tambahpr']))
{
    $SiteId                = $_POST['SiteId'];

    $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_pr WHERE SiteId='$SiteId'"));
    if ($cek > 0){
        header("location: ./../../PM/KelolaDataPR.php?pesan=duplicate");

        return;
    }

    $SiteName                = $_POST['SiteName'];
    $BandType                = $_POST['BandType'];
    $DetailSow               = $_POST['DetailSow'];
    $DetailEQP               = $_POST['DetailEQP'];
    $SiteType                = $_POST['SiteType'];
    $TanggalSubmit           = $_POST['TanggalSubmit'];
    $TanggalApproved         = $_POST['TanggalApproved'];

    $UploadFilePR            = 'Site ' . $SiteId . ' ' . $SiteName . ' ' . date('d - M - Y.') . pathinfo($_FILES['UploadFilePR']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFilePR']['tmp_name'], './../../assets/img/pr/' . $UploadFilePR);

    if ($uploaded) {
        $query = "INSERT INTO tb_pr (SiteId, SiteName, BandType, DetailSow, DetailEQP, SiteType, TanggalSubmit, TanggalApproved, UploadFilePR) 
              VALUES('$SiteId', '$SiteName', '$BandType', '$DetailSow', '$DetailEQP','$SiteType', '$TanggalSubmit', '$TanggalApproved', '$UploadFilePR')";
        $result = mysqli_query($db, $query);

        header("location: ./../../PM/KelolaDataPR.php?pesan=suksestambah");
    } else {

        header("location: ./../../PM/KelolaDataPR.php?pesan=gagaltambah");
    }

}