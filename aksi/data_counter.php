<?php

require_once '../koneksi/koneksi.php';

$mos = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_mos"))['_total'];
$pr = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_pr"))['_total'];
$sa = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_sa"))['_total'];
$sir = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_sir"))['_total'];
$site_integrasi = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_site_integrasi"))['_total'];
$site_verify = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_site_verify"))['_total'];

return [
    "mos"            => $mos,
    "pr"             => $pr,
    "sa"             => $sa,
    "sir"            => $sir,
    "site_integrasi" => $site_integrasi,
    "site_verify"    => $site_verify,
];
