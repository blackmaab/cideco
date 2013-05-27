<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FUNDACION CIDECO - Formulario de Acceso</title>

<link href="login-box.css" rel="stylesheet" type="text/css" />

<style type="text/css">

	.small  {
		width: 200px;
		padding: 3px 3px 3px 3px;
		border: 1px solid #ddd ;
		background-color:#ffffff;
		
		color: #000000;
	}

	.medium  {
		width: 300px;
		padding: 3px 3px 3px 3px;
		border: 1px solid #ddd ;
		background-color:#ffffff;
		
		color: #000000;
	}


	.yui-button#btn_get button {
		padding-left: 40px;
		background: url(../../../images/icons/shape_square_go.png) 10% 50% no-repeat;
	}
	
</style>

</head>

<body onLoad="ReadInfo();Init();">


<div style="padding: 100px 0 0 0;" align="center">


<div id="login-box">

<H2>CIDECO EL SALVADOR</H2>

Acceso a Sistema
<br />
<br />

<div id="login-box-name" style="margin-top:20px;">Usuario:</div><div id="login-box-field" style="margin-top:20px;"><input id="user" name="user" class="form-login" title="Username" value="" size="30" maxlength="2048" onKeyPress="if (event.keyCode == 13) SendData(); else return checkNoChars(event);" /></div>
<div id="login-box-name">Contraseña:</div><div id="login-box-field"><input id="pass" name="pass" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" onKeyPress="if (event.keyCode == 13) SendData(); else return checkNoChars(event);"  /></div>

<br />

<span class="login-box-options"><input type="checkbox" id="remember" name="remember" value="0"> Remember Me <a href="javascript:NoPass();" style="margin-left:30px;">olvide contraseña</a></span>

<br />
<br />

<img src="images/login-btn.png" width="103" height="42" style="margin-left:0px;" onClick="SendData();" />
<br/>

<?php

if (isset($_GET['err']))
{
	if ($_GET['err']==1)
		echo 'Usuario o Contraseña no valida...';
}
	
?>



</div>

</div>


	<div class="yui-skin-sam">
	
		<div style="visibility:hidden;">
		<button id="show"></button> 
		<button id="hide"></button>
    
		<div id="NoPass" class="yui-pe-content">
		<div class="hd">Olvide Contraseña...</div>
		<div class="bd">
		
		<div class="label">
		
			<table width="100%" style="text-align: left;">
			<tr>
				<td width="2%"></td>
				<td width="20%"></td>
				<td width="20%"></td>
				<td width="58%"></td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					Usuario:
				</td>
				<td>
					<input name="usuario" id="usuario" type="text" class="small" onfocus="jform.col(this);" onKeyPress="return checkNoChars(event);" >
					
				</td>
				<td>
					<div id="getPreg"></div>
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					Pregunta:
				</td>
				<td colspan="2">
					<input name="pregunta" id="pregunta" type="text" class="medium" onfocus="jform.col(this);" onKeyPress="return checkNoChars(event);" >
				</td>
			</tr>
				<tr>
				<td>
					&nbsp;
				</td>
				<td >
					Respuesta:
				</td >
				<td colspan="2">
					<input name="respuesta" id="respuesta" type="text" class="medium" onfocus="jform.col(this);" onKeyPress="return checkNoChars(event);" >
				</td>
			</tr>			
			</table>
		</div>
		</div>
		</div>
		</div>
		
	</div>

	<!-- Componente Formularios, Ventanas y Avisos -->

	<link rel="stylesheet" type="text/css" href="../../../components/build/fonts/fonts-min.css" />
	<link rel="stylesheet" type="text/css" href="../../../components/build/button/assets/skins/sam/button.css" />
	<link rel="stylesheet" type="text/css" href="../../../components/build/container/assets/skins/sam/container.css" />
	<link rel="stylesheet" type="text/css" href="../../../components/build/carousel/assets/skins/sam/carousel.css" />

	<script type="text/javascript" src="../../../components/build/framework-dom-event/framework-dom-event.js"></script>
	<script type="text/javascript" src="../../../components/build/element/element-min.js"></script>
	<script type="text/javascript" src="../../../components/build/button/button-min.js"></script>
	<script type="text/javascript" src="../../../components/build/animation/animation-min.js"></script>
	<script type="text/javascript" src="../../../components/build/dragdrop/dragdrop-min.js"></script>
	<script type="text/javascript" src="../../../components/build/container/container-min.js"></script>
	
	
	<script type="text/javascript" src = '../scripts/default.js'></script>
	<script type="text/javascript" src = '../../../script/functions.fields.js'></script>
	<script type="text/javascript" src = '../../../script/functions.ajax.js'></script>



</body>
</html>
