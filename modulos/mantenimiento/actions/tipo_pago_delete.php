<?php

/**
 * Nombre de Archivo: tipo_pago_delete.php
 * Fecha Creación: 05-19-2013 
 * Hora: 12:06:12 AM
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
    //array del where
    $arrayWhere["id_tipo_pago"] = ":id_tipo_pago";
    //array de los valores del campo
    $arrayValue[":id_tipo_pago"] = $_POST[$array_key[0]];
    $obj_tipo_pago->delete_TipoPago($arrayValue, $arrayWhere);

    if ($obj_tipo_pago->bandera == 1):
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
