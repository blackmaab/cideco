<?php

	header("Content-type: text/xml");

	//Inicia

	include("../../../class/database.class.php");
	
	
	//Creacion de Objetos


	$msj = 'Insert';
	
	
	// Llenamos las variables
	
	$pKeys = array_keys($_POST);
    //$Per->id_persona = trim($_POST[$pKeys[0]]);
    $nombres = trim($_POST[$pKeys[1]]);
    $apellido_pri = trim($_POST[$pKeys[2]]);
    $apellido_seg = trim($_POST[$pKeys[3]]);
    $Direccion = trim($_POST[$pKeys[4]]);
    $id_municipio = trim($_POST[$pKeys[5]]);
    $id_pais = trim($_POST[$pKeys[6]]);
    $telefono_casa = trim($_POST[$pKeys[7]]);
    $telefono_movil = trim($_POST[$pKeys[8]]);
    $telefono_trabajo = trim($_POST[$pKeys[9]]);
    $nit = trim($_POST[$pKeys[10]]);
    $fecha_nacimiento = trim($_POST[$pKeys[11]]);
    $Genero = trim($_POST[$pKeys[12]]);
    $correo_electronico = trim($_POST[$pKeys[13]]);
	
	
	$id_tipo_pago = trim($_POST[$pKeys[14]]);
	$Monto = trim($_POST[$pKeys[15]]);
	$id_promotor = trim($_POST[$pKeys[16]]);
	$id_persona = trim($_POST[$pKeys[17]]);
	
	
	
	

	
	
	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>$msj</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>