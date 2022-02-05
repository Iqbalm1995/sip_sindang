<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Balita Posyandu ".$filterBulan." ".$filterTahun.".xls");
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
$sheet->setCellValue('A' . $headerCop2Column1, 'LAPORAN FORMAT 2 - REGISTER BALITA DALAM WILAYAH KERJA POSYANDU');

// Isi
$sheet->setCellValue('A' . $headerTabColumnA, 'NO'); $sheet->mergeCells('A'.$headerTabColumnA.':A'.$headerTabColumnC);
$sheet->setCellValue('B' . $headerTabColumnA, 'NO KMS'); $sheet->mergeCells('B'.$headerTabColumnA.':B'.$headerTabColumnC);
$sheet->setCellValue('C' . $headerTabColumnA, 'NAMA ANAK'); $sheet->mergeCells('C'.$headerTabColumnA.':C'.$headerTabColumnC);
$sheet->setCellValue('D' . $headerTabColumnA, 'L/P'); $sheet->mergeCells('D'.$headerTabColumnA.':D'.$headerTabColumnC);
$sheet->setCellValue('E' . $headerTabColumnA, 'TANGGAL LAHIR'); $sheet->mergeCells('E'.$headerTabColumnA.':E'.$headerTabColumnC);

$sheet->setCellValue('F' . $headerTabColumnA, 'NAMA'); $sheet->mergeCells('F4:G4');
$sheet->setCellValue('F' . $headerTabColumnB, 'AYAH'); $sheet->mergeCells('F'.$headerTabColumnB.':F'.$headerTabColumnC);
$sheet->setCellValue('G' . $headerTabColumnB, 'IBU'); $sheet->mergeCells('G'.$headerTabColumnB.':G'.$headerTabColumnC);

$sheet->setCellValue('H' . $headerTabColumnA, 'KEL. DAWIS'); $sheet->mergeCells('H'.$headerTabColumnA.':H'.$headerTabColumnC);

$sheet->setCellValue('I' . $headerTabColumnA, 'HASIL PENIMBANGAN'); $sheet->mergeCells('I4:T4');
$sheet->setCellValue('I' . $headerTabColumnB, 'JAN'); $sheet->mergeCells('I'.$headerTabColumnB.':I'.$headerTabColumnC);
$sheet->setCellValue('J' . $headerTabColumnB, 'FEB'); $sheet->mergeCells('J'.$headerTabColumnB.':J'.$headerTabColumnC);
$sheet->setCellValue('K' . $headerTabColumnB, 'MAR'); $sheet->mergeCells('K'.$headerTabColumnB.':K'.$headerTabColumnC);
$sheet->setCellValue('L' . $headerTabColumnB, 'APR'); $sheet->mergeCells('L'.$headerTabColumnB.':L'.$headerTabColumnC);
$sheet->setCellValue('M' . $headerTabColumnB, 'MEI'); $sheet->mergeCells('M'.$headerTabColumnB.':M'.$headerTabColumnC);
$sheet->setCellValue('N' . $headerTabColumnB, 'JUN'); $sheet->mergeCells('N'.$headerTabColumnB.':N'.$headerTabColumnC);
$sheet->setCellValue('O' . $headerTabColumnB, 'JUL'); $sheet->mergeCells('O'.$headerTabColumnB.':O'.$headerTabColumnC);
$sheet->setCellValue('P' . $headerTabColumnB, 'AGUS'); $sheet->mergeCells('P'.$headerTabColumnB.':P'.$headerTabColumnC);
$sheet->setCellValue('Q' . $headerTabColumnB, 'SEP'); $sheet->mergeCells('Q'.$headerTabColumnB.':Q'.$headerTabColumnC);
$sheet->setCellValue('R' . $headerTabColumnB, 'OKT'); $sheet->mergeCells('R'.$headerTabColumnB.':R'.$headerTabColumnC);
$sheet->setCellValue('S' . $headerTabColumnB, 'NOV'); $sheet->mergeCells('S'.$headerTabColumnB.':S'.$headerTabColumnC);
$sheet->setCellValue('T' . $headerTabColumnB, 'DES'); $sheet->mergeCells('T'.$headerTabColumnB.':T'.$headerTabColumnC);


$sheet->setCellValue('U' . $headerTabColumnA, 'PELAYANAN YANG DIBERIKAN'); $sheet->mergeCells('U4:Z4');

