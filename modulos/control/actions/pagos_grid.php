<?php

// header("Content-type: text/xml");

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


$execQuery = "";
$retVal = "";
$p0 = "";

$p0 = $_GET['p0'];



if ($p0 == '')
{
	$p0 = 'NULL';
}

$execQuery = " Select 
					id_pago,
					fecha,
					mes,
					Monto,
					numero_recibo 
				   
				   From pagos
				   Left Join meses
						On mes_pago = id_mes
				   Where id_donacion = $p0 ";



//consulta a base de datos
$result = $database->database_query($execQuery);



$counter = 0;

//Inicia encabezado
$head = "";

$head .="<head>";
$head .="<column width='0' type='ro' align='left' sort='str'>id_pago</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>Fecha</column> \n";
$head .="<column width='80' type='ro' align='left' sort='str'>Mes</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>Monto</column> \n";
$head .="<column width='100' type='ro' align='left' sort='str'>No Recibo</column> \n";


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
