<?php

/**
 * Nombre de Archivo: tipo_pago_update.php
 * Fecha Creación: 05-18-2013 
 * Hora: 11:56:44 PM
 * @author Mario Alvarado
 */
include_once '../../../class/Conexion.class.php';
include_once '../../../class/TipoPago.class.php';



header("Content-type: text/xml");
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
if (isset($_POST)):
    $array_key = array_keys($_POST);
    $obj_tipo_pago = new TipoPago();
    //array de campos a actualizar
    $arrayCampos["descripcion"] = ":descripcion";
    $arrayCampos["meses"] = ":meses";
    $arrayCampos["activo"] = ":activo";
    //array del where 
    $arrayWhere["id_tipo_pago"] = ":id_tipo_pago";
    //array de valores
    $arrayValue[":id_tipo_pago"] = $_POST[$array_key[3]];
    $arrayValue[":descripcion"] = $_POST[$array_key[0]];
    $arrayValue[":meses"] = $_POST[$array_key[1]];
    $arrayValue[":activo"] = $_POST[$array_key[2]];

    $obj_tipo_pago->update_TipoPago($arrayCampos, $arrayValue, $arrayWhere);


    if ($obj_tipo_pago->bandera == 1):
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
