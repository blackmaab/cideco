<?php

function OpenDatabase($server, $username, $password, $db)
{
	$myServer = $server;
	$myUser = $username;
	$myPass = $password;
	$myDB = $db; 

	//connection to the database
	$dbhandle = mssql_connect($myServer, $myUser, $myPass)
	or die("Problema conectando el servidor de base de datos"); 

	//select a database to work with
	$selectedDB = mssql_select_db($myDB, $dbhandle)
	or die("No se encuentra la base de datos"); 
	
	return $dbhandle;

}

function getQuery($query)
{
	//execute the SQL query and return records
	$result = mssql_query($query) 
	or die("No se pudo ejecutar la consulta...");
	
	return $result;
}

function closeDatabase($dbhandle)
{
	//close the connection 
	mssql_close($dbhandle);
}

?>