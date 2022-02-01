<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Bumil Posyandu.xls");
header('Cache-Control: max-age=0');
ob_end_clean();

require base_url('/assets').'/assets/excel/autoload.php';

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
$sheet->setCellValue('A1', strtoupper($desa_name));
$sheet->setCellValue('A2', 'LAPORAN DATA BUMIL POSYANDU');
$sheet->setCellValue('A5', 'FILTERED BY');
$sheet->setCellValue('B5', strtoupper($pos_name));
$sheet->setCellValue('A6', 'START DATE');
$sheet->setCellValue('B6', "-Date here-");
$sheet->setCellValue('A7', 'END DATE');
$sheet->setCellValue('B7', "-Date here-");


// Isi
$sheet->setCellValue('A9', 'NO');
$sheet->setCellValue('B9', 'KMS');
$sheet->setCellValue('C9', 'NAMA IBU');
$sheet->setCellValue('D9', 'NAMA BAPAK');
$sheet->setCellValue('E9', 'NAMA BAYI');
$sheet->setCellValue('F9', 'JENIS KELAMIN BAYI');
$sheet->setCellValue('G9', 'TGL LAHIR BAYI');
$sheet->setCellValue('H9', 'TGL MENINGGAL BAYI');
$sheet->setCellValue('I9', 'TGL MENINGGAL IBU');

$no = 1;
$number = 1;
$column = 9;
$column1 = 9;


foreach ($report as $r => $row) {

  $column1++;
  $sheet->setCellValue('A' . $column1, $no);
  $sheet->setCellValue('B' . $column1, $row->kms);
  $sheet->setCellValue('C' . $column1, $row->nama_ibu);
  $sheet->setCellValue('D' . $column1, $row->nama_bapak);
  $sheet->setCellValue('E' . $column1, $row->nama_bayi);
  $sheet->setCellValue('F' . $column1, $row->jk_bayi);
  $sheet->setCellValue('G' . $column1, $row->tgl_lahir_bayi);
  $sheet->setCellValue('H' . $column1, $row->tgl_meninggal_bayi);
  $sheet->setCellValue('I' . $column1, $row->tgl_meninggal_ibu);


  $no++;
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
$sheet->getColumnDimension('A')->setWidth(12);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(23);
$sheet->getColumnDimension('D')->setWidth(23);
$sheet->getColumnDimension('E')->setWidth(23);
$sheet->getColumnDimension('F')->setWidth(23);
$sheet->getColumnDimension('G')->setWidth(23);
$sheet->getColumnDimension('H')->setWidth(23);

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

$sheet->getStyle('A9:M9')->applyFromArray(
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
$sheet->getStyle('A10:A' . $column1)->applyFromArray(
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
$sheet->getStyle('B10:B' . $column1)->applyFromArray(
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
$sheet->getStyle('C10:C' . $column1)->applyFromArray(
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
$sheet->getStyle('D10:D' . $column1)->applyFromArray(
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
$sheet->getStyle('E10:E' . $column1)->applyFromArray(
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
$sheet->getStyle('F10:F' . $column1)->applyFromArray(
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
$sheet->getStyle('G10:G' . $column1)->applyFromArray(
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
$sheet->getStyle('H10:H' . $column1)->applyFromArray(
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
$sheet->getStyle('I10:I' . $column1)->applyFromArray(
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
