<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/Conexion.class.php");
include("../../../class/Donacion.class.php");
include("../../../class/error.class.php");
//include("../../../class/database.class.php");
//Creacion de Objetos

$Dona = new Donacion;
$Err = new Error;
$arrayCampos = array();
$arrayValue = array();
$arrayWhere = array();


$msj = 'Delete';


// Llenamos las variables	
$pKeys = array_keys($_POST);
$id = trim($_POST[$pKeys[0]]);

// Establecemos los campos q vamos a actualizar.
$arrayCampos["estado"] = ":estado";


// Establecemos los Valores.
$arrayValue[":estado"] = "5";


// Establecemos el Where del Update

$arrayWhere['id_donacion'] = $id;


// Ejecutamos el Metodo Update de la Clase
$Dona->update_Donacion($arrayCampos, $arrayValue, $arrayWhere);


// Si Hubo Un error lo guardamos
if ($Dona->bandera == 0) {
    $Err->GuardarError('solicitud_donante_delete.php', $Dona->mensaje);
    $msj = 'error';
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