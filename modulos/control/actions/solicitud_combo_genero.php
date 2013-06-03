<?php

header("Content-type: text/xml");

$selValue = "";
$retVal = "";
$execQuery = "";

$selValue = $_GET['p0'];


$retVal = "<complete>";

if ($selValue == 'M')
    $retVal .= "<option  selected = 'true'  value='M'>Masculino</option>";
else
    $retVal .= "<option value='M'>Masculino</option>";

if ($selValue == 'F')
    $retVal .= "<option selected = 'true' value='F'>Femenino</option>";
else
    $retVal .= "<option value='F'>Femenino</option>";

$retVal .= "</complete>";

echo('<?xml version="1.0" encoding="ISO-8859-1"?>');
echo $retVal;

exit;
?>