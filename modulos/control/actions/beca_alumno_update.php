<?php

	header("Content-type: text/xml");

	//Inicia
	include("../../../class/database.class.php");

	
	$idre = "";
	$nombres = "";
	$apellido_pri = "";
	$apellido_seg = "";
	$direccion = "";
	$id_municipio = "";
	$telefono_casa = "";
	$telefono_movil = "";
	$nit = "";
    $fecha_nacimiento = "";
	$genero = "";
	$id_persona = "";
	$nie = "";
	$destacado_en = "";
	$necesidades_medicas = "";
	$numero_hermanos = "";
	$vive_con = "";
	$grande_quiere_ser = "";
    $juego_favorito = "";
	$materia_favorita = "";
	$ayuda_en_casa = "";
	$fecha_creacion	 = "";
	
	
	$pKeys = array_keys($_POST);
	$idre = trim($_POST[$pKeys[0]]);
	$nombres = trim($_POST[$pKeys[1]]);
	$apellido_pri = trim($_POST[$pKeys[2]]);
	$apellido_seg = trim($_POST[$pKeys[3]]);
	$direccion = trim($_POST[$pKeys[4]]);
	$id_municipio = trim($_POST[$pKeys[5]]);
	$telefono_casa = trim($_POST[$pKeys[6]]);
	$telefono_movil = trim($_POST[$pKeys[7]]);
	$nit = '0000-000000-000-0';
    $fecha_nacimiento = trim($_POST[$pKeys[8]]);
	$genero = trim($_POST[$pKeys[9]]);
	$nie = trim($_POST[$pKeys[10]]);
	$destacado_en = trim($_POST[$pKeys[11]]);
	$necesidades_medicas = trim($_POST[$pKeys[12]]);
	$numero_hermanos = trim($_POST[$pKeys[13]]);
	$vive_con = trim($_POST[$pKeys[14]]);
	$grande_quiere_ser = trim($_POST[$pKeys[15]]);
    $juego_favorito = trim($_POST[$pKeys[16]]);
	$materia_favorita = trim($_POST[$pKeys[17]]);
	$ayuda_en_casa = trim($_POST[$pKeys[18]]);
	
	
	$execQuery = "
					Update alumno
						   Set nie = $nie,
							   destacado_en = '$destacado_en',
							   necesidades_medicas = '$necesidades_medicas',
							   numero_hermanos = $numero_hermanos,
							   vive_con = '$vive_con',
							   grande_quiere_ser = '$grande_quiere_ser',
							   juego_favorito = '$juego_favorito',
							   materia_favorita = '$materia_favorita',
							   ayuda_en_casa = '$ayuda_en_casa'
					Where id_alumno = $idre ";

	$database -> database_query ($execQuery);
	
	$execQuery = " Select id_persona From alumno where  id_alumno = $idre ";

	$id_persona = $database -> database_scalar ($execQuery);
		
		
		
	$execQuery = "
				Update persona             
					   Set nombres = '$nombres',
						   apellido_pri = '$apellido_pri',
						   apellido_seg = '$apellido_seg',
						   direccion = '$direccion',
						   id_municipio = $id_municipio,
						   telefono_casa = '$telefono_casa',
						   telefono_movil = '$telefono_movil',
						   fecha_nacimiento = '$fecha_nacimiento',
						   genero = '$genero'
						   
				Where id_persona = $id_persona ";

				
	$database -> database_query ($execQuery);		


	
	//Cerramos Conexion
	$database -> database_close();
	
	
	//Retornar respuesta XML
	$xmlvar = "";
	$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
	$xmlvar .= "<item>\n";
   	$xmlvar .= "<field id='type'>Update_Alumno</field>\n";
	$xmlvar .= "</item>";
	
	echo $xmlvar;
	
	exit;

?>