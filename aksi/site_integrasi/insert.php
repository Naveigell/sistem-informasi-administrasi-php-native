<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['tambahsiteintegrasi']))
{
    $SiteId   = $_POST['SiteId'];

    $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_site_integrasi WHERE SiteId='$SiteId'"));
    if ($cek > 0){
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=duplicate");

        return;
    }

    $SiteName        = $_POST['SiteName'];
    $Sow             = $_POST['Sow'];
    $BandType        = $_POST['BandType'];
    $BTSType         = $_POST['BTSType'];
    $SiteConfig      = $_POST['SiteConfig'];
    $EnginerId       = $_POST['EnginerId'];
    $EnginerName     = $_POST['EnginerName'];
    $IntegratorName  = $_POST['IntegratorName'];
    $NoHpIntegrator  = $_POST['NoHpIntegrator'];

    $query = "INSERT INTO tb_site_integrasi (SiteId, SiteName, Sow, BandType, BTSType, SiteConfig, EnginerId, EnginerName, IntegratorName, NoHpIntegrator) 
              VALUES('$SiteId', '$SiteName', '$Sow', '$BandType', '$BTSType', '$SiteConfig', '$EnginerId', '$EnginerName', '$IntegratorName', '$NoHpIntegrator')";

    $result = mysqli_query($db, $query);

    if ($result) {
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=suksestambah");
    } else {
        header("location: ./../../PM/KelolaDataSiteIntegrasi.php?pesan=gagaltambah");
    }

}