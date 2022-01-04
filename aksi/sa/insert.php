<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['tambahsa']))
{
    $SiteId                = $_POST['SiteId'];

    $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_sa WHERE SiteId='$SiteId'"));
    if ($cek > 0){
        header("location: ./../../pages/KelolaDataSA.php?pesan=duplicate");

        return;
    }

    $SiteName              = $_POST['SiteName'];
    $BandType              = $_POST['BandType'];
    $DetailSow             = $_POST['DetailSow'];
    $SiteConfig            = $_POST['SiteConfig'];
    $BTSType               = $_POST['BTSType'];
    $PONumber              = $_POST['PONumber'];
    $SiteType              = $_POST['SiteType'];
    $TanggalSubmit         = $_POST['TanggalSubmit'];
    $TanggalApproved       = $_POST['TanggalApproved'];

    $UploadFileSA          = 'Site ' . $SiteId . ' ' . $SiteName . ' ' . date('d - M - Y.') . pathinfo($_FILES['UploadFileSA']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFileSA']['tmp_name'], './../../assets/img/sa/' . $UploadFileSA);

    if ($uploaded) {
        $query = "INSERT INTO tb_sa (SiteId, SiteName, BandType, DetailSow, SiteConfig, BTSType, PONumber, SiteType, TanggalSubmit, TanggalApproved, UploadFileSA) 
              VALUES('$SiteId', '$SiteName', '$BandType', '$DetailSow', '$SiteConfig','$BTSType', '$PONumber', '$SiteType', '$TanggalSubmit', '$TanggalApproved', '$UploadFileSA')";
        $result = mysqli_query($db, $query);

        header("location: ./../../pages/KelolaDataSA.php?pesan=suksestambah");
    } else {

        header("location: ./../../pages/KelolaDataSA.php?pesan=gagaltambah");
    }

}