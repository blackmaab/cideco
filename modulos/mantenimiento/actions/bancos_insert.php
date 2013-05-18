<?php

/**
 * Nombre de Archivo: usuarios_insert.php
 * Fecha Creación: 05-17-2013 
 * Hora: 10:29:58 PM
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
    $obj_banco->nombre_banco = $_POST[$array_key[0]];
    $obj_banco->activo = $_POST[$array_key[1]];
    $obj_banco->insert_Banco();

    if ($obj_banco->bandera == 1):
        $xmlvar .= "<field id='type'>Insert</field>\n";
    else:
        $xmlvar .= "<field id='type'>Se produjo un error</field>\n";
    endif;

else:
    $xmlvar .= "<field id='type'>No se enviaron valores</field>\n";
endif;


$xmlvar .= "</item>";
echo $xmlvar;
?>
