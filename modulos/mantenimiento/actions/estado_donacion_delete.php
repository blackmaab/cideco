<?php

/**
 * Nombre de Archivo: estado_donacion_delete.php
 * Fecha Creación: 05-19-2013 
 * Hora: 02:03:13 AM
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
    //array del where
    $arrayWhere["id_est_donacion"] = ":id_est_donacion";
    //array de los valores del campo
    $arrayValue[":id_est_donacion"] = $_POST[$array_key[0]];
    $obj_estado_donacion->delete_EstadoDonacion($arrayValue, $arrayWhere);

    if ($obj_estado_donacion->bandera == 1):
        $xmlvar .= "<field id='type'>Delete</field>\n";
    else:
        $xmlvar .= "<field id='type'>Error Delete</field>\n";
    endif;

else:
    $xmlvar .= "<field id='type'>No se enviaron valores</field>\n";
endif;


$xmlvar .= "</item>";
echo $xmlvar;

?>
