<?php
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Laporan Data Bumil Dan Bulin Posyandu ".$filterBulan." ".$filterTahun.".xls");
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
$sheet->setCellValue('A' . $headerCop2Column1, 'LAPORAN FORMAT 2 - REGISTER BUMIL DAN BULIN DALAM WILAYAH KERJA POSYANDU');

// Isi
$sheet->setCellValue('A' . $headerTabColumnA, 'NO'); $sheet->mergeCells('A'.$headerTabColumnA.':A'.$headerTabColumnC);
$sheet->setCellValue('B' . $headerTabColumnA, 'NO KMS'); $sheet->mergeCells('B'.$headerTabColumnA.':B'.$headerTabColumnC);
$sheet->setCellValue('C' . $headerTabColumnA, 'NAMA IBU HAMIL'); $sheet->mergeCells('C'.$headerTabColumnA.':C'.$headerTabColumnC);
$sheet->setCellValue('D' . $headerTabColumnA, 'UMUR'); $sheet->mergeCells('D'.$headerTabColumnA.':D'.$headerTabColumnC);
$sheet->setCellValue('E' . $headerTabColumnA, 'KEL. DAWIS'); $sheet->mergeCells('E'.$headerTabColumnA.':E'.$headerTabColumnC);
$sheet->setCellValue('F' . $headerTabColumnA, 'DIDAFTAR TANGGAL'); $sheet->mergeCells('F'.$headerTabColumnA.':F'.$headerTabColumnC);
$sheet->setCellValue('G' . $headerTabColumnA, 'UMUR KEHAMILAN'); $sheet->mergeCells('G'.$headerTabColumnA.':G'.$headerTabColumnC);
$sheet->setCellValue('H' . $headerTabColumnA, 'HAMIL KE'); $sheet->mergeCells('H'.$headerTabColumnA.':H'.$headerTabColumnC);

$sheet->setCellValue('I' . $headerTabColumnA, 'PIL TAMBAH DARAH PADA KEHAMILAN'); $sheet->mergeCells('I4:K4');
$sheet->setCellValue('I' . $headerTabColumnB, 'FE I BLN'); $sheet->mergeCells('I'.$headerTabColumnB.':I'.$headerTabColumnC);
$sheet->setCellValue('J' . $headerTabColumnB, 'FE II BLN'); $sheet->mergeCells('J'.$headerTabColumnB.':J'.$headerTabColumnC);
$sheet->setCellValue('K' . $headerTabColumnB, 'FE III BLN'); $sheet->mergeCells('K'.$headerTabColumnB.':K'.$headerTabColumnC);

$sheet->setCellValue('L' . $headerTabColumnA, 'IMUNISASI TT TGL/BLN'); $sheet->mergeCells('L4:M4');
$sheet->setCellValue('L' . $headerTabColumnB, 'I'); $sheet->mergeCells('L'.$headerTabColumnB.':L'.$headerTabColumnC);
$sheet->setCellValue('M' . $headerTabColumnB, 'II'); $sheet->mergeCells('M'.$headerTabColumnB.':M'.$headerTabColumnC);

$sheet->setCellValue('N' . $headerTabColumnA, 'KAPSUL YODIUM'); $sheet->mergeCells('N'.$headerTabColumnA.':N'.$headerTabColumnC);

$sheet->setCellValue('O' . $headerTabColumnA, 'PEMERIKSAAN KEHAMILAN PADA BULAN'); $sheet->mergeCells('O4:Z4');
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

$sheet->setCellValue('AA' . $headerTabColumnA, 'RESIKO'); $sheet->mergeCells('AA'.$headerTabColumnA.':AA'.$headerTabColumnC);

$sheet->setCellValue('AB' . $headerTabColumnA, 'MELAHIRKAN'); $sheet->mergeCells('AB4:AE4');
$sheet->setCellValue('AB' . $headerTabColumnB, 'TANGGAL'); $sheet->mergeCells('AB'.$headerTabColumnB.':AB'.$headerTabColumnC);
$sheet->setCellValue('AC' . $headerTabColumnB, 'DITOLONG OLEH'); $sheet->mergeCells('AC5:AE5');
$sheet->setCellValue('AC' . $headerTabColumnC, 'NAKES');
$sheet->setCellValue('AD' . $headerTabColumnC, 'DUKUN');
$sheet->setCellValue('AE' . $headerTabColumnC, 'DLL');

$sheet->setCellValue('AF' . $headerTabColumnA, 'MELAHIRKAN'); $sheet->mergeCells('AF4:AI4');
$sheet->setCellValue('AF' . $headerTabColumnB, 'HIDUP'); $sheet->mergeCells('AF5:AH5');
$sheet->setCellValue('AF' . $headerTabColumnC, '< 2000 GRAM');
$sheet->setCellValue('AG' . $headerTabColumnC, '2000 - 2500 GRAM');
$sheet->setCellValue('AH' . $headerTabColumnC, '> 2500 GRAM');
$sheet->setCellValue('AI' . $headerTabColumnB, 'MENINGGAL'); $sheet->mergeCells('AI'.$headerTabColumnB.':AI'.$headerTabColumnC);

