<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data WUS-PUS Posyandu ".$filterBulan." ".$filterTahun.".xls");
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

$headerTabColumn1 = 6;
$headerTabColumn2 = 7;

$headerTabColumn3 = 7;

$bodyTabColumn2 = 7;
$bodyTabColumn2Lock = 8;

// Pembuka
$sheet->setCellValue('A' . $headerCop1Column1, 'SISTEM INFORMASI POSYANDU SINDANG '.( !empty($desa_name) ? "DESA ".strtoupper($desa_name) : "" ) . ( !empty($pos_name) ? " POSYANDU ".strtoupper($pos_name) : "SEMUA POSYANDU" ).' BULAN '.strtoupper($filterBulan).' TAHUN '.$filterTahun);
$sheet->setCellValue('A' . $headerCop2Column1, 'LAPORAN FORMAT 2 - REGISTER WUS - PUS DALAM WILAYAH KERJA POSYANDU');

// Isi
$sheet->setCellValue('A' . $headerTabColumnA, 'NO'); $sheet->mergeCells('A'.$headerTabColumnA.':A'.$headerTabColumnC);
$sheet->setCellValue('B' . $headerTabColumnA, 'NO KMS'); $sheet->mergeCells('B'.$headerTabColumnA.':B'.$headerTabColumnC);
$sheet->setCellValue('C' . $headerTabColumnA, 'NAMA WUS/PUS'); $sheet->mergeCells('C'.$headerTabColumnA.':C'.$headerTabColumnC);
$sheet->setCellValue('D' . $headerTabColumnA, 'UMUR'); $sheet->mergeCells('D'.$headerTabColumnA.':D'.$headerTabColumnC);
$sheet->setCellValue('E' . $headerTabColumnA, 'SUAMI PUS'); $sheet->mergeCells('E'.$headerTabColumnA.':E'.$headerTabColumnC);
$sheet->setCellValue('F' . $headerTabColumnA, 'TAHA PAN KS'); $sheet->mergeCells('F'.$headerTabColumnA.':F'.$headerTabColumnC);
$sheet->setCellValue('G' . $headerTabColumnA, 'KEL. DAWIS'); $sheet->mergeCells('G'.$headerTabColumnA.':G'.$headerTabColumnC);

$sheet->setCellValue('H' . $headerTabColumnA, 'JUMLAH ANAK'); $sheet->mergeCells('H4:I4');
$sheet->setCellValue('H' . $headerTabColumnB, 'YANG HIDUP'); $sheet->mergeCells('H'.$headerTabColumnB.':H'.$headerTabColumnC);
$sheet->setCellValue('I' . $headerTabColumnB, 'MENINGGAL PADA UMUR'); $sheet->mergeCells('I'.$headerTabColumnB.':I'.$headerTabColumnC);

$sheet->setCellValue('J' . $headerTabColumnA, 'LILA'); $sheet->mergeCells('J'.$headerTabColumnA.':J'.$headerTabColumnC);

$sheet->setCellValue('K' . $headerTabColumnA, 'PEMBERIAN'); $sheet->mergeCells('K4:N4');
$sheet->setCellValue('K' . $headerTabColumnB, 'KAPSUL YODIUM'); $sheet->mergeCells('K'.$headerTabColumnB.':K'.$headerTabColumnC);
$sheet->setCellValue('L' . $headerTabColumnB, 'IMUNISASI TT'); $sheet->mergeCells('L5:N5');
$sheet->setCellValue('L' . $headerTabColumnC, 'I');
$sheet->setCellValue('M' . $headerTabColumnC, 'II');
$sheet->setCellValue('N' . $headerTabColumnC, 'LENGKAP');

$sheet->setCellValue('O' . $headerTabColumnA, 'AKSEPTOR'); $sheet->mergeCells('O4:Z4');
$sheet->setCellValue('O' . $headerTabColumnB, 'JAN'); $sheet->mergeCells('O'.$headerTabColumnB.':O'.$headerTabColumnC);
$sheet->setCellValue('P' . $headerTabColumnB, 'FEB'); $sheet->mergeCells('P'.$headerTabColumnB.':P'.$headerTabColumnC);
$sheet->setCellValue('Q' . $headerTabColumnB, 'MAR'); $sheet->mergeCells('Q'.$headerTabColumnB.':Q'.$headerTabColumnC);
$sheet->setCellValue('R' . $headerTabColumnB, 'APR'); $sheet->mergeCells('R'.$headerTabColumnB.':R'.$headerTabColumnC);
$sheet->setCellValue('S' . $headerTabColumnB, 'MEI'); $sheet->mergeCells('S'.$headerTabColumnB.':S'.$headerTabColumnC);
$sheet->setCellValue('T' . $headerTabColumnB, 'JUN'); $sheet->mergeCells('T'.$headerTabColumnB.':T'.$headerTabColumnC);
$sheet->setCellValue('U' . $headerTabColumnB, 'JUL'); $sheet->mergeCells('U'.$headerTabColumnB.':U'.$headerTabColumnC);
$sheet->setCellValue('V' . $headerTabColumnB, 'AGUS'); $sheet->mergeCells('V'.$headerTabColumnB.':V'.$headerTabColumnC);
$sheet->setCellValue('W' . $headerTabColumnB, 'SEP'); $sheet->mergeCells('W'.$headerTabColumnB.':W'.$headerTabColumnC);
$sheet->setCellValue('X' . $headerTabColumnB, 'OKT'); $sheet->mergeCells('X'.$headerTabColumnB.':X'.$headerTabColumnC);
$sheet->setCellValue('Y' . $headerTabColumnB, 'NOV'); $sheet->mergeCells('Y'.$headerTabColumnB.':Y'.$headerTabColumnC);
$sheet->setCellValue('Z' . $headerTabColumnB, 'DES'); $sheet->mergeCells('Z'.$headerTabColumnB.':Z'.$headerTabColumnC);

