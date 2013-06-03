

function LoadMenu() {
	
    //menu ppal
    menu = new dhtmlXMenuObject("menuObj");
    menu.setSkin("dhx_skyblue");
    menu.setIconsPath("../../../images/icons/");
    // menu.setTopText(document.getElementById("usr").value);
    menu.loadXML("../../../components/menu/menu.xml?e="+new Date().getTime());
    //menu.loadXML("../../../tmp/"+document.getElementById("mnu").value+"?e="+new Date().getTime());
	
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
            alert("Secci&oacute;n en Mantenimiento...(Id Key: <b>"+id+"</b>)");
            break;
		
    }
	
	
    return true;
}
