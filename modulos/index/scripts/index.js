
var loader;

function LoadMenu() {
	
	//menu ppal
	menu = new dhtmlXMenuObject("menuObj");
	menu.setSkin("dhx_skyblue");
	menu.setIconsPath("../../../images/icons/");
	menu.setTopText(document.getElementById("usr").value);
	//menu.loadXML("../../../components/menu/menu.xml?e="+new Date().getTime());
	menu.loadXML("../../../tmp/"+document.getElementById("mnu").value+"?e="+new Date().getTime());
	
	menu.attachEvent("onClick", menuClick);
	
	/*
	//menu logout
	menu = new dhtmlXMenuObject("menuObj2");
	menu.setIconsPath("../../../images/icons/");
	
	menu.loadXML("../../../components/menu/menu2.xml?e="+new Date().getTime());
	menu.attachEvent("onClick", menuClick);
	*/

}


function menuClick(id) {
	
	switch(id)
	{
		
		//-------------------
		//menu Sistema
		//-------------------
		
		
		case "Ad_Usuarios":
		
			document.getElementById('contenido').src = "../../administracion/pages/usuarios.php";
		
		break;
		
		
		
		case "Ad_Cambiar":
			
			document.getElementById('contenido').src = "";
			document.getElementById('pass_show').click();
			document.getElementById('contrasena').focus();

			
		break;
		
		
		case "Ad_Salir":
		
			document.location.href = "../../login/pages/logout.php";
			
		break;
		
		
		
		case "Ctr_Solicitud":
		
			document.getElementById('contenido').src = "../../control/pages/solicitud_donante.php";
		
		break;		
		
		
		case "Ctr_Donaciones":
		
			document.getElementById('contenido').src = "../../control/pages/donacion.php";
		
		break;		


		case "Ctr_Becas":
		
			document.getElementById('contenido').src = "../../control/pages/beca_escolar.php";
		
		break;	

		
		case "Ctr_Pagos":
		
			document.getElementById('contenido').src = "../../control/pages/pagos_donacion.php";
		
		break;	
		

		case "Ctr_Alumno":
		
			document.getElementById('contenido').src = "../../control/pages/registro_alumno.php";
		
		break;				
		
		
		case "Ctr_Notas":
		
			document.getElementById('contenido').src = "../../control/pages/nota_promedio.php";
		
		break;	
		
		
		
		
		
		// Mantenimiento.
		
		
		case "Man_Tipo_Beca":
		
			document.getElementById('contenido').src = "../../mantenimiento/pages/tipo_beca.php";
		
		break;	
		
		
		case "Man_Tipo_Donacion":
		
			document.getElementById('contenido').src = "../../mantenimiento/pages/tipo_donacion.php";
		
		break;	
		
		case "Man_Tipo_Pago":
		
			document.getElementById('contenido').src = "../../mantenimiento/pages/tipo_pago.php";
		
		break;			
		

		
		case "Man_Institucion":
		
			document.getElementById('contenido').src = "../../mantenimiento/pages/institucion.php";
		
		break;
		
		
		case "Man_Bancos":
		
			document.getElementById('contenido').src = "../../mantenimiento/pages/bancos.php";
		
		break;


		case "Man_Pais":
		
			document.getElementById('contenido').src = "../../mantenimiento/pages/pais.php";
		
		break;			
		
		
                case "Con_Donaciones":
                    document.getElementById('contenido').src = "../../consulta/pages/donaciones.php";
                break
                
                
                case "Con_Becas":
                    document.getElementById('contenido').src = "../../consulta/pages/becas.php";
                break
                
                case "Con_Notas":
                    document.getElementById('contenido').src = "../../consulta/pages/notas.php";
                break;
		/*
		case "ayuda": 
		
			ModalAlert("Secci&oacute;n en Mantenimiento...");
			
		break;
		
		
		case "bugs":
			
			url = "../../bugs/pages/bugreport.php?ids=new";
			OpenWindow(url,'Reporte de Bugs del Sistema.',740,410,40,20);
			
		break;

		
		case "Dye_Rep1": // 
			  
			  var url="../../dye/actions/rep_desarrollo_colores_lib.php";
		  
			  var window_width = 10;
			  var window_height = 10;
			  var newfeatures= 'scrollbars=no,resizable=no, menubar=no, toolbar=no';
			  var window_top = (screen.height-window_height)/2;
			  var window_left = (screen.width-window_width)/2;
			  window.open(url, 'titulo','width=' + window_width + ',height=' + window_height + ',top=' + window_top + ',left=' + window_left + ',features=' + newfeatures + '');
		
		break;
	
	*/
					
		default:
			alert("Seccion en Mantenimiento...(Id Key: <b>"+id+"</b>)");
		break;
		
	}
	
	
	return true;
}