$sheet->setCellValue('AJ' . $headerTabColumnA, 'IBU'); $sheet->mergeCells('AJ4:AK4');
$sheet->setCellValue('AJ' . $headerTabColumnB, 'MENINGGAL'); $sheet->mergeCells('AJ'.$headerTabColumnB.':AJ'.$headerTabColumnC);
$sheet->setCellValue('AK' . $headerTabColumnB, 'MENYUSUI'); $sheet->mergeCells('AK'.$headerTabColumnB.':AK'.$headerTabColumnC);

$sheet->setCellValue('AL' . $headerTabColumnA, 'KET'); $sheet->mergeCells('AL'.$headerTabColumnA.':AL'.$headerTabColumnC);


// Mengubah ukuran kolom
$sheet->getColumnDimension('A')->setWidth(8);
$sheet->getColumnDimension('AL')->setWidth(35);


for ($colsAlpha = 'B'; $colsAlpha !== 'AK'; $colsAlpha++){

    $sheet->getColumnDimension($colsAlpha)->setAutoSize(true);

}

$noColmn = 1;
for ($colsAlpha = 'A'; $colsAlpha !== 'AM'; $colsAlpha++){

    $sheet->setCellValue($colsAlpha . $headerTabColumn2, (string)$noColmn);

    $noColmn++;
}

