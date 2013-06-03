<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/Conexion.class.php");
include("../../../class/Donacion.class.php");
include("../../../class/Donante.class.php");
include("../../../class/Usuarios.class.php");
include("../../../class/error.class.php");
include("../../../class/database.class.php");
include("../../../class/security.class.php");



//Creacion de Objetos


$Usua = new Usuarios;
$Dona = new Donacion;
$Err = new Error;
$Donante = new Donante;
$Sec = new Security_Services;

$arrayWhere = array();
$arrayCampos = array();
$arrayValue = array();


$msj = 'Estado';


$fecha = date("Y-m-d H:i:s");
$execQuery = "";
$id_donacion = "";
$usuario = "";
$password = "";

$id_usuario = "";
$id_donante = "";
$id_registro_alumno = "";


// Llenamos las variables


$pKeys = array_keys($_POST);
$id_donacion = trim($_POST[$pKeys[0]]);
$usuario = trim($_POST[$pKeys[1]]);
$password = trim($Sec->Encrypt(trim($_POST[$pKeys[2]])));
$id_registro_alumno = trim($_POST[$pKeys[3]]);



$Usua->nombre_usuario = $usuario;
$Usua->clave_acceso = $password;
$Usua->fecha_caducidad = $fecha;
$Usua->pregunta_secreta = "";
$Usua->respuesta_secreta = "";
$Usua->id_perfil = "3";
$Usua->estado_usuario = "A";


$Usua->insert_Usuarios();


if ($Usua->bandera == 0) {
    $Err->GuardarError('usuarios_update.php', $Usua->mensaje);
    $msj = 'error';
} else {

    $execQuery = " Select MAX(id_usuario) as Id From usuarios ";
    $id_usuario = $database->database_scalar($execQuery);


    $execQuery = " Select id_donante From donacion where id_donacion = $id_donacion ";
    $id_donante = $database->database_scalar($execQuery);



    //ARRAY PARA LOS CAMPOS A ACTUALIZAR
    //=========nombre del campo=====mascara del campo, dicha mascara debe de contener al inicio los dos puntos
    $arrayCampos["id_usuario"] = ":id_usuario";

    //ARRAY PARA EL WHERE
    //=========nombre del campo=====mascara del campo
    $arrayWhere["id_donante"] = ":id_donante";

    //ARRAY PARA LOS VALORES DE LOS CAMPOS A ACTUALIZAR y DE LOS WHERE
    //=========nombre de la mascara que anteriormente fue definida  ==== Valor de la mascara
    $arrayValue[":id_donante"] = $id_donante;
    $arrayValue[":id_usuario"] = $id_usuario;

    // Ejecutamos el Metodo Update de la Clase
    $Donante->update_Donante($arrayCampos, $arrayValue, $arrayWhere);


    // Si Hubo Un error lo guardamos
    if ($Donante->bandera == 0) {
        $Err->GuardarError('control_solicitud_aprobar.php', $Donante->mensaje);
        $msj = 'error';
    } else {


        $arrayWhere = array();
        $arrayCampos = array();
        $arrayValue = array();


        //ARRAY PARA LOS CAMPOS A ACTUALIZAR
        //=========nombre del campo=====mascara del campo, dicha mascara debe de contener al inicio los dos puntos
        $arrayCampos["estado"] = ":estado";
        $arrayCampos["id_registro_alumno"] = ":id_registro_alumno";

        //ARRAY PARA EL WHERE
        //=========nombre del campo=====mascara del campo
        $arrayWhere["id_donacion"] = ":id_donacion";


        //ARRAY PARA LOS VALORES DE LOS CAMPOS A ACTUALIZAR y DE LOS WHERE
        //=========nombre de la mascara que anteriormente fue definida  ==== Valor de la mascara
        $arrayValue[":id_donacion"] = $id_donacion;
        $arrayValue[":id_registro_alumno"] = $id_registro_alumno;
        $arrayValue[":estado"] = 2;

        // Ejecutamos el Metodo Update de la Clase
        $Dona->update_Donacion($arrayCampos, $arrayValue, $arrayWhere);


        // Si Hubo Un error lo guardamos
        if ($Dona->bandera == 0) {
            $Err->GuardarError('control_solicitud_aprobar.php', $Dona->mensaje);
            $msj = 'error';
        }
    }
}


$database->database_close();

//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>$msj</field>\n";
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>