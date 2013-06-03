<?php

header("Content-type: text/xml");

set_time_limit(120);

//session_name("PLANNING_SYSTEM");
session_start();

$id = session_id();

/*
  if(!isset($_SESSION['PLANNING_SYSTEM']) || $_SESSION['EXPIRE'] == 999)
  {
  header ("location: ../../login/pages/default.php");
  }
 */

//Inicia
include("../../../class/database.class.php");


/*
  $p0 = $_GET['p0'];
  $p1 = $_GET['p1'];
 */
$execQuery = "";
$retVal = "";


$execQuery = " 
				Select 

					   id_registro,
					   nie,
					   nombres,
					   apellido_pri,
					   apellido_seg,
					   nombre_institucion,
					   nota_promedio
					   
					   From registro_alumno a
					   Left Join alumno b
							On b.id_alumno = a.id_alumno
					   LEFT JOIN persona c
							On c.id_persona = b.id_persona
					   Left Join institucion_educativa
							On id_institucion_edu = id_institucion ";



//consulta a base de datos
$result = $database->database_query($execQuery);



$counter = 0;

//Inicia encabezado
$head = "";

$head .="<head>";
$head .="<column width='0' type='ro' align='left' sort='str'>id_donate</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>NIE</column> \n";
$head .="<column width='125' type='ro' align='left' sort='str'>Nombre Alumno</column> \n";
$head .="<column width='125' type='ro' align='left' sort='str'>Primer Apellido</column> \n";
$head .="<column width='125' type='ro' align='center' sort='str'>Segundo Apellido</column> \n";
$head .="<column width='250' type='ro' align='left' sort='str'>Centro Escolar</column> \n";
$head .="<column width='100' type='ro' align='center' sort='str'>Nota Promedio</column> \n";

$head .="<settings> \n";
$head .="<colwidth>px</colwidth> \n";
$head .="</settings> \n";

$head .="</head> \n";

//Cierra encabezado
//Bucle para armar la tabla a mostrar
while ($row = $database->database_array($result)) {

    $counter++;

    $retVal .= "<row id='$counter'> \n";
    $retVal .= "<cell >" . trim($row[0]) . "</cell> \n";
    $retVal .= "<cell >" . trim($row[1]) . "</cell> \n";
    $retVal .= "<cell >" . trim($row[2]) . "</cell> \n";
    $retVal .= "<cell >" . trim($row[3]) . "</cell> \n";
    $retVal .= "<cell >" . trim($row[4]) . "</cell> \n";
    $retVal .= "<cell >" . trim($row[5]) . "</cell> \n";
    $retVal .= "<cell >" . trim($row[6]) . "</cell> \n";
    $retVal .= "</row>";
}

//Cerra conexiones a base de datos
$database->database_close();


//Concatenar elementos

$retVal = $head . $retVal;


//Retornar respuesta
echo('<?xml version="1.0" encoding="ISO-8859-1"?>');
echo "<rows id='datos'>" . $retVal . "</rows>";
exit;
?>
