<?php

	//Pagina para verificar el usuario y password valido
	
	header ("Cache-control: private");
	
	
	// Creamos la session CIDECO
	
	session_name("CIDECO");
	session_start();
	$id = session_id();
	
	if(!isset($_SESSION['CIDECO']) || $_SESSION['EXPIRE'] == 999) 
	{
	  header ("location: ../../login/pages/default.php"); 
	}
	
	//ini_set('display_errors','0');

	
	include("../../../class/database.class.php");
	include "../../../class/security.class.php";
	
	$usr = "";
	$pwd = "";

	//Activar servicios de seguridad
	$security_services =  new Security_Services;

	//Se ha accesado desde la pagina Login
	$usr =$_GET['user'];
	$pwd = $security_services -> Encrypt($_GET['pass']);
	$res =$_GET['resp'];
	
	
	$RedirectPage = "";
	$LogonTxt = "";
	$mnuID = "";
	$mnuID = "";

	$ip=$_SERVER['REMOTE_ADDR'];
	$host = gethostbyaddr($ip);
	
	//Procedimiento Almacenado para chequeo de usuarios
	//Inicializar Procedimiento Almacenado
	$execQuery = "
						Select 
							   id_usuario,
							   nombre_usuario,
							   a.id_perfil,
							   perfil,
							   menu

						From usuarios a
						LEFT Join perfil b On  a.id_perfil = b.id_perfil

						Where nombre_usuario = '$usr' And (clave_acceso = '$pwd' Or respuesta_secreta = '$res') And estado_usuario = 'A'";



	//Ejecutar
	$result = $database -> database_query ($execQuery);

	$CountRecords = 0;

	
	while($row = $database -> database_array($result))
	{
		//Usuario es correcto
		
		$CountRecords++;
		
		$_SESSION['CIDECO']=true;
		$_SESSION['USERID']=$row[0]; //usr_id
		$_SESSION['USER']=$usr;
		$_SESSION['PWD']=$pwd;
		$_SESSION['SES'] = $id;
		$_SESSION['IP'] = $host;
		$_SESSION['EXPIRE'] =1000;
		
		$menu = $row[4];
		

  
	}
	
	if ($CountRecords > 0)
	{	//Sesion Exitosa
		
		//Enviar a Indice
		
		LoadMenu($id, $menu);
		$RedirectPage = "../../index/pages/index.php?ses=".$id."&sh=1";

	}
	else
	{	
		//Session fallida
		$_SESSION['CIDECO']=true;
		$_SESSION['USERID']=$row[0]; //usr_id
		$_SESSION['USER']=$usr;
		$_SESSION['PWD']=$pwd;
		$_SESSION['SES'] = $id;
		$_SESSION['IP'] = $host;
		$_SESSION['EXPIRE'] =999;
		
		$mnuID = $row[4];
		
		$RedirectPage = "../pages/default.php?err=1";
		
	}

	//cerra conexiones
	$database -> database_freemem($result);
	$database -> database_close();
	
	//Enviar a la pagina indice 
	header ("location: $RedirectPage");

	
	
	exit;

//Fin de Login
//---------------------------------------------------------


//Cargar opciones del menu
function LoadMenu($ses, $menu)
{
	
	$_SESSION['MNU'] = $ses.".xml";

	$handle = fopen("../../../tmp/".$_SESSION['MNU'], "w");
	fwrite($handle, $menu);
	fclose($handle);
	
}

?>