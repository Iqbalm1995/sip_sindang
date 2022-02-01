<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Bumil Posyandu.xls");
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

// Pembuka
$sheet->setCellValue('A1', "POGRAM POSYANDU SINDANG");
$sheet->setCellValue('A2', 'LAPORAN DATA BUMIL POSYANDU');
$sheet->setCellValue('A5', 'FILTERED BY');
$sheet->setCellValue('B5', ( !empty($pos_name) ? strtoupper($pos_name) : "Semua Posyandu" ));
$sheet->setCellValue('A6', 'START DATE');
$sheet->setCellValue('B6', "-Date here-");
$sheet->setCellValue('A7', 'END DATE');
$sheet->setCellValue('B7', "-Date here-");

// Isi
$sheet->setCellValue('A9', 'NO');
$sheet->setCellValue('B9', 'NO KMS');
$sheet->setCellValue('C9', 'NAMA IBU');
$sheet->setCellValue('D9', 'NAMA BAPAK');
$sheet->setCellValue('E9', 'NAMA BAYI');
$sheet->setCellValue('F9', 'JENIS KELAMIN BAYI');
$sheet->setCellValue('G9', 'TGL LAHIR BAYI');
$sheet->setCellValue('H9', 'TGL MENINGGAL BAYI');
$sheet->setCellValue('I9', 'TGL MENINGGAL IBU');

$sheet->setCellValue('A10', '1');
$sheet->setCellValue('B10', '2');
$sheet->setCellValue('C10', '3');
$sheet->setCellValue('D10', '4');
$sheet->setCellValue('E10', '5');
$sheet->setCellValue('F10', '6');
$sheet->setCellValue('G10', '7');
$sheet->setCellValue('H10', '8');
$sheet->setCellValue('I10', '9');

$no = 1;
$number = 1;
$column = 10;
$column1 = 10;


foreach ($report as $r => $row) {

  $column1++;
  $sheet->setCellValue('A' . $column1, (string)$row['no']);
  $sheet->setCellValue('B' . $column1, $row['nik']);
  $sheet->setCellValue('C' . $column1, $row['nama_ibu']);
  $sheet->setCellValue('D' . $column1, $row['nama_bapak']);
  $sheet->setCellValue('E' . $column1, $row['nama_bayi']);
  $sheet->setCellValue('F' . $column1, (empty($row['jk_bayi'])) ? "-" : $row['jk_bayi']);
  $sheet->setCellValue('G' . $column1, (empty($row['tgl_lahir_bayi']) ? "-" : $row['tgl_lahir_bayi'] ));
  $sheet->setCellValue('H' . $column1, (empty($row['tgl_meninggal_bayi']) ? "-" : $row['tgl_meninggal_bayi']));
  $sheet->setCellValue('I' . $column1, (empty($row['tgl_meninggal_ibu']) ? "-" : $row['tgl_meninggal_ibu']));


}
$column_total = $column1 + 1;

//footer
// $sheet->setCellValue('K' . $column_total, 'TOTAL');
// $sheet->setCellValue('L' . $column_total, '=SUM(L10:L' . $column1 . ')');
// $sheet->setCellValue('M' . $column_total, '=SUM(M10:M' . $column1 . ')');

//Merge Cell
$sheet->mergeCells('A1:M1');
$sheet->mergeCells('A2:M2');

// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('B')->setWidth(30);
$sheet->getColumnDimension('C')->setWidth(35);
$sheet->getColumnDimension('D')->setWidth(35);
$sheet->getColumnDimension('E')->setWidth(35);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(23);
$sheet->getColumnDimension('H')->setWidth(23);
$sheet->getColumnDimension('I')->setWidth(23);

// Mengubah style header file

$sheet->getStyle('A1')->applyFromArray(
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
$sheet->getStyle('A2')->applyFromArray(
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

$sheet->getStyle('A9:I9')->applyFromArray(
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

$sheet->getStyle('A10:I10')->applyFromArray(
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

//keterangan filter by outlet, tanggal
$sheet->getStyle('A5:A7')->applyFromArray(
  [
    'font' => [
      'bold' => true,
    ],
  ]
);


//border
$sheet->getStyle('A11:A' . $column1)->applyFromArray(
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
$sheet->getStyle('B11:B' . $column1)->applyFromArray(
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
$sheet->getStyle('C11:C' . $column1)->applyFromArray(
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
$sheet->getStyle('D11:D' . $column1)->applyFromArray(
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
$sheet->getStyle('E11:E' . $column1)->applyFromArray(
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
$sheet->getStyle('F11:F' . $column1)->applyFromArray(
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
$sheet->getStyle('G11:G' . $column1)->applyFromArray(
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
$sheet->getStyle('H11:H' . $column1)->applyFromArray(
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
$sheet->getStyle('I11:I' . $column1)->applyFromArray(
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

// footer
// $sheet->getStyle('K' . $column_total)->applyFromArray(
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
// $sheet->getStyle('L' . $column_total)->applyFromArray(
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
// $sheet->getStyle('M' . $column_total)->applyFromArray(
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
// $sheet->getStyle('L' . $column_total)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('A5A5A5');
// $sheet->getStyle('H10:H' . $column1)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('J10:J' . $column1)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('K10:K' . $column1)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('L10:L' . $column1)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('M10:M' . $column1)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('L10:L' . $column_total)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('K10:K' . $column_total)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);
// $sheet->getStyle('M10:M' . $column_total)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);



ob_end_clean();
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
