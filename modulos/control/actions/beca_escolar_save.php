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
					Insert Into registro_alumno
					   (id_alumno,id_institucion_edu,id_grado,seccion,fecha_creacion)
					   Values ($id_alumno,$id_institucion_edu,$id_grado,'$seccion',Now()) ";

	$database -> database_query ($execQuery);


	$execQuery = " Select Max(id_registro) as Id from registro_alumno       ";

	$id_registro = $database -> database_scalar ($execQuery);
		
		
		
	$execQuery = "
				       Insert Into beca_escolar    
							(id_registro_alumno,Monto,fecha_inicio_beca,fecha_fin_beca,comentario,activo)
							
							Values($id_registro,$monto,'2013-01-01','2013-12-31','$comentario',1) ";

	$database -> database_query ($execQuery);		



	//Cerramos Conexion
	$database -> database_close();
	
	
	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>Insert_Registro</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>