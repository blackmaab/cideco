<?php

	header("Content-type: text/xml");

	//Inicia
	//include("../../../class/Usuarios.class.php");
	include("../../../class/database.class.php");
	include("../../../class/error.class.php");
	
	
	//Creacion de Objetos y Variables.
	
	//$Sec =  new Security_Services;
	//$Usr = new Usuarios;
	$Err = new Error;
	$msj = 'getPregunta';
	$user = '';

	// Llenamos las variables
	
	$pKeys = array_keys($_POST);
	$user = trim($_POST[$pKeys[0]]);
	
	
	
	$execQuery = " SELECT pregunta_secreta FROM usuarios WHERE nombre_usuario='$user' ";
	$result = $database -> database_query ($execQuery);
	
	while($row = $database -> database_array($result))
	{
		$pregunta = $row[0];
	
	}

	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>$msj</field>\n";
	$xmlvar .= "<field id='type'>$pregunta</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>