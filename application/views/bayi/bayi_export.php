<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Bayi Posyandu ".$filterBulan." ".$filterTahun.".xls");
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
$sheet->setCellValue('A' . $headerCop2Column1, 'LAPORAN FORMAT 2 - REGISTER BAYI DALAM WILAYAH KERJA POSYANDU');

// Isi
$sheet->setCellValue('A' . $headerTabColumnA, 'NO'); $sheet->mergeCells('A'.$headerTabColumnA.':A'.$headerTabColumnC);
$sheet->setCellValue('B' . $headerTabColumnA, 'NO KMS'); $sheet->mergeCells('B'.$headerTabColumnA.':B'.$headerTabColumnC);
$sheet->setCellValue('C' . $headerTabColumnA, 'NAMA BAYI'); $sheet->mergeCells('C'.$headerTabColumnA.':C'.$headerTabColumnC);
$sheet->setCellValue('D' . $headerTabColumnA, 'L/P'); $sheet->mergeCells('D'.$headerTabColumnA.':D'.$headerTabColumnC);
$sheet->setCellValue('E' . $headerTabColumnA, 'TANGGAL LAHIR'); $sheet->mergeCells('E'.$headerTabColumnA.':E'.$headerTabColumnC);
$sheet->setCellValue('F' . $headerTabColumnA, 'BBL'); $sheet->mergeCells('F'.$headerTabColumnA.':F'.$headerTabColumnC);

$sheet->setCellValue('G' . $headerTabColumnA, 'NAMA'); $sheet->mergeCells('G4:H4');
$sheet->setCellValue('G' . $headerTabColumnB, 'AYAH'); $sheet->mergeCells('G'.$headerTabColumnB.':G'.$headerTabColumnC);
$sheet->setCellValue('H' . $headerTabColumnB, 'IBU'); $sheet->mergeCells('H'.$headerTabColumnB.':H'.$headerTabColumnC);

$sheet->setCellValue('I' . $headerTabColumnA, 'KEL. DAWIS'); $sheet->mergeCells('I'.$headerTabColumnA.':I'.$headerTabColumnC);

$sheet->setCellValue('J' . $headerTabColumnA, 'HASIL PENIMBANGAN'); $sheet->mergeCells('J4:U4');
$sheet->setCellValue('J' . $headerTabColumnB, 'JAN'); $sheet->mergeCells('J'.$headerTabColumnB.':J'.$headerTabColumnC);
$sheet->setCellValue('K' . $headerTabColumnB, 'FEB'); $sheet->mergeCells('K'.$headerTabColumnB.':K'.$headerTabColumnC);
$sheet->setCellValue('L' . $headerTabColumnB, 'MAR'); $sheet->mergeCells('L'.$headerTabColumnB.':L'.$headerTabColumnC);
$sheet->setCellValue('M' . $headerTabColumnB, 'APR'); $sheet->mergeCells('M'.$headerTabColumnB.':M'.$headerTabColumnC);
$sheet->setCellValue('N' . $headerTabColumnB, 'MEI'); $sheet->mergeCells('N'.$headerTabColumnB.':N'.$headerTabColumnC);
$sheet->setCellValue('O' . $headerTabColumnB, 'JUN'); $sheet->mergeCells('O'.$headerTabColumnB.':O'.$headerTabColumnC);
$sheet->setCellValue('P' . $headerTabColumnB, 'JUL'); $sheet->mergeCells('P'.$headerTabColumnB.':P'.$headerTabColumnC);
$sheet->setCellValue('Q' . $headerTabColumnB, 'AGUS'); $sheet->mergeCells('Q'.$headerTabColumnB.':Q'.$headerTabColumnC);
$sheet->setCellValue('R' . $headerTabColumnB, 'SEP'); $sheet->mergeCells('R'.$headerTabColumnB.':R'.$headerTabColumnC);
$sheet->setCellValue('S' . $headerTabColumnB, 'OKT'); $sheet->mergeCells('S'.$headerTabColumnB.':S'.$headerTabColumnC);
$sheet->setCellValue('T' . $headerTabColumnB, 'NOV'); $sheet->mergeCells('T'.$headerTabColumnB.':T'.$headerTabColumnC);
$sheet->setCellValue('U' . $headerTabColumnB, 'DES'); $sheet->mergeCells('U'.$headerTabColumnB.':U'.$headerTabColumnC);


