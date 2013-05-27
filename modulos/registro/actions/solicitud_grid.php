<?php
	
	header("Content-type: text/xml");
	
	set_time_limit (120);

	//session_name("PLANNING_SYSTEM");
	session_start();
	
	$id = session_id();
	
	/*
	if(!isset($_SESSION['PLANNING_SYSTEM']) || $_SESSION['EXPIRE'] == 999) 
	{
	  header ("location: ../../login/pages/default.php"); 
	}
	*/
	
	//Inicia
	include("../../../class/database.class.php");
	include("../../../class/security.class.php");
	
	
	//Activar servicios de seguridad
	$Sec =  new Security_Services;
	
	/*
	$p0 = $_GET['p0'];
	$p1 = $_GET['p1'];
*/
	$execQuery = "";
	$retVal = ""; 
	
	
	$execQuery = " Select 
					   fecha_creacion,
					   a.estado,
					   a.id_donacion,
					   b.id_donante,
					   c.id_persona,
					   monto,
					   c.nombres,
					   c.apellido_pri,
					   c.apellido_seg,
					   e.nombres + ' ' + e.apellido_pri As Promotor
						
					   From donacion a
					   Left Join donante b On b.id_donante = a.id_donante
					   Left Join persona c On c.id_persona = b.id_persona
					   Left Join promotor d On a.id_promotor = d.id_promotor
					   Left Join persona e On e.id_persona = b.id_persona ";
			
			

	//consulta a base de datos
	$result = $database -> database_query ($execQuery);


		
	$counter = 0;
	
	//Inicia encabezado
	$head = "";

	$head .="<head>";
		$head .="<column width='0' type='ro' align='left' sort='str'></column> \n";
		$head .="<column width='100' type='ro' align='left' sort='str'>Usuario</column> \n";
		$head .="<column width='0' type='ro' align='left' sort='str'>Contrase�a</column> \n";
		$head .="<column width='120' type='ro' align='left' sort='str'>Contrase�a</column> \n";
		$head .="<column width='100' type='ro' align='center' sort='str'>Fecha Caducidad</column> \n";
		$head .="<column width='180' type='ro' align='left' sort='str'>Pregunta Secreta</column> \n";
		$head .="<column width='180' type='ro' align='left' sort='str'>Respuesta Secreta</column> \n";
		$head .="<column width='80' type='ro' align='left' sort='str'>Tipo Usuario</column> \n";
		$head .="<column width='80' type='ro' align='center' sort='str'>Status</column> \n";
		$head .="<column width='0' type='ro' align='center' sort='str'>id perfil</column> \n";
		
		$head .="<settings> \n";
		    $head .="<colwidth>px</colwidth> \n";
		$head .="</settings> \n";
		
		$head .="</head> \n";

	//Cierra encabezado
	
	
	//Bucle para armar la tabla a mostrar
	while($row = $database -> database_array($result))
	{	
	
		$counter++;

			$retVal .= "<row id='$counter'> \n"; 
			$retVal .= "<cell >".trim($row[0])."</cell> \n";
			$retVal .= "<cell >".trim($row[1])."</cell> \n";
			$retVal .= "<cell >".trim($Sec -> Decrypt($row[2]))."</cell> \n";
			$retVal .= "<cell >".trim($row[2])."</cell> \n";
			$retVal .= "<cell >".trim($row[3])."</cell> \n";
			$retVal .= "<cell >".trim($row[4])."</cell> \n";
			$retVal .= "<cell >".trim($row[5])."</cell> \n";
			$retVal .= "<cell >".trim($row[6])."</cell> \n";
			$retVal .= "<cell >".trim($row[7])."</cell> \n";
			$retVal .= "<cell >".trim($row[8])."</cell> \n";
			$retVal .= "</row>";

	}
	
	//Cerra conexiones a base de datos
	$database -> database_close();


	//Concatenar elementos
	
	$retVal = $head.$retVal;
	
	
	//Retornar respuesta
	echo('<?xml version="1.0" encoding="ISO-8859-1"?>'); 
	echo "<rows id='datos'>".$retVal."</rows>";
	exit;
	
?>
