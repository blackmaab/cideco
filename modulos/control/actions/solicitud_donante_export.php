<?php

//ini_set("memory_limit","500M");
//set_time_limit(120);
//session_name("CIDECO");
//session_start();
//$id = session_id();
//if(!isset($_SESSION['CIDECO']) || $_SESSION['EXPIRE'] == 999) 
//{
//header ("location: ../../login/pages/default.php"); 
//}

require_once '../../../components/excel/PHPExcel.php';
require_once '../../../components/excel/PHPExcel/IOFactory.php';
require_once '../../../components/excel/PHPExcel/RichText.php';

//Inicia
include("../../../class/database.class.php");



$execQuery = " 				
				Select 

				   fecha_creacion,
				   a.id_donacion,
				   estado_donacion,
				   monto,
				   c.nombres,
				   c.apellido_pri,
				   c.apellido_seg,
				   CONCAT(e.nombres , ' ' , e.apellido_pri) As Promotor
					
				   From donacion a
				   Left Join donante b On b.id_donante = a.id_donante
				   Left Join persona c On c.id_persona = b.id_persona
				   Left Join promotor d On a.id_promotor = d.id_promotor
				   Left Join persona e On e.id_persona = d.id_persona
                   Left Join estado_donacion On a.estado = id_est_donacion 
				   
				   Where a.estado <> 5	";

//consulta a base de datos
$result = $database->database_query($execQuery);

//Objeto Excel
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("CIDECO-ES")
        ->setLastModifiedBy("CIDECO-ES")
        ->setTitle("CIDECO-ES")
        ->setSubject("CIDECO-ES")
        ->setDescription("Usuarios de Sistema")
        ->setKeywords("CIDECO-ES")
        ->setCategory("Gestion de Donaciones");



//Configuraciones de pagina
$name = date("Ymd") . "_" . date("His", strtotime("-1 hour"));
$objPHPExcel->getActiveSheet()->setTitle('Usuarios - ' . $name);

//Tipo de letra
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

//Encabezado y Titulo
$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'CIDECO EL SALVADOR - REPORTE - SOLICITUD DE DONANTES ');
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

//Contenido
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
$objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB('000000');
$objPHPExcel->getActiveSheet()->setShowGridLines(true);
$objPHPExcel->getActiveSheet()->freezePane('A3');

$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);


//Encabezado
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A2', 'Fecha Solicitud')
        ->setCellValue('B2', 'No Solicitud')
        ->setCellValue('C2', 'Estado')
        ->setCellValue('D2', 'Monto')
        ->setCellValue('E2', 'Nombre')
        ->setCellValue('F2', 'Primer Apellido')
        ->setCellValue('G2', 'Sgundo Apellido')
        ->setCellValue('H2', 'Promotor');

$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR, 'rotation' => 90, 'startcolor' => array('argb' => 'FFFFFFFF'), 'endcolor' => array('argb' => 'FFCDE3FE'))));


$counter = 3;

while ($row = $database->database_array($result)) {
    $objPHPExcel->getActiveSheet()->getStyle('A' . $counter . ':H' . $counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $counter . ':H' . $counter)->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => 'FF999999'),),),));

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $row[0]);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, $row[1]);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, $row[2]);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, $row[3]);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, $row[4]);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, $row[5]);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $counter, $row[6]);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $counter, $row[7]);

    $counter++;
}

$objPHPExcel->getActiveSheet()->setAutoFilter('A2:H' . $counter);

$database->database_close();

//Finaliza programa

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $name . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
?>