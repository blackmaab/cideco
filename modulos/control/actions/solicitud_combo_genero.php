<?php

	header("Content-type: text/xml");

	$selValue = "";
	$retVal = "";
	$execQuery = "";
	
	$retVal = "<complete>";
	$retVal .= "<option value='M'>Masculino</option>";
	$retVal .= "<option value='F'>Femenino</option>";
	$retVal .= "</complete>";
	
	echo('<?xml version="1.0" encoding="ISO-8859-1"?>'); 
	echo $retVal;
	
	exit;

?>