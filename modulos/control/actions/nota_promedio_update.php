<?php

	header("Content-type: text/xml");

	//Inicia
	include("../../../class/database.class.php");

	
	$id = "";
	$nota = "";
	
	
	$pKeys = array_keys($_POST);
	$id = trim($_POST[$pKeys[0]]);
	$nota = trim($_POST[$pKeys[1]]);

	
	$execQuery = "    

		Update registro_alumno
			   set nota_promedio = $nota
			   where id_registro = $id  ";

	$database -> database_query ($execQuery);
	
	

	
	//Cerramos Conexion
	$database -> database_close();
	
	
	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>cambiar_nota</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>