<?php

session_name("CIDECO");
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Conexion.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Reportes.class.php';
header("Content-type: text/xml");
//Inicia encabezado
$head = "";
$head .="<head>";
$head .="<column width='150' type='ro' align='left' sort='str'>Alumno</column> \n";
$head .="<column width='150' type='ro' align='left' sort='str'>Nombre Institucion</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Grado</column> \n";
$head .="<column width='70' type='ro' align='center' sort='str'>Seccion</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Nota Promedio</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Año</column> \n";
$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";
$head .="</head> \n";
$obj_reporte = new Reportes();
$obj_reporte->idUsuario = $_SESSION['USERID'];
if (isset($_GET['anio'])):
    $obj_reporte->anio = $_GET['anio'];   
    $array_data = $obj_reporte->load_notas_becados(false);
else:
    $array_data = $obj_reporte->load_notas_becados(true);
endif;
//Cierra encabezado
//Bucle para armar la tabla a mostrar
$contador = 0;
$retVal = "";
foreach ($array_data as $key => $value):
    $retVal .= "<row id='$contador'> \n";
    $retVal .= "<cell >" . $value["alumno"] . "</cell> \n";
    $retVal .= "<cell >" . $value["institucion"] . "</cell> \n";
    $retVal .= "<cell >" . $value["grado"] . "</cell> \n";
    $retVal .= "<cell >" . $value["seccion"] . "</cell> \n";
    $retVal .= "<cell >" . $value["nota"] . "</cell> \n";
    $retVal .= "<cell >" . $value["anio"] . "</cell> \n";
    $retVal .= "</row>";    
    $contador++;
endforeach;
//Concatenar elementos
$retVal = $head . $retVal;
//Retornar respuesta
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<rows id='datos'>" . $retVal . "</rows>";
exit;
?>
