<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Format 7 - Data Kegiatan Posyandu Tahun ".$filterTahun.".xls");
header('Cache-Control: max-age=0');
ob_end_clean();

require 'assets/excel/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

// Membuat objek spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headerCop1Column1 = 1;
$headerCop2Column1 = 2;

$headerTabColumnA = 4;
$headerTabColumnB = 5;
$headerTabColumnC = 6;
$headerTabColumnD = 7;

$headerTabColumn1 = 7;
$headerTabColumn2 = 8;

$headerTabColumn3 = 8;

$bodyTabColumn2 = 8;
$bodyTabColumn2Lock = 9;

// Pembuka
$sheet->setCellValue('A' . $headerCop1Column1, 'SISTEM INFORMASI POSYANDU SINDANG '.( !empty($desa_name) ? "DESA ".strtoupper($desa_name) : "" ) . ( !empty($pos_name) ? " POSYANDU ".strtoupper($pos_name) : "SEMUA POSYANDU" ).' TAHUN '.$filterTahun);
$sheet->setCellValue('A' . $headerCop2Column1, 'LAPORAN FORMAT 7 - DATA KEGIATAN POSYANDU');

// Isi
$sheet->setCellValue('A' . $headerTabColumnA, 'NO'); $sheet->mergeCells('A'.$headerTabColumnA.':A'.$headerTabColumnD);
$sheet->setCellValue('B' . $headerTabColumnA, 'BULAN'); $sheet->mergeCells('B'.$headerTabColumnA.':B'.$headerTabColumnD);

$sheet->setCellValue('C' . $headerTabColumnA, 'JUMLAH IBU HAMIL'); $sheet->mergeCells('C'.$headerTabColumnA.':C'.$headerTabColumnD);
$sheet->setCellValue('D' . $headerTabColumnA, 'DIPERIKSA'); $sheet->mergeCells('D'.$headerTabColumnA.':D'.$headerTabColumnD);
$sheet->setCellValue('E' . $headerTabColumnA, 'FE TABLET BESI'); $sheet->mergeCells('E'.$headerTabColumnA.':E'.$headerTabColumnD);
$sheet->setCellValue('F' . $headerTabColumnA, 'JUMLAH IBU MENYUSUI'); $sheet->mergeCells('F'.$headerTabColumnA.':F'.$headerTabColumnD);

$sheet->setCellValue('G' . $headerTabColumnA, 'JUMLAH AKSEPTOR'); $sheet->mergeCells('G'.$headerTabColumnA.':N'.$headerTabColumnA);
$sheet->setCellValue('G' . $headerTabColumnB, 'KONDOM'); $sheet->mergeCells('G'.$headerTabColumnB.':G'.$headerTabColumnD);
$sheet->setCellValue('H' . $headerTabColumnB, 'PIL'); $sheet->mergeCells('H'.$headerTabColumnB.':H'.$headerTabColumnD);
$sheet->setCellValue('I' . $headerTabColumnB, 'IMPLANT'); $sheet->mergeCells('I'.$headerTabColumnB.':I'.$headerTabColumnD);
$sheet->setCellValue('J' . $headerTabColumnB, 'MOP'); $sheet->mergeCells('J'.$headerTabColumnB.':J'.$headerTabColumnD);
$sheet->setCellValue('K' . $headerTabColumnB, 'MOW'); $sheet->mergeCells('K'.$headerTabColumnB.':K'.$headerTabColumnD);
$sheet->setCellValue('L' . $headerTabColumnB, 'IUD'); $sheet->mergeCells('L'.$headerTabColumnB.':L'.$headerTabColumnD);
$sheet->setCellValue('M' . $headerTabColumnB, 'SUNTIK'); $sheet->mergeCells('M'.$headerTabColumnB.':M'.$headerTabColumnD);
$sheet->setCellValue('N' . $headerTabColumnB, 'LAIN-LAIN'); $sheet->mergeCells('N'.$headerTabColumnB.':N'.$headerTabColumnD);

