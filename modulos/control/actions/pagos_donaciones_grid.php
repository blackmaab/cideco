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

$p0= '';

$p0 = $_GET['p0'];


$execQuery = "";
$retVal = "";


if ($p0=='')
	$p0 = 'NULL';


$execQuery = " Select 
				   id_donacion,
				   anio,
				   Monto as MontoMensual,
				   mes,
				   estado_donacion
				   
				   From donacion 
				   Left Join estado_donacion 
						On estado = id_est_donacion
				   Left Join meses
						On mes_inicio = id_mes
						
				   where id_donante = $p0 and estado = 2
        ";



//consulta a base de datos
$result = $database->database_query($execQuery);



$counter = 0;

//Inicia encabezado
$head = "";

$head .="<head>";
$head .="<column width='80' type='ro' align='left' sort='str'>No Donacion</column> \n";
$head .="<column width='60' type='ro' align='left' sort='str'>Anio</column> \n";
$head .="<column width='125' type='ro' align='left' sort='str'>Monto Comprometido</column> \n";
$head .="<column width='80' type='ro' align='left' sort='str'>Mes Inicio</column> \n";
$head .="<column width='60' type='ro' align='left' sort='str'>Estado</column> \n";


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
