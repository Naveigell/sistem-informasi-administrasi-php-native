<?php
include './../../koneksi/koneksi.php';

//input User
if (isset($_POST['tambahsiteverify']))
{
//    $SiteId   = $data['SiteId'];
    $SiteName                   = $_POST['SiteName'];
    $TocoName                   = $_POST['TocoName'];
    $Sow                        = $_POST['Sow'];
    $ViewAntemna                = $_POST['ViewAntemna'];

    $UploadFotoCobmetTerbuka    = mt_rand(100000, 1000000) . date('dmYHis.') . pathinfo($_FILES['UploadFotoCobmetTerbuka']['name'], PATHINFO_EXTENSION);

    $uploaded = move_uploaded_file($_FILES['UploadFotoCobmetTerbuka']['tmp_name'], './../../assets/img/site_verify/' . $UploadFotoCobmetTerbuka);

    if ($uploaded) {
        $query = "INSERT INTO tb_site_verify (SiteName, TocoName, Sow, UploadFotoCobmetTerbuka, ViewAntemna) 
              VALUES('$SiteName', '$TocoName', '$Sow', '$UploadFotoCobmetTerbuka', '$ViewAntemna')";

        $result = mysqli_query($db, $query);

        header("location: ./../../PM/KelolaDataSiteVerify.php?pesan=suksestambah");
    } else {

        header("location: ./../../PM/KelolaDataSiteVerify.php?pesan=gagaltambah");
    }
}