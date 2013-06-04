
// Variables globales

var toolbar;
var mygrid;
var myCalendar;
var loader;

var idReg=0;
var idper=0;

// Funcion para cargar el menu
function doOnLoad() {

    // Creando nuevo objeto
    toolbar = new dhtmlXToolbarObject("toolbarObj");
    // Direccion de iconos
    toolbar.setIconsPath("../../../images/icons/");
    // xml a cargar, este es fijo en la direccion q aparece
    toolbar.loadXML("../../../components/toolbar/Control_Donacion.xml?etc=" + new Date().getTime());
	
	
    // Funcion cuando el usuario da click en el toolbar
    toolbar.attachEvent("onClick", function(id) {
	
        DoEvent(id);
	
    });
}


// Eventos al dar click en el toolbar
function DoEvent(data) {
	
	
    switch(data)
    {
	
        case "add":
		
            idReg=0;
            ClearParam()
            document.getElementById('frm_show').click();
            //document.getElementById('cbo_donate').focus();
			
            break;
		
		
        case "sol":

            document.location.href = "control_solicitud.php";
			
            break;
		
		
        case "save":
		
            SaveData();
            //Msjbox.show();
			
            break;
			
			
		case "edit_donacion":
		
            if(mygrid.getSelectedId())
            {
				idReg=0;
				idper=0;
				ClearParam()
				document.getElementById('frm_show').click();
				getDonacion();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }
			
            break;	

			
			
		case "edit_alumno":
		
            if(mygrid.getSelectedId())
            {
				idReg=0;
				idper=0;
				ClearParam()
				document.getElementById('Alu_show').click();
				getAlumno();
            }
            else
            {
                Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe Seleccionar Un Registro</td></tr></table>");
                Msjbox.show();
            }
			
            break;	
		
		
        case "can":
		
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
    mygrid.loadXML("../actions/donacion_grid.php",
        function()
        {
            // Para agregar los filtros del grid.
            mygrid.attachHeader(",,#text_filter,#text_filter,#text_filter,,,,");
            // finalizamos el mensaje de espere
            MsjWait.hide();
        }
        );
	
	
	
}


// funcion q carga los combos. perfil y estatus


var tipo_donacion;
var tipo_pago;
var genero;
var pais;
var municipio;
var promotor;
var alumno_bis;

function LoadCombos()
{

    // directorio de las imagenes del combo (no tocar)
    window.dhx_globalImgPath = "../../../components/select/imgs/";
	
    // creacion del combo tipo pago
    tipo_pago = new dhtmlXCombo("cbo_tipo_pago","cbo_tipo_pago",150);
    tipo_pago.enableFilteringMode(true);
    tipo_pago.loadXML("../actions/solicitud_combo_tipo_pago.php?p0=" , function(){});
    tipo_pago.readonly(1);
	
    // creacion del combo genero
    genero = new dhtmlXCombo("cbo_genero","cbo_genero",150);
    genero.enableFilteringMode(false);	
    genero.loadXML("../actions/solicitud_combo_genero.php?p0=" , function(){});
    genero.readonly(1);
	
	
	
    // creacion del combo pais
    pais = new dhtmlXCombo("cbo_pais","cbo_pais",150);
    pais.enableFilteringMode(true);	
    pais.loadXML("../actions/solicitud_combo_pais.php?p0=" , function(){});
    pais.attachEvent("onBlur", ValidarPais);
	

    // creacion del combo municipio
    municipio = new dhtmlXCombo("cbo_municipio","cbo_municipio",150);
    municipio.enableFilteringMode(true);	
    municipio.attachEvent("onBlur", ValidarMunicipio);
	
	
	
    // creacion del combo promotor
    promotor = new dhtmlXCombo("cbo_promotor","cbo_promotor",150);
    promotor.enableFilteringMode(true);	
    promotor.loadXML("../actions/solicitud_combo_promotor.php?p0=" , function(){});
    promotor.attachEvent("onBlur", ValidarPromotor);
	
	
	// Alumno 
    alumno_bis = new dhtmlXCombo("cbo_alumno_bis","cbo_alumno_bis",250);
    alumno_bis.enableFilteringMode(true);	
    //alumno_bis.loadXML("../actions/control_combo_alumno.php?p0=" , function(){});
	alumno_bis.attachEvent("onBlur", ValidacionAlumnoBis);		


}


function CargarMunicipio()
{

    municipio.loadXML("../actions/solicitud_combo_municipio.php?p0=" + pais.getSelectedValue(), function(){});

}


// validacion del combo Alumno_bis
function ValidacionAlumnoBis() {

	if (alumno_bis.getSelectedValue()==null)
	{
		alumno_bis.setComboText('');
	}
    return true;
}


// validacion del combo Pais

function ValidarPais() {

    if (pais.getSelectedValue()==null)
    {
        pais.setComboText('');
    }
    else
    {
        municipio.setComboText('');
        CargarMunicipio();
	
    }
    return true;
}


// validacion del combo Municipio

function ValidarMunicipio() {

    if (municipio.getSelectedValue()==null)
    {
        municipio.setComboText('');
    }
    return true;
}


function ValidarPromotor() {

    if (promotor.getSelectedValue()==null)
    {
        promotor.setComboText('');
    }
    return true;
}



function getDonacion()
{

    var parameters = ""; 
    parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
	
    loader = dhtmlxAjax.post( "../actions/solicitud_get_donacion.php",encodeURI(parameters), function(){
        ReadXml()
    } );
    MsjWait.show();


}


function getAlumno()
{

    var parameters = ""; 
    parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
	
    loader = dhtmlxAjax.post( "../actions/solicitud_get_alumno.php",encodeURI(parameters), function(){
        ReadXml()
    } );
	
    //MsjWait.show();


}


function CancelarDonacion()
{

    var parameters = ""; 
    parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
	
    loader = dhtmlxAjax.post( "../actions/donacion_cancelar.php",encodeURI(parameters), function(){
        ReadXml()
    } );
    MsjWait.show();


}


function AsignarAlumno()
{


	
	if (alumno_bis.getSelectedValue() != null)
	{
        var parameters = ""; 
        parameters = parameters + "?p0=" + mygrid.cells(mygrid.getSelectedId(),1).getValue();
        parameters = parameters + "&p1=" + alumno_bis.getSelectedValue();
		
		
        MsjWait.show();
        loader = dhtmlxAjax.post( "../actions/control_solicitud_aprobar_bis.php",encodeURI(parameters), function(){ ReadXml() } );
		
	}	
	else
	{
		// mensaje de llenar los campos obligatorios
        Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar el Campo Alumno</td></tr></table>");
        Msjbox.show();
	
	}

}




// funcion para guardar los registros
function SaveData()
{

    try
    {

        // verificamos q los parametros obligatorios esten llenos
        if(CheckParam())
        {
		
            // guardamos los parametros en un arreglo post
			
            var parameters = ""; 
            parameters = parameters + "?p0=" + idReg;
            parameters = parameters + "&p1=" + document.getElementById("nombre").value;
            parameters = parameters + "&p2=" + document.getElementById("apellido1").value;
            parameters = parameters + "&p3=" + document.getElementById("apellido2").value;
            parameters = parameters + "&p4=" + document.getElementById("direccion").value;
            parameters = parameters + "&p5=" + municipio.getSelectedValue();
            parameters = parameters + "&p6=" + pais.getSelectedValue();
            parameters = parameters + "&p7=" + document.getElementById("telefono_casa").value;
            parameters = parameters + "&p8=" + document.getElementById("telefono_movil").value;
            parameters = parameters + "&p9=" + document.getElementById("telefono_trabajo").value;
            parameters = parameters + "&p10=" + document.getElementById("nit").value;
            parameters = parameters + "&p11=" + document.getElementById("fecha_nac").value;
            parameters = parameters + "&p12=" + genero.getSelectedValue();
            parameters = parameters + "&p13=" + document.getElementById("correo").value;

            parameters = parameters + "&p14=" + tipo_pago.getSelectedValue();
            parameters = parameters + "&p15=" + document.getElementById("monto").value;
            parameters = parameters + "&p16=" + promotor.getSelectedValue();
            parameters = parameters + "&p17=" + idper
	

			// si es un update entra aqui
			
			loader = dhtmlxAjax.post( "../actions/solicitud_donante_update.php",encodeURI(parameters), function(){
				ReadXml()
                } );

			MsjWait.show();
        }
        else
        {
		
            // mensaje de llenar los campos obligatorios
            Msjbox.setBody("<table><tr><td><img src='../../../images/icons/close.gif' align='middle'></td><td>&nbsp;&nbsp;Debe llenar los campos Obligatorios</td></tr></table>");
            Msjbox.show();
		
        }

    }
    catch(err)
    {

        alert(err.message );
		
    }



}


// Verificar los Campos Obligatorios

function CheckParam()
{
    var Val = true;
	
    if (document.getElementById('nombre').value == '')
    {
        Val = false;
    }
	
    if (document.getElementById('apellido1').value == '')
    {
        Val = false;
    }
	
    if (document.getElementById('direccion').value == '')
    {
        Val = false;
    }
	
	
    if (document.getElementById('fecha_nac').value == '')
    {
        Val = false;
    }
	
    if (document.getElementById('nit').value == '')
    {
        Val = false;
    }
	
    if (document.getElementById('monto').value == '')
    {
        Val = false;
    }
	
    if (pais.getSelectedValue()=='null' && pais.getSelectedValue()=='')
    {
        Val = false;
    }
	
    if (genero.getSelectedValue()=='null' && genero.getSelectedValue()=='')
    {
        Val = false;
    }
	
    if (tipo_pago.getSelectedValue()=='null' && tipo_pago.getSelectedValue()=='')
    {
        Val = false;
    }
	
    if (promotor.getSelectedValue()=='null' && promotor.getSelectedValue()=='')
    {
        Val = false;
    }
	
	
	
    return Val;

}




// funcion para limpiar las cajas

function ClearParam()
{

    document.getElementById("nombre").value = '';
    document.getElementById("apellido1").value = '';
    document.getElementById("apellido2").value = '';
    document.getElementById("direccion").value = '';
    municipio.setComboText('');
    pais.setComboText('');
    document.getElementById("telefono_casa").value = '';
    document.getElementById("telefono_movil").value = '';
    document.getElementById("telefono_trabajo").value = '';
    document.getElementById("nit").value = '';
    document.getElementById("fecha_nac").value = '';
    genero.setComboText('');
    document.getElementById("correo").value = '';
    tipo_pago.setComboText('');
    document.getElementById("monto").value = '30.00';
    promotor.setComboText('');
	
	
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
				
				
                break;
		
		
            // si fue un update
            case "Update":
			
				
                
                document.getElementById('frm_hide').click();
                LoadGrid();
				MsjWait.hide();
				
			
                break;
			
			
            // si fue un delete
            case "Delete":
			
				
                MsjWait.show();
                document.getElementById('msj_hide').click();
                LoadGrid();
				
			
				break;
				
			
			case "get_alumno":
			
				
				alumno_bis.loadXML("../actions/control_combo_alumno.php?p0="+ xmlDoc.documentElement.childNodes[1].text , function(){});
				
				MsjWait.hide();
			
				break;
			
				
				
            case "get_donacion":
			
                document.getElementById("nit").value = xmlDoc.documentElement.childNodes[1].text
                idper = xmlDoc.documentElement.childNodes[2].text;
                document.getElementById("nombre").value = xmlDoc.documentElement.childNodes[3].text;
                document.getElementById("apellido1").value = xmlDoc.documentElement.childNodes[4].text;
                document.getElementById("apellido2").value = xmlDoc.documentElement.childNodes[5].text;
                document.getElementById("direccion").value = xmlDoc.documentElement.childNodes[6].text;
                pais.loadXML("../actions/solicitud_combo_pais.php?p0=" + xmlDoc.documentElement.childNodes[7].text , function(){});
                municipio.getSelectedValue();
                document.getElementById("fecha_nac").value = xmlDoc.documentElement.childNodes[9].text;
                document.getElementById("telefono_casa").value = xmlDoc.documentElement.childNodes[10].text;
                document.getElementById("telefono_movil").value = xmlDoc.documentElement.childNodes[11].text;
                document.getElementById("telefono_trabajo").value = xmlDoc.documentElement.childNodes[12].text;
                genero.loadXML("../actions/solicitud_combo_genero.php?p0="+xmlDoc.documentElement.childNodes[13].text , function(){});
                document.getElementById("correo").value= xmlDoc.documentElement.childNodes[14].text;
                tipo_pago.loadXML("../actions/solicitud_combo_tipo_pago.php?p0="+xmlDoc.documentElement.childNodes[15].text , function(){});
                document.getElementById("monto").value = xmlDoc.documentElement.childNodes[16].text;
                promotor.loadXML("../actions/solicitud_combo_promotor.php?p0="+xmlDoc.documentElement.childNodes[17].text , function(){});
                idReg = xmlDoc.documentElement.childNodes[18].text;
					

                MsjWait.hide();
				
                document.getElementById("nombre").focus();
			
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

				case "Cancelar":
				
				
					LoadGrid();
					document.getElementById('msj_hide').click();
					MsjWait.hide();
					
					
					
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
    CancelarDonacion();
};
var RegDel_Cancel = function() {
    document.getElementById('msj_hide').click();
};	

var AluNew_Submit = function() {
    AsignarAlumno();
};
var AluNew_Cancel = function() {
    document.getElementById('Alu_hide').click();
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
            width : "68em", 
            fixedcenter : true, 
            visible : false, 
            modal: true, 
            constraintoviewport : true, 
            buttons : [ {
                text:"Guardar", 
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