$sheet->setCellValue('V' . $headerTabColumnA, 'PELAYANAN YANG DIBERIKAN'); $sheet->mergeCells('V4:AL4');


$sheet->setCellValue('V' . $headerTabColumnB, 'SIRUP BESI'); $sheet->mergeCells('V5:W5');
$sheet->setCellValue('V' . $headerTabColumnC, 'FE I BLN');
$sheet->setCellValue('W' . $headerTabColumnC, 'FE II BLN');

$sheet->setCellValue('X' . $headerTabColumnB, 'VIT A'); $sheet->mergeCells('X5:Y5');
$sheet->setCellValue('X' . $headerTabColumnC, 'I BLN');
$sheet->setCellValue('Y' . $headerTabColumnC, 'II BLN');

$sheet->setCellValue('Z' . $headerTabColumnB, 'ORALIT'); $sheet->mergeCells('Z'.$headerTabColumnB.':Z'.$headerTabColumnC);
$sheet->setCellValue('AA' . $headerTabColumnB, 'BCG'); $sheet->mergeCells('AA'.$headerTabColumnB.':AA'.$headerTabColumnC);

$sheet->setCellValue('AB' . $headerTabColumnB, 'DPT'); $sheet->mergeCells('AB5:AD5');
$sheet->setCellValue('AB' . $headerTabColumnC, 'I');
$sheet->setCellValue('AC' . $headerTabColumnC, 'II');
$sheet->setCellValue('AD' . $headerTabColumnC, 'III');

$sheet->setCellValue('AE' . $headerTabColumnB, 'POLIO'); $sheet->mergeCells('AE5:AH5');
$sheet->setCellValue('AE' . $headerTabColumnC, 'I');
$sheet->setCellValue('AF' . $headerTabColumnC, 'II');
$sheet->setCellValue('AG' . $headerTabColumnC, 'III');
$sheet->setCellValue('AH' . $headerTabColumnC, 'VI');

$sheet->setCellValue('AI' . $headerTabColumnB, 'CAMPAK'); $sheet->mergeCells('AI'.$headerTabColumnB.':AI'.$headerTabColumnC);

$sheet->setCellValue('AJ' . $headerTabColumnB, 'HEPATITIS'); $sheet->mergeCells('AJ5:AL5');
$sheet->setCellValue('AJ' . $headerTabColumnC, 'I');
$sheet->setCellValue('AK' . $headerTabColumnC, 'II');
$sheet->setCellValue('AL' . $headerTabColumnC, 'III');

$sheet->setCellValue('AM' . $headerTabColumnA, 'TGL MENINGGAL BAYI'); $sheet->mergeCells('AM'.$headerTabColumnA.':AM'.$headerTabColumnC);
$sheet->setCellValue('AN' . $headerTabColumnA, 'KET'); $sheet->mergeCells('AN'.$headerTabColumnA.':AN'.$headerTabColumnC);

// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('AN')->setWidth(35);


for ($colsAlpha = 'B'; $colsAlpha !== 'AM'; $colsAlpha++){

    $sheet->getColumnDimension($colsAlpha)->setAutoSize(true);

}

$noColmn = 1;
for ($colsAlpha = 'A'; $colsAlpha !== 'AO'; $colsAlpha++){

    $sheet->setCellValue($colsAlpha . $headerTabColumn2, (string)$noColmn);

    $noColmn++;
}


