<?php

/**
 * Nombre de Archivo: banco_delete.php
 * Fecha Creación: 05-18-2013 
 * Hora: 03:53:36 PM
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
    //array del where
    $arrayWhere["id_banco"] = ":id_banco";
    //array de los valores del campo
    $arrayValue[":id_banco"] = $_POST[$array_key[0]];
    $obj_banco->delete_Banco($arrayValue, $arrayWhere);

    if ($obj_banco->bandera == 1):
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
