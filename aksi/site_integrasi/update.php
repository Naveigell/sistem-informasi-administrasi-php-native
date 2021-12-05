<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $SiteId   = $_GET['Id'];
    $SiteName = $_POST['SiteName'];
    $Sow      = $_POST['Sow'];
    $BandType = $_POST['BandType'];
    $BTSType  = $_POST['BTSType'];

    $query = "UPDATE tb_site_integrasi SET SiteName = '$SiteName', Sow = '$Sow', BandType = '$BandType', BTSType = '$BTSType' WHERE SiteId='$SiteId'";
    $result = mysqli_query($db, $query);

    if ($result) {
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=suksesedit");
    } else {
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=gagaledit");
    }
}