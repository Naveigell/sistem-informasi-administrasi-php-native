<?php
include './../../koneksi/koneksi.php';

$SiteId = $_POST['SiteId'];
$Id     = (array_key_exists('Id', $_GET) ? $_GET['Id'] : null);

if ($SiteId == $Id) {
    http_response_code(200);

    return;
}

$cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_site_integrasi WHERE SiteId='$SiteId'"));

if ($cek > 0) {
    http_response_code(419);

    echo json_encode([
        "message" => "Site Id sudah terpakai",
    ]);
}