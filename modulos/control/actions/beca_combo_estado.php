<?php

header("Content-type: text/xml");

$selValue = "";
$retVal = "";

$selValue = $_GET['p0'];


$retVal = "<complete>";
if ($selValue == '1')
    $retVal .= "<option selected = 'true' value='1'>Activa</option>";
else
    $retVal .= "<option value='1'>Activa</option>";

if ($selValue == '0')
    $retVal .= "<option selected = 'true' value='0'>Inactiva</option>";
else
    $retVal .= "<option value='0'>Inactiva</option>";

$retVal .= "</complete>";



echo('<?xml version="1.0" encoding="ISO-8859-1"?>');
echo $retVal;

exit;
?>