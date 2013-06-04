
// Variables globales

var toolbar;
var toolbar1;
var mygrid;
var mygrid1;
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
    toolbar.loadXML("../../../components/toolbar/Control_Pagos_Detalle.xml?etc=" + new Date().getTime());
	
	
    // Funcion cuando el usuario da click en el toolbar
    toolbar.attachEvent("onClick", function(id) {
	
        DoEvent(id);
	
    });
	
	// Segundo Toolbar
	
	toolbar2 = new dhtmlXToolbarObject("toolbarObj1");
    toolbar2.setIconsPath("../../../images/icons/");
    toolbar2.loadXML("../../../components/toolbar/Pago_Donacion.xml?etc=" + new Date().getTime());	
	
}


// Eventos al dar click en el toolbar
function DoEvent(data) {
	
	
    switch(data)
    {
	
	
	
		case "add":
		
			if (mygrid1.getSelectedId())
			{
				idReg=0;
				ClearParam()
				document.getElementById('frm_show').click();
				document.getElementById('fecha').focus();
			}
			else
			{
				Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar una Donacion</td></tr></table>");
                Msjbox.show();
			}
			
		break;
			
        case "edit":
		
		/*
            idReg=0;
            ClearParam()
            document.getElementById('frm_show').click();
            document.getElementById('fecha').focus();
		*/
            break;
		
		
        case "dona":

            document.location.href = "pagos_donacion.php";
			
            break;
		
		
        case "save":
		
            SaveData();
            //Msjbox.show();
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
                document.getElementById('msj_show').click();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }		

            break;
		
        case "export":
		
            var url="../actions/usuarios_export.php";
			
            var window_width = 10;
            var window_height = 10;
            var newfeatures= 'scrollbars=no,resizable=no, menubar=no, toolbar=no';
            var window_top = (screen.height-window_height)/2;
            var window_left = (screen.width-window_width)/2;
            window.open(url, 'titulo','width=' + window_width + ',height=' + window_height + ',top=' + window_top + ',left=' + window_left + ',features=' + newfeatures + '');
		
            break;
		
        default:
            alert('Opcion aun en desarrollo.... ' + data);
            break;
		
    }
	
}


// funcion para crear el calendario
function doCalendar()
{

    myCalendar = new dhtmlXCalendarObject(["fecha"]);

}

// Funcion para cargar los datos
function LoadData(){

    // primero se muestra el mensaje de "espere"
    MsjWait.show();
	
    // Luego despues de un segundo cargamos el grid
    setTimeout("LoadGridDonaciones();LoadGrid();", 1000);

}


// Funcion para cargar el grid de datos.