$sheet->setCellValue('U' . $headerTabColumnB, 'SIRUP BESI'); $sheet->mergeCells('U5:V5');
$sheet->setCellValue('U' . $headerTabColumnC, 'FE I BLN');
$sheet->setCellValue('V' . $headerTabColumnC, 'FE II BLN');

$sheet->setCellValue('W' . $headerTabColumnB, 'VIT A'); $sheet->mergeCells('W5:X5');
$sheet->setCellValue('W' . $headerTabColumnC, 'I BLN');
$sheet->setCellValue('X' . $headerTabColumnC, 'II BLN');

$sheet->setCellValue('Y' . $headerTabColumnB, 'PMT PEMULIHAN'); $sheet->mergeCells('Y'.$headerTabColumnB.':Y'.$headerTabColumnC);
$sheet->setCellValue('Z' . $headerTabColumnB, 'ORALIT'); $sheet->mergeCells('Z'.$headerTabColumnB.':Z'.$headerTabColumnC);

$sheet->setCellValue('AA' . $headerTabColumnA, 'KET'); $sheet->mergeCells('AA'.$headerTabColumnA.':AA'.$headerTabColumnC);


// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('AA')->setWidth(35);


for ($colsAlpha = 'B'; $colsAlpha !== 'Z'; $colsAlpha++){

    $sheet->getColumnDimension($colsAlpha)->setAutoSize(true);

}

$noColmn = 1;
for ($colsAlpha = 'A'; $colsAlpha !== 'AB'; $colsAlpha++){

    $sheet->setCellValue($colsAlpha . $headerTabColumn2, (string)$noColmn);

    $noColmn++;
}

