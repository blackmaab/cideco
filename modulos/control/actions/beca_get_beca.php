<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/database.class.php");


$idre = "";
$datos = "";

$pKeys = array_keys($_POST);
$idre = trim($_POST[$pKeys[0]]);


$execQuery = "    
			Select 
				  id_beca,
				  b.id_alumno,
				  b.id_institucion_edu,
				  b.id_grado,
				  seccion,
				  monto,
				  comentario,
				  activo
			From beca_escolar  a
			Left Join registro_alumno b
				 On id_registro = id_registro_alumno
				 
			Left Join alumno c
				 On   c.id_alumno = b.id_alumno
				 
			where id_beca = $idre    ";

$result = $database->database_query($execQuery);

while ($row = $database->database_array($result)) {

    $datos = "";
    $datos .= "<field id='type'>" . $row[0] . "</field>\n";
    $datos .= "<field id='type'>" . $row[1] . "</field>\n";
    $datos .= "<field id='type'>" . $row[2] . "</field>\n";
    $datos .= "<field id='type'>" . $row[3] . "</field>\n";
    $datos .= "<field id='type'>" . $row[4] . "</field>\n";
    $datos .= "<field id='type'>" . $row[5] . "</field>\n";
    $datos .= "<field id='type'>" . $row[6] . "</field>\n";
    $datos .= "<field id='type'>" . $row[7] . "</field>\n";
}


//Cerramos Conexion
$database->database_close();


//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>Get_Beca</field>\n";
$xmlvar .= $datos;
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>