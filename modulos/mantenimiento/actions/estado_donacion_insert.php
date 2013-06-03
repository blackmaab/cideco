<?php

/**
 * Nombre de Archivo: estado_donacion_insert.php
 * Fecha Creación: 05-19-2013 
 * Hora: 01:51:53 AM
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
    $obj_estado_donacion->estado_donacion = $_POST[$array_key[0]];
    $obj_estado_donacion->activo = $_POST[$array_key[1]];
    $obj_estado_donacion->insert_EstadoDonacion();

    if ($obj_estado_donacion->bandera == 1):
        $xmlvar .= "<field id='type'>Insert</field>\n";
    else:
        $xmlvar .= "<field id='type'>Error Insert</field>\n";
    endif;

else:
    $xmlvar .= "<field id='type'>No se enviaron valores</field>\n";
endif;


$xmlvar .= "</item>";
echo $xmlvar;
?>
