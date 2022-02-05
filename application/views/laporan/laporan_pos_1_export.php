<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Format 6 Posyandu Tahun ".$filterTahun.".xls");
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
$sheet->setCellValue('A' . $headerCop2Column1, 'LAPORAN FORMAT 6 - JUMLAH PENGUNJUNG/JUMLAH PETUGAS POSYANDU/JUMLAH BAYI LAHIR/MENINGGAL');

// Isi
$sheet->setCellValue('A' . $headerTabColumnA, 'NO'); $sheet->mergeCells('A'.$headerTabColumnA.':A'.$headerTabColumnD);
$sheet->setCellValue('B' . $headerTabColumnA, 'BULAN'); $sheet->mergeCells('B'.$headerTabColumnA.':B'.$headerTabColumnD);

$sheet->setCellValue('C' . $headerTabColumnA, 'JUMLAH PENGUNJUNG'); $sheet->mergeCells('C'.$headerTabColumnA.':J'.$headerTabColumnA);
$sheet->setCellValue('C' . $headerTabColumnB, 'BALITA'); $sheet->mergeCells('C'.$headerTabColumnB.':F'.$headerTabColumnB);

$sheet->setCellValue('C' . $headerTabColumnC, '0-12 BULAN'); $sheet->mergeCells('C'.$headerTabColumnC.':D'.$headerTabColumnC);
$sheet->setCellValue('C' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('D' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('E' . $headerTabColumnC, '1-5 TAHUN'); $sheet->mergeCells('E'.$headerTabColumnC.':F'.$headerTabColumnC);
$sheet->setCellValue('E' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('F' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('G' . $headerTabColumnB, 'WUS'); $sheet->mergeCells('G'.$headerTabColumnB.':G'.$headerTabColumnD);

$sheet->setCellValue('H' . $headerTabColumnB, 'IBU'); $sheet->mergeCells('H'.$headerTabColumnB.':J'.$headerTabColumnB);
$sheet->setCellValue('H' . $headerTabColumnC, 'PUS'); $sheet->mergeCells('H'.$headerTabColumnC.':H'.$headerTabColumnD);
$sheet->setCellValue('I' . $headerTabColumnC, 'HAMIL'); $sheet->mergeCells('I'.$headerTabColumnC.':I'.$headerTabColumnD);
$sheet->setCellValue('J' . $headerTabColumnC, 'MENYUSUI'); $sheet->mergeCells('J'.$headerTabColumnC.':J'.$headerTabColumnD);

$sheet->setCellValue('K' . $headerTabColumnA, 'JUMLAH PETUGAS YANG HADIR'); $sheet->mergeCells('K'.$headerTabColumnA.':P'.$headerTabColumnA);
$sheet->setCellValue('K' . $headerTabColumnB, 'KADER'); $sheet->mergeCells('K'.$headerTabColumnB.':L'.$headerTabColumnC);
$sheet->setCellValue('K' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('L' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('M' . $headerTabColumnB, 'PLKB'); $sheet->mergeCells('M'.$headerTabColumnB.':N'.$headerTabColumnC);
$sheet->setCellValue('M' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('N' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('O' . $headerTabColumnB, 'MEDIS DAN PARAMEDIS'); $sheet->mergeCells('O'.$headerTabColumnB.':P'.$headerTabColumnC);
$sheet->setCellValue('O' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('P' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('Q' . $headerTabColumnA, 'JUMLAH BAYI'); $sheet->mergeCells('Q'.$headerTabColumnA.':T'.$headerTabColumnA);
$sheet->setCellValue('Q' . $headerTabColumnB, 'YANG LAHIR'); $sheet->mergeCells('Q'.$headerTabColumnB.':R'.$headerTabColumnC);
$sheet->setCellValue('Q' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('R' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('S' . $headerTabColumnB, 'MENINGGAL'); $sheet->mergeCells('S'.$headerTabColumnB.':T'.$headerTabColumnC);
$sheet->setCellValue('S' . $headerTabColumnD, 'L'); 
$sheet->setCellValue('T' . $headerTabColumnD, 'P'); 

$sheet->setCellValue('U' . $headerTabColumnA, 'KET'); $sheet->mergeCells('U'.$headerTabColumnA.':U'.$headerTabColumnD);


// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('U')->setWidth(35);


for ($colsAlpha = 'C'; $colsAlpha !== 'S'; $colsAlpha++){

    $sheet->getColumnDimension($colsAlpha)->setWidth(15);

}

$noColmn = 1;
for ($colsAlpha = 'A'; $colsAlpha !== 'V'; $colsAlpha++){

    $sheet->setCellValue($colsAlpha . $headerTabColumn2, (string)$noColmn);

    $noColmn++;
}

foreach ($report as $r => $row) {
  $bodyTabColumn2++;

  $sheet->setCellValue('A' . $bodyTabColumn2, (string)$row['no']);
  $sheet->setCellValue('B' . $bodyTabColumn2, $row['bulan']);
  $sheet->setCellValue('C' . $bodyTabColumn2, $row['blt_L_0_12bln']);
  $sheet->setCellValue('D' . $bodyTabColumn2, $row['blt_P_0_12bln']);
  $sheet->setCellValue('E' . $bodyTabColumn2, $row['blt_L_1_5thn']);
  $sheet->setCellValue('F' . $bodyTabColumn2, $row['blt_P_1_5thn']);
  $sheet->setCellValue('G' . $bodyTabColumn2, $row['wus']);
  $sheet->setCellValue('H' . $bodyTabColumn2, $row['pus']);
  $sheet->setCellValue('I' . $bodyTabColumn2, $row['ibu_hamil']);
  $sheet->setCellValue('J' . $bodyTabColumn2, $row['ibu_menyusui']);
  $sheet->setCellValue('K' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('L' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('M' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('N' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('O' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('P' . $bodyTabColumn2, '      ');
  $sheet->setCellValue('Q' . $bodyTabColumn2, $row['bayi_lahir_L']);
  $sheet->setCellValue('R' . $bodyTabColumn2, $row['bayi_lahir_P']);
  $sheet->setCellValue('S' . $bodyTabColumn2, $row['bayi_meninggal_L']);
  $sheet->setCellValue('T' . $bodyTabColumn2, $row['bayi_meninggal_P']);
  $sheet->setCellValue('U' . $bodyTabColumn2, '      ');
}
$footerTabColumn1 = $bodyTabColumn2 + 1;


//Merge Cell
$sheet->mergeCells('A'.$headerCop1Column1.':U' .$headerCop1Column1);
$sheet->mergeCells('A'.$headerCop2Column1.':U' .$headerCop2Column1);


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
$sheet->getStyle('A'.$headerTabColumnA.':U'.$headerTabColumnD)->applyFromArray(
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

$sheet->getStyle('A'.$headerTabColumn2.':U'.$headerTabColumn2)->applyFromArray(
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
for ($colsAlpha = 'A'; $colsAlpha !== 'V'; $colsAlpha++){

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