$sheet->setCellValue('AA' . $headerTabColumnA, 'KELUARGA BERENCANA'); $sheet->mergeCells('AA4:AD4');
$sheet->setCellValue('AA' . $headerTabColumnB, 'KAPSUL YODIUM'); $sheet->mergeCells('AA'.$headerTabColumnB.':AA'.$headerTabColumnC);
$sheet->setCellValue('AB' . $headerTabColumnB, 'IMUNISASI TT'); $sheet->mergeCells('AB5:AD5');
$sheet->setCellValue('AB' . $headerTabColumnC, 'I');
$sheet->setCellValue('AC' . $headerTabColumnC, 'II');
$sheet->setCellValue('AD' . $headerTabColumnC, 'LENGKAP');


$sheet->setCellValue('AE' . $headerTabColumnA, 'KET'); $sheet->mergeCells('AE'.$headerTabColumnA.':AE'.$headerTabColumnC);


// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('AE')->setWidth(35);


for ($colsAlpha = 'B'; $colsAlpha !== 'AD'; $colsAlpha++){

    $sheet->getColumnDimension($colsAlpha)->setAutoSize(true);

}

$noColmn = 1;
for ($colsAlpha = 'A'; $colsAlpha !== 'AF'; $colsAlpha++){

    $sheet->setCellValue($colsAlpha . $headerTabColumn2, (string)$noColmn);

    $noColmn++;
}

foreach ($report as $r => $row) {
  $bodyTabColumn2++;

  $sheet->setCellValue('A' . $bodyTabColumn2, (string)$row['no']);
  $sheet->setCellValue('B' . $bodyTabColumn2, $row['kms']);
  $sheet->setCellValue('C' . $bodyTabColumn2, $row['nama']);
  $sheet->setCellValue('D' . $bodyTabColumn2, $row['umur']);
  $sheet->setCellValue('E' . $bodyTabColumn2, $row['suami_pus']);
  $sheet->setCellValue('F' . $bodyTabColumn2, $row['taha_kan_ks']);
  $sheet->setCellValue('G' . $bodyTabColumn2, (empty($row['kel_dawis'])) ? "-" : $row['kel_dawis']);
  $sheet->setCellValue('H' . $bodyTabColumn2, $row['jml_anak_hidup']);
  $sheet->setCellValue('I' . $bodyTabColumn2, (empty($row['umur_anak_meninggal'])) ? "-" : $row['umur_anak_meninggal']);
  $sheet->setCellValue('J' . $bodyTabColumn2, $row['lila']);
  $sheet->setCellValue('K' . $bodyTabColumn2, (empty($row['pyd_kapsul_yodium'])) ? "-" : "V");
  $sheet->setCellValue('L' . $bodyTabColumn2, (empty($row['pyd_imsi1'])) ? "-" : "V");
  $sheet->setCellValue('M' . $bodyTabColumn2, (empty($row['pyd_imsi2'])) ? "-" : "V");
  $sheet->setCellValue('N' . $bodyTabColumn2, (empty($row['pyd_imsi_lengkap'])) ? "-" : "V");

  $sheet->setCellValue('O' . $bodyTabColumn2, $row['r01_jenis']);
  $sheet->setCellValue('P' . $bodyTabColumn2, $row['r02_jenis']);
  $sheet->setCellValue('Q' . $bodyTabColumn2, $row['r03_jenis']);
  $sheet->setCellValue('R' . $bodyTabColumn2, $row['r04_jenis']);
  $sheet->setCellValue('S' . $bodyTabColumn2, $row['r05_jenis']);
  $sheet->setCellValue('T' . $bodyTabColumn2, $row['r06_jenis']);
  $sheet->setCellValue('U' . $bodyTabColumn2, $row['r07_jenis']);
  $sheet->setCellValue('V' . $bodyTabColumn2, $row['r08_jenis']);
  $sheet->setCellValue('W' . $bodyTabColumn2, $row['r09_jenis']);
  $sheet->setCellValue('X' . $bodyTabColumn2, $row['r10_jenis']);
  $sheet->setCellValue('Y' . $bodyTabColumn2, $row['r11_jenis']);
  $sheet->setCellValue('Z' . $bodyTabColumn2, $row['r12_jenis']);
  
  $sheet->setCellValue('AA' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('AB' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('AC' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('AD' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('AE' . $bodyTabColumn2, '      ');
}
$footerTabColumn1 = $bodyTabColumn2 + 1;


//Merge Cell
$sheet->mergeCells('A'.$headerCop1Column1.':AE' .$headerCop1Column1);
$sheet->mergeCells('A'.$headerCop2Column1.':AE' .$headerCop2Column1);


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
$sheet->getStyle('A'.$headerTabColumnA.':AE'.$headerTabColumnC)->applyFromArray(
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

$sheet->getStyle('A'.$headerTabColumn2.':AE'.$headerTabColumn2)->applyFromArray(
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
for ($colsAlpha = 'A'; $colsAlpha !== 'AF'; $colsAlpha++){

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

ob_end_clean();
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');



