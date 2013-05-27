<?php

	header("Content-type: text/xml");

	//Inicia
	include("../../../class/database.class.php");
	include("../../../class/security.class.php");
	
	
	//Activar servicios de seguridad
	$Sec =  new Security_Services;


	$idre = "";
	$user = "";
	$pass = "";
	$date = "";
	$preg = "";
	$resp = "";
	$perf = "";
	$esta = "";
	
	$pKeys = array_keys($_POST);
	$idre = trim($_POST[$pKeys[0]]);
	$user = trim($_POST[$pKeys[1]]);
	$pass = trim($Sec -> Encrypt(trim($_POST[$pKeys[2]])));
	$date = trim($_POST[$pKeys[3]]);
	$preg = trim($_POST[$pKeys[4]]);
	$resp = trim($_POST[$pKeys[5]]);
	$perf = trim($_POST[$pKeys[6]]);
	$esta = trim($_POST[$pKeys[7]]);
	
	
	$execQuery = " Select id_perfil from perfil where perfil = '$perf' ";

	$id_perfil = $database -> database_scalar ($execQuery);
		
		
	$execQuery = "
		
		Update usuarios
		Set nombre_usuario = '$user',
			clave_acceso = '$pass',
			fecha_caducidad = '$date',
			pregunta_secreta = '$preg',
			respuesta_secreta = '$resp',
			id_perfil = $id_perfil,
			estado_usuario = '$esta'
		Where id_usuario = $idre ";
	
	/*
	$fp = fopen("prueba.txt","a");
	fwrite($fp, $execQuery . PHP_EOL );
	fclose($fp);
	*/	  
			 
	$database -> database_query ($execQuery);
		
	
	//Cerramos Conexion
	$database -> database_close();
	
	
	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>Update</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>