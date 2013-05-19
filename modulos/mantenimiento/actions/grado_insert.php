<?php

/**
 * Nombre de Archivo: grado_insert.php
 * Fecha Creación: 05-19-2013 
 * Hora: 02:45:44 AM
 * @author Mario Alvarado
 */
include_once '../../../class/Conexion.class.php';
include_once '../../../class/Grado.class.php';


header("Content-type: text/xml");
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
if (isset($_POST)):
    $array_key = array_keys($_POST);
    $obj_grado = new Grado();
    $obj_grado->grado = $_POST[$array_key[0]];
    $obj_grado->activo = $_POST[$array_key[1]];
    $obj_grado->insert_Grado();

    if ($obj_grado->bandera == 1):
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
