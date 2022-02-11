<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Format 6 - Kunjungan Posyandu Tahun ".$filterTahun.".xls");
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
$headerTabColumnE = 8;

$headerTabColumn1 = 8;
$headerTabColumn2 = 9;

$headerTabColumn3 = 9;

$bodyTabColumn2 = 9;
$bodyTabColumn2Lock = 10;

// Pembuka
$sheet->setCellValue('A' . $headerCop1Column1, 'SISTEM INFORMASI POSYANDU SINDANG '.( !empty($desa_name) ? "DESA ".strtoupper($desa_name) : "" ) . ( !empty($pos_name) ? " POSYANDU ".strtoupper($pos_name) : "SEMUA POSYANDU" ).' TAHUN '.$filterTahun);
$sheet->setCellValue('A' . $headerCop2Column1, 'LAPORAN FORMAT 6 - JUMLAH PENGUNJUNG/JUMLAH PETUGAS POSYANDU/JUMLAH BAYI LAHIR/MENINGGAL');

// Isi
$sheet->setCellValue('A' . $headerTabColumnA, 'NO'); $sheet->mergeCells('A'.$headerTabColumnA.':A'.$headerTabColumnE);
$sheet->setCellValue('B' . $headerTabColumnA, 'BULAN'); $sheet->mergeCells('B'.$headerTabColumnA.':B'.$headerTabColumnE);

$sheet->setCellValue('C' . $headerTabColumnA, 'JUMLAH PENGUNJUNG'); $sheet->mergeCells('C'.$headerTabColumnA.':N'.$headerTabColumnA); //
$sheet->setCellValue('C' . $headerTabColumnB, 'BALITA'); $sheet->mergeCells('C'.$headerTabColumnB.':J'.$headerTabColumnB);

