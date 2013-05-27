<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FUNDACION CIDECO - Formulario de Acceso</title>

<link href="login-box.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="ReadInfo()">


<div style="padding: 100px 0 0 0;" align="center">


<div id="login-box">


<div id="login-box-name" style="margin-top:20px;">Usuario:</div><div id="login-box-field" style="margin-top:15px;"><input id="user" name="user" class="form-login" title="Username" value="" size="30" maxlength="2048" onKeyPress="if (event.keyCode == 13) SendData(); else return checkNoChars(event);" /></div>
<div id="login-box-name" style="margin-top:20px;">Usuario:</div><div id="login-box-field" style="margin-top:15px;"><input id="user" name="user" class="form-login" title="Username" value="" size="30" maxlength="2048" onKeyPress="if (event.keyCode == 13) SendData(); else return checkNoChars(event);" /></div>

<div id="login-box-name" style="margin-top:20px;">Pregunta:</div><div id="login-box-field" style="margin-top:15px;"><input id="user" name="user" class="form-login" title="Username" value="" size="30" maxlength="2048" onKeyPress="if (event.keyCode == 13) SendData(); else return checkNoChars(event);" /></div>
<div id="login-box-name" style="margin-top:20px;">Respuesta:</div><div id="login-box-field" style="margin-top:15px;"><input id="user" name="user" class="form-login" title="Username" value="" size="50" maxlength="2048" onKeyPress="if (event.keyCode == 13) SendData(); else return checkNoChars(event);" /></div>

<img src="images/login-btn.png" width="103" height="42" style="margin-left:60px;" onClick="SendData();" />



</div>

</div>


<script type="text/javascript" src = '../scripts/default.js'></script>

</body>
</html>
