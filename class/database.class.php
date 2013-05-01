<?php
	ini_set('session.gc_maxlifetime',60*180);
	ini_set('session.gc_probability',1);
	ini_set('session.gc_divisor',1);
	
	//Db
	include "../../../class/config.class.php";
	include("../../../class/mysql.class.php");
	include("../../../class/params.class.php");
	

	$database = new database_mysql($dbhost, $dbuser, $dbpass, $dbname);
	$services =  new Query_Services();
	
?>