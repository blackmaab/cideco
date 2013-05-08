<?php

	header("Content-type: text/xml");

	//Inicia
	include("../../../class/Usuarios.class.php");
	include("../../../class/security.class.php");
	include("../../../class/error.class.php");
	
	
	//Creacion de Objetos
	
	$Sec =  new Security_Services;
	$Usr = new Usuarios;
	$Err = new Error;
	$arrayWhere = array();

	$msj = 'Update';
	
	
	// Llenamos las variables
	
	$pKeys = array_keys($_POST);
	$Usr->id_usuario = 		trim($_POST[$pKeys[0]]);
	$Usr->nombre_usuario = 	trim($_POST[$pKeys[1]]);
	$Usr->clave_acceso = 	trim($Sec -> Encrypt(trim($_POST[$pKeys[2]])));
	$Usr->fecha_caducidad = trim($_POST[$pKeys[3]]);
	$Usr->pregunta_secreta = 	trim($_POST[$pKeys[4]]);
	$Usr->respuesta_secreta = 	trim($_POST[$pKeys[5]]);
	$Usr->id_perfil = 		trim($_POST[$pKeys[6]]);
	$Usr->estado_usuario = 	trim($_POST[$pKeys[7]]);

	
	// Establecemos el Where del Update
	
	$arrayWhere['id_usuario'] = trim($_POST[$pKeys[0]]);

	
	// Ejecutamos el Metodo Update de la Clase
	$Usr->update_Usuarios($arrayWhere);
	
	
	
	
	// Si Hubo Un error lo guardamos
	if ($Usr->bandera == 0)
	{
		$Err -> GuardarError('usuarios_update.php',$Usr->mensaje);
		$msj = 'error';
	}
	
	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>$msj</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>