
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
    toolbar.loadXML("../../../components/toolbar/Control_Solicitud_Apr.xml?etc=" + new Date().getTime());
	
	
    // Funcion cuando el usuario da click en el toolbar
    toolbar.attachEvent("onClick", function(id) {
	
        DoEvent(id);
	
    });
}


// Eventos al dar click en el toolbar
function DoEvent(data) {
	
	
    switch(data)
    {
	
        case "apr":
			
            if(mygrid.getSelectedId())
            {
				ExisteUsuario();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }			
			 
            break;
		
		
        case "rec":

			
            RechazarSolicitud();
			 
            break;
		
		
		
        case "dona":

            document.location.href = "donacion.php";
			
            break;
		
		

		
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
    mygrid.loadXML("../actions/control_solicitud_grid.php",
        function()
        {
            // Para agregar los filtros del grid.
            mygrid.attachHeader(",,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );
	
	
	
}


// funcion q carga los combos. perfil y estatus


var alumno;
var alumno_bis;
	

function LoadCombos()
{

    // directorio de las imagenes del combo (no tocar)
    window.dhx_globalImgPath = "../../../components/select/imgs/";
	
	
    // creacion del combo tipo donacion
    alumno = new dhtmlXCombo("cbo_alumno","cbo_alumno",250);
    alumno.enableFilteringMode(true);	
    alumno.loadXML("../actions/control_combo_alumno.php?p0=" , function(){});
	alumno.attachEvent("onBlur", ValidacionAlumno);
	
	
    alumno_bis = new dhtmlXCombo("cbo_alumno_bis","cbo_alumno_bis",250);
    alumno_bis.enableFilteringMode(true);	
    alumno_bis.loadXML("../actions/control_combo_alumno.php?p0=" , function(){});
	alumno_bis.attachEvent("onBlur", ValidacionAlumnoBis);	
	
}



// validacion del combo Alumno
function ValidacionAlumno() {

	if (alumno.getSelectedValue()==null)
	{
		alumno.setComboText('');
	}
    return true;
}

// validacion del combo Alumno_bis
function ValidacionAlumnoBis() {

	if (alumno_bis.getSelectedValue()==null)
	{
		alumno_bis.setComboText('');
	}
    return true;
}



function AprobarSolicitud()
{


    if (mygrid.getSelectedId())
    {
        var parameters = ""; 
        parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
        parameters = parameters + "&p1=2";
		
        MsjWait.show();
		
        loader = dhtmlxAjax.post( "../actions/control_solicitud_aprobar.php",encodeURI(parameters), function(){
            ReadXml()
        } );

		
    }


}


function RechazarSolicitud()
{


    if (mygrid.getSelectedId())
    {
        var parameters = ""; 
        parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
        parameters = parameters + "&p1=6";
		
        MsjWait.show();
		
        loader = dhtmlxAjax.post( "../actions/control_solicitud_rechazar.php",encodeURI(parameters), function(){
            ReadXml()
        } );

		
    }


}



function AsignarAlumno()
{

	if (alumno.setComboText() != '')
	{
        var parameters = ""; 
        parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
        parameters = parameters + "&p1=" + alumno_bis.getSelectedValue();
		
        MsjWait.show();
        loader = dhtmlxAjax.post( "../actions/control_solicitud_aprobar_bis.php",encodeURI(parameters), function(){ ReadXml() } );
		
	}	

}

// funcion para guardar los registros
function SaveData()
{


    // verificamos q los parametros obligatorios esten llenos
    if(CheckParam())
    {
	
		if (document.getElementById('contrasena').value == document.getElementById("confirmar").value)
		{
		
			var parameters = ""; 
			parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
			parameters = parameters + "&p1=" + document.getElementById("usuario").value;
			parameters = parameters + "&p2=" + document.getElementById("contrasena").value;
			parameters = parameters + "&p3=" + alumno.getSelectedValue();
			
			//MsjWait.show();
			
			loader = dhtmlxAjax.post( "../actions/control_solicitud_aprobar.php",encodeURI(parameters), function(){ ReadXml() } );
		
		}
		else
		{
		
			Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Los campos Contrasenia deben ser Iguales</td></tr></table>");
			Msjbox.show();
		}

        
    }
    else
    {
	
        // mensaje de llenar los campos obligatorios
        Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar los campos Obligatorios</td></tr></table>");
        Msjbox.show();
	
    }


}


function ExisteUsuario()
{

	var parameters = ""; 
	parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
	
	//MsjWait.show();
	
	loader = dhtmlxAjax.post( "../actions/control_existe_usuario.php",encodeURI(parameters), function(){ ReadXml() } );


}


// Campos Obligatorios.

function CheckParam()
{
    var Val = true
	
	
	
    if (document.getElementById('usuario').value == '')
    {
        Val = false;
    }
	
    if (document.getElementById('contrasena').value == '')
    {
        Val = false;
    }
	
    if (document.getElementById('confirmar').value == '')
    {
        Val = false;
    }	
	
    if ( alumno.getSelectedValue() == '' || alumno.getSelectedValue() == null)
    {
        Val = false;
    }
	
    return Val;

}


// funcion para limpiar las cajas

function ClearParam(){


	document.getElementById('usuario').value = '';
	document.getElementById("contrasena").value = '';	
	document.getElementById("confirmar").value = '';	
	alumno.setComboText('');
	
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
		
			
			
            // si fue un insert
            case "Estado":
				
                document.getElementById('frm_hide').click();
                LoadGrid();
                MsjWait.hide();
				
				
                break;
				
            case "Estado_bis":
				
				if (xmlDoc.documentElement.childNodes[1].text == 0)
				{
					document.getElementById('Alu_hide').click();
					LoadGrid();
					MsjWait.hide();
				}
				else
				{
					Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;El Donante ya tiene Asociado a Este Alumno</td></tr></table>");
					Msjbox.show();
					MsjWait.hide();
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
			
			
			case "existe_usuario":
			
			
				if (xmlDoc.documentElement.childNodes[1].text!='')
				{
					document.getElementById('Alu_show').click();
					MsjWait.hide();
				}
				else
				{
					idReg=0;
					ClearParam()
					document.getElementById('frm_show').click();
					document.getElementById('usuario').focus();
				}
				


				
			
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


var AluNew_Submit = function() {
    AsignarAlumno();
};
var AluNew_Cancel = function() {
    document.getElementById('Alu_hide').click();
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
            width : "40em", 
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
		
		
		
        // Fromulario Para Asignar Alumno. ************************
		
        FormRegistro = new HBI.widget.Dialog("AluNew", {
            width : "40em", 
            fixedcenter : true, 
            visible : false, 
            modal: true, 
            constraintoviewport : true, 
            buttons : [ {
                text:"Aceptar", 
                handler:AluNew_Submit, 
                isDefault:true
            }, {
                text:"Cancelar", 
                handler:AluNew_Cancel
            } ]
        });
        FormRegistro.render();
        HBI.util.Event.addListener("Alu_show", "click", FormRegistro.show, FormRegistro, true);
        HBI.util.Event.addListener("Alu_hide", "click", FormRegistro.hide, FormRegistro, true);		
		
		
		
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
