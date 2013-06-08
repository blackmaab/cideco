
// Variables globales


var mygrid;
var myCalendar;
var loader;

var idReg=0;


function setSens(id, k) {
    // update range
    if (k == "min") {
        myCalendar.setSensitiveRange(byId(id).value, null);
    } else {
        myCalendar.setSensitiveRange(null, byId(id).value);
    }
}
function byId(id) {
    return document.getElementById(id);
}

// funcion para crear el calendario
function doCalendar()
{
    myCalendar = new dhtmlXCalendarObject(["txtFechaIni", "txtFechaFin"]);


}

// Funcion para cargar los datos
function LoadData(){
    
    // primero se muestra el mensaje de "espere"
    MsjWait.show();
    
    // Luego despues de un segundo cargamos el grid
    setTimeout("LoadGrid();", 1000);

}


// Funcion para cargar el grid de datos.

function LoadGrid()
{   
    mygrid = new dhtmlXGridObject('gridbox');
    mygrid.setImagePath("../../../components/grid/imgs/");
    mygrid.init();
    mygrid.setSkin("dhx_skyblue");
    
    // direccion de la pagina que hace el xml de forma dinamica
    mygrid.loadXML("../actions/notas_grid.php?type=load",
        function()
        {            
            // Para agregar los filtros del grid.
            mygrid.attachHeader(",#text_filter,#text_filter,,,,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );
}


function filterGrid()
{   
        
    mygrid = new dhtmlXGridObject('gridbox');
    mygrid.setImagePath("../../../components/grid/imgs/");
    mygrid.init();
    mygrid.setSkin("dhx_skyblue");
    var param="?anio="+document.getElementById("selAnio").value;   
    // direccion de la pagina que hace el xml de forma dinamica
    mygrid.loadXML("../actions/notas_grid.php"+param,
        function()
        {            
            // Para agregar los filtros del grid.
            mygrid.attachHeader(",#text_filter,#text_filter,,,,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );
}

// Funcion para cargar el menu
function doOnLoad() {

    // Creando nuevo objeto
    toolbar = new dhtmlXToolbarObject("toolbarObj");
    // Direccion de iconos
    toolbar.setIconsPath("../../../images/icons/");
    // xml a cargar, este es fijo en la direccion q aparece
    toolbar.loadXML("../../../components/toolbar/Notas_Donante.xml?etc=" + new Date().getTime());
	
	
    // Funcion cuando el usuario da click en el toolbar
    toolbar.attachEvent("onClick", function(id) {
	
        DoEvent(id);
	
    });
}


function DoEvent(data) {
    var param="";
    var fecha_fin="";
    //verificacion del tipo de usuario
    usuario=$('#txtTipoUsuario').val();
    if(usuario==1){ 
        
        var opc= $('#selFiltro').val();        
        switch(opc){
            case '1':
            case '5':
                if($('#txtNombre').val()==""){
                    Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar el campo nombre</td></tr></table>");
                    Msjbox.show();
                    return false;
                }
                if(opc==1){
                    param="?type=alumno&nombre="+$('#txtNombre').val();  
                }else if(opc==5){
                    param="?type=donante&nombre="+$('#txtNombre').val();  
                }
                                
                break;
            case '2':
                param="?type=institucion&id="+$('#selInstitucion').val();                  
                break;
            case '3':
                param="?type=load&anio="+$('#selAnio').val();                  
                break;
            case '4':
                if($('#txtFechaIni').val()==""){
                    Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar al menos la fecha de inicio</td></tr></table>");
                    Msjbox.show();
                    return false;
                }
                fecha_fin=($('#txtFechaFin').val()=="")?$("#txtFechaIni").val():$("#txtFechaFin").val();
                param="?fechaini="+$("#txtFechaIni").val();
                param+="&fechafin="+fecha_fin+"&type=fecha";                
                break;
                       
        }
    }else if(usuario==3){
        param="?type=load&anio="+$('#selAnio').val();             
    }else{
        return false;
    }
console.log(param);
    var url="../actions/notas_export.php"+param;
			
    var window_width = 10;
    var window_height = 10;
    var newfeatures= 'scrollbars=no,resizable=no, menubar=no, toolbar=no';
    var window_top = (screen.height-window_height)/2;
    var window_left = (screen.width-window_width)/2;
    window.open(url, 'titulo','width=' + window_width + ',height=' + window_height + ',top=' + window_top + ',left=' + window_left + ',features=' + newfeatures + '');
		
   
	
}

function init() {
    
    try
    {
        
        // Cargar los Controles.
        
        // Mensaje de Espere. *********************************************
        
        MsjWait = new HBI.widget.Panel("wait", {
            width: "240px", 
            fixedcenter: true, 
            close: false, 
            draggable: false, 
            zindex:4, 
            modal: true, 
            visible: false
        } );
        MsjWait.setHeader("Espere...");
        MsjWait.setBody("<img src=\"../../../images/icons/rel_interstitial_loading.gif\"/>");
        MsjWait.render(document.body);
        
        
        // Mensaje Personalizado. ****************************************
        Msjbox = new HBI.widget.Panel("panel1", {
            width:"500px",  
            visible:false, 
            draggable:true, 
            close:true, 
            modal: true, 
            fixedcenter : true
        });
        Msjbox.setHeader("Atenci&oacute;n... <br>");
        Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Prueba de Mensaje</td></tr></table>");
        Msjbox.render(document.body);
        
        
        
    
    
    
    }
    catch(err)
    {
        
        alert(err.message );
    
    }

}

$(document).ready(function(){
    var filter_Grid_notas=function(param){
        console.log(param);
        mygrid = new dhtmlXGridObject('gridbox');
        mygrid.setImagePath("../../../components/grid/imgs/");
        mygrid.init();
        mygrid.setSkin("dhx_skyblue");   
        // direccion de la pagina que hace el xml de forma dinamica
        mygrid.loadXML("../actions/notas_grid.php"+param,
            function()
            {            
                // Para agregar los filtros del grid.
                mygrid.attachHeader(",#text_filter,#text_filter,,,,");
                // finalizamos el mensaje de espere
                MsjWait.hide();
            }
            );
    }
    
    $('#selFiltro').change(function(){
        var opc=$(this).val();
        switch(opc){
            case '1':
            case '5':
                $('#rowNombre').show();
                $('#rowInstitucion').hide();
                $('#rowAnio').hide();
                $('#rowFecha').hide();
                break;
            case '2':
                $('#rowNombre').hide();
                $('#rowInstitucion').show();
                $('#rowAnio').hide();
                $('#rowFecha').hide();
                break;
            case '3':
                $('#rowNombre').hide();
                $('#rowInstitucion').hide();
                $('#rowAnio').show();
                $('#rowFecha').hide();
                break;
            case '4':
                $('#rowNombre').hide();
                $('#rowInstitucion').hide();
                $('#rowAnio').hide();
                $('#rowFecha').show();
                break;
        }
    });
    
    $('#btnBuscar').click(function(){
        
        var param="";
        var opc= $('#selFiltro').val();        
        switch(opc){
            case '1':
            case '5':
                if($('#txtNombre').val()==""){
                    Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar el campo nombre</td></tr></table>");
                    Msjbox.show();
                    return false;
                }
                if(opc==1){
                    param="?type=alumno&nombre="+$('#txtNombre').val();  
                }else if(opc==5){
                    param="?type=donante&nombre="+$('#txtNombre').val();  
                }
                
                filter_Grid_notas(param);
                break;
            case '2':
                param="?type=institucion&id="+$('#selInstitucion').val();  
                filter_Grid_notas(param);
                break;
            case '3':
                param="?type=load&anio="+$('#selAnio').val();  
                filter_Grid_notas(param);
                break;
            case '4':
                if($('#txtFechaIni').val()==""){
                    Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar al menos la fecha de inicio</td></tr></table>");
                    Msjbox.show();
                    return false;
                }
                var fecha_fin=($('#txtFechaFin').val()=="")?$("#txtFechaIni").val():$("#txtFechaFin").val();
                param="?fechaini="+$("#txtFechaIni").val();
                param+="&fechafin="+fecha_fin+"&type=fecha";
                filter_Grid_notas(param);
                break;
               
        }
    });
});
