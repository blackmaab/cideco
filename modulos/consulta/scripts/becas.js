
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
    mygrid.loadXML("../actions/becas_grid.php",
        function()
        {            
            // Para agregar los filtros del grid.
            mygrid.attachHeader(",#text_filter,");
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
    var param="?fechaini="+document.getElementById("txtFechaIni").value;
    param+="&fechafin="+document.getElementById("txtFechaFin").value;
    // direccion de la pagina que hace el xml de forma dinamica
    mygrid.loadXML("../actions/becas_grid.php"+param,
        function()
        {            
            // Para agregar los filtros del grid.
            mygrid.attachHeader(",#text_filter,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );
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
