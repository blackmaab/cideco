
var loader;

HBI.example.init = function () {

	var bt_getPreg = new HBI.widget.Button({ label:"Obtener Pregunta", id:"btn_get", container:"getPreg", onclick: { fn: GetPregunta } });


} ();


function GetPregunta()
{


	var parameters = ""; 
	parameters = parameters + "?p0=" + document.getElementById("usuario").value;
	
	loader = dhtmlxAjax.post( "../actions/get_pregunta.php",encodeURI(parameters), function(){ReadXml()} );
	
	
}



// funcion para cargar las cookies

function ReadInfo(){

	// leemos las cookies por medio de la funcion readCookie()
	
	var ck1 = readCookie('78582542013');
	var ck2 = readCookie('98652241858');
	var ck3 = readCookie('97545604138');
	
	
	// si las cookies existen se cargan los valores de usuario, password, y remember
	
	if (ck1 != null )
	{
		
		document.getElementById('user').value = ck1;
		
	}
	
	if (ck2 != null )
	{
	
		document.getElementById('pass').value = ck2;
		
	}

	if (ck3 != null )
	{
	
		document.getElementById('remember').checked = ck3;
		
	}	

}


function checkNoChars(evt) {

    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
	if ((charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <= 90)|| (charCode >= 97 && charCode <= 122)) 
	{
        status = "";
        return true;
    }
	else
	{
		status = "Este campo unicamente acepta letras y numeros.";
        return false;
	}

}


function NoPass()
{

	document.getElementById('show').click();
	document.getElementById('usuario').value = document.getElementById('user').value;
	document.getElementById('pregunta').value = '';
	document.getElementById('usuario').focus();

}


// funcion para enviar a la pagina que vefirica el usuario
function SendData()
{


	// guardamos el nombre del "usuario" y el check "recuerdame" en las cookies
	
	createCookie('78582542013',document.getElementById('user').value, 365);
	createCookie('97545604138',document.getElementById('remember').checked, 365);
	
	if (document.getElementById('remember').checked)
	{
	
		// si es remember esta chekeado, se crea una cookies con el password
		createCookie('98652241858',document.getElementById('pass').value, 365);
	
	
	}
	else
	{
		// si no esta chekeado, se borrar las cookies
		eraseCookie('98652241858');
		eraseCookie('97545604138');
	
	}
	

	// se guadan los parametros de usuario y password
	var param = "";
	param = param + "user=" + document.getElementById('user').value;
	param = param + "&pass=" + document.getElementById('pass').value;
	param = param + "&resp=" + document.getElementById('respuesta').value;
	
	
	// se envian los datos para verificacion
	document.location.href = "../actions/default.php?"+param;
	


}





// lectura del xml de respuesta
function ReadXml(){

	
	if ( loader.xmlDoc.responseXML != null && loader.xmlDoc.statusText=='OK' && loader.doSerialization()!='' ) 
	{
		xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async = false;
		xmlDoc.loadXML(loader.doSerialization());
		
		switch(xmlDoc.documentElement.childNodes[0].text)
		{
		
			// si fue un insert
			case "getPregunta":
				
				document.getElementById('pregunta').value = xmlDoc.documentElement.childNodes[1].text
				
			break;
			
			
			default:
			
			
				Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Error en la Base de Datos, Contacte a su Administrado!!!</td></tr></table>");
				Msjbox.show();
			
			break;
		
		}
	}
	else
	{
		// en el caso q haya sucedido un error.
		alert('No se Pudo Realizar la Operacion, Contacte a su Administrador!!!');
  
	}
 
}
			

// funcion para verificar que no hayan caracteres especiales solo acepta numeros y letras

function CheckLetter()
{
	var validchars = "abcdefghijklmnopqrstuvwxyz0123456789."; 
	var contenidousr = theForm.usr.value; 
	//var contenidopwd = theForm.pwd.value;
	  
	for (var i=0; i < contenidousr.length; i++) 
	{ 
		var letter = contenidousr.charAt(i).toLowerCase();
		if (validchars.indexOf(letter) != -1) 
			continue;
		
			alert('Existe Caracteres no Validos');
			
		return(false);
		break;
	}
	
}


// funcion para crear cookie
function createCookie(name,value,days) {

	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
	
}

// funcion para leer cookie
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

// funcion para eliminar cookie
function eraseCookie(name) {
	createCookie(name,"",-1);
}




// Funciones de los Formularios
var Submit = function() { SendData();};
var Cancel = function() { document.getElementById('hide').click();};	


function Init() {

	try
	{
	
	
		// Mensaje Personalizado. ****************************************
		
		Msjbox = new HBI.widget.Panel("panel1", { width:"500px",  visible:false, draggable:true, close:true, modal: true, fixedcenter : true});
		Msjbox.setHeader("Atenci&oacute;n... <br>");
		Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Prueba de Mensaje</td></tr></table>");
		Msjbox.render(document.body);
		
		
		
		// Fromulario Cambio de Contraseña . ************************
		
		FormPass = new HBI.widget.Dialog("NoPass", { width : "500px", fixedcenter : true, visible : false, modal: true, constraintoviewport : true, 
									buttons : [ { text:"Login", handler:Submit, isDefault:true }, { text:"Cancelar", handler:Cancel } ]});
		FormPass.render();
		HBI.util.Event.addListener("show", "click", FormPass.show, FormPass, true);
		HBI.util.Event.addListener("hide", "click", FormPass.hide, FormPass, true);
		
		
	}
	catch(err)
	{

		alert(err.message );
		
	}
	
}
