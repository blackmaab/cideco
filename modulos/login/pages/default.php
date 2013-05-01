<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CIDECO - Formulario de Acceso</title>

<link href="login-box.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="ReadInfo()">


<div style="padding: 100px 0 0 0;" align="center">


<div id="login-box">

<H2>CIDECO EL SALVADOR</H2>

Acceso a Sistema
<br />
<br />

<div id="login-box-name" style="margin-top:20px;">Usuario:</div><div id="login-box-field" style="margin-top:20px;"><input id="user" name="user" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
<div id="login-box-name">Contraseña:</div><div id="login-box-field"><input id="pass" name="pass" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>

<br />

<span class="login-box-options"><input type="checkbox" id="remember" name="remember" value="0"> Remember Me <a href="#" style="margin-left:30px;">olvide contraseña</a></span>

<br />
<br />

<img src="images/login-btn.png" width="103" height="42" style="margin-left:60px;" onClick="SendData();" />



</div>

</div>


<script type="text/javascript" src = '../scripts/default.js'></script>

</body>
</html>
