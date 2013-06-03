<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/database.class.php");


$idreg = "";

$pKeys = array_keys($_POST);
$idreg = trim($_POST[$pKeys[0]]);


$execQuery = "  delete from usuarios where id_usuario = $idreg ";

$database->database_query($execQuery);


//Cerramos Conexion
$database->database_close();


//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>Delete</field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>