<?php

/**
 * Nombre de Archivo: estado_donacion_update.php
 * Fecha Creación: 05-19-2013 
 * Hora: 02:00:27 AM
 * @author Mario Alvarado
 */
include_once '../../../class/Conexion.class.php';
include_once '../../../class/EstadoDonacion.class.php';



header("Content-type: text/xml");
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
if (isset($_POST)):
    $array_key = array_keys($_POST);
    $obj_estado_donacion = new EstadoDonacion();
    //array de campos a actualizar
    $arrayCampos["estado_donacion"] = ":estado_donacion";
    $arrayCampos["activo"] = ":activo";
    //array del where 
    $arrayWhere["id_est_donacion"] = ":id_est_donacion";
    //array de valores
    $arrayValue[":id_est_donacion"] = $_POST[$array_key[2]];
    $arrayValue[":estado_donacion"] = $_POST[$array_key[0]];
    $arrayValue[":activo"] = $_POST[$array_key[1]];

    $obj_estado_donacion->update_EstadoDonacion($arrayCampos, $arrayValue, $arrayWhere);


    if ($obj_estado_donacion->bandera == 1):
        $xmlvar .= "<field id='type'>Update</field>\n";
    else:
        $xmlvar .= "<field id='type'>Error Update</field>\n";
    endif;

else:
    $xmlvar .= "<field id='type'>No se enviaron valores</field>\n";
endif;


$xmlvar .= "</item>";
echo $xmlvar;
?>
