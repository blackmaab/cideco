
// Variables globales

var toolbar;
var mygrid;
var myCalendar;
var loader;

var idReg=0;

// Funcion para cargar el menu
function doOnLoad() {
    
    // Creando nuevo objeto
    toolbar = new dhtmlXToolbarObject("toolbarObj");
    // Direccion de iconos
    toolbar.setIconsPath("../../../images/icons/");
    // xml a cargar, este es fijo en la direccion q aparece
    toolbar.loadXML("../../../components/toolbar/Mantenimiento_bancos.xml?etc=" + new Date().getTime());
    
    
    // Funcion cuando el usuario da click en el toolbar
    toolbar.attachEvent("onClick", function(id) {
        
        DoEvent(id);
    
    });
}


// Eventos al dar click en el toolbar
function DoEvent(data) {
    
    
    switch(data)
    {
        
        case "new":
            idReg=0;
            ClearParam()
            document.getElementById('frm_show').click();
            document.getElementById('tipo_pago').focus();
            break;

        case "edit":
                    
            if(mygrid.getSelectedId())
            {
                LoadParam();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }
                    
            break;		
                
        case "delete":
                    
            if(mygrid.getSelectedId())
            {
                idReg = mygrid.cells(mygrid.getSelectedId(),0).getValue();
                document.getElementById('msj_show').click();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }		
                    
                    
            break;
        //        
        //        case "export":
        //                    
        //            var url="../actions/usuarios_export.php";
        //                    
        //            var window_width = 10;
        //            var window_height = 10;
        //            var newfeatures= 'scrollbars=no,resizable=no, menubar=no, toolbar=no';
        //            var window_top = (screen.height-window_height)/2;
        //            var window_left = (screen.width-window_width)/2;
        //            window.open(url, 'titulo','width=' + window_width + ',height=' + window_height + ',top=' + window_top + ',left=' + window_left + ',features=' + newfeatures + '');
        //                    
        //            break;
        
        default:
            alert('Opcion aun en desarrollo.... ' + data);
            break;
    
    }

}


