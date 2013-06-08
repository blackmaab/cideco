<?php

session_name("CIDECO");
session_start();
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
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Conexion.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Reportes.class.php';


$obj_reporte = new Reportes();
$obj_reporte->idUsuario = $_SESSION['USERID'];

if ($_SESSION['IDPERF'] == 3):
    $obj_reporte->anio = $_GET['anio'];
    $array_data = $obj_reporte->load_notas_becados(2);

elseif ($_SESSION['IDPERF'] == 1):
    //verificacion de la busqueda a realizar
    if (isset($_GET['type'])):
        if ($_GET['type'] == 'load'):
            if (isset($_GET['anio'])):
                $obj_reporte->anio = $_GET['anio'];
                $array_data = $obj_reporte->load_notas_becados(5);
            else:
                $array_data = $obj_reporte->load_notas_becados(4);
            endif;
        elseif ($_GET['type'] == 'alumno'):
            $obj_reporte->texto_buscar = $_GET['nombre'];
            $array_data = $obj_reporte->load_notas_becados(3);
        elseif ($_GET['type'] == 'institucion'):
            $obj_reporte->texto_buscar = $_GET['id'];
            $array_data = $obj_reporte->load_notas_becados(6);
        elseif ($_GET['type'] == 'fecha'):
            $obj_reporte->date_start = $_GET['fechaini'];
            $obj_reporte->date_end = $_GET['fechafin'];
            $array_data = $obj_reporte->load_notas_becados(7);
        elseif ($_GET['type'] == 'donante'):
            $obj_reporte->texto_buscar = $_GET['nombre'];
            $array_data = $obj_reporte->load_notas_becados(8);
        endif;
    endif;
endif;




//Objeto Excel
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("CIDECO-ES")
        ->setLastModifiedBy("CIDECO-ES")
        ->setTitle("CIDECO-ES")
        ->setSubject("CIDECO-ES")
        ->setDescription("Notas de Apadrinados")
        ->setKeywords("CIDECO-ES")
        ->setCategory("Pagos Realizados");



//Configuraciones de pagina
$name = date("Ymd") . "_" . date("His", strtotime("-1 hour"));
$objPHPExcel->getActiveSheet()->setTitle('Notas - ' . $name);

//Tipo de letra
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');

//Encabezado y Titulo
$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
if ($_GET['type'] == 'load'):
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'CIDECO EL SALVADOR - NOTAS DE LOS APADRINADOS AÑO ' . $obj_reporte->anio);
elseif ($_GET['type'] == 'fecha'):
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'CIDECO EL SALVADOR - NOTAS DE LOS APADRINADOS PERIODO ' . $_GET['fechaini'] . ' HASTA ' . $_GET['fechafin']);
else:
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'CIDECO EL SALVADOR - NOTAS DE LOS APADRINADOS');
endif;

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

//Contenido
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
$objPHPExcel->getDefaultStyle()->getFont()->getColor()->setARGB('000000');
$objPHPExcel->getActiveSheet()->setShowGridLines(true);
$objPHPExcel->getActiveSheet()->freezePane('A3');

$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);


//Encabezado
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A2', '#')
        ->setCellValue('B2', 'Alumno')
        ->setCellValue('C2', 'Nombre Institución')
        ->setCellValue('D2', 'Grado')
        ->setCellValue('E2', 'Sección')
        ->setCellValue('F2', 'Nota Promedio')
        ->setCellValue('G2', 'Año')
        ->setCellValue('H2', 'Donante');

$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR, 'rotation' => 90, 'startcolor' => array('argb' => 'FFFFFFFF'), 'endcolor' => array('argb' => 'FFCDE3FE'))));


$counter = 3;

$totales = 0;
$correlativo = 1;
foreach ($array_data as $key => $value):
    $objPHPExcel->getActiveSheet()->getStyle('A' . $counter . ':H' . $counter)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A' . $counter . ':H' . $counter)->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => 'FF999999'),),),));

    $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $correlativo);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, $value["alumno"]);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, $value["institucion"]);
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, $value["grado"]);
    $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, $value["seccion"]);
    $objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, $value["nota"]);
    $objPHPExcel->getActiveSheet()->setCellValue('G' . $counter, $value["anio"]);
    $objPHPExcel->getActiveSheet()->setCellValue('H' . $counter, $value["donante"]);
    $correlativo++;
    $counter++;
endforeach;


$objPHPExcel->getActiveSheet()->setAutoFilter('A2:H' . $counter);


//Finaliza programa

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $name . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
?>