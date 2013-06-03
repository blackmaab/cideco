<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/database.class.php");
include("../../../class/security.class.php");


//Activar servicios de seguridad
$Sec = new Security_Services;


$user = "";
$pass = "";
$date = "";
$preg = "";
$resp = "";
$perf = "";
$esta = "";

$pKeys = array_keys($_POST);
$user = trim($_POST[$pKeys[1]]);
$pass = trim($Sec->Encrypt(trim($_POST[$pKeys[2]])));
$date = trim($_POST[$pKeys[3]]);
$preg = trim($_POST[$pKeys[4]]);
$resp = trim($_POST[$pKeys[5]]);
$perf = trim($_POST[$pKeys[6]]);
$esta = trim($_POST[$pKeys[7]]);


$execQuery = " Insert INTO usuarios
					   (nombre_usuario,
						clave_acceso,
						fecha_caducidad,
						pregunta_secreta,
						respuesta_secreta,
						id_perfil,
						estado_usuario)
					Values('$user',
						   '$pass',
						   '$date',
						   '$preg',
						   '$resp',
						    $perf,
						   '$esta') ";


$database->database_query($execQuery);


//Cerramos Conexion
$database->database_close();


//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>Insert</field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>