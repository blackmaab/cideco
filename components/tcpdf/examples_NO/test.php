<?php
	function testQuery($query,$name)
	{
		$name = str_replace (".txt",".sql",$name);
		$dataWrite=$query;
		$file = fopen("$name","w+");
		fwrite($file, $dataWrite);
		fclose($file);
	}
	
	function testQueryW($query,$name)
	{
		$name = str_replace (".txt",".sql",$name);
		$dataWrite=$query;
		$file = fopen("$name","a+");
		fwrite($file, $dataWrite);
		fclose($file);
	}
?>