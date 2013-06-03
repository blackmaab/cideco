<?php

header("Content-type: text/xml");

//Inicia

include("../../../class/database.class.php");



//Creacion de Objetos

$id_donacion = "";
$status = "";
$msj = '';
$execQuery = '';

$msj = 'Estado';


// Llenamos las variables


$pKeys = array_keys($_POST);
$id_donacion = trim($_POST[$pKeys[0]]);
$status = trim($_POST[$pKeys[1]]);


$execQuery = " Update donacion
					   set estado = $status
					   Where id_donacion = $id_donacion ";

$database->database_query($execQuery);




$database->database_close();

//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>$msj</field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>