<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['tambahsiteintegrasi']))
{
//    $SiteId   = $data['SiteId'];
    $SiteName = $_POST['SiteName'];
    $Sow      = $_POST['Sow'];
    $BandType = $_POST['BandType'];
    $BTSType  = $_POST['BTSType'];

    $query = "INSERT INTO tb_site_integrasi (SiteName, Sow, BandType, BTSType) 
              VALUES('$SiteName', '$Sow', '$BandType', '$BTSType')";

    $result = mysqli_query($db, $query);

    if ($result) {
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=suksestambah");
    } else {
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=gagaltambah");
    }

}