<?php

/**
 * Nombre de Archivo: pais_insert.php
 * Fecha Creación: 05-18-2013 
 * Hora: 04:44:37 PM
 * @author Mario Alvarado
 */
include_once '../../../class/Conexion.class.php';
include_once '../../../class/Pais.class.php';


header("Content-type: text/xml");
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
if (isset($_POST)):
    $array_key = array_keys($_POST);
    $obj_pais = new Pais();
    $obj_pais->nombre_pais = $_POST[$array_key[0]];
    $obj_pais->activo = $_POST[$array_key[1]];
    $obj_pais->insert_Pais();

    if ($obj_pais->bandera == 1):
        $xmlvar .= "<field id='type'>Insert</field>\n";
    else:
        $xmlvar .= "<field id='type'>Se produjo un error</field>\n";
    endif;

else:
    $xmlvar .= "<field id='type'>No se enviaron valores</field>\n";
endif;


$xmlvar .= "</item>";
echo $xmlvar;
?>