foreach ($report as $r => $row) {
  $bodyTabColumn2++;

  $sheet->setCellValue('A' . $bodyTabColumn2, (string)$row['no']);
  $sheet->setCellValue('B' . $bodyTabColumn2, $row['kms']);
  $sheet->setCellValue('C' . $bodyTabColumn2, $row['nama_bayi']);
  $sheet->setCellValue('D' . $bodyTabColumn2, $row['jk_bayi']);
  $sheet->setCellValue('E' . $bodyTabColumn2, $row['tgl_lahir_bayi']);
  $sheet->setCellValue('F' . $bodyTabColumn2, (empty($row['bbl'])) ? "-" : $row['bbl']);
  $sheet->setCellValue('G' . $bodyTabColumn2, $row['nama_bapak']);
  $sheet->setCellValue('H' . $bodyTabColumn2, $row['nama_ibu']);
  $sheet->setCellValue('I' . $bodyTabColumn2, (empty($row['kel_dawis'])) ? "-" : $row['kel_dawis']);
  $sheet->setCellValue('J' . $bodyTabColumn2, (empty((string)$row['r01_tinggi']) || (string)$row['r01_tinggi'] == '0.0' ? '  ' : (string)$row['r01_tinggi']) .'/'. (empty((string)$row['r01_berat']) || (string)$row['r01_berat'] == '0.0' ? '  ' : (string)$row['r01_berat'] ));
  $sheet->setCellValue('K' . $bodyTabColumn2, (empty((string)$row['r02_tinggi']) || (string)$row['r02_tinggi'] == '0.0' ? '  ' : (string)$row['r02_tinggi']) .'/'. (empty((string)$row['r02_berat']) || (string)$row['r02_berat'] == '0.0' ? '  ' : (string)$row['r02_berat'] ));
  $sheet->setCellValue('L' . $bodyTabColumn2, (empty((string)$row['r03_tinggi']) || (string)$row['r03_tinggi'] == '0.0' ? '  ' : (string)$row['r03_tinggi']) .'/'. (empty((string)$row['r03_berat']) || (string)$row['r03_berat'] == '0.0' ? '  ' : (string)$row['r03_berat'] ));
  $sheet->setCellValue('M' . $bodyTabColumn2, (empty((string)$row['r04_tinggi']) || (string)$row['r04_tinggi'] == '0.0' ? '  ' : (string)$row['r04_tinggi']) .'/'. (empty((string)$row['r04_berat']) || (string)$row['r04_berat'] == '0.0' ? '  ' : (string)$row['r04_berat'] ));
  $sheet->setCellValue('N' . $bodyTabColumn2, (empty((string)$row['r05_tinggi']) || (string)$row['r05_tinggi'] == '0.0' ? '  ' : (string)$row['r05_tinggi']) .'/'. (empty((string)$row['r05_berat']) || (string)$row['r05_berat'] == '0.0' ? '  ' : (string)$row['r05_berat'] ));
  $sheet->setCellValue('O' . $bodyTabColumn2, (empty((string)$row['r06_tinggi']) || (string)$row['r06_tinggi'] == '0.0' ? '  ' : (string)$row['r06_tinggi']) .'/'. (empty((string)$row['r06_berat']) || (string)$row['r06_berat'] == '0.0' ? '  ' : (string)$row['r06_berat'] ));
  $sheet->setCellValue('P' . $bodyTabColumn2, (empty((string)$row['r07_tinggi']) || (string)$row['r07_tinggi'] == '0.0' ? '  ' : (string)$row['r07_tinggi']) .'/'. (empty((string)$row['r07_berat']) || (string)$row['r07_berat'] == '0.0' ? '  ' : (string)$row['r07_berat'] ));
  $sheet->setCellValue('Q' . $bodyTabColumn2, (empty((string)$row['r08_tinggi']) || (string)$row['r08_tinggi'] == '0.0' ? '  ' : (string)$row['r08_tinggi']) .'/'. (empty((string)$row['r08_berat']) || (string)$row['r08_berat'] == '0.0' ? '  ' : (string)$row['r08_berat'] ));
  $sheet->setCellValue('R' . $bodyTabColumn2, (empty((string)$row['r09_tinggi']) || (string)$row['r09_tinggi'] == '0.0' ? '  ' : (string)$row['r09_tinggi']) .'/'. (empty((string)$row['r09_berat']) || (string)$row['r09_berat'] == '0.0' ? '  ' : (string)$row['r09_berat'] ));
  $sheet->setCellValue('S' . $bodyTabColumn2, (empty((string)$row['r10_tinggi']) || (string)$row['r10_tinggi'] == '0.0' ? '  ' : (string)$row['r10_tinggi']) .'/'. (empty((string)$row['r10_berat']) || (string)$row['r10_berat'] == '0.0' ? '  ' : (string)$row['r10_berat'] ));
  $sheet->setCellValue('T' . $bodyTabColumn2, (empty((string)$row['r11_tinggi']) || (string)$row['r11_tinggi'] == '0.0' ? '  ' : (string)$row['r11_tinggi']) .'/'. (empty((string)$row['r11_berat']) || (string)$row['r11_berat'] == '0.0' ? '  ' : (string)$row['r11_berat'] ));
  $sheet->setCellValue('U' . $bodyTabColumn2, (empty((string)$row['r12_tinggi']) || (string)$row['r12_tinggi'] == '0.0' ? '  ' : (string)$row['r12_tinggi']) .'/'. (empty((string)$row['r12_berat']) || (string)$row['r12_berat'] == '0.0' ? '  ' : (string)$row['r12_berat'] ));
  $sheet->setCellValue('V' . $bodyTabColumn2, (empty($row['pyd_syrp_besi_fe1'])) ? "-" : "V");
  $sheet->setCellValue('W' . $bodyTabColumn2, (empty($row['pyd_syrp_besi_fe2'])) ? "-" : "V");
  $sheet->setCellValue('X' . $bodyTabColumn2, (empty($row['pyd_vit_a_bln1'])) ? "-" : "V");
  $sheet->setCellValue('Y' . $bodyTabColumn2, (empty($row['pyd_vit_a_bln2'])) ? "-" : "V");
  $sheet->setCellValue('Z' . $bodyTabColumn2, (empty($row['pyd_oralit'])) ? "-" : "V");
  $sheet->setCellValue('AA' . $bodyTabColumn2, (empty($row['pyd_bcg'])) ? "-" : "V");
  $sheet->setCellValue('AB' . $bodyTabColumn2, (empty($row['pyd_dpt1'])) ? "-" : "V");
  $sheet->setCellValue('AC' . $bodyTabColumn2, (empty($row['pyd_dpt2'])) ? "-" : "V");
  $sheet->setCellValue('AD' . $bodyTabColumn2, (empty($row['pyd_dpt3'])) ? "-" : "V");
  $sheet->setCellValue('AE' . $bodyTabColumn2, (empty($row['pyd_polio1'])) ? "-" : "V");
  $sheet->setCellValue('AF' . $bodyTabColumn2, (empty($row['pyd_polio2'])) ? "-" : "V");
  $sheet->setCellValue('AG' . $bodyTabColumn2, (empty($row['pyd_polio3'])) ? "-" : "V");
  $sheet->setCellValue('AH' . $bodyTabColumn2, (empty($row['pyd_polio4'])) ? "-" : "V");
  $sheet->setCellValue('AI' . $bodyTabColumn2, (empty($row['pyd_campak'])) ? "-" : "V");
  $sheet->setCellValue('AJ' . $bodyTabColumn2, (empty($row['pyd_hepatitis1'])) ? "-" : "V");
  $sheet->setCellValue('AK' . $bodyTabColumn2, (empty($row['pyd_hepatitis2'])) ? "-" : "V");
  $sheet->setCellValue('AL' . $bodyTabColumn2, (empty($row['pyd_hepatitis3'])) ? "-" : "V");
  $sheet->setCellValue('AM' . $bodyTabColumn2, (empty($row['tgl_meninggal_bayi'])) ? "-" : $row['tgl_meninggal_bayi']);
  $sheet->setCellValue('AN' . $bodyTabColumn2, '');


}
$footerTabColumn1 = $bodyTabColumn2 + 1;

