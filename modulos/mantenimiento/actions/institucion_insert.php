<?php

/**
 * Nombre de Archivo: institucion_insert.php
 * Fecha Creación: 05-19-2013 
 * Hora: 12:55:27 AM
 * @author Mario Alvarado
 */
include_once '../../../class/Conexion.class.php';
include_once '../../../class/InstitucionEducativa.class.php';



header("Content-type: text/xml");
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
if (isset($_POST)):
    $array_key = array_keys($_POST);
    $obj_institucion = new InstitucionEducativa();
    $obj_institucion->nombre_institucion = $_POST[$array_key[0]];
    $obj_institucion->direccion = $_POST[$array_key[1]];
    $obj_institucion->telefono = $_POST[$array_key[2]];
    $obj_institucion->nombre_director = $_POST[$array_key[3]];
    $obj_institucion->insert_InstitucionEducativa();

    if ($obj_institucion->bandera == 1):
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
