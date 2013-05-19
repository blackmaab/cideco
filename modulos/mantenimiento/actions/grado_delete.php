<?php

/**
 * Nombre de Archivo: grado_delete.php
 * Fecha Creación: 05-19-2013 
 * Hora: 02:48:36 AM
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
    //array del where
    $arrayWhere["id_grado"] = ":id_grado";
    //array de los valores del campo
    $arrayValue[":id_grado"] = $_POST[$array_key[0]];
    $obj_grado->delete_Grado($arrayValue, $arrayWhere);

    if ($obj_grado->bandera == 1):
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
