<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $Id       = $_GET['Id'];
    $SiteId   = $_POST['SiteId'];
    $SiteName = $_POST['SiteName'];
    $Sow      = $_POST['Sow'];
    $BandType = $_POST['BandType'];
    $BTSType  = $_POST['BTSType'];

    if ($Id != $SiteId) {
        $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_site_integrasi WHERE SiteId='$SiteId'"));
        if ($cek > 0){
            header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=duplicate");

            return;
        }
    }

    $query = "UPDATE tb_site_integrasi SET SiteId='$SiteId', SiteName = '$SiteName', Sow = '$Sow', BandType = '$BandType', BTSType = '$BTSType' WHERE SiteId='$Id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=suksesedit");
    } else {
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=gagaledit");
    }
}