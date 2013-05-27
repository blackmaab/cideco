<?php


	session_name("CIDECO");
	session_start();
	
	$id = session_id();
	
	
	if(!isset($_SESSION['CIDECO'])) 
	{
	  header ("location: ../../login/pages/default.php"); 
	}
	
	session_unset();
	session_destroy(); 
	
	/*bye...--------------------*/


	header ("location: default.php");
	
?>