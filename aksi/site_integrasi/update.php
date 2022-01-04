<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $Id              = $_GET['Id'];
    $SiteId          = $_POST['SiteId'];
    $SiteName        = $_POST['SiteName'];
    $Sow             = $_POST['Sow'];
    $BandType        = $_POST['BandType'];
    $BTSType         = $_POST['BTSType'];
    $SiteConfig      = $_POST['SiteConfig'];
    $EnginerId       = $_POST['EnginerId'];
    $EnginerName     = $_POST['EnginerName'];
    $IntegratorName  = $_POST['IntegratorName'];
    $NoHpIntegrator  = $_POST['NoHpIntegrator'];

    if ($Id != $SiteId) {
        $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_site_integrasi WHERE SiteId='$SiteId'"));
        if ($cek > 0){
            header("location: ./../../pages/KelolaDataSiteIntegrasi.php?pesan=duplicate");

            return;
        }
    }

    $query = "UPDATE tb_site_integrasi SET SiteId='$SiteId', SiteName = '$SiteName', Sow = '$Sow', BandType = '$BandType', BTSType = '$BTSType', SiteConfig = '$SiteConfig', EnginerId = '$EnginerId', EnginerName = '$EnginerName', IntegratorName = '$IntegratorName', NoHpIntegrator = '$NoHpIntegrator' WHERE SiteId='$Id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        header("location: ./../../pages/KelolaDataSiteIntegrasi.php?pesan=suksesedit");
    } else {
        header("location: ./../../pages/KelolaDataSiteIntegrasi.php?pesan=gagaledit");
    }
}