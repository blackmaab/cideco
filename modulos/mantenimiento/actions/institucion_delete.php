<?php

/**
 * Nombre de Archivo: institucion_delete.php
 * Fecha Creación: 05-19-2013 
 * Hora: 01:32:36 AM
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
    //array del where
    $arrayWhere["id_institucion"] = ":id_institucion";
    //array de los valores del campo
    $arrayValue[":id_institucion"] = $_POST[$array_key[0]];
    $obj_institucion->delete_InstitucionEducativa($arrayValue, $arrayWhere);

    if ($obj_institucion->bandera == 1):
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
