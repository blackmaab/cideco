<?php
	
	header("Content-type: text/xml");
	
	set_time_limit (120);

	//session_name("PLANNING_SYSTEM");
	session_start();
	
	$id = session_id();
	
	
	//Inicia
	include("../../../class/database.class.php");

	
	/*
	$p0 = $_GET['p0'];
	$p1 = $_GET['p1'];
	*/
	$execQuery = "";
	$retVal = ""; 
	
	
	$execQuery = " Select 

				   fecha_creacion,
				   a.id_donacion,
				   estado_donacion,
				   monto,
				   c.nombres,
				   c.apellido_pri,
				   c.apellido_seg,
				   CONCAT(e.nombres , ' ' , e.apellido_pri) As Promotor
					
				   From donacion a
				   Left Join donante b On b.id_donante = a.id_donante
				   Left Join persona c On c.id_persona = b.id_persona
				   Left Join promotor d On a.id_promotor = d.id_promotor
				   Left Join persona e On e.id_persona = b.id_persona
                   Left Join estado_donacion On a.estado = id_est_donacion
				   
				   Where a.estado in(1,5)
        ";
			
			

	//consulta a base de datos
	$result = $database -> database_query ($execQuery);


		
	$counter = 0;
	
	//Inicia encabezado
	$head = "";

	$head .="<head>";
		$head .="<column width='100' type='ro' align='center' sort='str'>Fecha</column> \n";
		$head .="<column width='90' type='ro' align='center' sort='str'>No Solicitud</column> \n";
		$head .="<column width='80' type='ro' align='center' sort='str'>Estado</column> \n";
		$head .="<column width='100' type='ro' align='right' sort='str'>Monto</column> \n";
		$head .="<column width='130' type='ro' align='left' sort='str'>Nombres</column> \n";
		$head .="<column width='100' type='ro' align='left' sort='str'>Primer Apellido</column> \n";
		$head .="<column width='100' type='ro' align='left' sort='str'>Segundo Apellido</column> \n";
		$head .="<column width='130' type='ro' align='left' sort='str'>Promotor</column> \n";
		
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
			$retVal .= "<cell >".trim($row[2])."</cell> \n";
			$retVal .= "<cell >".trim($row[3])."</cell> \n";
			$retVal .= "<cell >".trim($row[4])."</cell> \n";
			$retVal .= "<cell >".trim($row[5])."</cell> \n";
			$retVal .= "<cell >".trim($row[6])."</cell> \n";
			$retVal .= "<cell >".trim($row[7])."</cell> \n";
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
