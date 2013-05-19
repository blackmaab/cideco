<?php

include_once '../../../class/Conexion.class.php';
include_once '../../../class/InstitucionEducativa.class.php';
header("Content-type: text/xml");

//Inicia encabezado
$head = "";

$head .="<head>";

$head .="<column width='50' type='ro' align='center' sort='str'>Id</column> \n";
$head .="<column width='300' type='ro' align='left' sort='str'>Institucion</column> \n";
$head .="<column width='450' type='ro' align='center' sort='str'>Direccion</column> \n";
$head .="<column width='75' type='ro' align='center' sort='str'>Telefono</column> \n";
$head .="<column width='150' type='ro' align='center' sort='str'>Director</column> \n";

$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";

$head .="</head> \n";

$obj_institucion = new InstitucionEducativa();



//Cierra encabezado
//Bucle para armar la tabla a mostrar
$contador = 0;
$retVal = "";
$array_data = $obj_institucion->select_InstitucionEducativa();

foreach ($array_data as $key => $value):
    $retVal .= "<row id='$contador'> \n";
    $retVal .= "<cell >" . $value["id_institucion"] . "</cell> \n";
    $retVal .= "<cell >" . $value["nombre_institucion"] . "</cell> \n";
    $retVal .= "<cell >" . $value["direccion"] . "</cell> \n";
    $retVal .= "<cell >" . $value["telefono"] . "</cell> \n";
    $retVal .= "<cell >" . $value["nombre_director"] . "</cell> \n";
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
