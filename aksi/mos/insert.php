<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['tambahmos']))
{
    $SiteId                = $_POST['SiteId'];

    $cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_mos WHERE SiteId='$SiteId'"));
    if ($cek > 0){
        header("location: ./../../pages/KelolaDataMos.php?pesan=duplicate");

        return;
    }

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
        $query = "INSERT INTO tb_mos (SiteId, SiteName, SiteType, PicOnSite, NoTelpPic, PenanggungJawabVendor, TocoName, Sow, UploadFotoMaterial, UploadFotoPicOnSite) 
              VALUES('$SiteId', '$SiteName', '$SiteType', '$PicOnSite', '$NoTelpPic','$PenanggungJawabVendor', '$TocoName', '$Sow', '$UploadFotoMaterial', '$UploadFotoPicOnSite')";
        $result = mysqli_query($db, $query);

        header("location: ./../../pages/KelolaDataMos.php?pesan=suksestambah");
    } else {

        header("location: ./../../pages/KelolaDataMos.php?pesan=gagaltambah");
    }
}