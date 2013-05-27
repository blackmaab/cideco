<?php

	header("Content-type: text/xml");

	//Inicia
	include("../../../class/Conexion.class.php");
	include("../../../class/Donacion.class.php");
	include("../../../class/error.class.php");
	
	
	//Creacion de Objetos
	
	$Dona = new Donacion;
	$Err = new Error;
	
	$arrayWhere = array();
	$arrayCampos = array();
	$arrayValue = array();
	

	$msj = 'Estado';
	
	
	// Llenamos las variables
	
	$pKeys = array_keys($_POST);


	
	//ARRAY PARA LOS CAMPOS A ACTUALIZAR
	//=========nombre del campo=====mascara del campo, dicha mascara debe de contener al inicio los dos puntos
	$arrayCampos["estado"] = ":estado";

	//ARRAY PARA EL WHERE
	//=========nombre del campo=====mascara del campo
	$arrayWhere["id_donacion"] = ":id_donacion";

	//ARRAY PARA LOS VALORES DE LOS CAMPOS A ACTUALIZAR y DE LOS WHERE
	//=========nombre de la mascara que anteriormente fue definida  ==== Valor de la mascara
	$arrayValue[":id_donacion"] = trim($_POST[$pKeys[0]]);
	$arrayValue[":estado"] = trim($_POST[$pKeys[1]]);

	// Ejecutamos el Metodo Update de la Clase
	$Dona->update_Donacion($arrayCampos,$arrayValue,$arrayWhere);
	
	
	
	
	// Si Hubo Un error lo guardamos
	if ($Dona->bandera == 0)
	{
		$Err -> GuardarError('control_solicitud_aprobar.php',$Dona->mensaje);
		$msj = 'error';
	}
	
	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>$msj</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>