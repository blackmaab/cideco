<?php

	header("Content-type: text/xml");

	//Inicia
	include("../../../class/database.class.php");


	$selValue = "";
	$retVal = "";
	$execQuery = "";
	
	//$selValue = $_GET['p0'];
	
	$execQuery = " Select id_alumno,CONCAT(nombres,' ',Apellido_pri)
       from alumno a
       Left Join persona b on a.id_persona = b.id_persona ";
			  
			 
	$result = $database -> database_query ($execQuery);
	
	$retVal = "<complete>";
	while($row = $database -> database_array($result))
	{
		if ($selValue == '')
		{
			$retVal .= "<option value='".trim($row[0])."'>".trim($row[1])."</option>";
		}
		else
		{
			if ($selValue == $row[0])
			{
				$retVal .= "<option selected = 'true' value='".trim($row[0])."'>".trim($row[1])."</option>";
			}
			else
			{
				$retVal .= "<option value='".trim($row[0])."'>".trim($row[1])."</option>";
			}
		}
	}

	$retVal .= "</complete>";
	
	$database -> database_freemem($result);
	$database -> database_close();
	
	
	echo('<?xml version="1.0" encoding="ISO-8859-1"?>'); 
	echo $retVal;
	
	exit;

?>