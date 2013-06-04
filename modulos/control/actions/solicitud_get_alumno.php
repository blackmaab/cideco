<?php

header("Content-type: text/xml");

//Inicia

include("../../../class/database.class.php");


//Creacion de Objetos

$id = "";
$data = "";
$msj = "";
$id_reg_alumno = "";


// Llenamos las variables

$pKeys = array_keys($_POST);
$id = trim($_POST[$pKeys[0]]);


$execQuery = " 
				Select id_registro
				   From donacion a 
				   Left Join registro_alumno b
						On id_registro_alumno = id_registro
						
				where id_donacion = $id  ";

$id_reg_alumno = $database->database_scalar($execQuery);


$database->database_close();


//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>get_alumno</field>\n";
$xmlvar .= "<field id='type'>$id_reg_alumno </field>\n";
$xmlvar .= $data;
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>