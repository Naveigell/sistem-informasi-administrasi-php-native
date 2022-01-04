<?php
include './../../koneksi/koneksi.php';

//hapus user
if (isset($_POST['btnHapus']))
{
    $SiteId = $_GET['Id'];
    $getData = mysqli_query($db, "SELECT * FROM tb_sa WHERE SiteId='$SiteId'");
    $data = mysqli_fetch_assoc($getData);

    mysqli_query($db, "DELETE FROM tb_sa WHERE SiteId='$SiteId'");

    header("location: ./../../pages/KelolaDataSA.php?pesan=sukseshapus");
}