<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Bumil Posyandu ".$filterBulan." ".$filterTahun.".xls");
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

$headerTabColumn1 = 4;
$headerTabColumn2 = 5;

$headerTabColumn3 = 5;

$bodyTabColumn2 = 5;
$bodyTabColumn2Lock = 6;

// Pembuka
$sheet->setCellValue('A' . $headerCop1Column1, 'SISTEM INFORMASI POSYANDU SINDANG '.( !empty($desa_name) ? "DESA ".strtoupper($desa_name) : "" ) . ( !empty($pos_name) ? " POSYANDU ".strtoupper($pos_name) : "SEMUA POSYANDU" ).' BULAN '.strtoupper($filterBulan).' TAHUN '.$filterTahun);
$sheet->setCellValue('A' . $headerCop2Column1, 'LAPORAN FORMAT 1 - CATATAN IBU HAMIL, KELAHIRAN, KEMATIAN BAYI, DAN KEMATIAN IBU HAMIL, MELAHIRKAN / NIFAS');

// Isi
$sheet->setCellValue('A' . $headerTabColumn1, 'NO');
$sheet->setCellValue('B' . $headerTabColumn1, 'NO KMS');
$sheet->setCellValue('C' . $headerTabColumn1, 'NAMA IBU');
$sheet->setCellValue('D' . $headerTabColumn1, 'NAMA BAPAK');
$sheet->setCellValue('E' . $headerTabColumn1, 'NAMA BAYI');
$sheet->setCellValue('F' . $headerTabColumn1, 'L/P BAYI');
$sheet->setCellValue('G' . $headerTabColumn1, 'TGL LAHIR BAYI');
$sheet->setCellValue('H' . $headerTabColumn1, 'TGL MENINGGAL BAYI');
$sheet->setCellValue('I' . $headerTabColumn1, 'TGL MENINGGAL IBU');
$sheet->setCellValue('J' . $headerTabColumn1, 'BERESIKO(?)');

// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setAutoSize(true);

$sheet->setCellValue('A' . $headerTabColumn2, '1');
$sheet->setCellValue('B' . $headerTabColumn2, '2');
$sheet->setCellValue('C' . $headerTabColumn2, '3');
$sheet->setCellValue('D' . $headerTabColumn2, '4');
$sheet->setCellValue('E' . $headerTabColumn2, '5');
$sheet->setCellValue('F' . $headerTabColumn2, '6');
$sheet->setCellValue('G' . $headerTabColumn2, '7');
$sheet->setCellValue('H' . $headerTabColumn2, '8');
$sheet->setCellValue('I' . $headerTabColumn2, '9');
$sheet->setCellValue('J' . $headerTabColumn2, '10');


foreach ($report as $r => $row) {
  $bodyTabColumn2++;

  $sheet->setCellValue('A' . $bodyTabColumn2, (string)$row['no']);
  $sheet->setCellValue('B' . $bodyTabColumn2, $row['nik']);
  $sheet->setCellValue('C' . $bodyTabColumn2, $row['nama_ibu']);
  $sheet->setCellValue('D' . $bodyTabColumn2, $row['nama_bapak']);
  $sheet->setCellValue('E' . $bodyTabColumn2, $row['nama_bayi']);
  $sheet->setCellValue('F' . $bodyTabColumn2, (empty($row['jk_bayi'])) ? "-" : $row['jk_bayi']);
  $sheet->setCellValue('G' . $bodyTabColumn2, (empty($row['tgl_lahir_bayi']) ? "-" : $row['tgl_lahir_bayi'] ));
  $sheet->setCellValue('H' . $bodyTabColumn2, (empty($row['tgl_meninggal_bayi']) ? "-" : $row['tgl_meninggal_bayi']));
  $sheet->setCellValue('I' . $bodyTabColumn2, (empty($row['tgl_meninggal_ibu']) ? "-" : $row['tgl_meninggal_ibu']));
  $sheet->setCellValue('J' . $bodyTabColumn2, (empty($row['is_risk']) ? "TIDAK BERESIKO" : "BERESIKO"));


}
$footerTabColumn1 = $bodyTabColumn2 + 1;

//footer
// $sheet->setCellValue('K' . $footerTabColumn1, 'TOTAL');
// $sheet->setCellValue('L' . $footerTabColumn1, '=SUM(L10:L' . $bodyTabColumn2 . ')');
// $sheet->setCellValue('M' . $footerTabColumn1, '=SUM(M10:M' . $bodyTabColumn2 . ')');

//Merge Cell
$sheet->mergeCells('A'.$headerCop1Column1.':J' .$headerCop1Column1);
$sheet->mergeCells('A'.$headerCop2Column1.':J' .$headerCop2Column1);

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
$sheet->getStyle('A'.$headerTabColumn1.':J'.$headerTabColumn1)->applyFromArray(
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

$sheet->getStyle('A'.$headerTabColumn2.':J'.$headerTabColumn2)->applyFromArray(
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
$sheet->getStyle('A'.$bodyTabColumn2Lock.':A' . $bodyTabColumn2)->applyFromArray(
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
$sheet->getStyle('B'.$bodyTabColumn2Lock.':B' . $bodyTabColumn2)->applyFromArray(
  [

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
$sheet->getStyle('C'.$bodyTabColumn2Lock.':C' . $bodyTabColumn2)->applyFromArray(
  [

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
$sheet->getStyle('D'.$bodyTabColumn2Lock.':D' . $bodyTabColumn2)->applyFromArray(
  [

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
$sheet->getStyle('E'.$bodyTabColumn2Lock.':E' . $bodyTabColumn2)->applyFromArray(
  [

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
$sheet->getStyle('F'.$bodyTabColumn2Lock.':F' . $bodyTabColumn2)->applyFromArray(
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
$sheet->getStyle('G'.$bodyTabColumn2Lock.':G' . $bodyTabColumn2)->applyFromArray(
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
$sheet->getStyle('H'.$bodyTabColumn2Lock.':H' . $bodyTabColumn2)->applyFromArray(
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
$sheet->getStyle('I'.$bodyTabColumn2Lock.':I' . $bodyTabColumn2)->applyFromArray(
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
$sheet->getStyle('J'.$bodyTabColumn2Lock.':J' . $bodyTabColumn2)->applyFromArray(
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
