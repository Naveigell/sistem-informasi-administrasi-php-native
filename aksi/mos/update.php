<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['btnEdit']))
{
    $SiteId                   = $_GET['SiteId'];
    $SiteName                 = $_POST['SiteName'];
    $SiteType                 = $_POST['SiteType'];
    $PicOnSite                = $_POST['PicOnSite'];
    $NoTelpPic                = $_POST['NoTelpPic'];
    $PenanggungJawabVendor    = $_POST['PenanggungJawabVendor'];
    $TocoName                 = $_POST['TocoName'];
    $Sow                      = $_POST['Sow'];

    $UploadFotoMaterial       = mt_rand(100000, 1000000) . date('dmYHis.') . pathinfo($_FILES['UploadFotoMaterial']['name'], PATHINFO_EXTENSION);
    $UploadFotoPicOnSite      = mt_rand(100000, 1000000) . date('siHYmd.') . pathinfo($_FILES['UploadFotoPicOnSite']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFotoMaterial']['tmp_name'], './../../assets/img/mos/' . $UploadFotoMaterial) && move_uploaded_file($_FILES['UploadFotoPicOnSite']['tmp_name'], './../../assets/img/mos/' . $UploadFotoPicOnSite);

    if ($uploaded) {
        $query = "UPDATE tb_mos SET SiteName = '$SiteName', SiteType = '$SiteType', PicOnSite = '$PicOnSite', NoTelpPic = '$NoTelpPic', PenanggungJawabVendor = '$PenanggungJawabVendor', TocoName = '$TocoName', Sow = '$Sow', UploadFotoMaterial = '$UploadFotoMaterial', UploadFotoPicOnSite = '$UploadFotoPicOnSite' WHERE SiteId='$SiteId'";
        $result = mysqli_query($db, $query);

//        header("location: ./../../PM/KelolaDataMos.php?pesan=suksestambah");
    } else {

//        header("location: ./../../PM/KelolaDataUser.php?pesan=gagaltambah");
    }
}