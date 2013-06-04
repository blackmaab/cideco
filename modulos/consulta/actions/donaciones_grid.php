<?php

session_name("CIDECO");
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Conexion.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Reportes.class.php';
header("Content-type: text/xml");
//Inicia encabezado
$head = "";
$head .="<head>";
$head .="<column width='150' type='ro' align='left' sort='str'>Donante</column> \n";
$head .="<column width='150' type='ro' align='center' sort='str'>Promotor</column> \n";
$head .="<column width='150' type='ro' align='center' sort='str'>Tipo Pago</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Monto</column> \n";
$head .="<column width='120' type='ro' align='center' sort='str'>Numero recibo</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Fecha de pago</column> \n";
$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";
$head .="</head> \n";
$obj_reporte = new Reportes();
$obj_reporte->idUsuario = $_SESSION['USERID'];
if (isset($_GET['fechaini']) && isset($_GET['fechafin'])):
    $obj_reporte->date_start = $_GET['fechaini'];
    $obj_reporte->date_end = $_GET['fechafin'];
    $array_data = $obj_reporte->load_donaciones(false);
else:
    $array_data = $obj_reporte->load_donaciones(true);
endif;
//Cierra encabezado
//Bucle para armar la tabla a mostrar
$contador = 0;
$retVal = "";
$totales=0;
foreach ($array_data as $key => $value):
    $retVal .= "<row id='$contador'> \n";
    $retVal .= "<cell >" . $value["donante"] . "</cell> \n";
    $retVal .= "<cell >" . $value["promotor"] . "</cell> \n";
    $retVal .= "<cell >" . $value["tipo_pago"] . "</cell> \n";
    $retVal .= "<cell >" . $value["monto"] . "</cell> \n";
    $retVal .= "<cell >" . $value["numero_recibo"] . "</cell> \n";
    $retVal .= "<cell >" . $value["fecha"] . "</cell> \n";
    $retVal .= "</row>";
    $totales+=$value["monto"];
    $contador++;
endforeach;
//IMPRESION DE TOTALES
$retVal .= "<row id='$contador'> \n";
$retVal .= "<cell >-</cell> \n";
$retVal .= "<cell >-</cell> \n";
$retVal .= "<cell >TOTALES</cell> \n";
$retVal .= "<cell >" . $totales . "</cell> \n";
$retVal .= "<cell >-</cell> \n";
$retVal .= "<cell >-</cell> \n";
$retVal .= "</row>";
//Concatenar elementos
$retVal = $head . $retVal;
//Retornar respuesta
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<rows id='datos'>" . $retVal . "</rows>";
exit;
?>
