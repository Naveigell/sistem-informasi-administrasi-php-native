<?php

require '../vendor/autoload.php';
require_once '../koneksi/koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Site Id');
$sheet->setCellValue('C1', 'Site Name');
$sheet->setCellValue('D1', 'Toco Name');
$sheet->setCellValue('E1', 'SOW');
$sheet->setCellValue('F1', 'Tanggal MOS');
$sheet->setCellValue('G1', 'PIC MOS');
$sheet->setCellValue('H1', 'Tanggal Site Verify');
$sheet->setCellValue('I1', 'Tanggal Site Integrasi');
$sheet->setCellValue('J1', 'Tanggal PR Approved');
$sheet->setCellValue('K1', 'Tanggal SA Approved');
$sheet->setCellValue('L1', 'Tanggal SIR Approved');

$i = 2;
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

    $filterTracker .= " WHERE MONTH(tb_mos.CreatedAt) = {$month} AND YEAR(tb_mos.CreatedAt) = {$year}";
}

$tracker        = mysqli_query($db, $filterTracker);

while ($row = mysqli_fetch_object($tracker)) {
    $sheet->setCellValue("A{$i}", $i);
    $sheet->setCellValue("B{$i}", $row->SiteId);
    $sheet->setCellValue("C{$i}", $row->SiteName);
    $sheet->setCellValue("D{$i}", $row->TocoName);
    $sheet->setCellValue("E{$i}", $row->Sow);
    $sheet->setCellValue("F{$i}", date('m - d - Y', strtotime($row->MosDate)));
    $sheet->setCellValue("G{$i}", $row->PicOnSite);
    $sheet->setCellValue("H{$i}", date('m - d - Y', strtotime($row->SiteVerifyDate)));
    $sheet->setCellValue("I{$i}", date('m - d - Y', strtotime($row->SiteIntegrasiDate)));
    $sheet->setCellValue("J{$i}", date('m - d - Y', strtotime($row->PRApproved)));
    $sheet->setCellValue("K{$i}", date('m - d - Y', strtotime($row->SAApproved)));
    $sheet->setCellValue("L{$i}", date('m - d - Y', strtotime($row->SIRApproved)));

    $i++;
}

foreach ($sheet->getColumnIterator() as $column) {
    $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
}

$writer = new Xlsx($spreadsheet);
try {
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="file.xlsx"');

    $writer->save('php://output');

    if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: ../PM/homePM.php');
    }

} catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
    var_dump($e->getMessage());
}