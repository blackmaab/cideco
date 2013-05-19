<?php

/**
 * Nombre de Archivo: tipo_pago_insert.php
 * Fecha Creación: 05-18-2013 
 * Hora: 11:18:09 PM
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
    $obj_tipo_pago->descripcion = $_POST[$array_key[0]];
    $obj_tipo_pago->meses = $_POST[$array_key[1]];
    $obj_tipo_pago->activo = $_POST[$array_key[2]];
    $obj_tipo_pago->insert_TipoPago();

    if ($obj_tipo_pago->bandera == 1):
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
