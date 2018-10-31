<?php
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

$this->load->library('Classes/PHPExcel');

$creator = php_uname('n');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator($creator)
            ->setLastModifiedBy($creator);

$sheet = $objPHPExcel->getActiveSheet();

$sheet->setTitle('Laporan Transaksi');

$user_level = $this->session->userdata('user_level');
if($user_level == 0){

    $lastcol = 'J';

}else{

    $lastcol = 'I';
}

// Set Column width
foreach(range('A', $lastcol) as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Set Header
$sheet->getRowDimension('2')->setRowHeight(20);
// Judul
$sheet->mergeCells('A2:'.$lastcol.'2');
$sheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue('A2', 'LAPORAN TRANSAKSI');
$sheet->getStyle('A2')->getFont()->setName('Calibri');
$sheet->getStyle('A2')->getFont()->setSize(16);
$sheet->getStyle('A2')->getFont()->setBold(true);
// Periode
if($datastartend['start'] != '') {
    $sheet->mergeCells('A3:'.$lastcol.'3');
    $sheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $sheet->setCellValue('A3', 'Periode: ' . $datastartend['start'] . ' s/d ' . $datastartend['end']);
}

$sheet->getStyle('A3')->getFont()->setName('Tahoma');
$sheet->getStyle('A3')->getFont()->setSize(12);
$sheet->getStyle('A3')->getFont()->setBold(true);

//set table header
$sheet->getStyle('A5:'.$lastcol.'5')->getFont()->setName('Calibri');
$sheet->getStyle('A5:'.$lastcol.'5')->getFont()->setSize(12);
$sheet->getStyle('A5:'.$lastcol.'5')->getFont()->setBold(true);
$sheet->getStyle('A5:'.$lastcol.'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A5:'.$lastcol.'5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('A5:'.$lastcol.'5')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('A5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('B5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('C5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('D5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('E5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('F5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('G5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('H5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('I5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
if($user_level == 0){

    $sheet->getStyle('J5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('J5')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

    $sheet->setCellValue('A5', 'NO');
    $sheet->setCellValue('B5', 'ID TRANSAKSI');
    $sheet->setCellValue('C5', 'TANGGAL');
    $sheet->setCellValue('D5', 'KODE AGEN');
    $sheet->setCellValue('E5', 'KODE PRODUK');
    $sheet->setCellValue('F5', 'NO PELANGGAN');
    $sheet->setCellValue('G5', 'SN');
    $sheet->setCellValue('H5', 'REF');
    $sheet->setCellValue('I5', 'STATUS');
    $sheet->setCellValue('J5', 'NOMINAL');

    //Data transaksi
    $no = 1;
    $i = 6;
    foreach ($datatransaksi as $datatransaksi) {

        $sheet->getStyle('I'.$i)->getNumberFormat();

        $sheet->setCellValue('A'.$i, $no++);
        $sheet->setCellValue('B'.$i, $datatransaksi->id);
        $sheet->setCellValue('C'.$i, $datatransaksi->date_created);
        $sheet->setCellValue('D'.$i, $datatransaksi->user_created);
        $sheet->setCellValue('E'.$i, $datatransaksi->trans_code);
        $sheet->setCellValueExplicit('F'.$i, $datatransaksi->nopelanggan, PHPExcel_Cell_DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('G'.$i, $datatransaksi->sn, PHPExcel_Cell_DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('H'.$i, $datatransaksi->ref, PHPExcel_Cell_DataType::TYPE_STRING);
        if($datatransaksi->status == 1){
            $nama_status = 'Berhasil';
        }
        else{
            $nama_status = 'Gagal';
        }
        $sheet->setCellValue('I'.$i, $nama_status);
        $nom = $datatransaksi->nominal;
        $sheet->setCellValue('J'.$i, $nom);

        $i++;

    }

    $j=$i;

    $sheet->mergeCells('A'.$j.':I'.$j);
    $sheet->getStyle('A'.$j)->getFont()->setBold(true);
    $sheet->getStyle('J'.$j)->getFont()->setBold(true);
    $sheet->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $sheet->getStyle('A'.$j.':I'.$j)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('A'.$j.':I'.$j)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('A'.$j)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('J'.$j)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('J'.$j)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('A'.$j,'GRAND TOTAL');
    $sheet->setCellValue('J'.$j, $datatotal[0]->nominal);

}else{

    $sheet->getStyle('I5')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

    $sheet->setCellValue('A5', 'NO');
    $sheet->setCellValue('B5', 'ID TRANSAKSI');
    $sheet->setCellValue('C5', 'TANGGAL');
    $sheet->setCellValue('D5', 'KODE PRODUK');
    $sheet->setCellValue('E5', 'NO PELANGGAN');
    $sheet->setCellValue('F5', 'SN');
    $sheet->setCellValue('G5', 'REF');
    $sheet->setCellValue('H5', 'STATUS');
    $sheet->setCellValue('I5', 'NOMINAL');

    //Data transaksi
    $no = 1;
    $i = 6;
    foreach ($datatransaksi as $datatransaksi) {

        $sheet->getStyle('I'.$i)->getNumberFormat();

        $sheet->setCellValue('A'.$i, $no++);
        $sheet->setCellValue('B'.$i, $datatransaksi->id);
        $sheet->setCellValue('C'.$i, $datatransaksi->date_created);
        $sheet->setCellValue('D'.$i, $datatransaksi->trans_code);
        $sheet->setCellValueExplicit('E'.$i, $datatransaksi->nopelanggan, PHPExcel_Cell_DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('F'.$i, $datatransaksi->sn, PHPExcel_Cell_DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('G'.$i, $datatransaksi->ref, PHPExcel_Cell_DataType::TYPE_STRING);
        if($datatransaksi->status == 1){
            $nama_status = 'Berhasil';
        }
        else{
            $nama_status = 'Gagal';
        }
        $sheet->setCellValue('H'.$i, $nama_status);
        $nom = $datatransaksi->nominal;
        $sheet->setCellValue('I'.$i, $nom);

        $i++;

    }

    $j=$i;

    $sheet->mergeCells('A'.$j.':H'.$j);
    $sheet->getStyle('A'.$j)->getFont()->setBold(true);
    $sheet->getStyle('I'.$j)->getFont()->setBold(true);
    $sheet->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $sheet->getStyle('A'.$j.':I'.$j)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('A'.$j.':I'.$j)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('A'.$j)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('I'.$j)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('I'.$j)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('A'.$j,'GRAND TOTAL');
    $sheet->setCellValue('I'.$j,$datatotal[0]->nominal);

}


// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="Laporan Transaksi.xlsx"');
$objWriter->save('php://output');
