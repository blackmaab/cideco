<?php

header("Content-type: text/xml");

$retVal = "";
$retVal = "<complete>";
$retVal .= "<option value='A'>Activo</option>";
$retVal .= "<option value='I'>Inactivo</option>";
$retVal .= "</complete>";


echo('<?xml version="1.0" encoding="ISO-8859-1"?>');
echo $retVal;

exit;
?>