$sheet->setCellValue('C' . $headerTabColumnC, '0-12 BULAN'); $sheet->mergeCells('C'.$headerTabColumnC.':F'.$headerTabColumnC);
$sheet->setCellValue('C' . $headerTabColumnD, 'BARU'); $sheet->mergeCells('C'.$headerTabColumnD.':D'.$headerTabColumnD);
$sheet->setCellValue('C' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('D' . $headerTabColumnE, 'P'); 
$sheet->setCellValue('E' . $headerTabColumnD, 'LAMA'); $sheet->mergeCells('E'.$headerTabColumnD.':F'.$headerTabColumnD);
$sheet->setCellValue('E' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('F' . $headerTabColumnE, 'P'); 

$sheet->setCellValue('G' . $headerTabColumnC, '1-5 TAHUN'); $sheet->mergeCells('G'.$headerTabColumnC.':J'.$headerTabColumnC);
$sheet->setCellValue('G' . $headerTabColumnD, 'BARU'); $sheet->mergeCells('G'.$headerTabColumnD.':H'.$headerTabColumnD);
$sheet->setCellValue('G' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('H' . $headerTabColumnE, 'P'); 
$sheet->setCellValue('I' . $headerTabColumnD, 'LAMA'); $sheet->mergeCells('I'.$headerTabColumnD.':J'.$headerTabColumnD);
$sheet->setCellValue('I' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('J' . $headerTabColumnE, 'P'); 

$sheet->setCellValue('K' . $headerTabColumnB, 'WUS'); $sheet->mergeCells('K'.$headerTabColumnB.':K'.$headerTabColumnE);

$sheet->setCellValue('L' . $headerTabColumnB, 'IBU'); $sheet->mergeCells('L'.$headerTabColumnB.':N'.$headerTabColumnB);
$sheet->setCellValue('L' . $headerTabColumnC, 'PUS'); $sheet->mergeCells('L'.$headerTabColumnC.':L'.$headerTabColumnE);
$sheet->setCellValue('M' . $headerTabColumnC, 'HAMIL'); $sheet->mergeCells('M'.$headerTabColumnC.':M'.$headerTabColumnE);
$sheet->setCellValue('N' . $headerTabColumnC, 'MENYUSUI'); $sheet->mergeCells('N'.$headerTabColumnC.':N'.$headerTabColumnE);

$sheet->setCellValue('O' . $headerTabColumnA, 'JUMLAH PETUGAS YANG HADIR'); $sheet->mergeCells('O'.$headerTabColumnA.':T'.$headerTabColumnA); //
$sheet->setCellValue('O' . $headerTabColumnB, 'KADER'); $sheet->mergeCells('O'.$headerTabColumnB.':P'.$headerTabColumnD);
$sheet->setCellValue('O' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('P' . $headerTabColumnE, 'P'); 

$sheet->setCellValue('Q' . $headerTabColumnB, 'PLKB'); $sheet->mergeCells('Q'.$headerTabColumnB.':R'.$headerTabColumnD);
$sheet->setCellValue('Q' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('R' . $headerTabColumnE, 'P'); 

$sheet->setCellValue('S' . $headerTabColumnB, 'MEDIS DAN PARAMEDIS'); $sheet->mergeCells('S'.$headerTabColumnB.':T'.$headerTabColumnD);
$sheet->setCellValue('S' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('T' . $headerTabColumnE, 'P'); 

$sheet->setCellValue('U' . $headerTabColumnA, 'JUMLAH BAYI'); $sheet->mergeCells('U'.$headerTabColumnA.':X'.$headerTabColumnA); //
$sheet->setCellValue('U' . $headerTabColumnB, 'YANG LAHIR'); $sheet->mergeCells('U'.$headerTabColumnB.':V'.$headerTabColumnD);
$sheet->setCellValue('U' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('V' . $headerTabColumnE, 'P'); 

$sheet->setCellValue('W' . $headerTabColumnB, 'MENINGGAL'); $sheet->mergeCells('W'.$headerTabColumnB.':X'.$headerTabColumnD);
$sheet->setCellValue('W' . $headerTabColumnE, 'L'); 
$sheet->setCellValue('X' . $headerTabColumnE, 'P'); 

$sheet->setCellValue('Y' . $headerTabColumnA, 'KET'); $sheet->mergeCells('Y'.$headerTabColumnA.':Y'.$headerTabColumnE);


// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('Y')->setWidth(35);


for ($colsAlpha = 'C'; $colsAlpha !== 'W'; $colsAlpha++){

    $sheet->getColumnDimension($colsAlpha)->setWidth(12);

}

$noColmn = 1;
for ($colsAlpha = 'A'; $colsAlpha !== 'Z'; $colsAlpha++){

    $sheet->setCellValue($colsAlpha . $headerTabColumn2, (string)$noColmn);

    $noColmn++;
}

foreach ($report as $r => $row) {
  $bodyTabColumn2++;

  $sheet->setCellValue('A' . $bodyTabColumn2, (string)$row['no']);
  $sheet->setCellValue('B' . $bodyTabColumn2, $row['bulan']);
  $sheet->setCellValue('C' . $bodyTabColumn2, $row['byi_L_0_12bln_new']);
  $sheet->setCellValue('D' . $bodyTabColumn2, $row['byi_P_0_12bln_new']);
  $sheet->setCellValue('E' . $bodyTabColumn2, $row['byi_L_0_12bln_old']);
  $sheet->setCellValue('F' . $bodyTabColumn2, $row['byi_P_0_12bln_old']);

  $sheet->setCellValue('G' . $bodyTabColumn2, $row['blt_L_1_5thn_new']);
  $sheet->setCellValue('H' . $bodyTabColumn2, $row['blt_P_1_5thn_new']);
  $sheet->setCellValue('I' . $bodyTabColumn2, $row['blt_L_1_5thn_old']);
  $sheet->setCellValue('J' . $bodyTabColumn2, $row['blt_P_1_5thn_old']);

  $sheet->setCellValue('K' . $bodyTabColumn2, $row['wus']);
  $sheet->setCellValue('L' . $bodyTabColumn2, $row['pus']);
  $sheet->setCellValue('M' . $bodyTabColumn2, $row['ibu_hamil']);
  $sheet->setCellValue('N' . $bodyTabColumn2, $row['ibu_menyusui']);

  $sheet->setCellValue('O' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('P' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('Q' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('R' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('S' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('T' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('U' . $bodyTabColumn2, $row['bayi_lahir_L']);
  $sheet->setCellValue('V' . $bodyTabColumn2, $row['bayi_lahir_P']);
  $sheet->setCellValue('W' . $bodyTabColumn2, $row['bayi_meninggal_L']);
  $sheet->setCellValue('X' . $bodyTabColumn2, $row['bayi_meninggal_P']);
  $sheet->setCellValue('Y' . $bodyTabColumn2, '      ');
}
$footerTabColumn1 = $bodyTabColumn2 + 1;


//Merge Cell
$sheet->mergeCells('A'.$headerCop1Column1.':Y' .$headerCop1Column1);
$sheet->mergeCells('A'.$headerCop2Column1.':Y' .$headerCop2Column1);


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
$sheet->getStyle('A'.$headerTabColumnA.':Y'.$headerTabColumnE)->applyFromArray(
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

$sheet->getStyle('A'.$headerTabColumn2.':Y'.$headerTabColumn2)->applyFromArray(
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
for ($colsAlpha = 'A'; $colsAlpha !== 'Z'; $colsAlpha++){

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



