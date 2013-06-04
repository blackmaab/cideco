<?php

header("Content-type: text/xml");

//Inicia

include("../../../class/database.class.php");


//Creacion de Objetos

$msj = '';


$msj = 'existe_usuario';

$id_donacion = '';
$id_usuario = '';



// Llenamos las variables

$pKeys = array_keys($_POST);
$id_donacion = trim($_POST[$pKeys[0]]);




$execQuery = " 	Select 
				   id_usuario
			   From donacion a
			   Left Join donante b
					On a.id_donante = b.id_donante
					
			   Where id_donacion = $id_donacion ";


$id_usuario = $database->database_scalar($execQuery);




//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>$msj</field>\n";
$xmlvar .= "<field id='type'>$id_usuario</field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>