function ChangePass()
{


	

	var contr = document.getElementById("contrasena").value;
	var confr = document.getElementById("confirmar").value;

	
	if (contr!='')
	{
		if (contr == confr)
		{
		
			
			var parameters = ""; 
			parameters = parameters + "?p0=" + document.getElementById("usrid").value;
			parameters = parameters + "&p1=" + document.getElementById("contrasena").value;
	
			

			loader = dhtmlxAjax.post( "../../Administracion/actions/cambiar_password.php",encodeURI(parameters), function(){ReadXml()} );
		
		
		}
		else
		{
		
			Msjbox.setBody("<table ><tr><td><img src='../../../images/icons/close.gif' align='left'></td><td>&nbsp;&nbsp;Los Campos deben ser Iguales</td></tr></table>");
			Msjbox.show();
		
		}
	}
	else
	{
			Msjbox.setBody("<table ><tr><td><img src='../../../images/icons/close.gif' align='left'></td><td>&nbsp;&nbsp;Debe llenar el campo Contrase&ntilde;a</td></tr></table>");
			Msjbox.show();
	
		
	}


}




// lectura del xml de respuesta
function ReadXml(){

	// alert(loader.doSerialization());
	
	if ( loader.xmlDoc.responseXML != null && loader.xmlDoc.statusText=='OK' && loader.doSerialization()!='' ) 
	{
		xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async = false;
		xmlDoc.loadXML(loader.doSerialization());
		
		switch(xmlDoc.documentElement.childNodes[0].text)
		{
		
			// si fue un insert
			case "Update":

				document.getElementById('pass_hide').click();
				
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



function showTime(){

	var Digital=new Date();
	var hours=Digital.getHours();
	var minutes=Digital.getMinutes();
	var seconds=Digital.getSeconds();
	var dn="AM" ;
	if (hours>12){
	dn="PM";
	hours=hours-12;
	}
	if (hours==0)
	hours=12;
	if (minutes<=9)
	minutes="0"+minutes;
	if (seconds<=9)
	seconds="0"+seconds;

	document.getElementById("Clock").value = hours+":"+minutes+":" +seconds+" "+dn;

	setTimeout("showTime(); getToday();",1000);

}

function getToday()
{
	 calendar = new Date();
	 day = calendar.getDay();
	 month = calendar.getMonth();
	 date = calendar.getDate();
	 year = calendar.getYear();
	 if (year < 1000)
	 year+=1900;
	 cent = parseInt(year/100);
	 g = year % 19;
	 k = parseInt((cent - 17)/25);
	 i = (cent - parseInt(cent/4) - parseInt((cent - k)/3) + 19*g + 15) % 30;
	 i = i - parseInt(i/28)*(1 - parseInt(i/28)*parseInt(29/(i+1))*parseInt((21-g)/11));
	 j = (year + parseInt(year/4) + i + 2 - cent + parseInt(cent/4)) % 7;
	 l = i - j;
	 emonth = 3 + parseInt((l + 40)/44);
	 edate = l + 28 - 31*parseInt((emonth/4));
	 emonth--;
	 var dayname = new Array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
	 var monthname = 
	 new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" );
	 
	 var tmpVar;
	 if (date< 10) tmpVar = "0" + date + ", ";
		 else tmpVar = date + ", ";
	 
	 var Hoy = dayname[day] + ", " + monthname[month] + " " + tmpVar + year + ", ";

	document.getElementById("Dte").value = Hoy;
	

}






// Funciones de los Formularios
var Pass_Submit = function() { ChangePass();};
var Pass_Cancel = function() { document.getElementById('pass_hide').click();};	


function Init() {

	try
	{
	
		// Mensaje Personalizado. ****************************************
	
		Msjbox = new HBI.widget.Panel("panel1", { width:"300px",  visible:false, draggable:true, close:true, modal: true, fixedcenter : true});
		Msjbox.setHeader("Atenci&oacute;n... <br>");
		Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Prueba de Mensaje</td></tr></table>");
		Msjbox.render(document.body);	
		
		// Fromulario Cambio de Contrase�a . ************************
		
		FormPass = new HBI.widget.Dialog("RegPass", { width : "23em", fixedcenter : true, visible : false, modal: true, constraintoviewport : true, 
									buttons : [ { text:"Cambiar", handler:Pass_Submit, isDefault:true }, { text:"Cancelar", handler:Pass_Cancel } ]});
		FormPass.render();
		HBI.util.Event.addListener("pass_show", "click", FormPass.show, FormPass, true);
		HBI.util.Event.addListener("pass_hide", "click", FormPass.hide, FormPass, true);
		
		
	}
	catch(err)
	{

		alert(err.message );
		
	}
	
}
