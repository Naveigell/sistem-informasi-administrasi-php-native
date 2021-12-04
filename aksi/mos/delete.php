<?php
include './../../koneksi/koneksi.php';

//hapus user
if (isset($_POST['btnHapus']))
{
    $SiteId = $_GET['SiteId'];
    $getData = mysqli_query($db, "SELECT * FROM tb_mos WHERE SiteId='$SiteId'");
    $data = mysqli_fetch_assoc($getData);

    mysqli_query($db, "DELETE FROM tb_mos WHERE SiteId='$SiteId'");

    header("location: ./../../PM/KelolaDataMos.php?pesan=sukseshapus");
}