foreach ($report as $r => $row) {
  $bodyTabColumn2++;

  $sheet->setCellValue('A' . $bodyTabColumn2, (string)$row['no']);
  $sheet->setCellValue('B' . $bodyTabColumn2, $row['kms']);
  $sheet->setCellValue('C' . $bodyTabColumn2, $row['nama_anak']);
  $sheet->setCellValue('D' . $bodyTabColumn2, $row['jk_anak']);
  $sheet->setCellValue('E' . $bodyTabColumn2, $row['tgl_lahir_anak']);
  $sheet->setCellValue('F' . $bodyTabColumn2, $row['nama_bapak']);
  $sheet->setCellValue('G' . $bodyTabColumn2, $row['nama_ibu']);
  $sheet->setCellValue('H' . $bodyTabColumn2, (empty($row['kel_dawis'])) ? "-" : $row['kel_dawis']);

  $sheet->setCellValue('I' . $bodyTabColumn2, (empty((string)$row['r01_tinggi']) || (string)$row['r01_tinggi'] == '0.0' ? '  ' : (string)$row['r01_tinggi']) .'/'. (empty((string)$row['r01_berat']) || (string)$row['r01_berat'] == '0.0' ? '  ' : (string)$row['r01_berat'] ));
  $sheet->setCellValue('J' . $bodyTabColumn2, (empty((string)$row['r02_tinggi']) || (string)$row['r02_tinggi'] == '0.0' ? '  ' : (string)$row['r02_tinggi']) .'/'. (empty((string)$row['r02_berat']) || (string)$row['r02_berat'] == '0.0' ? '  ' : (string)$row['r02_berat'] ));
  $sheet->setCellValue('K' . $bodyTabColumn2, (empty((string)$row['r03_tinggi']) || (string)$row['r03_tinggi'] == '0.0' ? '  ' : (string)$row['r03_tinggi']) .'/'. (empty((string)$row['r03_berat']) || (string)$row['r03_berat'] == '0.0' ? '  ' : (string)$row['r03_berat'] ));
  $sheet->setCellValue('L' . $bodyTabColumn2, (empty((string)$row['r04_tinggi']) || (string)$row['r04_tinggi'] == '0.0' ? '  ' : (string)$row['r04_tinggi']) .'/'. (empty((string)$row['r04_berat']) || (string)$row['r04_berat'] == '0.0' ? '  ' : (string)$row['r04_berat'] ));
  $sheet->setCellValue('M' . $bodyTabColumn2, (empty((string)$row['r05_tinggi']) || (string)$row['r05_tinggi'] == '0.0' ? '  ' : (string)$row['r05_tinggi']) .'/'. (empty((string)$row['r05_berat']) || (string)$row['r05_berat'] == '0.0' ? '  ' : (string)$row['r05_berat'] ));
  $sheet->setCellValue('N' . $bodyTabColumn2, (empty((string)$row['r06_tinggi']) || (string)$row['r06_tinggi'] == '0.0' ? '  ' : (string)$row['r06_tinggi']) .'/'. (empty((string)$row['r06_berat']) || (string)$row['r06_berat'] == '0.0' ? '  ' : (string)$row['r06_berat'] ));
  $sheet->setCellValue('O' . $bodyTabColumn2, (empty((string)$row['r07_tinggi']) || (string)$row['r07_tinggi'] == '0.0' ? '  ' : (string)$row['r07_tinggi']) .'/'. (empty((string)$row['r07_berat']) || (string)$row['r07_berat'] == '0.0' ? '  ' : (string)$row['r07_berat'] ));
  $sheet->setCellValue('P' . $bodyTabColumn2, (empty((string)$row['r08_tinggi']) || (string)$row['r08_tinggi'] == '0.0' ? '  ' : (string)$row['r08_tinggi']) .'/'. (empty((string)$row['r08_berat']) || (string)$row['r08_berat'] == '0.0' ? '  ' : (string)$row['r08_berat'] ));
  $sheet->setCellValue('Q' . $bodyTabColumn2, (empty((string)$row['r09_tinggi']) || (string)$row['r09_tinggi'] == '0.0' ? '  ' : (string)$row['r09_tinggi']) .'/'. (empty((string)$row['r09_berat']) || (string)$row['r09_berat'] == '0.0' ? '  ' : (string)$row['r09_berat'] ));
  $sheet->setCellValue('R' . $bodyTabColumn2, (empty((string)$row['r10_tinggi']) || (string)$row['r10_tinggi'] == '0.0' ? '  ' : (string)$row['r10_tinggi']) .'/'. (empty((string)$row['r10_berat']) || (string)$row['r10_berat'] == '0.0' ? '  ' : (string)$row['r10_berat'] ));
  $sheet->setCellValue('S' . $bodyTabColumn2, (empty((string)$row['r11_tinggi']) || (string)$row['r11_tinggi'] == '0.0' ? '  ' : (string)$row['r11_tinggi']) .'/'. (empty((string)$row['r11_berat']) || (string)$row['r11_berat'] == '0.0' ? '  ' : (string)$row['r11_berat'] ));
  $sheet->setCellValue('T' . $bodyTabColumn2, (empty((string)$row['r12_tinggi']) || (string)$row['r12_tinggi'] == '0.0' ? '  ' : (string)$row['r12_tinggi']) .'/'. (empty((string)$row['r12_berat']) || (string)$row['r12_berat'] == '0.0' ? '  ' : (string)$row['r12_berat'] ));
  $sheet->setCellValue('U' . $bodyTabColumn2, (empty($row['pyd_syrp_besi_fe1'])) ? "-" : "V");
  $sheet->setCellValue('V' . $bodyTabColumn2, (empty($row['pyd_syrp_besi_fe2'])) ? "-" : "V");
  $sheet->setCellValue('W' . $bodyTabColumn2, (empty($row['pyd_vit_a_bln1'])) ? "-" : "V");
  $sheet->setCellValue('X' . $bodyTabColumn2, (empty($row['pyd_vit_a_bln2'])) ? "-" : "V");
  $sheet->setCellValue('Y' . $bodyTabColumn2, (empty($row['pyd_pmt_pemulihan'])) ? "-" : "V");
  $sheet->setCellValue('Z' . $bodyTabColumn2, (empty($row['pyd_oralit'])) ? "-" : "V");
  $sheet->setCellValue('AA' . $bodyTabColumn2, '');
}
$footerTabColumn1 = $bodyTabColumn2 + 1;


//Merge Cell
$sheet->mergeCells('A'.$headerCop1Column1.':AA' .$headerCop1Column1);
$sheet->mergeCells('A'.$headerCop2Column1.':AA' .$headerCop2Column1);


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
$sheet->getStyle('A'.$headerTabColumnA.':AA'.$headerTabColumnC)->applyFromArray(
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

$sheet->getStyle('A'.$headerTabColumn2.':AA'.$headerTabColumn2)->applyFromArray(
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
for ($colsAlpha = 'A'; $colsAlpha !== 'AB'; $colsAlpha++){

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



