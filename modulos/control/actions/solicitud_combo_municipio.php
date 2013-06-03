<?php

header("Content-type: text/xml");

//Inicia
include("../../../class/database.class.php");


$selValue = "";
$retVal = "";
$execQuery = "";

$selValue = $_GET['p0'];

$execQuery = " Select id_municipio,municipio
						from municipio a
						inner join departamento b
							  On a.id_departamento = b.id_departamento
						Where id_pais = $selValue and
						a.activo = 1 and b.activo = 1 order by municipio ";


$result = $database->database_query($execQuery);

$retVal = "<complete>";
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