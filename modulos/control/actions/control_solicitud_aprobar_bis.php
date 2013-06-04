<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/database.class.php");

$msj = 'Estado_bis';


$execQuery = "";
$id_donacion = "";
$id_registro_alumno = "";


// Llenamos las variables


$pKeys = array_keys($_POST);
$id_donacion = trim($_POST[$pKeys[0]]);
$id_registro_alumno = trim($_POST[$pKeys[1]]);



$execQuery = " 	        
				Select 
				   Count(*) As CountRow
			 from donacion
			 Where id_donante In (
			 
								Select 
									   id_donante
								   From donacion 
										
								   Where id_donacion = $id_donacion
								   
								)
					And id_registro_alumno = $id_registro_alumno 
					And estado = 2 ";


$NumRow = $database->database_scalar($execQuery);


if ($NumRow == 0)
{		

	$execQuery = " 	        
					Update donacion
					   Set id_registro_alumno = $id_registro_alumno,
						   estado = 2
					Where  id_donacion = $id_donacion ";
					


	$database->database_query($execQuery);
	
}


$database->database_close();

//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>$msj</field>\n";
$xmlvar .= "<field id='type'>$NumRow</field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>