function LoadGrid()
{

	var valor = '';
	
    mygrid = new dhtmlXGridObject('gridbox');
    mygrid.setImagePath("../../../components/grid/imgs/");
    mygrid.init();
    mygrid.setSkin("dhx_skyblue");

    // direccion de la pagina que hace el xml de forma dinamica
	if (mygrid1.getSelectedId())
	{
		valor = mygrid1.cells(mygrid1.getSelectedId(),0).getValue();
	}
	
    mygrid.loadXML("../actions/pagos_grid.php?p0=" + valor,
        function()
        {
            // Para agregar los filtros del grid.
            //mygrid.attachHeader(",,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );
	
	
	
}


function LoadGridDonaciones()
{

    mygrid1 = new dhtmlXGridObject('gridbox_dona');
    mygrid1.setImagePath("../../../components/grid/imgs/");
    mygrid1.init();
    mygrid1.setSkin("dhx_skyblue");

	mygrid1.attachEvent("onRowSelect",function(rowId,columnIndex){LoadGrid();})

	
    // direccion de la pagina que hace el xml de forma dinamica
    mygrid1.loadXML("../actions/pagos_donaciones_grid.php?p0=" + donante.getSelectedValue(),
        function()
        {
            // Para agregar los filtros del grid.
            // mygrid.attachHeader(",,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );

}





// funcion q carga los combos. perfil y estatus


var donante;
var mes;
	



function LoadCombos()
{

    // directorio de las imagenes del combo (no tocar)
    window.dhx_globalImgPath = "../../../components/select/imgs/";
	
	
    // creacion del combo tipo donacion
    donante = new dhtmlXCombo("cbo_donante","cbo_donante",250);
    donante.enableFilteringMode(true);	
    donante.loadXML("../actions/pago_combo_donantes.php?p0=", function(){});
    donante.attachEvent("onSelectionChange", function(){ LoadGridDonaciones(); });  

	
	    // creacion del combo tipo donacion
    mes = new dhtmlXCombo("cbo_mes","cbo_mes",125);
    mes.enableFilteringMode(true);	
    mes.loadXML("../actions/pago_combo_meses.php?p0=", function(){});
	mes.attachEvent("onBlur", ValidacionMes);

}



// validacion del combo Mes
function ValidacionMes() 
{

	if (mes.getSelectedValue()==null)
	{
		mes.setComboText('');
	}
    return true;
}


// funcion para guardar los registros
function SaveData()
{

		
        // verificamos q los parametros obligatorios esten llenos
        if(CheckParam())
        {
		
            // guardamos los parametros en un arreglo post
			
            var parameters = ""; 
			parameters = parameters + "?p0=" + idReg;
            parameters = parameters + "&p1=" + mygrid1.cells(mygrid1.getSelectedId(),0).getValue();
			parameters = parameters + "&p2=" + mygrid1.cells(mygrid1.getSelectedId(),1).getValue();
			parameters = parameters + "&p3=" + mygrid1.cells(mygrid1.getSelectedId(),2).getValue();
            parameters = parameters + "&p4=" + document.getElementById("fecha").value;
			parameters = parameters + "&p5=" + mes.getSelectedValue();
			parameters = parameters + "&p6=" + document.getElementById("monto").value;
			parameters = parameters + "&p7=" + document.getElementById("recibo").value;
			
			alert(parameters);
			
			
			
            if (idReg==0)
            {
                // si es nuevo entra aqui
                loader = dhtmlxAjax.post( "../actions/pago_save.php",encodeURI(parameters), function(){
                    ReadXml()
                } );
            }
            else
            {
                // si es un update entra aqui
                loader = dhtmlxAjax.post( "../actions/usuarios_update.php",encodeURI(parameters), function(){
                    ReadXml()
                } );
            }
			

        }
        else
        {
		
            // mensaje de llenar los campos obligatorios
            Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar los campos Obligatorios</td></tr></table>");
            Msjbox.show();
		
        }





}



// Campos Obligatorios.

function CheckParam()
{
    var Val = true
	
	
	
    if (document.getElementById('fecha').value == '')
	{
		Val = false;
	}
	
	if (document.getElementById('monto').value == '')
	{
		Val = false;
	}
	
	if (document.getElementById('recibo').value == '')
	{
		Val = false;
	}
	
	if (mes.getSelectedValue()==null)
	{
		Val = false;
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
	
    /*
	document.getElementById("usuario").value = mygrid.cells(mygrid.getSelectedId(),1).getValue();
	document.getElementById("contrasena").value = mygrid.cells(mygrid.getSelectedId(),2).getValue();
	document.getElementById("fechacad").value = mygrid.cells(mygrid.getSelectedId(),4).getValue();
	document.getElementById("pregunta").value = mygrid.cells(mygrid.getSelectedId(),5).getValue();
	document.getElementById("respuesta").value = mygrid.cells(mygrid.getSelectedId(),6).getValue();
	combo_perfil.setComboValue(mygrid.cells(mygrid.getSelectedId(),7).getValue());
	combo_status.setComboValue(mygrid.cells(mygrid.getSelectedId(),8).getValue());
	*/
	
    document.getElementById('frm_show').click();

}


// funcion para limpiar las cajas

function ClearParam(){



//document.getElementById("usuario").value = "";	
//combo_perfil.setComboText('');

	
	
}


// funcion para eliminar un registro
function DeleteData()
{


    var parameters = ""; 
    parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),0).getValue();

    if (idReg==0)
    {
    //loader = dhtmlxAjax.post( "../actions/usuarios_delete.php",encodeURI(parameters), function(){ReadXml()} );
    }
			
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
		
                
                
            
            
            case "Add_pago":
                
                if (xmlDoc.documentElement.childNodes[1].text=='0')
                    {
                        
                        MsjWait.show();
                        document.getElementById('frm_hide').click();
                        LoadGrid();
                        
                    }
                else
                    {
                        
                        if (xmlDoc.documentElement.childNodes[1].text == '1')
                        {
                            Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Existe Monto Pendiente en el Mes Anterior</td></tr></table>");
                            Msjbox.show();
                        }
                        
                        if (xmlDoc.documentElement.childNodes[1].text == '2')
                        {
                            Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;El Monto sobrepasa el pago de la Cuota </td></tr></table>");
                            Msjbox.show();
                        }

                    }
                        

				
				
                break;
                
            // si fue un insert
            case "Insert":
				
                MsjWait.show();
                document.getElementById('frm_hide').click();
                LoadGrid();
				
				
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
