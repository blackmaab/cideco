<?php

header("Content-type: text/xml");

//Inicia

include_once("../../../class/Conexion.class.php");
include_once("../../../class/Usuarios.class.php");
include_once("../../../class/security.class.php");
include_once("../../../class/error.class.php");


//Creacion de Objetos y variables

$Sec = new Security_Services;
$Usr = new Usuarios;
$Err = new Error;
$arrayCampos = array();
$arrayValue = array();
$arrayWhere = array();



$msj = 'Update';


// Llenamos las variables	

$pKeys = array_keys($_POST);
$id = trim($_POST[$pKeys[0]]);
$pass = trim($_POST[$pKeys[1]]);




// Establecemos los campos q vamos a actualizar.
$arrayCampos["clave_acceso"] = ":clave_acceso";


// Establecemos los Valores.
$arrayValue[":clave_acceso"] = trim($Sec->Encrypt(trim($pass)));


// Establecemos el Where del Update

$arrayWhere['id_usuario'] = $id;


// Ejecutamos el Metodo Update de la Clase
$Usr->update_Usuarios($arrayCampos, $arrayValue, $arrayWhere);




// Si Hubo Un error lo guardamos
if ($Usr->bandera == 0) {
    $Err->GuardarError('usuarios_update.php', $Usr->mensaje);
    $msj = 'error';
}



//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'></field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>