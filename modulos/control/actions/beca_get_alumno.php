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

				   b.id_alumno,
				   nombres,
				   apellido_pri,
				   apellido_seg,
				   direccion,
				   id_municipio,
				   telefono_casa,
				   telefono_movil,
				   fecha_nacimiento,
				   genero,
				   nie,
				   destacado_en,
				   necesidades_medicas,
				   numero_hermanos,
				   vive_con,
				   grande_quiere_ser,
				   juego_favorito,
				   materia_favorita,
				   ayuda_en_casa
			From beca_escolar  
			Left Join registro_alumno a
				 On id_registro = id_registro_alumno
				 
			Left Join alumno b
				 On   b.id_alumno = a.id_alumno
				 
			left Join persona c
				 On c.id_persona = b.id_persona
				 
			where id_beca = $idre ";

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
    $datos .= "<field id='type'>" . $row[8] . "</field>\n";
    $datos .= "<field id='type'>" . $row[9] . "</field>\n";
    $datos .= "<field id='type'>" . $row[10] . "</field>\n";
    $datos .= "<field id='type'>" . $row[11] . "</field>\n";
    $datos .= "<field id='type'>" . $row[12] . "</field>\n";
    $datos .= "<field id='type'>" . $row[13] . "</field>\n";
    $datos .= "<field id='type'>" . $row[14] . "</field>\n";
    $datos .= "<field id='type'>" . $row[15] . "</field>\n";
    $datos .= "<field id='type'>" . $row[16] . "</field>\n";
    $datos .= "<field id='type'>" . $row[17] . "</field>\n";
    $datos .= "<field id='type'>" . $row[18] . "</field>\n";
}


//Cerramos Conexion
$database->database_close();


//Retornar respuesta XML
$xmlvar = "";
$xmlvar .= "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
$xmlvar .= "<item>\n";
$xmlvar .= "<field id='type'>Get_Alumno</field>\n";
$xmlvar .= $datos;
$xmlvar .= "</item>";

echo $xmlvar;

exit;
?>