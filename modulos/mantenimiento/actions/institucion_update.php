<?php

/**
 * Nombre de Archivo: institucion_update.php
 * Fecha Creación: 05-19-2013 
 * Hora: 01:21:31 AM
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
    //array de campos a actualizar
    $arrayCampos["nombre_institucion"] = ":nombre_institucion";
    $arrayCampos["direccion"] = ":direccion";
    $arrayCampos["telefono"] = ":telefono";
    $arrayCampos["nombre_director"] = ":nombre_director";
    //array del where 
    $arrayWhere["id_institucion"] = ":id_institucion";
    //array de valores
    $arrayValue[":id_institucion"] = $_POST[$array_key[4]];
    $arrayValue[":nombre_institucion"] = $_POST[$array_key[0]];
    $arrayValue[":direccion"] = $_POST[$array_key[1]];
    $arrayValue[":telefono"] = $_POST[$array_key[2]];
    $arrayValue[":nombre_director"] = $_POST[$array_key[3]];

    $obj_institucion->update_InstitucionEducativa($arrayCampos, $arrayValue, $arrayWhere);


    if ($obj_institucion->bandera == 1):
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
