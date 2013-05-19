<?php

/**
 * Nombre de Archivo: pais_delete.php
 * Fecha Creación: 05-18-2013 
 * Hora: 09:43:32 PM
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
    $obj_banco = new Pais();
    //array del where
    $arrayWhere["id_pais"] = ":id_pais";
    //array de los valores del campo
    $arrayValue[":id_pais"] = $_POST[$array_key[0]];
    $obj_banco->delete_pais($arrayValue, $arrayWhere);

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
