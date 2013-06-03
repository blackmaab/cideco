<?php

/**
 * Nombre de Archivo: pais_update.php
 * Fecha Creación: 05-18-2013 
 * Hora: 05:14:16 PM
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
    //array de campos a actualizar
    $arrayCampos["nombre_pais"] = ":nombre_pais";
    $arrayCampos["activo"] = ":activo";
    //array del where 
    $arrayWhere["id_pais"] = ":id_pais";
    //array de valores
    $arrayValue[":id_pais"] = $_POST[$array_key[2]];
    $arrayValue[":nombre_pais"] = $_POST[$array_key[0]];
    $arrayValue[":activo"] = $_POST[$array_key[1]];

    $obj_pais->update_Pais($arrayCampos, $arrayValue, $arrayWhere);


    if ($obj_pais->bandera == 1):
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
