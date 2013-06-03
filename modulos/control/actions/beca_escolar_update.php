<?php

	header("Content-type: text/xml");

	//Inicia
	include("../../../class/database.class.php");

	
	$idre = "";
	$id_alumno = "";
	$id_institucion_edu = "";
	$grado = "";
	$id_grado = "";
	$seccion = "";
	$monto = "";
	$comentario = "";
	$estado = "";
	$id_registro = "";
	
	
	$pKeys = array_keys($_POST);
	$idre = trim($_POST[$pKeys[0]]);
	$id_alumno = trim($_POST[$pKeys[1]]);
	$id_institucion_edu = trim($_POST[$pKeys[2]]);
	$id_grado = trim($_POST[$pKeys[3]]);
	$seccion = trim($_POST[$pKeys[4]]);
	$monto = trim($_POST[$pKeys[5]]);
	$comentario = trim($_POST[$pKeys[6]]);
	$estado = trim($_POST[$pKeys[7]]);

	
	
	$execQuery = "
					Update beca_escolar 
					   Set Monto = $monto,
						   comentario = '$comentario',
						   activo = $estado
					   Where id_beca = $idre ";

	$database -> database_query ($execQuery);

	$execQuery = " Select id_registro_alumno from beca_escolar Where id_beca = $idre ";

	$id_registro = $database -> database_scalar ($execQuery);
		
		
		
	$execQuery = "
					Update registro_alumno
					   Set id_alumno = $id_alumno,
						   id_institucion_edu = $id_institucion_edu,
						   id_grado = $id_grado,
						   seccion = '$seccion'
					   Where id_registro = $id_registro ";

	$database -> database_query ($execQuery);		

	$fp = fopen("prueba.txt","a");
	fwrite($fp, $execQuery . PHP_EOL );
	fclose($fp);

	//Cerramos Conexion
	$database -> database_close();
	
	
	//Retornar respuesta XML
	
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>Update_Registro</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>