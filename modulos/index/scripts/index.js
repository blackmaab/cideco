

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
		
			document.getElementById('contenido').src = "../../administracion/pages/usuarios.php"
		
		break;
		
		case "ayuda": 
		
			ModalAlert("Secci&oacute;n en Mantenimiento...");
			
		break;
		
		
		case "bugs":
			
			url = "../../bugs/pages/bugreport.php?ids=new";
			OpenWindow(url,'Reporte de Bugs del Sistema.',740,410,40,20);
			
		break;
		case "mapa":
			//Nothing
		break;
		case "cerrar":
			
			document.location.href = "../../login/pages/logout.php?ids=new";
			
		break;
	

	
		case "Dye_Rep1": // Desarrollo de Color por Libras
			  
			  var url="../../dye/actions/rep_desarrollo_colores_lib.php";
		  
			  var window_width = 10;
			  var window_height = 10;
			  var newfeatures= 'scrollbars=no,resizable=no, menubar=no, toolbar=no';
			  var window_top = (screen.height-window_height)/2;
			  var window_left = (screen.width-window_width)/2;
			  window.open(url, 'titulo','width=' + window_width + ',height=' + window_height + ',top=' + window_top + ',left=' + window_left + ',features=' + newfeatures + '');
		
		break;
	

					
		default:
			alert("Seccion en Mantenimiento...(Id Key: <b>"+id+"</b>)");
		break;
		
	}
	
	
	return true;
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
