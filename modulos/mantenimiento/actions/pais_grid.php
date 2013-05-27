<?php

include_once '../../../class/Conexion.class.php';
include_once '../../../class/Pais.class.php';
header("Content-type: text/xml");

//Inicia encabezado
$head = "";

$head .="<head>";

$head .="<column width='100' type='ro' align='center' sort='str'>Id</column> \n";
$head .="<column width='150' type='ro' align='left' sort='str'>Pais</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>Activo</column> \n";

$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";

$head .="</head> \n";

$obj_banco = new Pais();

$activo;

//Cierra encabezado
//Bucle para armar la tabla a mostrar
$contador = 0;
$retVal = "";
$array_data = $obj_banco->select_Pais();

foreach ($array_data as $key => $value):
    $retVal .= "<row id='$contador'> \n";
    $retVal .= "<cell >" . $value["id_pais"] . "</cell> \n";
    $retVal .= "<cell >" . $value["nombre_pais"] . "</cell> \n";
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
echo('<?xml version="1.0" encoding="UTF-8"?>');
echo "<rows id='datos'>" . $retVal . "</rows>";
exit;
?>
