<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Conexion.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cideco/class/Reportes.class.php';
header("Content-type: text/xml");
//Inicia encabezado
$head = "";
$head .="<head>";
$head .="<column width='100' type='ro' align='center' sort='str'>Id</column> \n";
$head .="<column width='150' type='ro' align='left' sort='str'>Alumno</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>Institucion</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>Grado</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>Seccion</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>Monto</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>Fecha beca</column> \n";
$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";
$head .="</head> \n";
$obj_reporte = new Reportes();
if (isset($_GET['fechaini']) && isset($_GET['fechafin'])):
    $obj_reporte->date_start = $_GET['fechaini'];
    $obj_reporte->date_end = $_GET['fechafin'];
    $array_data = $obj_reporte->load_becas(false);
else:
    $array_data = $obj_reporte->load_becas(true);
endif;
//Cierra encabezado
//Bucle para armar la tabla a mostrar
$contador = 0;
$retVal = "";
foreach ($array_data as $key => $value):
    $retVal .= "<row id='$contador'> \n";
    $retVal .= "<cell >" . $value["idalumno"] . "</cell> \n";
    $retVal .= "<cell >" . $value["alumno"] . "</cell> \n";
    $retVal .= "<cell >" . $value["nombre_institucion"] . "</cell> \n";
    $retVal .= "<cell >" . $value["grado"] . "</cell> \n";
    $retVal .= "<cell >" . $value["seccion"] . "</cell> \n";
    $retVal .= "<cell >" . $value["monto"] . "</cell> \n";
    $retVal .= "<cell >" . $value["fecha"] . "</cell> \n";
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
