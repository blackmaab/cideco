<?php

/**
 * Nombre de Archivo: banco_update.php
 * Fecha Creación: 05-18-2013 
 * Hora: 03:40:20 PM
 * @author Mario Alvarado
 */
include_once '../../../class/Conexion.class.php';
include_once '../../../class/Banco.class.php';



header("Content-type: text/xml");
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
if (isset($_POST)):
    $array_key = array_keys($_POST);
    $obj_banco = new Banco();
    //array de campos a actualizar
    $arrayCampos["nombre_banco"] = ":nombre_banco";
    $arrayCampos["activo"] = ":activo";
    //array del where 
    $arrayWhere["id_banco"] = ":id_banco";
    //array de valores
    $arrayValue[":id_banco"] = $_POST[$array_key[2]];
    $arrayValue[":nombre_banco"] = $_POST[$array_key[0]];
    $arrayValue[":activo"] = $_POST[$array_key[1]];

    $obj_banco->update_Banco($arrayCampos, $arrayValue, $arrayWhere);


    if ($obj_banco->bandera == 1):
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
