<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/database.class.php");


$selValue = "";
$retVal = "";
$execQuery = "";

$selValue = $_GET['p0'];

$execQuery = " 
					Select id_alumno as Id,              
					   concat(nombres,' ',apellido_pri,' ',apellido_seg) as Alumno
					   From alumno a
					   Left Join persona b
							On b.id_persona = a.id_persona ";


$result = $database->database_query($execQuery);

$retVal = "<complete>";

$retVal .= "<option value='-1'>(Nuevo)</option>";

while ($row = $database->database_array($result)) {
    if ($selValue == '') {
        $retVal .= "<option value='" . trim($row[0]) . "'>" . trim($row[1]) . "</option>";
    } else {
        if ($selValue == $row[0]) {
            $retVal .= "<option selected = 'true' value='" . trim($row[0]) . "'>" . trim($row[1]) . "</option>";
        } else {
            $retVal .= "<option value='" . trim($row[0]) . "'>" . trim($row[1]) . "</option>";
        }
    }
}

$retVal .= "</complete>";

$database->database_freemem($result);
$database->database_close();


echo('<?xml version="1.0" encoding="ISO-8859-1"?>');
echo $retVal;

exit;
?>