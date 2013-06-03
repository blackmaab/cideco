<?php

header("Content-type: text/xml");

//Inicia

include("../../../class/database.class.php");


//Creacion de Objetos


$anio = "";
$msj = "";
$execQuery = "";

$msj = 'Insert';


// Llenamos las variables

$pKeys = array_keys($_POST);

$id_tipo_pago = trim($_POST[$pKeys[14]]);
$Monto = trim($_POST[$pKeys[15]]);
$id_promotor = trim($_POST[$pKeys[16]]);
$id_persona = trim($_POST[$pKeys[17]]);


$execQuery = " Select anio_trans from anio_transacciones where activo = 1 ";
$anio = $database->database_scalar($execQuery);


$execQuery = " select id_donante from donante where id_persona = $id_persona ";
$id_donante = $database->database_scalar($execQuery);


$execQuery = " 	Insert into donacion
				   (anio,id_donante,id_tipo_pago,id_promotor,Monto,fecha_creacion,estado)
				   
				   Values ($anio,$id_donante,$id_tipo_pago,$id_promotor,$Monto,Now(),1) ";

/*
  $fp = fopen("prueba.txt","a");
  fwrite($fp, $execQuery . PHP_EOL );
  fclose($fp);
 */

$database->database_query($execQuery);


//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>$msj</field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>