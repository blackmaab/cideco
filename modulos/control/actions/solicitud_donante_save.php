<?php

	header("Content-type: text/xml");

	//Inicia
	include("../../../class/Conexion.class.php");
	include("../../../class/Persona.class.php");
	include("../../../class/Donante.class.php");
	include("../../../class/Donacion.class.php");
	include("../../../class/error.class.php");
	include("../../../class/database.class.php");
	
	
	//Creacion de Objetos
	
	$Per = new Persona;
	$Don = new Donante;
	$Dona = new Donacion;
	$Err = new Error;

	$msj = 'Insert';
	
	
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
	
	
	// Llenamos las variables
	
	$pKeys = array_keys($_POST);
    //$Per->id_persona = trim($_POST[$pKeys[0]]);
    $Per->nombres = trim($_POST[$pKeys[1]]);
    $Per->apellido_pri = trim($_POST[$pKeys[2]]);
    $Per->apellido_seg = trim($_POST[$pKeys[3]]);
    $Per->Direccion = trim($_POST[$pKeys[4]]);
    $Per->id_municipio = trim($_POST[$pKeys[5]]);
    $Per->id_pais = trim($_POST[$pKeys[6]]);
    $Per->telefono_casa = trim($_POST[$pKeys[7]]);
    $Per->telefono_movil = trim($_POST[$pKeys[8]]);
    $Per->telefono_trabajo = trim($_POST[$pKeys[9]]);
    $Per->nit = trim($_POST[$pKeys[10]]);
    $Per->fecha_nacimiento = trim($_POST[$pKeys[11]]);
    $Per->Genero = trim($_POST[$pKeys[12]]);
    $Per->correo_electronico = trim($_POST[$pKeys[13]]);
	
	
	$Dona -> id_tipo_pago = trim($_POST[$pKeys[14]]);
	$Dona -> Monto = trim($_POST[$pKeys[15]]);
	$Dona -> id_promotor = trim($_POST[$pKeys[16]]);
	
	
	// Ejecutamos el Metodo Insert de la Clase
	//$Per->insert_Persona();
	
	
	// Si Hubo Un error lo guardamos
	/*
	if ($Per->bandera == 0)
	{
		$Err -> GuardarError('solicitud_donante_save.php',$Per->mensaje);
		$msj = 'error';
	}
	else
	{
	*/
	
	/*
	$Per->nombres = trim($_POST[$pKeys[1]]);
    $Per->apellido_pri = trim($_POST[$pKeys[2]]);
    $Per->apellido_seg = trim($_POST[$pKeys[3]]);
    $Per->Direccion = trim($_POST[$pKeys[4]]);
    $Per->id_municipio = trim($_POST[$pKeys[5]]);
    $Per->id_pais = trim($_POST[$pKeys[6]]);
    $Per->telefono_casa = trim($_POST[$pKeys[7]]);
    $Per->telefono_movil = trim($_POST[$pKeys[8]]);
    $Per->telefono_trabajo = trim($_POST[$pKeys[9]]);
    $Per->nit = trim($_POST[$pKeys[10]]);
    $Per->fecha_nacimiento = trim($_POST[$pKeys[11]]);
    $Per->Genero = trim($_POST[$pKeys[12]]);
    $Per->correo_electronico = trim($_POST[$pKeys[13]]);
	*/
	
	
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
	
	
	if ($id_municipio=='')
	{
		$id_municipio = 'NULL';
	}
	
	
	$execQuery = " 	Insert into persona
					   (nombres,apellido_pri,apellido_seg,Direccion,id_municipio,id_pais,telefono_casa,
						telefono_movil,telefono_trabajo,nit,fecha_nacimiento,Genero,correo_electronico)
						
						Values ('$nombres','$apellido_pri','$apellido_seg','$Direccion',$id_municipio,
								$id_pais,'$telefono_casa','$telefono_movil','$telefono_trabajo','$nit','$fecha_nacimiento',
								'$Genero','$correo_electronico') ";
						
	$database -> database_query ($execQuery);
	
	
		$execQuery = " Select Max(id_persona) from persona ";
		
		/*
		$Don->id_persona = $database -> database_scalar ($execQuery);
		$Don->estado = "1";
		$Don->id_usuario = "NULL";
		
		$Don->insert_Donante();
		*/
		
		
		$id_persona = $database -> database_scalar ($execQuery);
		$execQuery = " INSERT INTO donante (id_usuario,id_persona,estado) VALUES(NULL,$id_persona,1) ";
		$database -> database_query ($execQuery);
		$Don->bandera = 1;

		
		
		if ($Don->bandera == 0)
		{
			$Err -> GuardarError('solicitud_donante_save.php',$Don->mensaje);
			$msj = 'error';
		}
		else
		{
		
			$execQuery = " Select max(id_donante) From donante ";
			$Dona->id_donante = $database -> database_scalar ($execQuery);
			
			/*
			$Dona->id_registro_alumno = "NULL";
			$Dona->fecha_creacion = "NOW()";
			$Dona->estado = "1";
			
			$Dona->insert_Donacion();
						
			if ($Dona->bandera == 0)
			{
				$Err -> GuardarError('solicitud_donante_save.php',$Dona->mensaje);
				$msj = 'error';
			}
			*/
			

			$id_donante = $Dona->id_donante;
			$id_tipo_pago = $Dona -> id_tipo_pago;
			$id_promotor = $Dona -> id_promotor;
			$Monto = $Dona -> Monto;
			
			$execQuery = " Select anio_trans from anio_transacciones where activo = 1 ";
			$anio = $database -> database_scalar ($execQuery);

			
			$execQuery = " INSERT INTO donacion 
								(anio,id_donante,id_tipo_pago,id_promotor,id_registro_alumno,Monto,fecha_creacion,estado)
								VALUES($anio,$id_donante,$id_tipo_pago,$id_promotor,NULL,$Monto,Now(),1) ";
								
			$database -> database_query ($execQuery);
			

		//}

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