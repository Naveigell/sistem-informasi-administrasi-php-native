<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['tambahsir']))
{
    $SiteName              = $_POST['SiteName'];
    $BandType              = $_POST['BandType'];
    $DetailSow             = $_POST['DetailSow'];
    $SiteConfig            = $_POST['SiteConfig'];
    $BTSType               = $_POST['BTSType'];
    $PONumber              = $_POST['PONumber'];
    $SiteType              = $_POST['SiteType'];
    $TanggalAudit          = $_POST['TanggalAudit'];
    $TanggalSubmit         = $_POST['TanggalSubmit'];
    $TanggalApproved       = $_POST['TanggalApproved'];

    $UploadFileSA          = mt_rand(100000, 1000000) . date('dmYHis.') . pathinfo($_FILES['UploadFileSA']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFileSA']['tmp_name'], './../../assets/img/sir/' . $UploadFileSA);

    if ($uploaded) {
        $query = "INSERT INTO tb_sir (SiteName, BandType, DetailSow, SiteConfig, BTSType, PONumber, SiteType, TanggalAudit, TanggalSubmit, TanggalApproved, UploadFileSA) 
              VALUES('$SiteName', '$BandType', '$DetailSow', '$SiteConfig','$BTSType', '$PONumber', '$SiteType', '$TanggalAudit', '$TanggalSubmit', '$TanggalApproved', '$UploadFileSA')";
        $result = mysqli_query($db, $query);

        header("location: ./../../PM/KelolaDataSir.php?pesan=suksestambah");
    } else {

        header("location: ./../../PM/KelolaDataSir.php?pesan=gagaltambah");
    }

}