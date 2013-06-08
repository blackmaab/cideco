<?php

session_name("CIDECO");
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Conexion.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Reportes.class.php';
header("Content-type: text/xml");
//Inicia encabezado
$head = "";
$head .="<head>";
$head .="<column width='150' type='ro' align='center' sort='str'>Donante</column> \n";
$head .="<column width='150' type='ro' align='center' sort='str'>Promotor</column> \n";
$head .="<column width='150' type='ro' align='center' sort='str'>Tipo Pago</column> \n";
$head .="<column width='100' type='ro' align='right' sort='str'>Monto</column> \n";
$head .="<column width='120' type='ro' align='center' sort='str'>Numero recibo</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Fecha de pago</column> \n";
$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";
$head .="</head> \n";
$obj_reporte = new Reportes();
$obj_reporte->idUsuario = $_SESSION['USERID'];
if ($_SESSION['IDPERF'] == 3):
    if (isset($_GET['type'])):
        if (isset($_GET['fechaini']) && isset($_GET['fechafin'])):
            $obj_reporte->date_start = $_GET['fechaini'];
            $obj_reporte->date_end = $_GET['fechafin'];
            $array_data = $obj_reporte->load_donaciones(2);
        else:
            $array_data = $obj_reporte->load_donaciones(1);
        endif;
    endif;

elseif ($_SESSION['IDPERF'] == 1):
    //verificacion de la busqueda a realizar
    if (isset($_GET['type'])):
        if ($_GET['type'] == 'load'):
            if (isset($_GET['fechaini']) && isset($_GET['fechafin'])):
                $obj_reporte->date_start = $_GET['fechaini'];
                $obj_reporte->date_end = $_GET['fechafin'];
                $array_data = $obj_reporte->load_donaciones(4);
            else:
                $array_data = $obj_reporte->load_donaciones(3);
            endif;
        elseif ($_GET['type'] == 'donante'):
            $obj_reporte->texto_buscar = $_GET['nombre'];
            $array_data = $obj_reporte->load_donaciones(5);
            elseif ($_GET['type'] == 'promotor'):
            $obj_reporte->texto_buscar = $_GET['nombre'];
            $array_data = $obj_reporte->load_donaciones(6);
        endif;
    endif;

endif;

//Cierra encabezado
//Bucle para armar la tabla a mostrar
$contador = 0;
$retVal = "";
$totales = 0;
foreach ($array_data as $key => $value):
    $retVal .= "<row id='$contador'> \n";
    $retVal .= "<cell >" . $value["donante"] . "</cell> \n";
    $retVal .= "<cell >" . $value["promotor"] . "</cell> \n";
    $retVal .= "<cell >" . $value["tipo_pago"] . "</cell> \n";
    $retVal .= "<cell >" . "$ " . $value["monto"] . "</cell> \n";
    $retVal .= "<cell >" . $value["numero_recibo"] . "</cell> \n";
    $retVal .= "<cell >" . $value["fecha"] . "</cell> \n";
    $retVal .= "</row>";
    $totales+=$value["monto"];
    $contador++;
endforeach;
//IMPRESION DE TOTALES
if ($contador > 1):
    $retVal .= "<row id='$contador'> \n";
    $retVal .= "<cell >-</cell> \n";
    $retVal .= "<cell >-</cell> \n";
    $retVal .= "<cell >TOTALES</cell> \n";
    $retVal .= "<cell >" . "$ " . number_format($totales, 2) . "</cell> \n";
    $retVal .= "<cell >-</cell> \n";
    $retVal .= "<cell >-</cell> \n";
    $retVal .= "</row>";
endif;
//Concatenar elementos
$retVal = $head . $retVal;
//Retornar respuesta
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<rows id='datos'>" . $retVal . "</rows>";
exit;
?>
