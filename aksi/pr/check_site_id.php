<?php
include './../../koneksi/koneksi.php';

$SiteId = $_POST['SiteId'];
$Id     = (array_key_exists('Id', $_GET) ? $_GET['Id'] : null);

if ($SiteId == $Id) {
    http_response_code(200);

    exit();
}

if (strlen($SiteId) != 6) {
    http_response_code(404);

    echo json_encode([
        "message" => "Site Id karakter minimal 6",
    ]);

    exit();
}

$cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tb_pr WHERE SiteId='$SiteId'"));

if ($cek > 0) {
    http_response_code(419);

    echo json_encode([
        "message" => "Site Id sudah terpakai",
    ]);

    exit();
}