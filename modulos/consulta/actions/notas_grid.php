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
$head .="<column width='150' type='ro' align='left' sort='str'>Donante</column> \n";
$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";
$head .="</head> \n";
$obj_reporte = new Reportes();
$obj_reporte->idUsuario = $_SESSION['USERID'];


if ($_SESSION['IDPERF'] == 3):

    if (isset($_GET['anio'])):
        $obj_reporte->anio = $_GET['anio'];
        $array_data = $obj_reporte->load_notas_becados(2);
    else:
        $array_data = $obj_reporte->load_notas_becados(1);
    endif;


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
    $retVal .= "<cell >" . $value["donante"] . "</cell> \n";
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