$sheet->setCellValue('O' . $headerTabColumnA, 'PENIMBANGAN BALITA'); $sheet->mergeCells('O'.$headerTabColumnA.':Z'.$headerTabColumnA);
$sheet->setCellValue('O' . $headerTabColumnB, 'JUMLAH BALITA (S)'); $sheet->mergeCells('O'.$headerTabColumnB.':P'.$headerTabColumnC);
$sheet->setCellValue('O' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('P' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('Q' . $headerTabColumnB, 'JUMLAH BALITA YANG MEMILIKI KMS (K)'); $sheet->mergeCells('Q'.$headerTabColumnB.':R'.$headerTabColumnC);
$sheet->setCellValue('Q' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('R' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('S' . $headerTabColumnB, 'JUMLAH YANG DITIMBANG (D)'); $sheet->mergeCells('S'.$headerTabColumnB.':T'.$headerTabColumnC);
$sheet->setCellValue('S' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('T' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('U' . $headerTabColumnB, 'JUMLAH YANG NAIK (N)'); $sheet->mergeCells('U'.$headerTabColumnB.':V'.$headerTabColumnC);
$sheet->setCellValue('U' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('V' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('W' . $headerTabColumnB, 'JUMLAH MENDAPAT VIT A'); $sheet->mergeCells('W'.$headerTabColumnB.':X'.$headerTabColumnC);
$sheet->setCellValue('W' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('X' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('Y' . $headerTabColumnB, 'JUMLAH MENDAPAT PMT'); $sheet->mergeCells('Y'.$headerTabColumnB.':Z'.$headerTabColumnC);
$sheet->setCellValue('Y' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('Z' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('AA' . $headerTabColumnA, 'IMUNISASI TT IBU'); $sheet->mergeCells('AA'.$headerTabColumnA.':AB'.$headerTabColumnC);
$sheet->setCellValue('AA' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AB' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('AC' . $headerTabColumnA, 'BCG'); $sheet->mergeCells('AC'.$headerTabColumnA.':AD'.$headerTabColumnC);
$sheet->setCellValue('AC' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AD' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('AE' . $headerTabColumnA, 'JUMLAH BAYI YANG DIIMUNISASI'); $sheet->mergeCells('AE'.$headerTabColumnA.':AZ'.$headerTabColumnA); //
$sheet->setCellValue('AE' . $headerTabColumnB, 'DPT'); $sheet->mergeCells('AE'.$headerTabColumnB.':AJ'.$headerTabColumnB);
$sheet->setCellValue('AE' . $headerTabColumnC, 'I'); $sheet->mergeCells('AE'.$headerTabColumnC.':AF'.$headerTabColumnC);
$sheet->setCellValue('AE' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AF' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('AG' . $headerTabColumnC, 'II'); $sheet->mergeCells('AG'.$headerTabColumnC.':AH'.$headerTabColumnC);
$sheet->setCellValue('AG' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AH' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('AI' . $headerTabColumnC, 'III'); $sheet->mergeCells('AI'.$headerTabColumnC.':AJ'.$headerTabColumnC);
$sheet->setCellValue('AI' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AJ' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('AK' . $headerTabColumnB, 'POLIO'); $sheet->mergeCells('AK'.$headerTabColumnB.':AR'.$headerTabColumnB); //
$sheet->setCellValue('AK' . $headerTabColumnC, 'I'); $sheet->mergeCells('AK'.$headerTabColumnC.':AL'.$headerTabColumnC);
$sheet->setCellValue('AK' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AL' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('AM' . $headerTabColumnC, 'II'); $sheet->mergeCells('AM'.$headerTabColumnC.':AN'.$headerTabColumnC);
$sheet->setCellValue('AM' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AN' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('AO' . $headerTabColumnC, 'III'); $sheet->mergeCells('AO'.$headerTabColumnC.':AP'.$headerTabColumnC);
$sheet->setCellValue('AO' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AP' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('AQ' . $headerTabColumnC, 'III'); $sheet->mergeCells('AQ'.$headerTabColumnC.':AR'.$headerTabColumnC);
$sheet->setCellValue('AQ' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AR' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('AS' . $headerTabColumnB, 'CAMPAK'); $sheet->mergeCells('AS'.$headerTabColumnB.':AT'.$headerTabColumnC); //
$sheet->setCellValue('AS' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AT' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('AU' . $headerTabColumnB, 'HEPATITIS'); $sheet->mergeCells('AU'.$headerTabColumnB.':AZ'.$headerTabColumnB);
$sheet->setCellValue('AU' . $headerTabColumnC, 'I'); $sheet->mergeCells('AU'.$headerTabColumnC.':AV'.$headerTabColumnC);
$sheet->setCellValue('AU' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AV' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('AW' . $headerTabColumnC, 'II'); $sheet->mergeCells('AW'.$headerTabColumnC.':AX'.$headerTabColumnC);
$sheet->setCellValue('AW' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AX' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('AY' . $headerTabColumnC, 'III'); $sheet->mergeCells('AY'.$headerTabColumnC.':AZ'.$headerTabColumnC);
$sheet->setCellValue('AY' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('AZ' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('BA' . $headerTabColumnA, 'BALITA YANG MENDERITA DIARE'); $sheet->mergeCells('BA'.$headerTabColumnA.':BD'.$headerTabColumnA); //
$sheet->setCellValue('BA' . $headerTabColumnB, 'JUMLAH'); $sheet->mergeCells('BA'.$headerTabColumnB.':BB'.$headerTabColumnC);
$sheet->setCellValue('BA' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('BB' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('BC' . $headerTabColumnB, 'YANG MENDAPAT ORALIT'); $sheet->mergeCells('BC'.$headerTabColumnB.':BD'.$headerTabColumnC);
$sheet->setCellValue('BC' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('BD' . $headerTabColumnD, 'P'); 
$sheet->setCellValue('BE' . $headerTabColumnA, 'KET'); $sheet->mergeCells('BE'.$headerTabColumnA.':BE'.$headerTabColumnD);


// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('BE')->setWidth(35);


for ($colsAlpha = 'C'; $colsAlpha !== 'BC'; $colsAlpha++){

    $sheet->getColumnDimension($colsAlpha)->setWidth(8);

}

$noColmn = 1;
for ($colsAlpha = 'A'; $colsAlpha !== 'BF'; $colsAlpha++){

    $sheet->setCellValue($colsAlpha . $headerTabColumn2, (string)$noColmn);

    $noColmn++;
}

foreach ($report as $r => $row) {
  $bodyTabColumn2++;

  $sheet->setCellValue('A' . $bodyTabColumn2, (string)$row['no']);
  $sheet->setCellValue('B' . $bodyTabColumn2, $row['bulan']);
  $sheet->setCellValue('C' . $bodyTabColumn2, $row['Ibu_hamil']);
  $sheet->setCellValue('D' . $bodyTabColumn2, $row['diperiksa']);
  $sheet->setCellValue('E' . $bodyTabColumn2, $row['jml_FE_besi']);
  $sheet->setCellValue('F' . $bodyTabColumn2, $row['menyusui']);

  $sheet->setCellValue('G' . $bodyTabColumn2, $row['kb_kondom']);
  $sheet->setCellValue('H' . $bodyTabColumn2, $row['kb_pil']);
  $sheet->setCellValue('I' . $bodyTabColumn2, $row['kb_implant']);
  $sheet->setCellValue('J' . $bodyTabColumn2, $row['kb_mop']);
  $sheet->setCellValue('K' . $bodyTabColumn2, $row['kb_mow']);
  $sheet->setCellValue('L' . $bodyTabColumn2, $row['kb_iud']);
  $sheet->setCellValue('M' . $bodyTabColumn2, $row['kb_suntik']);
  $sheet->setCellValue('N' . $bodyTabColumn2, $row['kb_lainlain']);
  
  $sheet->setCellValue('O' . $bodyTabColumn2, $row['jml_balita_L']);
  $sheet->setCellValue('P' . $bodyTabColumn2, $row['jml_balita_P']);
  
  $sheet->setCellValue('Q' . $bodyTabColumn2, $row['jml_punya_kms_L']);
  $sheet->setCellValue('R' . $bodyTabColumn2, $row['jml_punya_kms_P']);
  
  $sheet->setCellValue('S' . $bodyTabColumn2, $row['jml_balita_timbang_L']);
  $sheet->setCellValue('T' . $bodyTabColumn2, $row['jml_balita_timbang_P']);
  
  $sheet->setCellValue('U' . $bodyTabColumn2, $row['jml_balita_timbang_naik_L']);
  $sheet->setCellValue('V' . $bodyTabColumn2, $row['jml_balita_timbang_naik_P']);
  
  $sheet->setCellValue('W' . $bodyTabColumn2, $row['jml_vitA_L']);
  $sheet->setCellValue('X' . $bodyTabColumn2, $row['jml_vitA_P']);
  
  $sheet->setCellValue('Y' . $bodyTabColumn2, $row['jml_dapat_pmt_L']);
  $sheet->setCellValue('Z' . $bodyTabColumn2, $row['jml_dapat_pmt_P']);
  
  $sheet->setCellValue('AA' . $bodyTabColumn2, $row['jml_imni_tt_1']);
  $sheet->setCellValue('AB' . $bodyTabColumn2, $row['jml_imni_tt_2']);
  
  $sheet->setCellValue('AC' . $bodyTabColumn2, $row['jml_bcg_L']);
  $sheet->setCellValue('AD' . $bodyTabColumn2, $row['jml_bcg_P']);
  
  $sheet->setCellValue('AE' . $bodyTabColumn2, $row['jml_dpt_1_L']);
  $sheet->setCellValue('AF' . $bodyTabColumn2, $row['jml_dpt_1_P']);
  $sheet->setCellValue('AG' . $bodyTabColumn2, $row['jml_dpt_2_L']);
  $sheet->setCellValue('AH' . $bodyTabColumn2, $row['jml_dpt_2_P']);
  $sheet->setCellValue('AI' . $bodyTabColumn2, $row['jml_dpt_3_L']);
  $sheet->setCellValue('AJ' . $bodyTabColumn2, $row['jml_dpt_3_L']);
  
  $sheet->setCellValue('AK' . $bodyTabColumn2, $row['jml_polio_1_L']);
  $sheet->setCellValue('AL' . $bodyTabColumn2, $row['jml_polio_1_P']);
  $sheet->setCellValue('AM' . $bodyTabColumn2, $row['jml_polio_2_L']);
  $sheet->setCellValue('AN' . $bodyTabColumn2, $row['jml_polio_2_P']);
  $sheet->setCellValue('AO' . $bodyTabColumn2, $row['jml_polio_3_L']);
  $sheet->setCellValue('AP' . $bodyTabColumn2, $row['jml_polio_3_P']);
  $sheet->setCellValue('AQ' . $bodyTabColumn2, $row['jml_polio_4_L']);
  $sheet->setCellValue('AR' . $bodyTabColumn2, $row['jml_polio_4_P']);
  
  $sheet->setCellValue('AS' . $bodyTabColumn2, $row['jml_campak_L']);
  $sheet->setCellValue('AT' . $bodyTabColumn2, $row['jml_campak_P']);
  
  $sheet->setCellValue('AU' . $bodyTabColumn2, $row['jml_hepatitis_1_L']);
  $sheet->setCellValue('AV' . $bodyTabColumn2, $row['jml_hepatitis_1_P']);
  $sheet->setCellValue('AW' . $bodyTabColumn2, $row['jml_hepatitis_2_L']);
  $sheet->setCellValue('AX' . $bodyTabColumn2, $row['jml_hepatitis_2_P']);
  $sheet->setCellValue('AY' . $bodyTabColumn2, $row['jml_hepatitis_3_L']);
  $sheet->setCellValue('AZ' . $bodyTabColumn2, $row['jml_hepatitis_3_P']);
  
  $sheet->setCellValue('BA' . $bodyTabColumn2, $row['jml_diare_L']);
  $sheet->setCellValue('BB' . $bodyTabColumn2, $row['jml_diare_P']);
  
  $sheet->setCellValue('BC' . $bodyTabColumn2, $row['jml_diare_L']);
  $sheet->setCellValue('BD' . $bodyTabColumn2, $row['jml_diare_P']);
  
  $sheet->setCellValue('BE' . $bodyTabColumn2, '      ');
}
$footerTabColumn1 = $bodyTabColumn2 + 1;

//footer
$sheet->setCellValue('B' . $footerTabColumn1, 'TOTAL');
$sheet->setCellValue('C' . $footerTabColumn1, '=SUM(C'.$bodyTabColumn2Lock.':C' . $bodyTabColumn2 . ')');
$sheet->setCellValue('D' . $footerTabColumn1, '=SUM(D'.$bodyTabColumn2Lock.':D' . $bodyTabColumn2 . ')');
$sheet->setCellValue('E' . $footerTabColumn1, '=SUM(E'.$bodyTabColumn2Lock.':E' . $bodyTabColumn2 . ')');
$sheet->setCellValue('F' . $footerTabColumn1, '=SUM(F'.$bodyTabColumn2Lock.':F' . $bodyTabColumn2 . ')');
$sheet->setCellValue('G' . $footerTabColumn1, '=SUM(G'.$bodyTabColumn2Lock.':G' . $bodyTabColumn2 . ')');
$sheet->setCellValue('H' . $footerTabColumn1, '=SUM(H'.$bodyTabColumn2Lock.':H' . $bodyTabColumn2 . ')');
$sheet->setCellValue('I' . $footerTabColumn1, '=SUM(I'.$bodyTabColumn2Lock.':I' . $bodyTabColumn2 . ')');
$sheet->setCellValue('J' . $footerTabColumn1, '=SUM(J'.$bodyTabColumn2Lock.':J' . $bodyTabColumn2 . ')');
$sheet->setCellValue('K' . $footerTabColumn1, '=SUM(K'.$bodyTabColumn2Lock.':K' . $bodyTabColumn2 . ')');
$sheet->setCellValue('L' . $footerTabColumn1, '=SUM(L'.$bodyTabColumn2Lock.':L' . $bodyTabColumn2 . ')');
$sheet->setCellValue('M' . $footerTabColumn1, '=SUM(M'.$bodyTabColumn2Lock.':M' . $bodyTabColumn2 . ')');
$sheet->setCellValue('N' . $footerTabColumn1, '=SUM(N'.$bodyTabColumn2Lock.':N' . $bodyTabColumn2 . ')');
$sheet->setCellValue('O' . $footerTabColumn1, '=SUM(O'.$bodyTabColumn2Lock.':O' . $bodyTabColumn2 . ')');
$sheet->setCellValue('P' . $footerTabColumn1, '=SUM(P'.$bodyTabColumn2Lock.':P' . $bodyTabColumn2 . ')');
$sheet->setCellValue('Q' . $footerTabColumn1, '=SUM(Q'.$bodyTabColumn2Lock.':Q' . $bodyTabColumn2 . ')');
$sheet->setCellValue('R' . $footerTabColumn1, '=SUM(R'.$bodyTabColumn2Lock.':R' . $bodyTabColumn2 . ')');
$sheet->setCellValue('S' . $footerTabColumn1, '=SUM(S'.$bodyTabColumn2Lock.':S' . $bodyTabColumn2 . ')');
$sheet->setCellValue('T' . $footerTabColumn1, '=SUM(T'.$bodyTabColumn2Lock.':T' . $bodyTabColumn2 . ')');
$sheet->setCellValue('U' . $footerTabColumn1, '=SUM(U'.$bodyTabColumn2Lock.':U' . $bodyTabColumn2 . ')');
$sheet->setCellValue('V' . $footerTabColumn1, '=SUM(V'.$bodyTabColumn2Lock.':V' . $bodyTabColumn2 . ')');
$sheet->setCellValue('W' . $footerTabColumn1, '=SUM(W'.$bodyTabColumn2Lock.':W' . $bodyTabColumn2 . ')');
$sheet->setCellValue('X' . $footerTabColumn1, '=SUM(X'.$bodyTabColumn2Lock.':X' . $bodyTabColumn2 . ')');
$sheet->setCellValue('Y' . $footerTabColumn1, '=SUM(Y'.$bodyTabColumn2Lock.':Y' . $bodyTabColumn2 . ')');
$sheet->setCellValue('Z' . $footerTabColumn1, '=SUM(Z'.$bodyTabColumn2Lock.':Z' . $bodyTabColumn2 . ')');

$sheet->setCellValue('AA' . $footerTabColumn1, '=SUM(AA'.$bodyTabColumn2Lock.':AA' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AB' . $footerTabColumn1, '=SUM(AB'.$bodyTabColumn2Lock.':AB' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AC' . $footerTabColumn1, '=SUM(AC'.$bodyTabColumn2Lock.':AC' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AD' . $footerTabColumn1, '=SUM(AD'.$bodyTabColumn2Lock.':AD' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AE' . $footerTabColumn1, '=SUM(AE'.$bodyTabColumn2Lock.':AE' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AF' . $footerTabColumn1, '=SUM(AF'.$bodyTabColumn2Lock.':AF' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AG' . $footerTabColumn1, '=SUM(AG'.$bodyTabColumn2Lock.':AG' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AH' . $footerTabColumn1, '=SUM(AH'.$bodyTabColumn2Lock.':AH' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AI' . $footerTabColumn1, '=SUM(AI'.$bodyTabColumn2Lock.':AI' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AJ' . $footerTabColumn1, '=SUM(AJ'.$bodyTabColumn2Lock.':AJ' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AK' . $footerTabColumn1, '=SUM(AK'.$bodyTabColumn2Lock.':AK' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AL' . $footerTabColumn1, '=SUM(AL'.$bodyTabColumn2Lock.':AL' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AM' . $footerTabColumn1, '=SUM(AM'.$bodyTabColumn2Lock.':AM' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AN' . $footerTabColumn1, '=SUM(AN'.$bodyTabColumn2Lock.':AN' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AO' . $footerTabColumn1, '=SUM(AO'.$bodyTabColumn2Lock.':AO' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AP' . $footerTabColumn1, '=SUM(AP'.$bodyTabColumn2Lock.':AP' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AQ' . $footerTabColumn1, '=SUM(AQ'.$bodyTabColumn2Lock.':AQ' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AR' . $footerTabColumn1, '=SUM(AR'.$bodyTabColumn2Lock.':AR' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AS' . $footerTabColumn1, '=SUM(AS'.$bodyTabColumn2Lock.':AS' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AT' . $footerTabColumn1, '=SUM(AT'.$bodyTabColumn2Lock.':AT' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AU' . $footerTabColumn1, '=SUM(AU'.$bodyTabColumn2Lock.':AU' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AV' . $footerTabColumn1, '=SUM(AV'.$bodyTabColumn2Lock.':AV' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AW' . $footerTabColumn1, '=SUM(AW'.$bodyTabColumn2Lock.':AW' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AX' . $footerTabColumn1, '=SUM(AX'.$bodyTabColumn2Lock.':AX' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AY' . $footerTabColumn1, '=SUM(AY'.$bodyTabColumn2Lock.':AY' . $bodyTabColumn2 . ')');
$sheet->setCellValue('AZ' . $footerTabColumn1, '=SUM(AZ'.$bodyTabColumn2Lock.':AZ' . $bodyTabColumn2 . ')');

$sheet->setCellValue('BA' . $footerTabColumn1, '=SUM(BA'.$bodyTabColumn2Lock.':BA' . $bodyTabColumn2 . ')');
$sheet->setCellValue('BB' . $footerTabColumn1, '=SUM(BB'.$bodyTabColumn2Lock.':BB' . $bodyTabColumn2 . ')');
$sheet->setCellValue('BC' . $footerTabColumn1, '=SUM(BC'.$bodyTabColumn2Lock.':BC' . $bodyTabColumn2 . ')');
$sheet->setCellValue('BD' . $footerTabColumn1, '=SUM(BD'.$bodyTabColumn2Lock.':BD' . $bodyTabColumn2 . ')');


//Merge Cell
$sheet->mergeCells('A'.$headerCop1Column1.':BE' .$headerCop1Column1);
$sheet->mergeCells('A'.$headerCop2Column1.':BE' .$headerCop2Column1);

// Mengubah style header file

$sheet->getStyle('A' . $headerCop1Column1)->applyFromArray(
[
    'alignment' => [
    'horizontal' => Alignment::HORIZONTAL_CENTER,
    'vertical' => Alignment::VERTICAL_CENTER,
    'wrapText' => true,
    ],
    'font' => [
    'bold' => true,
    ],
]
);
$sheet->getStyle('A' . $headerCop2Column1)->applyFromArray(
[
    'alignment' => [
    'horizontal' => Alignment::HORIZONTAL_CENTER,
    'vertical' => Alignment::VERTICAL_CENTER,
    'wrapText' => true,
    ],
    'font' => [
    'bold' => true,
    ],
]
);

// header tabel style
$sheet->getStyle('A'.$headerTabColumnA.':BE'.$headerTabColumnD)->applyFromArray(
[
    'alignment' => [
    'horizontal' => Alignment::HORIZONTAL_CENTER,
    'vertical' => Alignment::VERTICAL_CENTER,
    'wrapText' => true,
    ],
    'font' => [
    'bold' => true,
    ],
    'borders' => [
    'allBorders' => [
        'borderStyle' => Border::BORDER_THIN,
        'color' => [
        'argb' => 'FF000000'
        ],
    ],
    ],
]
);

$sheet->getStyle('A'.$headerTabColumn2.':BE'.$headerTabColumn2)->applyFromArray(
  [
    'alignment' => [
      'horizontal' => Alignment::HORIZONTAL_CENTER,
      'vertical' => Alignment::VERTICAL_CENTER,
      'wrapText' => true,
    ],
    'font' => [
      'bold' => true,
    ],
    'borders' => [
      'allBorders' => [
        'borderStyle' => Border::BORDER_THIN,
        'color' => [
          'argb' => 'FF000000'
        ],
      ],
    ],
  ]
);
//border
for ($colsAlpha = 'A'; $colsAlpha !== 'BF'; $colsAlpha++){

    $sheet->getStyle($colsAlpha.$bodyTabColumn2Lock.':'. $colsAlpha . $bodyTabColumn2)->applyFromArray(
        [
            'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
            'wrapText' => true,
            ],
            'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => [
                'argb' => 'FF000000'
                ],
            ],
            ],
        ]
    );
}
//Border Footer
for ($colsAlpha = 'A'; $colsAlpha !== 'BF'; $colsAlpha++){

  $sheet->getStyle($colsAlpha.$footerTabColumn1.':'. $colsAlpha . $footerTabColumn1)->applyFromArray(
      [
          'alignment' => [
          'horizontal' => Alignment::HORIZONTAL_CENTER,
          'vertical' => Alignment::VERTICAL_CENTER,
          'wrapText' => true,
          ],
          'font' => [
          'bold' => true,
          ],
          'borders' => [
          'outline' => [
              'borderStyle' => Border::BORDER_THIN,
              'color' => [
              'argb' => 'FF000000'
              ],
          ],
          ],
      ]
  );
}

ob_end_clean();
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');