//footer
// $sheet->setCellValue('K' . $footerTabColumn1, 'TOTAL');
// $sheet->setCellValue('L' . $footerTabColumn1, '=SUM(L10:L' . $bodyTabColumn2 . ')');
// $sheet->setCellValue('M' . $footerTabColumn1, '=SUM(M10:M' . $bodyTabColumn2 . ')');

//Merge Cell
$sheet->mergeCells('A'.$headerCop1Column1.':AN' .$headerCop1Column1);
$sheet->mergeCells('A'.$headerCop2Column1.':AN' .$headerCop2Column1);

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
$sheet->getStyle('A'.$headerTabColumnA.':AN'.$headerTabColumnC)->applyFromArray(
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

$sheet->getStyle('A'.$headerTabColumn2.':AN'.$headerTabColumn2)->applyFromArray(
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
for ($colsAlpha = 'A'; $colsAlpha !== 'AO'; $colsAlpha++){

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


// $sheet->getStyle('A'.$bodyTabColumn2Lock.':A' . $bodyTabColumn2)->applyFromArray(
//   [

//     'alignment' => [
//       'horizontal' => Alignment::HORIZONTAL_CENTER,
//       'vertical' => Alignment::VERTICAL_CENTER,
//       'wrapText' => true,
//     ],
//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('B'.$bodyTabColumn2Lock.':B' . $bodyTabColumn2)->applyFromArray(
//   [

//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('C'.$bodyTabColumn2Lock.':C' . $bodyTabColumn2)->applyFromArray(
//   [

//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('D'.$bodyTabColumn2Lock.':D' . $bodyTabColumn2)->applyFromArray(
//   [

//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('E'.$bodyTabColumn2Lock.':E' . $bodyTabColumn2)->applyFromArray(
//   [

//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('F'.$bodyTabColumn2Lock.':F' . $bodyTabColumn2)->applyFromArray(
//   [

//     'alignment' => [
//       'horizontal' => Alignment::HORIZONTAL_CENTER,
//       'vertical' => Alignment::VERTICAL_CENTER,
//       'wrapText' => true,
//     ],
//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('G'.$bodyTabColumn2Lock.':G' . $bodyTabColumn2)->applyFromArray(
//   [

//     'alignment' => [
//       'horizontal' => Alignment::HORIZONTAL_CENTER,
//       'vertical' => Alignment::VERTICAL_CENTER,
//       'wrapText' => true,
//     ],
//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('H'.$bodyTabColumn2Lock.':H' . $bodyTabColumn2)->applyFromArray(
//   [

//     'alignment' => [
//       'horizontal' => Alignment::HORIZONTAL_CENTER,
//       'vertical' => Alignment::VERTICAL_CENTER,
//       'wrapText' => true,
//     ],
//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('I'.$bodyTabColumn2Lock.':I' . $bodyTabColumn2)->applyFromArray(
//   [

//     'alignment' => [
//       'horizontal' => Alignment::HORIZONTAL_CENTER,
//       'vertical' => Alignment::VERTICAL_CENTER,
//       'wrapText' => true,
//     ],
//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('J'.$bodyTabColumn2Lock.':J' . $bodyTabColumn2)->applyFromArray(
//   [

//     'alignment' => [
//       'horizontal' => Alignment::HORIZONTAL_CENTER,
//       'vertical' => Alignment::VERTICAL_CENTER,
//       'wrapText' => true,
//     ],
//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );

// footer
// $sheet->getStyle('K' . $bodyTabColumn2Lock)->applyFromArray(
//   [

//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('L' . $bodyTabColumn2Lock)->applyFromArray(
//   [

//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// $sheet->getStyle('M' . $bodyTabColumn2Lock)->applyFromArray(
//   [

//     'borders' => [
//       'outline' => [
//         'borderStyle' => Border::BORDER_THIN,
//         'color' => [
//           'argb' => 'FF000000'
//         ],
//       ],
//     ],
//   ]
// );
// H, J, K, L, M
// $sheet->getStyle('L' . $bodyTabColumn2Lock)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('A5A5A5');
// $sheet->getStyle('H10:H' . $bodyTabColumn2)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('J10:J' . $bodyTabColumn2)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('K10:K' . $bodyTabColumn2)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('L10:L' . $bodyTabColumn2)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('M10:M' . $bodyTabColumn2)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('L10:L' . $bodyTabColumn2Lock)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('K10:K' . $bodyTabColumn2Lock)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('M10:M' . $bodyTabColumn2Lock)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);



ob_end_clean();
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
