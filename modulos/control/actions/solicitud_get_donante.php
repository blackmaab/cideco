<?php

header("Content-type: text/xml");

//Inicia

include("../../../class/database.class.php");


//Creacion de Objetos

$nit = "";
$data = "";
$msj = "";


// Llenamos las variables

$pKeys = array_keys($_POST);
$nit = trim($_POST[$pKeys[0]]);


$execQuery = " 
				Select 
					   nombres,
					   apellido_pri,
					   apellido_seg,
					   direccion,
					   id_pais,
					   id_municipio,
					   fecha_nacimiento,
					   telefono_casa,
					   telefono_movil,
					   telefono_trabajo,
					   Genero,
					   correo_electronico,
					   id_persona
					   
				from  persona
				Where nit = '$nit'
				 ";

$result = $database->database_query($execQuery);

while ($row = $database->database_array($result)) {
    $data .= "<field id='type'>" . $row[0] . "</field>\n";
    $data .= "<field id='type'>" . $row[1] . "</field>\n";
    $data .= "<field id='type'>" . $row[2] . "</field>\n";
    $data .= "<field id='type'>" . $row[3] . "</field>\n";
    $data .= "<field id='type'>" . $row[4] . "</field>\n";
    $data .= "<field id='type'>" . $row[5] . "</field>\n";
    $data .= "<field id='type'>" . $row[6] . "</field>\n";
    $data .= "<field id='type'>" . $row[7] . "</field>\n";
    $data .= "<field id='type'>" . $row[8] . "</field>\n";
    $data .= "<field id='type'>" . $row[9] . "</field>\n";
    $data .= "<field id='type'>" . $row[10] . "</field>\n";
    $data .= "<field id='type'>" . $row[11] . "</field>\n";
    $data .= "<field id='type'>" . $row[12] . "</field>\n";
    $msj = "1";
}


$database->database_close();


//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>get_donante</field>\n";
$xmlvar .= "<field id='type'>$msj</field>\n";
$xmlvar .= $data;
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>