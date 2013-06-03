<?php

	header("Content-type: text/xml");

	//Inicia

	include("../../../class/database.class.php");
	
	
	//Creacion de Objetos
	
	$msj = '';
	

	$msj = 'Update';
	
	$id_persona = '';
	$id_donacion = '';
	$nombres = '';
    $apellido_pri = '';
    $apellido_seg = '';
    $Direccion = '';
    $id_municipio = '';
    $id_pais = '';
    $telefono_casa = '';
    $telefono_movil = '';
    $telefono_trabajo = '';
    $nit = '';
    $fecha_nacimiento = '';
    $Genero = '';
    $correo_electronico = '';
	$anio = '';
	$id_promotor = '';
	$Monto ='';
	$id_tipo_pago = '';
	
	
	// Llenamos las variables
	
	$pKeys = array_keys($_POST);
	$id_donacion = trim($_POST[$pKeys[0]]);
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
	
	
	
	if ($id_municipio=='')
	{
		$id_municipio = 'NULL';
	}
	
	
	$execQuery = " 	Update persona                            

						Set nombres = '$nombres',
							apellido_pri = '$apellido_pri',
							apellido_seg = '$apellido_seg',
							Direccion = '$Direccion',
							id_municipio = $id_municipio,
							id_pais = $id_pais,
							telefono_casa = '$telefono_casa',
							telefono_movil = '$telefono_movil',
							telefono_trabajo = '$telefono_trabajo',
							nit = '$nit',
							fecha_nacimiento = '$fecha_nacimiento',
							Genero = '$Genero',
							correo_electronico ='$correo_electronico'
						 
						 where id_persona = $id_persona ";
						
	
	$database -> database_query ($execQuery);
	

	

	$execQuery = " Update donacion
					   set id_tipo_pago = $id_tipo_pago,
						   id_promotor = $id_promotor,
						   Monto = $Monto
					Where id_donacion =  $id_donacion ";

	
	$database -> database_query ($execQuery);
			


	
	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>$msj</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>