foreach ($report as $r => $row) {
  $bodyTabColumn2++;

  $sheet->setCellValue('A' . $bodyTabColumn2, (string)$row['no']);
  $sheet->setCellValue('B' . $bodyTabColumn2, $row['kms']);
  $sheet->setCellValue('C' . $bodyTabColumn2, $row['nama_bumil']);
  $sheet->setCellValue('D' . $bodyTabColumn2, $row['umur']);
  $sheet->setCellValue('E' . $bodyTabColumn2, (empty($row['kel_dawis'])) ? "-" : $row['kel_dawis']);
  $sheet->setCellValue('F' . $bodyTabColumn2, $row['tgl_pendaftaran']);
  $sheet->setCellValue('G' . $bodyTabColumn2, $row['umur_kehamilan']);
  $sheet->setCellValue('H' . $bodyTabColumn2, $row['hamil_ke']);
  $sheet->setCellValue('I' . $bodyTabColumn2, $row['pyd_ptdh_fe1']);
  $sheet->setCellValue('J' . $bodyTabColumn2, $row['pyd_ptdh_fe2']);
  $sheet->setCellValue('K' . $bodyTabColumn2, $row['pyd_ptdh_fe3']);
  $sheet->setCellValue('L' . $bodyTabColumn2, $row['pyd_imsi1']);
  $sheet->setCellValue('M' . $bodyTabColumn2, $row['pyd_imsi2']);
  $sheet->setCellValue('N' . $bodyTabColumn2, $row['pyd_kapsul_yodium']);

  $sheet->setCellValue('O' . $bodyTabColumn2, (empty((string)$row['r01_darah']) || (string)$row['r01_darah'] == '0/0' ? '0/0' : (string)$row['r01_darah']) .' | '. (empty((string)$row['r01_berat']) || (string)$row['r01_berat'] == '0.0' ? '0.0' : (string)$row['r01_berat'] ));
  $sheet->setCellValue('P' . $bodyTabColumn2, (empty((string)$row['r02_darah']) || (string)$row['r02_darah'] == '0/0' ? '0/0' : (string)$row['r02_darah']) .' | '. (empty((string)$row['r02_berat']) || (string)$row['r02_berat'] == '0.0' ? '0.0' : (string)$row['r02_berat'] ));
  $sheet->setCellValue('Q' . $bodyTabColumn2, (empty((string)$row['r03_darah']) || (string)$row['r03_darah'] == '0/0' ? '0/0' : (string)$row['r03_darah']) .' | '. (empty((string)$row['r03_berat']) || (string)$row['r03_berat'] == '0.0' ? '0.0' : (string)$row['r03_berat'] ));
  $sheet->setCellValue('R' . $bodyTabColumn2, (empty((string)$row['r04_darah']) || (string)$row['r04_darah'] == '0/0' ? '0/0' : (string)$row['r04_darah']) .' | '. (empty((string)$row['r04_berat']) || (string)$row['r04_berat'] == '0.0' ? '0.0' : (string)$row['r04_berat'] ));
  $sheet->setCellValue('S' . $bodyTabColumn2, (empty((string)$row['r05_darah']) || (string)$row['r05_darah'] == '0/0' ? '0/0' : (string)$row['r05_darah']) .' | '. (empty((string)$row['r05_berat']) || (string)$row['r05_berat'] == '0.0' ? '0.0' : (string)$row['r05_berat'] ));
  $sheet->setCellValue('T' . $bodyTabColumn2, (empty((string)$row['r06_darah']) || (string)$row['r06_darah'] == '0/0' ? '0/0' : (string)$row['r06_darah']) .' | '. (empty((string)$row['r06_berat']) || (string)$row['r06_berat'] == '0.0' ? '0.0' : (string)$row['r06_berat'] ));
  $sheet->setCellValue('U' . $bodyTabColumn2, (empty((string)$row['r07_darah']) || (string)$row['r07_darah'] == '0/0' ? '0/0' : (string)$row['r07_darah']) .' | '. (empty((string)$row['r07_berat']) || (string)$row['r07_berat'] == '0.0' ? '0.0' : (string)$row['r07_berat'] ));
  $sheet->setCellValue('V' . $bodyTabColumn2, (empty((string)$row['r08_darah']) || (string)$row['r08_darah'] == '0/0' ? '0/0' : (string)$row['r08_darah']) .' | '. (empty((string)$row['r08_berat']) || (string)$row['r08_berat'] == '0.0' ? '0.0' : (string)$row['r08_berat'] ));
  $sheet->setCellValue('W' . $bodyTabColumn2, (empty((string)$row['r09_darah']) || (string)$row['r09_darah'] == '0/0' ? '0/0' : (string)$row['r09_darah']) .' | '. (empty((string)$row['r09_berat']) || (string)$row['r09_berat'] == '0.0' ? '0.0' : (string)$row['r09_berat'] ));
  $sheet->setCellValue('X' . $bodyTabColumn2, (empty((string)$row['r10_darah']) || (string)$row['r10_darah'] == '0/0' ? '0/0' : (string)$row['r10_darah']) .' | '. (empty((string)$row['r10_berat']) || (string)$row['r10_berat'] == '0.0' ? '0.0' : (string)$row['r10_berat'] ));
  $sheet->setCellValue('Y' . $bodyTabColumn2, (empty((string)$row['r11_darah']) || (string)$row['r11_darah'] == '0/0' ? '0/0' : (string)$row['r11_darah']) .' | '. (empty((string)$row['r11_berat']) || (string)$row['r11_berat'] == '0.0' ? '0.0' : (string)$row['r11_berat'] ));
  $sheet->setCellValue('Z' . $bodyTabColumn2, (empty((string)$row['r12_darah']) || (string)$row['r12_darah'] == '0/0' ? '0/0' : (string)$row['r12_darah']) .' | '. (empty((string)$row['r12_berat']) || (string)$row['r12_berat'] == '0.0' ? '0.0' : (string)$row['r12_berat'] ));

  $sheet->setCellValue('AA' . $bodyTabColumn2, (empty($row['pyd_resiko'])) ? "-" : "V");
  $sheet->setCellValue('AB' . $bodyTabColumn2, $row['lahir_tanggal']);
  $sheet->setCellValue('AC' . $bodyTabColumn2,  ($row['lahir_pic'] == 'Nakes') ? " " : "V");
  $sheet->setCellValue('AD' . $bodyTabColumn2,  ($row['lahir_pic'] == 'Dukun') ? " " : "V");
  $sheet->setCellValue('AE' . $bodyTabColumn2,  ($row['lahir_pic'] == 'Lain-lain') ? " " : "V");

  $sheet->setCellValue('AF' . $bodyTabColumn2,  ($row['bayi_berat'] < 2000) ? " " : "V");
  $sheet->setCellValue('AG' . $bodyTabColumn2,  ($row['bayi_berat'] >= 2000 && $row['bayi_berat'] <= 2500) ? " " : "V");
  $sheet->setCellValue('AH' . $bodyTabColumn2,  ($row['bayi_berat'] > 2500) ? " " : "V");
  $sheet->setCellValue('AI' . $bodyTabColumn2, $row['bayi_meninggal']);
  $sheet->setCellValue('AJ' . $bodyTabColumn2, $row['ibu_meninggal']);
  $sheet->setCellValue('AK' . $bodyTabColumn2, $row['ibu_menyusui']);
  $sheet->setCellValue('AL' . $bodyTabColumn2, '');
}
$footerTabColumn1 = $bodyTabColumn2 + 1;


//Merge Cell
$sheet->mergeCells('A'.$headerCop1Column1.':AL' .$headerCop1Column1);
$sheet->mergeCells('A'.$headerCop2Column1.':AL' .$headerCop2Column1);


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
$sheet->getStyle('A'.$headerTabColumnA.':AL'.$headerTabColumnC)->applyFromArray(
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

$sheet->getStyle('A'.$headerTabColumn2.':AL'.$headerTabColumn2)->applyFromArray(
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
for ($colsAlpha = 'A'; $colsAlpha !== 'AM'; $colsAlpha++){

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



