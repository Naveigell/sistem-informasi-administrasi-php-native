<?php

require_once '../koneksi/koneksi.php';

$filterTotal   = '';
$filterTracker = 'SELECT *, 
                    tb_pr.TanggalApproved AS PRApproved, 
                    tb_sa.TanggalApproved AS SAApproved, 
                    tb_sir.TanggalApproved AS SIRApproved,
                    tb_site_verify.CreatedAt AS SiteVerifyDate,
                    tb_site_integrasi.CreatedAt AS SiteIntegrasiDate,
                    tb_mos.CreatedAt AS MosDate
                    FROM tb_mos 
                    INNER JOIN tb_pr ON tb_mos.SiteId = tb_pr.SiteId 
                    INNER JOIN tb_sa ON tb_mos.SiteId = tb_sa.SiteId
                    INNER JOIN tb_sir ON tb_mos.SiteId = tb_sir.SiteId 
                    INNER JOIN tb_site_integrasi ON tb_mos.SiteId = tb_site_integrasi.SiteId 
                    INNER JOIN tb_site_verify ON tb_mos.SiteId = tb_site_verify.SiteId';

if (array_key_exists('month', $_GET)) {
    $month = date('m', strtotime($_GET['month']));
    $year  = date('Y', strtotime($_GET['month']));

    $filterTotal    = " WHERE MONTH(CreatedAt) = {$month} AND YEAR(CreatedAt) = {$year}";
    $filterTracker .= " WHERE MONTH(tb_mos.CreatedAt) = {$month} AND YEAR(tb_mos.CreatedAt) = {$year}";
}

$mos            = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_mos {$filterTotal}"))['_total'];
$pr             = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_pr {$filterTotal}"))['_total'];
$sa             = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_sa {$filterTotal}"))['_total'];
$sir            = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_sir {$filterTotal}"))['_total'];
$site_integrasi = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_site_integrasi {$filterTotal}"))['_total'];
$site_verify    = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(*) AS _total FROM tb_site_verify {$filterTotal}"))['_total'];
$tracker        = mysqli_query($db, $filterTracker);

return [
    "mos"            => $mos,
    "pr"             => $pr,
    "sa"             => $sa,
    "sir"            => $sir,
    "site_integrasi" => $site_integrasi,
    "site_verify"    => $site_verify,
    "tracker"        => $tracker,
];