// funcion para crear el calendario
function doCalendar()
{
    
    myCalendar = new dhtmlXCalendarObject(["fechacad"]);

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
    mygrid.loadXML("../actions/bancos_grid.php",
        function()
        {            
            // Para agregar los filtros del grid.
            mygrid.attachHeader(",#text_filter,,#text_filter,,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );



}


// funcion q carga los combos. perfil y estatus


var estado;




// funcion para guardar los registros
var mensaje_error;
function SaveData()
{
 
    try
    {
        
        // verificamos q los parametros obligatorios esten llenos
        if(CheckParam())
        {
            
            // guardamos los parametros en un arreglo post  
            var valor=0;
            var parameters="?p0="+document.getElementById('tipo_pago').value;            
            if(document.getElementById('rd_si').checked==true){
                valor=1;
            }
            parameters+="&p1="+valor;
            if (idReg==0)
            {
                // si es nuevo entra aqui
                
                
                loader = dhtmlxAjax.post( "../actions/bancos_insert.php",encodeURI(parameters), function(){
                    ReadXml()                    
                } );
            }
            else
            {
                // si es un update entra aqui               
                parameters+="&p2="+idReg;
                loader = dhtmlxAjax.post( "../actions/bancos_update.php",encodeURI(parameters), function(){
                    ReadXml()
                } );               
            }
        
        }
        else
        {
            
            // mensaje de llenar los campos obligatorios
            Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;"+mensaje_error+"</td></tr></table>");
            Msjbox.show();
        
        }
    
    }
    catch(err)
    {
        
        alert(err.message );
    
    }



}



// Campos Obligatorios.

function CheckParam()
{
    var Val = true
    var dato=document.getElementById('tipo_pago').value;
    if(dato==""){
        Val=false;
        mensaje_error="Debe llenar los campos Obligatorios";
    }
    if(dato!=""){
        patron=/^([A-Za-zñÑáéíóúÁÉÍÓÚ]{2})+([A-Za-zñÑáéíóúÁÉÍÓÚ\s ]{1,})$/;
        if(!patron.test(dato)){
            Val=false;
            mensaje_error="En el campo: Nombre Banco solo se permiten letras";
        }
    }
        
    return Val;

}


// Catgando los campos del grid hacia las cajas del formulario
function LoadParam()
{
    
    // limpiamos las cajas
    ClearParam();
    
    // llenamos las cajas
    idReg = mygrid.cells(mygrid.getSelectedId(),0).getValue();    
    document.getElementById('tipo_pago').value=mygrid.cells(mygrid.getSelectedId(),1).getValue();
    
    if(mygrid.cells(mygrid.getSelectedId(),2).getValue()=="Si"){
        document.getElementById('rd_si').checked=true;
    }else{
        document.getElementById('rd_no').checked=true;
    }    
    document.getElementById('frm_show').click();

}


// funcion para limpiar las cajas

function ClearParam(){

    document.getElementById('tipo_pago').value="";
    document.getElementById('rd_si').check=true;
}


// funcion para eliminar un registro
function DeleteData()
{
    
    
    var parameters = ""; 
    parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),0).getValue();
    
    if (idReg>0)
    {
        loader = dhtmlxAjax.post( "../actions/bancos_delete.php",encodeURI(parameters), function(){
            ReadXml()
        } );
    }

}



// lectura del xml de respuesta
function ReadXml(){
    
    //alert(loader.doSerialization());
    if ( loader.xmlDoc.responseXML != null && loader.xmlDoc.statusText=='OK' && loader.doSerialization()!='' ) 
    {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = false;
        xmlDoc.loadXML(loader.doSerialization());
        
        switch(xmlDoc.documentElement.childNodes[0].text)
        {
            
            // si fue un insert
            case "Insert":
                
                MsjWait.show();
                document.getElementById('frm_hide').click();
                LoadGrid();
                
                ClearParam();
                break;
            
            
            // si fue un update
            case "Update":
                
                
                MsjWait.show();
                document.getElementById('frm_hide').click();
                LoadGrid();
                
                
                break;
            
            
            // si fue un delete
            case "Delete":
                
                
                MsjWait.show();
                document.getElementById('msj_hide').click();
                LoadGrid();
                
                
                break;
                
            case "Error Update":
            case "Error Insert":
                alert("Compruebe que los datos ingresados son los correctos");
                break;
                
            case "Error Delete":
                alert("Compruebe que no existan datos que dependan de este registro");
                break;
        
        }
    }
    else
    {
        // en el caso q haya sucedido un error.
        alert('No se Pudo Realizar la Operacion, Contacte a su Administrador!!!');
    
    }

}




//HBI.namespace("classPopup.container");
//HBI.namespace("classes.container");


// Funciones de los Formularios
var RegNew_Submit = function() {
    SaveData();
};
var RegNew_Cancel = function() {
    document.getElementById('frm_hide').click();
};	

var RegDel_Submit = function() {
    DeleteData();
};
var RegDel_Cancel = function() {
    document.getElementById('msj_hide').click();
};	


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
        
        
        // Fromulario de Nuevo Registro y Edicion. ************************
        
        FormRegistro = new HBI.widget.Dialog("RegNew", {
            width : "35em", 
            fixedcenter : true, 
            visible : false, 
            modal: true, 
            constraintoviewport : true, 
            buttons : [ {
                text:"Aceptar", 
                handler:RegNew_Submit, 
                isDefault:true
            }, {
                text:"Cancelar", 
                handler:RegNew_Cancel
            } ]
        });
        FormRegistro.render();
        HBI.util.Event.addListener("frm_show", "click", FormRegistro.show, FormRegistro, true);
        HBI.util.Event.addListener("frm_hide", "click", FormRegistro.hide, FormRegistro, true);
        
        
        // Mensaje de Eliminar Registro. **********************************
        MsjDelete = new HBI.widget.Dialog("RegDel", {
            width : "35em", 
            fixedcenter : true, 
            visible : false, 
            modal: true, 
            constraintoviewport : true, 
            buttons : [ {
                text:"Aceptar", 
                handler:RegDel_Submit, 
                isDefault:true
            }, {
                text:"Cancelar", 
                handler:RegDel_Cancel
            } ]
        });
        MsjDelete.render();
        HBI.util.Event.addListener("msj_show", "click", MsjDelete.show, MsjDelete, true);
        HBI.util.Event.addListener("msj_hide", "click", MsjDelete.hide, MsjDelete, true);
    
    
    
    }
    catch(err)
    {
        
        alert(err.message );
    
    }

}
