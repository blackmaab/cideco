<?php

include_once '../../../class/Conexion.class.php';
include_once '../../../class/TipoPago.class.php';
header("Content-type: text/xml");

//Inicia encabezado
$head = "";

$head .="<head>";

$head .="<column width='100' type='ro' align='center' sort='str'>Id</column> \n";
$head .="<column width='300' type='ro' align='left' sort='str'>Descripcion</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Meses</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Activo</column> \n";

$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";

$head .="</head> \n";

$obj_tipo_pago = new TipoPago();



//Cierra encabezado
//Bucle para armar la tabla a mostrar
$contador = 0;
$retVal = "";
$array_data = $obj_tipo_pago->select_TipoPago();

foreach ($array_data as $key => $value):
    $retVal .= "<row id='$contador'> \n";
    $retVal .= "<cell >" . $value["id_tipo_pago"] . "</cell> \n";
    $retVal .= "<cell >" . $value["descripcion"] . "</cell> \n";
    $retVal .= "<cell >" . $value["meses"] . "</cell> \n";
    if ($value["activo"] == 1):
        $activo = "Si";
    else:
        $activo = "No";
    endif;
    $retVal .= "<cell >" . $activo . "</cell> \n";
    $retVal .= "</row>";
    $contador++;
endforeach;

//Concatenar elementos

$retVal = $head . $retVal;

//Retornar respuesta
echo('<?xml version="1.0" encoding="ISO-8859-1"?>');
echo "<rows id='datos'>" . $retVal . "</rows>";
exit;
?>
