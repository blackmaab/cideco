<?php

/**
 * Nombre de Archivo: grado_update.php
 * Fecha Creación: 05-19-2013 
 * Hora: 02:47:02 AM
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
    //array de campos a actualizar
    $arrayCampos["grado"] = ":grado";
    $arrayCampos["activo"] = ":activo";
    //array del where 
    $arrayWhere["id_grado"] = ":id_grado";
    //array de valores
    $arrayValue[":id_grado"] = $_POST[$array_key[2]];
    $arrayValue[":grado"] = $_POST[$array_key[0]];
    $arrayValue[":activo"] = $_POST[$array_key[1]];

    $obj_grado->update_Grado($arrayCampos, $arrayValue, $arrayWhere);


    if ($obj_grado->bandera == 1):
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
