<?php
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	session_name("CIDECO");
	session_start();
	
	$id = session_id();
	
	
	if(!isset($_SESSION['CIDECO']) || $_SESSION['EXPIRE'] == 999) 
	{
	  header ("location: ../../login/pages/default.php"); 
	}
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">
<head>
 <title>CIDECO - Sistema de Gestion de Donaciones</title>
 <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
 <link rel="stylesheet" type="text/css" href="../../../css/style.css" />

  
  <!--[if lt IE 8.]>
<link rel="stylesheet" type="text/css" href="css/style-ie.css" />
<![endif]-->
 <!--[if lt IE 7.]>
<link rel="stylesheet" type="text/css" href="css/style-ie6.css" />
<![endif]-->

<!-- Content Slider -->
<script type="text/javascript" src="../../../js/swfobject/swfobject.js"></script>

<script type="text/javascript">
		var flashvars = {};
		flashvars.xml = "../../../config.xml";
		flashvars.font = "../../../font.swf";
		var attributes = {};
		attributes.wmode = "transparent";
		attributes.id = "slider";
		swfobject.embedSWF("../../../design3edge.swf", "content_slider", "600", "280", "9", "../../../expressInstall.swf", flashvars, attributes);
</script>

<!-- Content Slider -->



</head>

<body onLoad="LoadMenu()">
	
	<!-- Main Body Starts Here -->
	<div id="main_body">

		<!-- Header Starts Here -->
		<div id="header">
			
			<div class="menu">
				<ul>
					<li class="menu_active" ><a href="index.html">HOME</a></li>
					<li><a href="about.html">CONTACTENOS</a></li>
					<li><a href="../../../index.php">SALIR</a></li>
					
				</ul>
			</div>

		</div>

		<div id="content_body">
			<table width="100%">
			<tr>
				<td width="70%">&nbsp;&nbsp; <b>CIDECO - SISTEMA DE GESTION DE DONACIONES </b><td>
				<td width="30%">
					<input type="text" size="40" name="Dte" id="Dte" style="text-align:right;border:none; border-color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px" value=""/>
					<input type="text" size="10" name="Clock" id="Clock" style="text-align:right;border:none; border-color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:10px" value=""/>
				<td>
			</tr>
			</table>
			
			<div id="menuObj"></div>

			<iframe src ="" id="contenido" name="contenido" width="100%" height="450px"  frameborder="0" scrolling="no"> </iframe>

		</div>

		<input type = "hidden" id = "ses" value = "<?php echo $id;?>">
		<input type = "hidden" id = "usrid" value = "<?php echo $_SESSION['USERID'];?>">
		<input type = "hidden" id = "usr" value="<?php echo $_SESSION['USER'];?>">
		<input type = "hidden" id = "mnu" value="<?php echo $_SESSION['MNU'];?>">
		


	<!-- Footer Starts Here -->

		<div id="footer">
			<p id="footer_links">
			<a href="index.html">Home</a> &nbsp;&nbsp; | &nbsp;&nbsp;<a href="about.html">Contactenos</a> &nbsp;&nbsp; | &nbsp;&nbsp; <a href="contact.html">Salir</a>
		</p>

		<!-- Template Copyright -->
		<p id="footer_copyright">
		© All Rights Reserved 2013. Fideco El Salvador
		</p>
		<!-- Template Copyright -->

		</div>
		<!-- Footer Ends Here -->

		<br />
		
	</div>
	
	<script type="text/javascript" src = '../scripts/index.js'></script>

	<!-- Librarys Here -->

	<link rel="stylesheet" type="text/css" href="../../../components/menu/skins/menu_dhx_skyblue.css">
	<script src="../../../components/menu/common.js"></script>
	<script src="../../../components/menu/menu.js"></script>
	<script src="../../../components/menu/menu_ext.js"></script>
	<script src="../../../components/menu/menu_effects.js"></script>
	
	
<script type="text/javascript">
	showTime();
	getToday();
</script>


 </body>
</html>